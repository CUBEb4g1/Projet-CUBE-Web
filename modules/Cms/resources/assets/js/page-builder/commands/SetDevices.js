export default [
	{
		id: 'set-device-desktop',
		run: editor => editor.setDevice('Desktop')
	},{
		id: 'set-device-xs-desktop',
		run: editor => editor.setDevice('XSDesktop')
	}, {
		id: 'set-device-tablet',
		run: editor => editor.setDevice('Tablet')
	},  {
		id: 'set-device-xs-tablet',
		run: editor => editor.setDevice('XSTablet')
	}, {
		id: 'set-device-mobile',
		run: editor => editor.setDevice('Mobile')
	}
]
