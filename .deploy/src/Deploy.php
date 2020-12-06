<?php

/**
 * Le but de cette classe est d'être étendue pour pouvoir surcharger la méthode deploy()
 *
 * Les configs sont modifiables en ajoutant un fichier config.json qui retourne un tableau php
 * comportant les configs à changer
 *
 * @version 1.0.0
 *
 * @author Alexis Weber
 */
abstract class Deploy
{
	protected $config = [
		// Activer le déploiement
		'enabled' => true,
		// Enregistrer dans un dossier l'output des commandes executées
		'logs'    => true,
	];

	protected $configPath = __DIR__.'/config.json';

	protected $logs = [];

	protected $logsDir = __DIR__.'/logs';

	protected $workingDir = null;

	public function __construct()
	{
		$this->mergeConfig();
	}

	/**
	 * Executer le déploiement
	 */
	public function run()
	{
		if ($this->config['enabled'] === true) {
			// Dans le log écrire la date d'exécution du déploiement
			$this->logs[] = date('Y-m-d H:i:s');

			// Se placer à la racine du projet
			if ($this->workingDir !== null) {
				chdir($this->workingDir);
			}

			// Lancer le déploiement
			echo "=== Start of deploy, it may take some times ===\n";
			$this->deploy();
			echo "=== End of deploy, see the logs for more info ===\n";

			if ($this->config['logs'] === true) {
				$this->storeLogs();
			}
		} else {
			echo "The deployment is disabled";
		}
	}

	/**
	 * Commandes et directives à effectuer pour déployer le site
	 */
	protected function deploy()
	{
		//...
	}

	/**
	 * Enregistrer les logs dans un fichier
	 */
	protected function storeLogs()
	{
		// Créer le dossier si non existant
		if (!file_exists($this->logsDir)) {
			mkdir($this->logsDir);
		}

		// Ajouter au fichier de log
		$todayLogName = 'deploy-'.date('Y-m-d').'.log';
		file_put_contents($this->logsDir.'/'.$todayLogName, "\n".implode("\n", $this->logs)."\n", FILE_APPEND);

		// Supprimer les anciens logs
		foreach (glob($this->logsDir.'/deploy-*') as $file) {
			if (basename($file) !== $todayLogName) {
				@unlink($file);
			}
		}
	}

	/**
	 * Utiliser la fonction exec() native, mais en loguant dans un fichier les outputs des commandes
	 *
	 * @param $command
	 *
	 * @see exec()
	 */
	protected function execAndLog($command)
	{
		// Afficher la cmd
		echo "- ".$command."\n";
		// Ajouter au log la cmd
		$this->logs[] = 'exec => '.$command;

		// Executer la cmd
		exec($command.' 2>&1', $this->logs, $return_var);
	}

	/**
	 * Récupérer les configs du fichier config.json si existant et les merger aux configs par défaut
	 */
	protected function mergeConfig()
	{
		$fileConfig   = file_exists($this->configPath) ? json_decode(file_get_contents($this->configPath), true) : [];
		$this->config = array_merge($this->config, $fileConfig);
	}
}
