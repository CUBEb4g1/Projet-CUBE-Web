let config = {
	lang: 'en',
	styles: [],
	urlStore: null,
	urlLoad: null,
	fileUpload: null,
	getUploads: null,
	textEntryOnly: false,
};

function mergeToConfig (settings) {
	config = { ...config, ...settings };
}

export { config, mergeToConfig };
