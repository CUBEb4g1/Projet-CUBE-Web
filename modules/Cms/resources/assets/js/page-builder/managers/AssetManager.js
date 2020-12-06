import { config } from '../config'
import { __ } from '../lang/I18n'

export default {
	// Configuration pour l'instanciantion du AssetManager de GrapesJs
	getConfig: _ => {
		return {
			upload: config.fileUpload,
			headers: {
				'X-CSRF-TOKEN': APP.csrf_token
			},
			uploadText: __('assets.drag_and_drop'),
			addBtnText: __('assets.add_image'),
			modalTitle: __('assets.select_image'),
		}
	},
	// Charger les fichiers déjà uploadés
	loadFiles: editor => {
		const httpRequest  = new XMLHttpRequest(),
			  assetManager = editor.AssetManager;

		httpRequest.open('GET', config.getUploads, true);
		httpRequest.setRequestHeader('X-CSRF-TOKEN', APP.csrf_token);
		httpRequest.send();

		httpRequest.onreadystatechange = function () {
			if (httpRequest.readyState === XMLHttpRequest.DONE) {
				if (httpRequest.status === 200) {
					const files = JSON.parse(httpRequest.responseText);

					files.forEach(function (file) {
						assetManager.add(file);
					});
				} else {
					console.error('An error occured. The files for the AssetManager could not been loaded.');
				}
			}
		};
	}
}
