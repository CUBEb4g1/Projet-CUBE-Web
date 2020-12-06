import { __ } from '../lang/I18n'

export default () => {
	const Titles = {};

	for (var i = 2; i <= 6; i++) {
		// Pour éviter des prbl de SEO, les titres sont toujours présentés 1 niveau au dessus de son réel niveau
		// Par ex., une balise présentée comme "h1", est en réalité une balise "h2"
		const fakeTitle = i - 1;

		Titles['H' + i] = {
			id: 'h' + i,
			label: '<i class="far fa-h' + fakeTitle + ' fa-4x"></i><div>' + __('blocks.title') + ' ' + fakeTitle + '</div>',
			category: __('blocks.essential'),
			content: {
				name: __('blocks.level_title') + ' ' + fakeTitle,
				type: 'text',
				tagName: 'h' + i,
				classes: 'h-title cms-title',
				content: __('blocks.title_default'),
				activeOnRender: true,
			},
		}
	}

	return Titles;
}
