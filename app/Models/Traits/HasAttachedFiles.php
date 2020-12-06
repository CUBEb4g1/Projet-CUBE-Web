<?php

namespace App\Models\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Exception\NotReadableException;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as InterventionImage;

/**
 * Trait HasAttachedFiles
 */
trait HasAttachedFiles
{
	protected $oldAttachedFiles = [];

	/**
	 * Fichiers à attacher aux attributs du Model
	 * Voir l'exemple présent dans la fonction
	 *
	 * @return array
	 */
	public function attachedFiles()
	{
		return [
//			'image' => [
//				'name'       => 'acme-' . $this->id,
//				'path'       => 'foo/bar/' . $this->user_id,
//				'thumbnails' => ['xs' => 20, 'sm' => 50, 'md' => 100],
//			],
		];
	}

	/**
	 * Booting du Trait
	 */
	public static function bootHasAttachedFiles()
	{
		// Mettre en mémoire les anciens fichiers si modification du Model
		static::updating(function ($model) {
			/** @var HasAttachedFiles $model */
			foreach ($model->attachedFiles() as $attribute => $info) {
				$model->oldAttachedFiles[$attribute] = $model->original[$attribute] ?? null;
			}
		});

		// A la suppression d'un model, supprimer toutes les images attachées
		static::deleted(function ($model) {
			/** @var HasAttachedFiles $model */
			foreach ($model->attachedFiles() as $attribute => $info) {
				$model->deleteAttachedFile($attribute);
			}
		});
	}

	/**
	 * Uploader un fichier attaché à un attribut
	 * Génère des thumbnails si précisé dans attachedFiles()
	 *
	 * @param string $attribute
	 * @param UploadedFile|InterventionImage $file
	 * @param string|null $extension
	 *
	 * @return bool|null
	 */
	public function attachFile(string $attribute, $file = null, string $extension = null)
	{
		if ($file === null) {
			return null;
		} elseif (!in_array(get_class($file), [UploadedFile::class, InterventionImage::class])) {
			throw new \InvalidArgumentException('The $file parameter should be of the type ' . UploadedFile::class . ' or ' . InterventionImage::class);
		}

		// Récupérer les infos du fichier envoyé
		$name        = $this->attachedFiles()[$attribute]['name'];
		$path        = $this->attachedFiles()[$attribute]['path'];
		$thumbnails  = $this->attachedFiles()[$attribute]['thumbnails'] ?? null;
		$extension   = $extension ?? (is_a($file, UploadedFile::class) ? $file->guessExtension() : 'jpg');
		$nameWithExt = $name . '.' . $extension;
		$errors      = [];

		// Si l'image est directement de la classe InterventionImage, ou qu'elle est de UploadedFile et est valide
		if (is_a($file, InterventionImage::class) || ($file->isValid())) {
			// Supprimer l'ancien fichier
			if ($this->oldFileVersionExists($attribute)) {
				$this->deleteAttachedFile($attribute, true);
			}

			try {
				// En local, WSL jette l'erreur "chmod(): Operation not permitted", passer l'erreur sous silence
				// le temps de trouver un fix
				if (is_a($file, UploadedFile::class)) {
					@Storage::disk('public')->putFileAs($path, $file, $nameWithExt);
				} else {
					@Storage::disk('public')->put($path . '/' . $nameWithExt, $file->encode($extension));
				}
			} catch (\Exception $e) {
				$errors[] = $e->getMessage();
			}

			$this->{$attribute} = $path . '/' . $nameWithExt;
			$this->save();

			// Si précisé que besoin d'avoir des miniatures
			if ($thumbnails !== null && in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
				foreach ($thumbnails as $thumbnail => $size) {
					// Pourquoi clone : Si déjà une instance de InterventionImage, éviter de réutiliser le même objet quand resize()
					// Autrement c'est toujours le même resize qui est appliqué quelque soit la thumbnail
					try {
						$image = clone Image::make($file);
					} catch (NotReadableException $exception) {
						// Si le fichier n'est pas une image, Intervention l'informe en renvoyant une erreur
						// Stopper la boucle et la génération de miniatures
						break;
					}

					if (is_array($size)) {
						$w = $size[0];
						$h = $size[1] ?? $size[0]; // Si un array mais qu'avec une seule entrée
					} else {
						$w = $h = $size;
					}

					$image->resize($w, $h, function (Constraint $constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					})->encode($extension);

					try {
						Storage::disk('public')->put($path . '/' . $name . '-' . $thumbnail . '.' . $extension, $image);
					} catch (\Exception $e) {
						$errors[] = $e->getMessage();
					}
				}
			}
		} else {
			$errors[] = 'The file seems to be corrupted.';
		}

		return true;
	}

	/**
	 * Supprimer les fichiers attachés à un attribut
	 *
	 * @param string $attribute
	 * @param bool $isOldFile
	 */
	public function deleteAttachedFile(string $attribute, bool $isOldFile = false)
	{
		$path         = $this->attachedFiles()[$attribute]['path'];
		$thumbnails   = $this->attachedFiles()[$attribute]['thumbnails'] ?? null;
		$fileToDelete = $isOldFile === false ? $this->{$attribute} : $this->oldAttachedFiles[$attribute];

		// Supprimer le fichier de base
		Storage::disk('public')->delete($fileToDelete);

		// Supprimer des thumbnails si existantes
		if ($thumbnails !== null) {
			foreach ($thumbnails as $thumbnail => $size) {
				Storage::disk('public')->delete($this->getThumbnailStoragePath($attribute, $thumbnail, $isOldFile));
			}
		}

		// Supprimer le dossier si vide
		if (empty(Storage::disk('public')->allFiles($path))) {
			Storage::disk('public')->deleteDirectory($path);
		}
	}

	/**
	 * Récupérer le lien de la thumbnail d'une image
	 *
	 * @see getThumbnailStoragePath()
	 *
	 * @param string $attribute
	 * @param string $thumbnail
	 *
	 * @return string
	 */
	public function getThumbnail(string $attribute, string $thumbnail)
	{
		return 'storage/' . $this->getThumbnailStoragePath($attribute, $thumbnail);
	}

	/**
	 * Récupérer le lien du fichier
	 *
	 * @param string $attribute
	 *
	 * @return string
	 */
	public function getAttachedFile(string $attribute)
	{
		return 'storage/' . $this->{$attribute};
	}

	/**
	 * Retourne la thumbnail d'une image
	 *
	 * @internal
	 *
	 * @param string $attribute
	 * @param string $thumbnail
	 * @param bool $isOldFile
	 *
	 * @return string
	 */
	final private function getThumbnailStoragePath(string $attribute, string $thumbnail, bool $isOldFile = false)
	{
		$filePath      = $isOldFile === false ? $this->{$attribute} : $this->oldAttachedFiles[$attribute];
		$extensionPart = strrchr($filePath, '.');
		$filePathPart  = str_replace($extensionPart, '', $filePath);

		return $filePathPart . '-' . $thumbnail . $extensionPart;
	}

	/**
	 * Existe t-il une ancienne version du fichier attaché à l'attribut donné
	 *
	 * @internal
	 *
	 * @param string $attribute
	 *
	 * @return bool
	 */
	final private function oldFileVersionExists(string $attribute)
	{
		return array_key_exists($attribute, $this->oldAttachedFiles) && $this->oldAttachedFiles[$attribute] !== null;
	}
}
