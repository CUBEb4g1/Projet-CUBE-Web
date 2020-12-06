// Config
import { config, mergeToConfig } from '../config';
// I18n
import { __, setLocale } from '../lang/I18n';
// Libs
import grapesjs from 'grapesjs';
// Blocks
import ContainerBlock from '../blocks/Bootstrap/Container'
import ImageBlock from '../plugins/Figure/blocks/Figure'
import LinkBlock from '../plugins/LinkBlock/blocks/LinkBlock'
import LineBreak from '../blocks/LineBreak'
import SimpleBlock from '../blocks/Block'
import TextBlock from '../blocks/Text'
import TitlesBlocks from '../blocks/Titles'
import VideoBlock from '../plugins/ResponsiveVideo/blocks/ResponsiveVideo'
// Buttons
import * as DevicesBtn from '../buttons/Devices';
import FullScreenBtn from '../buttons/FullScreen';
import RedoBtn from '../buttons/Redo';
import * as SwitchPanelsBtns from "../buttons/SwitchPanels";
import UndoBtn from '../buttons/Undo';
// Commands
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
import AssetManager from '../managers/AssetManager';
import ComponentVisibilityBtn from "../buttons/ComponentsVisibility";
import StorageManager from '../managers/StorageManager'
import StyleManager from '../managers/StyleManager';
import TraitManager from '../managers/TraitManager';
// Plugins
import LocalizeDefaultTexts from '../plugins/LocalizeDefaultTexts';
import RichTextEditorExtended from '../plugins/RichTextEditorExtended';
import SectorsAccordion from '../plugins/SectorsAccordion';
import SimpleUserMod from '../plugins/SimpleUserMod';
// Types
import FigureComponent from "../plugins/Figure";
import LinkBlockComponent from "../plugins/LinkBlock";
import LineBreakType from "../types/line-break";
import ResponsiveVideoComponent from "../plugins/ResponsiveVideo";
import SimpleBlockType from '../types/block';

const LightPageBuilder = function (options) {
	const _self  = this;
	_self.editor = null;

	/**
	 * Initialiser l'objet
	 *
	 * @private
	 */
	function _init () {
		_setConfig(options);
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
			height: '750px',
			protectedCss: '',
			avoidInlineStyle: true, // permet l'utilisation de @media et des pseudo éléments (eg. :hover)
			showOffsets: true,
			allowScripts: true,
			avoidDefaults: true,
			noticeOnUnload: false,
			storageManager: StorageManager(),
			plugins: [
				SimpleUserMod,
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
						id: 'basic-actions',
						el: '.center-container .top-bar',
						buttons: [
							FullScreenBtn(),
							ComponentVisibilityBtn(),
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
						id: 'editor-actions',
						el: '.center-container .top-bar',
						buttons: [
							UndoBtn(),
							RedoBtn(),
						]
					}, {
						id: 'switch-panels',
						el: '.right-container .top-bar',
						buttons: [
							SwitchPanelsBtns.Styles(),
							SwitchPanelsBtns.Traits(),
							SwitchPanelsBtns.Blocks(),
						]
					}
				]
			},
			styleManager: {
				appendTo: '.styles-panel',
				...StyleManager()
			},
			traitManager: {
				appendTo: '.traits-panel',
				...TraitManager
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
					LineBreak(),
					SimpleBlock(),
					ContainerBlock(),
				]
			},
		});

		_self.editor.DomComponents.getWrapper().addClass('inner-page');

		// Charger les fichiers précédemment uploadés
		AssetManager.loadFiles(_self.editor);

		// Ajouter un contenu par défaut si l'éditeur est vide
		if (_self.editor.getComponents().length === 0) {
			const defaultComponent      = ContainerBlock().content;
			defaultComponent.components = TextBlock().content;
			_self.editor.addComponents(defaultComponent);
		}

		if (config.textEntryOnly) {
			// Bug : Modifie le comportement des Components et empêche plus tard leur suppression même depuis l'éditeur avancé
			/*_self.editor.DomComponents.getWrapper().set({
				'draggable': false,
				'copyable': false,
				'resizable': false,
				'removable': false,
				'toolbar': {},
				'propagate': ['draggable', 'copyable', 'resizable', 'removable', 'toolbar'],
			});*/
		}

		// fix du bug https://github.com/artf/grapesjs/issues/2160
		// quand est utilisé {dragMode: 'absolute'} dans la config
		window.editor = _self.editor;
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

window.LightPageBuilder = LightPageBuilder;
