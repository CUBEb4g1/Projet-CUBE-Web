// Config
import { config, mergeToConfig } from '../config';
// I18n
import { __, setLocale } from '../lang/I18n';
// Libs
import grapesjs from 'grapesjs';
import toastr from 'toastr';
// Blocks
import ContainerBlock from '../blocks/Bootstrap/Container'
import ImageBlock from '../plugins/Figure/blocks/Figure'
import LinkBlock from '../plugins/LinkBlock/blocks/LinkBlock'
import LineBreakBlock from '../blocks/LineBreak'
import SimpleBlock from '../blocks/Block'
import TextBlock from '../blocks/Text'
import TitlesBlocks from '../blocks/Titles'
import VideoBlock from '../plugins/ResponsiveVideo/blocks/ResponsiveVideo'
// Buttons
import ComponentVisibilityBtn from '../buttons/ComponentsVisibility'
import * as DevicesBtn from '../buttons/Devices'
// import EditCodeBtn from '../buttons/EditCode'
import ExportTemplateBtn from '../buttons/ExportTemplate'
import FullScreenBtn from '../buttons/FullScreen'
import RedoBtn from '../buttons/Redo'
import SaveBtn from '../buttons/Save'
import * as SwitchPanelsBtns from '../buttons/SwitchPanels'
import UndoBtn from '../buttons/Undo'
// Commands
import EditCodeCmd from '../commands/EditCode'
import SetDevicesCmd from '../commands/SetDevices'
import ShowPanels from '../commands/ShowPanels'
import UndoRedo from '../commands/UndoRedo'
// Devices
import DesktopDevice from '../devices/Desktop'
import XSDesktopDevice from '../devices/XSDesktop'
import TabletDevice from '../devices/Tablet'
import XSTabletDevice from '../devices/XSTablet'
import MobileDevice from '../devices/Mobile'
// Managers
import AssetManager from '../managers/AssetManager'
import SelectorManager from '../managers/SelectorManager'
import StorageManager from '../managers/StorageManager'
import StyleManager from '../managers/StyleManager';
import TraitManager from '../managers/TraitManager';
// Plugins
import FigureComponent from '../plugins/Figure';
import LocalizeDefaultTexts from '../plugins/LocalizeDefaultTexts';
import RichTextEditorExtended from '../plugins/RichTextEditorExtended';
import SectorsAccordion from '../plugins/SectorsAccordion';
// Types
import LinkBlockComponent from "../plugins/LinkBlock";
import LineBreakType from "../types/line-break";
import ResponsiveVideoComponent from "../plugins/ResponsiveVideo";
import SimpleBlockType from "../types/block";

const FullPageBuilder = function (options) {
	const _self  = this;
	_self.editor = null;

	/**
	 * Initialiser l'objet
	 *
	 * @private
	 */
	function _init () {
		_setConfig(options);
		_initToastr();
		_initEditor();
	}

	/**
	 * Initialiser l'éditeur
	 *
	 * @private
	 */
	function _initEditor () {
		_self.editor = grapesjs.init({
			container: '#gjs',
			fromElement: true,
			width: 'auto',
			protectedCss: '',
			avoidInlineStyle: true, // permet l'utilisation de @media et des pseudo éléments (eg. :hover)
			showOffsets: true,
			allowScripts: true,
			avoidDefaults: true,
			storageManager: StorageManager(),
			plugins: [
				LocalizeDefaultTexts,
				SectorsAccordion,
				RichTextEditorExtended,
				SimpleBlockType,
				LineBreakType,
				FigureComponent,
				LinkBlockComponent,
				ResponsiveVideoComponent,
			],
			canvas: {
				styles: [
					...config.styles,
					'/modules/cms/css/page-builder/canvas.css',
				],
			},
			commands: {
				defaults: [
					...EditCodeCmd(),
					...SetDevicesCmd,
					...ShowPanels,
					...UndoRedo,
				]
			},
			assetManager: AssetManager.getConfig(),
			deviceManager: {
				devices: [
					DesktopDevice,
					XSDesktopDevice,
					TabletDevice,
					XSTabletDevice,
					MobileDevice,
				]
			},
			panels: {
				defaults: [
					{
						id: 'editor-actions',
						el: '.left-container .vertical-bar',
						buttons: [
							ComponentVisibilityBtn(),
							FullScreenBtn(),
						]
					}, {
						id: 'devices',
						el: '.center-container .top-bar',
						buttons: [
							DevicesBtn.Desktop(),
							DevicesBtn.XSDesktop(),
							DevicesBtn.Tablet(),
							DevicesBtn.XSTablet(),
							DevicesBtn.Mobile(),
						]
					}, {
						id: 'basic-actions',
						el: '.center-container .top-bar',
						buttons: [
							{
								...UndoBtn(),
								className: 'gjs-btn-lm',
							},
							RedoBtn(),
							ExportTemplateBtn(),
							SaveBtn(),
						]
					}, {
						id: 'switch-panels',
						el: '.right-container .top-bar',
						buttons: [
							SwitchPanelsBtns.Styles(),
							SwitchPanelsBtns.Traits(),
							SwitchPanelsBtns.Layers(),
							SwitchPanelsBtns.Blocks(),
						]
					}
				]
			},
			selectorManager: {
				appendTo: '.styles-panel',
				...SelectorManager()
			},
			styleManager: {
				appendTo: '.styles-panel',
				...StyleManager()
			},
			traitManager: {
				appendTo: '.traits-panel',
				...TraitManager
			},
			layerManager: {
				appendTo: '.layers-panel'
			},
			blockManager: {
				appendTo: '.blocks-panel',
				blocks: [
					TitlesBlocks().H2,
					TitlesBlocks().H3,
					TitlesBlocks().H4,
					TitlesBlocks().H5,
					TextBlock(),
					LinkBlock(),
					ImageBlock(),
					VideoBlock(),
					LineBreakBlock(),
					SimpleBlock(),
					ContainerBlock(),
				]
			},
		}).on('storage:end:store', function () {
			toastr.success('');
		});

		_self.editor.DomComponents.getWrapper().addClass('inner-page');

		// Charger les fichiers précédemment uploadés
		AssetManager.loadFiles(_self.editor);

		// fix du bug https://github.com/artf/grapesjs/issues/2160
		// quand est utilisé {dragMode: 'absolute'} dans la config
		window.editor = _self.editor;

		// Restaurer la possibilité de styliser les components en utilisant leur classe
		editor.SelectorManager.getAll().each(selector => selector.set('private', 0));
		editor.on('selector:add', selector => selector.set('private', 0));
	}

	/**
	 * Initialiser la lib. Toastr
	 *
	 * @private
	 */
	function _initToastr () {
		toastr.options = {
			positionClass: 'toast-bottom-right',
			preventDuplicates: true,
		};
	}

	/**
	 * Mettre à jour la config
	 *
	 * @param options
	 * @private
	 */
	function _setConfig (options) {
		mergeToConfig(options);
		setLocale(config.lang);
	}

	_init();
};

window.FullPageBuilder = FullPageBuilder;
