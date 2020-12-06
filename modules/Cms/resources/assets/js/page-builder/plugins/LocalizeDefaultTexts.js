/**
 * Certains textes générés GrapesJs par défaut sont en anglais
 * Les traduire
 *
 * @param editor
 */
export default (editor) => {
	editor.DomComponents.addType('link', {
		model: {
			defaults: {
				traits: [
					{ type: 'text', label: 'Titre au survol', name: 'title' },
					{ type: 'text', label: 'URL du lien', name: 'href' },
					{
						type: 'select',
						label: 'Ouvrir dans',
						name: 'target',
						options: [
							{ value: '', name: 'La même page' },
							{ value: '_blank', name: 'Un nouvel onglet' }
						]
					},
				]
			}
		}
	});
}
