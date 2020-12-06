import { config } from '../config'

export default function () {
	return {
		type: 'remote',
		autosave: config.urlStore !== null,
		stepsBeforeSave: 10,
		urlStore: config.urlStore,
		urlLoad: config.urlLoad,
		params: {},
		headers: {
			'X-CSRF-TOKEN': APP.csrf_token
		}
	};
}
