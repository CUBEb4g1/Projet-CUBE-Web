import { __ } from '../lang/I18n'

const Desktop = function () {
	return {
		id: 'device-desktop',
		label: '<i class="fad fa-laptop"></i>',
		attributes: { title: __('devices.desktop'), style: 'font-size: 18px' },
		command: 'set-device-desktop',
		togglable: false,
		active: true,
	}
};

const XSDesktop = function () {
	return {
		id: 'device-xs-desktop',
		label: '<i class="fad fa-laptop" style="font-size: 70%;"></i>',
		attributes: { title: __('devices.desktop'), style: 'font-size: 18px' },
		command: 'set-device-xs-desktop',
		togglable: false,
		active: true,
	}
};

const Tablet = function () {
	return {
		id: 'device-tablet',
		label: '<i class="fad fa-tablet-alt"></i>',
		attributes: { title: __('devices.tablet'), style: 'font-size: 16px' },
		command: 'set-device-tablet',
		togglable: false,
	}
};

const XSTablet = function () {
	return {
		id: 'device-xs-tablet',
		label: '<i class="fad fa-tablet-alt" style="font-size: 70%;"></i>',
		attributes: { title: __('devices.tablet'), style: 'font-size: 16px' },
		command: 'set-device-xs-tablet',
		togglable: false,
	}
};

const Mobile = function () {
	return {
		id: 'device-mobile',
		label: '<i class="fad fa-mobile-alt"></i>',
		attributes: { title: __('devices.mobile'), style: 'font-size: 14px' },
		command: 'set-device-mobile',
		togglable: false,
	}
};

export { Desktop, XSDesktop, Tablet, XSTablet, Mobile };
