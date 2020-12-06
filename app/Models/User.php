<?php

namespace App\Models;

use App\Models\Traits\HasAttachedFiles;
use App\Models\Traits\HasSettings;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, HasLocalePreference
{
	use HasAttachedFiles;
	use HasFactory;
	use HasRoles;
	use HasSettings;
	use Notifiable;

	protected $fillable = [
		'username', 'email', 'firstname', 'lastname', 'password',
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function attachedFiles()
	{
		return [
			'avatar' => [
				'name'       => 'user-'.$this->id.'-'.uniqid(),
				'path'       => 'avatars',
				'thumbnails' => ['xs' => 150, 'sm' => 300],
			],
		];
	}

	public function defaultSettings()
	{
		return [
			'locale' => config('app.locale'),
		];
	}

	public function preferredLocale()
	{
		return $this->settings['locale'];
	}

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

	/**
	 * Ajouter une clause whereHas pour chercher une permission à travers les Role ou directement assignée via
	 * une Permission en utilisant le package spatie/laravel-permission
	 *
	 * @link https://github.com/spatie/laravel-permission
	 *
	 * @param Builder $query
	 * @param string $permission
	 *
	 * @return Builder|static
	 */
	public function scopeWhereHasPermissionTo(Builder $query, string $permission)
	{
		return $query->where(function (Builder $query) use ($permission) {
			$query->whereHas('roles', function (Builder $query) use ($permission) {
				$query->whereHas('permissions', function (Builder $query) use ($permission) {
					$query->where('name', $permission);
				});
			})->orWhereHas('permissions', function (Builder $query) use ($permission) {
				$query->where('name', $permission);
			});
		});
	}

	/*
	|--------------------------------------------------------------------------
	| EVENTS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| ACCESSORS & MUTATORS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| GETTERS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Basé sur la fonction getAllPermissions() du package spatie/laravel-permission
	 * Plus performant car n'execute qu'une seule requête
	 *
	 * @return Collection|Permission[]
	 * @link https://github.com/spatie/laravel-permission#usage
	 *
	 * @see HasPermissions::getAllPermissions()
	 */
	public function getAllUserPermissions()
	{
		return Permission::whereHas('roles', function (Builder $query) {
			$query->whereHas('users', function (Builder $query) {
				$query->where('id', $this->id);
			});
		})->orWhereHas('users', function (Builder $query) {
			$query->where('id', $this->id);
		})->get();
	}

	/**
	 * Retourne l'avatar de l'utilisateur
	 * Si aucun existant, retourne un avatar par défaut
	 *
	 * @param string|null $thumbnail
	 *
	 * @return string
	 */
	public function getAvatar(string $thumbnail = null)
	{
		if ($this->avatar !== null) {
			if ($thumbnail !== null) {
				return $this->getThumbnail('avatar', $thumbnail);
			} else {
				return $this->getAttachedFile('avatar');
			}
		} else {
			return 'media/avatars/default.jpg';
		}
	}

	/**
	 * Retourne les initiales du prénom-nom si existants, sinon les 2 premières lettres du prénom, sinon celles du username
	 *
	 * @return bool|string
	 */
	public function getInitials()
	{
		if (!empty($this->firstname) && !empty($this->lastname)) {
			$initials = substr($this->firstname, 0, 1).substr($this->lastname, 0, 1);
		} elseif (!empty($this->firstname)) {
			$initials = substr($this->firstname, 0, 2);
		} else {
			$initials = substr($this->username, 0, 2);
		}

		return strtoupper($initials);
	}

	/**
	 * Retourne le nom prénom formaté en ucfirst ou le username
	 *
	 * @return string
	 */
	public function getFullName()
	{
		if ($this->firstname !== null || $this->lastname !== null) {
			return trim(ucfirst(strtolower($this->firstname)).' '.ucfirst(strtolower($this->lastname)));
		} else {
			return null;
		}
	}

	/**
	 * Retourne le nom prénom formaté du genre DUPONT Pierre
	 *
	 * @return string
	 */
	public function getAdministrativeFullName()
	{
		if ($this->lastname !== null || $this->firstname !== null) {
			return trim(Str::upper(mb_strtolower($this->lastname)).' '.Str::ucfirst(mb_strtolower($this->firstname)));
		} else {
			return null;
		}
	}

	/*
	|--------------------------------------------------------------------------
	| LOGIC FUNCTIONS
	|--------------------------------------------------------------------------
	*/
}
