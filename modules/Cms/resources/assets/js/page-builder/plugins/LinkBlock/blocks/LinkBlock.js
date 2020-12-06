import { __ } from '../../../lang/I18n'

export default () => {
	return {
		id: 'link-block',
		label: '<span class="fa-stack fa-2x"><i class="fal fa-square fa-stack-2x"></i><i class="far fa-link fa-stack-1x"></i></span><div>' + __('blocks.link_block') + '</div>',
		category: __('blocks.essential'),
		content: {
			type: 'link-block',
		},
	}
}
