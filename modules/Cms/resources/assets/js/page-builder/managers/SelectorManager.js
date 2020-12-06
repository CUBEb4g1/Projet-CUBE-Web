import { __ } from '../lang/I18n'

export default function () {
	return {
		statesLabel: '- '+__('states.state')+' -',

		selectedLabel: __('states.selected'),

		// States
		states: [
			{ name: 'hover', label: __('states.hover') },
			{ name: 'active', label: __('states.active') },
			{ name: 'nth-of-type(2n)', label: __('states.even_odd') }
		],
	}
}
