import { __ } from '../lang/I18n'

export default function () {
	const general = {
		name: __('style_editor.sector.general'),
		buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom'],
		open: false,
		properties: [{
			name: __('style_editor.sector.float'),
			property: 'float',
			type: 'radio',
			defaults: 'none',
			list: [{
				value: 'none',
				name: '<i class="fa fa-times"></i>',
				title: __('style_editor.property.float_none'),
			}, {
				value: 'left',
				name: '<i class="fa fa-align-left"></i>',
				title: __('style_editor.property.float_left'),
			}, {
				value: 'right',
				name: '<i class="fa fa-align-right"></i>',
				title: __('style_editor.property.float_right'),
			}],
		}, {
			property: 'display',
			type: 'select',
			list: [{
				value: 'block',
				title: 'Block',
			}, {
				value: 'inline',
				title: 'Inline',
			}, {
				value: 'inline-block',
				title: 'Inline-block',
			}, {
				value: 'flex',
				title: 'flex',
			}, {
				value: 'none',
				title: 'None',
				className: 'fa fa-eye-slash',
			}],
		}, {
			property: 'position',
			type: 'select',
		}],
	};

	const dimensions = {
		name: __('style_editor.sector.dimension'),
		open: false,
		buildProps: ['width', 'height', 'min-width', 'min-height', 'max-width', 'max-height', 'margin', 'padding'],
		properties: [{
			name: __('style_editor.property.height'),
			property: 'height',
		}, {
			name: __('style_editor.property.width'),
			property: 'width',
		}, {
			name: __('style_editor.property.min_width'),
			property: 'min-width',
		}, {
			name: __('style_editor.property.min_height'),
			property: 'min-height',
		}, {
			name: __('style_editor.property.max_width'),
			property: 'max-width',
		}, {
			name: __('style_editor.property.max_height'),
			property: 'max-height',
		}, {
			name: __('style_editor.property.margin'),
			property: 'margin',
			type: 'composite',
			properties: [{
				name: __('style_editor.property.top'),
				property: 'margin-top',
				type: 'integer',
				units: ['px', 'rem', '%'],
				defaults: 0,
			}, {
				name: __('style_editor.property.right'),
				property: 'margin-right',
				type: 'integer',
				units: ['px', 'rem', '%'],
				defaults: 0,
			}, {
				name: __('style_editor.property.bottom'),
				property: 'margin-bottom',
				type: 'integer',
				units: ['px', 'rem', '%'],
				defaults: 0,
			}, {
				name: __('style_editor.property.left'),
				property: 'margin-left',
				type: 'integer',
				units: ['px', 'rem', '%'],
				defaults: 0,
			},],
		},/*{
              name    : 'Center block',
              property  : 'margin',
              type    : 'select',
              defaults  : '0',
              list    : [
                         { value: '0', name: 'Normal',},
                         { value: '0 auto', name: 'Center',}
                        ],
            },*/{
			name: __('style_editor.property.padding'),
			property: 'padding',
			type: 'composite',
			properties: [{
				name: __('style_editor.property.top'),
				property: 'padding-top',
				type: 'integer',
				units: ['px', 'rem', '%'],
				defaults: 0,
				min: 0,
			}, {
				name: __('style_editor.property.right'),
				property: 'padding-right',
				type: 'integer',
				units: ['px', 'rem', '%'],
				defaults: 0,
				min: 0,
			}, {
				name: __('style_editor.property.bottom'),
				property: 'padding-bottom',
				type: 'integer',
				units: ['px', 'rem', '%'],
				defaults: 0,
				min: 0,
			}, {
				name: __('style_editor.property.left'),
				property: 'padding-left',
				type: 'integer',
				units: ['px', 'rem', '%'],
				defaults: 0,
				min: 0,
			},],
		},],
	};

	const typography = {
		name: __('style_editor.sector.typography'),
		buildProps: ['text-align', 'font-family', 'font-size', 'font-weight', 'letter-spacing', 'line-height', 'color', 'text-decoration', 'text-shadow'],
		open: false,
		properties: [{
			name: __('style_editor.property.font'),
			property: 'font-family',
		}, {
			name: __('style_editor.property.font_size'),
			property: 'font-size',
			units: ['rem', 'px', '%'],
		}, {
			name: __('style_editor.property.font_weight'),
			property: 'font-weight',
		}, {
			name: __('style_editor.property.letter_spacing'),
			property: 'letter-spacing',
			units: ['rem', 'px', '%'],
		}, {
			name: __('style_editor.property.line_height'),
			property: 'line-height',
			units: ['rem', 'px', '%'],
		}, {
			name: __('style_editor.property.color'),
			property: 'color',
		}, {
			name: __('style_editor.property.text_decoration'),
			property: 'text-decoration', type: 'radio',
			defaults: 'left',
			list: [{ value: 'none', name: '<i class="fa fa-times"></i>' },
				{ value: 'underline', name: '<i class="fa fa-underline"></i>' },
				{ value: 'line-through', name: '<i class="fa fa-strikethrough"></i>' }],
		}, {
			name: __('style_editor.property.text_align'),
			property: 'text-align',
			type: 'radio',
			defaults: 'left',
			list: [{ value: 'left', name: '<i class="fa fa-align-left"></i>' },
				{ value: 'center', name: '<i class="fa fa-align-center"></i>' },
				{ value: 'right', name: '<i class="fa fa-align-right"></i>' },
				{ value: 'justify', name: '<i class="fa fa-align-justify"></i>' }],
		}, {
			name: __('style_editor.property.text_shadow'),
			property: 'text-shadow',
			type: 'stack',
			preview: true,
			properties: [{
				name: 'X position',
				property: 'h-shadow',
				type: 'integer',
				units: ['px', '%'],
				defaults: 0,
			}, {
				name: 'Y position',
				property: 'v-shadow',
				type: 'integer',
				units: ['px', '%'],
				defaults: 0,
			}, {
				name: __('style_editor.property.blur_radius'),
				property: 'blur-radius',
				type: 'integer',
				units: ['px'],
				defaults: 0,
				min: 0,
			}, {
				name: __('style_editor.property.shadow_color'),
				property: 'shadow-color',
				type: 'color',
				defaults: 'black',
			},],
		}],
	};

	const decorations = {
		name: 'Decorations',
		open: false,
		buildProps: ['background-color', 'background', 'border', 'border-radius', 'box-shadow'],
		properties: [{
			name: __('style_editor.property.background_color'),
			property: 'background-color',
		}, {
			name: 'Border radius',
			property: 'border-radius',
			type: 'composite',
			properties: [{
				name: 'Top',
				property: 'border-top-left-radius',
				type: 'integer',
				units: ['px', '%'],
				defaults: 0,
				min: 0,
			}, {
				name: 'Right',
				property: 'border-top-right-radius',
				type: 'integer',
				units: ['px', '%'],
				min: 0,
				defaults: 0,
			}, {
				name: 'Bottom',
				property: 'border-bottom-left-radius',
				type: 'integer',
				units: ['px', '%'],
				min: 0,
				defaults: 0,
			}, {
				name: 'Left',
				property: 'border-bottom-right-radius',
				type: 'integer',
				units: ['px'],
				min: 0,
				defaults: 0,
			},],
		}, {
			name: 'Box shadow',
			property: 'box-shadow',
			type: 'stack',
			preview: true,
			properties: [{
				name: 'X position',
				property: 'shadow-x',
				type: 'integer',
				units: ['px', '%'],
				defaults: 0,
			}, {
				name: 'Y position',
				property: 'shadow-y',
				type: 'integer',
				units: ['px', '%'],
				defaults: 0,
			}, {
				name: 'Blur',
				property: 'shadow-blur',
				type: 'integer',
				units: ['px'],
				defaults: 5,
				min: 0,
			}, {
				name: 'Spread',
				property: 'shadow-spread',
				type: 'integer',
				units: ['px'],
				defaults: 0,
			}, {
				name: 'Color',
				property: 'shadow-color',
				type: 'color',
				defaults: 'black',
			}, {
				name: 'Shadow type',
				property: 'shadow-type',
				type: 'select',
				defaults: '',
				list: [{ value: '', name: 'Outside', },
					{ value: 'inset', name: 'Inside', }],
			}],
		}, {
			name: 'Background',
			property: 'background',
			type: 'stack',
			preview: true,
			detached: true,
			properties: [{
				name: 'Image',
				property: 'background-image',
				type: 'file',
				defaults: 'none',
			},
				{
					name: 'Repeat',
					property: 'background-repeat',
					type: 'select',
					defaults: 'repeat',
					list: [{ value: 'repeat', name: 'Repeat', },
						{ value: 'repeat-x', name: 'Repeat X', },
						{ value: 'repeat-y', name: 'Repeat Y', },
						{ value: 'no-repeat', name: 'No repeat', }],
				},
				{
					name: 'Position',
					property: 'background-position',
					type: 'select',
					defaults: 'left top',
					list: [{ value: 'left top', },
						{ value: 'left center', },
						{ value: 'left bottom', },
						{ value: 'right top', },
						{ value: 'right center' },
						{ value: 'right bottom' },
						{ value: 'center top' },
						{ value: 'center center' },
						{ value: 'center bottom' }
					]
				}, {
					name: 'Attachment',
					property: 'background-attachment',
					type: 'select',
					defaults: 'scroll',
					list: [{ value: 'scroll' },
						{ value: 'fixed' },
						{ value: 'local' }],
				}, {
					name: 'Size',
					property: 'background-size',
					type: 'select',
					defaults: 'auto',
					list: [{ value: 'auto' },
						{ value: 'cover' },
						{ value: 'contain' }],
				}],
		},],
	};

	const flex = {
		name: __('style_editor.sector.flex'),
		open: false,
		properties: [{
			name: 'Flex Container',
			property: 'display',
			type: 'select',
			defaults: 'block',
			list: [{
				value: 'block',
				name: 'Disable',
			}, {
				value: 'flex',
				name: 'Enable',
			}],
		}, {
			name: 'Flex Parent',
			property: 'label-parent-flex',
			type: 'integer',
		}, {
			name: 'Flex Wrap',
			property: 'flex-wrap',
			type: 'select',
			defaults: 'block',
			list: [{
				value: 'nowrap',
				name: 'No wrap',
			}, {
				value: 'wrap',
				name: 'Wrap',
			}, {
				value: 'wrap-reverse',
				name: 'Wrap reverse',
			}],
		}, {
			name: 'Direction',
			property: 'flex-direction',
			type: 'radio',
			defaults: 'row',
			list: [{
				value: 'row',
				name: '<span class="icons-flex icon-dir-row"></span>',
				title: 'Row',
			}, {
				value: 'row-reverse',
				name: '<span class="icons-flex icon-dir-row-rev"></span>',
				title: 'Row reverse',
			}, {
				value: 'column',
				name: '<span class="icons-flex icon-dir-col"></span>',
				title: 'Column',
			}, {
				value: 'column-reverse',
				name: '<span class="icons-flex icon-dir-col-rev"></span>',
				title: 'Column reverse',
			}],
		}, {
			name: 'Justify',
			property: 'justify-content',
			type: 'radio',
			defaults: 'flex-start',
			list: [{
				value: 'flex-start',
				name: '<span class="icons-flex icon-just-start"></span>',
				title: 'Start',
			}, {
				value: 'flex-end',
				name: '<span class="icons-flex icon-just-end"></span>',
				title: 'End',
			}, {
				value: 'space-between',
				name: '<span class="icons-flex icon-just-sp-bet"></span>',
				title: 'Space between',
			}, {
				value: 'space-around',
				name: '<span class="icons-flex icon-just-sp-ar"></span>',
				title: 'Space around',
			}, {
				value: 'center',
				name: '<span class="icons-flex icon-just-sp-cent"></span>',
				title: 'Center',
			}],
		}, {
			name: 'Align items',
			property: 'align-items',
			type: 'radio',
			defaults: 'center',
			list: [{
				value: 'flex-start',
				name: '<span class="icons-flex icon-al-start"></span>',
				title: 'Start',
			}, {
				value: 'flex-end',
				name: '<span class="icons-flex icon-al-end"></span>',
				title: 'End',
			}, {
				value: 'stretch',
				name: '<span class="icons-flex icon-al-str"></span>',
				title: 'Stretch',
			}, {
				value: 'center',
				name: '<span class="icons-flex icon-al-center"></span>',
				title: 'Center',
			}],
		}, {
			name: 'Flex Children',
			property: 'label-parent-flex',
			type: 'integer',
		}, {
			name: 'Order',
			property: 'order',
			type: 'integer',
			defaults: 0,
			min: 0
		}, {
			name: 'Column count',
			property: 'column-count',
			type: 'integer',
			min: 0
		}, {
			name: 'Flex',
			property: 'flex',
			type: 'composite',
			properties: [{
				name: 'Grow',
				property: 'flex-grow',
				type: 'integer',
				defaults: 0,
				min: 0
			}, {
				name: 'Shrink',
				property: 'flex-shrink',
				type: 'integer',
				defaults: 0,
				min: 0
			}, {
				name: 'Basis',
				property: 'flex-basis',
				type: 'integer',
				units: ['px', '%', ''],
				unit: '',
				defaults: 'auto',
			}],
		}, {
			name: 'Align self',
			property: 'align-self',
			type: 'radio',
			defaults: 'auto',
			list: [{
				value: 'auto',
				name: 'Auto',
			}, {
				value: 'flex-start',
				name: '<span class="icons-flex icon-al-start"></span>',
				title: 'Start',
			}, {
				value: 'flex-end',
				name: '<span class="icons-flex icon-al-end"></span>',
				title: 'End',
			}, {
				value: 'stretch',
				name: '<span class="icons-flex icon-al-str"></span>',
				title: 'Stretch',
			}, {
				value: 'center',
				name: '<span class="icons-flex icon-al-center"></span>',
				title: 'Center',
			}],
		}]
	};

	const extra = {
		name: 'Extra',
		open: false,
		buildProps: ['transition', 'perspective', 'transform'],
		properties: [{
			name: 'Transition',
			property: 'transition',
			type: 'stack',
			preview: false,
			properties: [{
				name: 'Property',
				property: 'transition-property',
				type: 'select',
				defaults: '',
				list: [{ value: 'all', name: 'All', },
					{ value: 'width', name: 'Width', },
					{ value: 'height', name: 'Height', },
					{ value: 'background-color', name: 'Background', },
					{ value: 'transform', name: 'Transform', },
					{ value: 'box-shadow', name: 'Box shadow', },
					{ value: 'opacity', name: 'Opacity', }],
			}, {
				name: 'Duration',
				property: 'transition-duration',
				type: 'integer',
				units: ['s'],
				defaults: '2',
				min: 0,
			}, {
				name: 'Easing',
				property: 'transition-timing-function',
				type: 'select',
				defaults: 'ease',
				list: [{ value: 'linear', name: 'Linear', },
					{ value: 'ease', name: 'Ease', },
					{ value: 'ease-in', name: 'Ease-in', },
					{ value: 'ease-out', name: 'Ease-out', },
					{ value: 'ease-in-out', name: 'Ease-in-out', }],
			}],
		}, {
			name: 'Transform',
			property: 'transform',
			type: 'composite',
			properties: [{
				name: 'Rotate X',
				property: 'transform-rotate-x',
				type: 'integer',
				units: ['deg'],
				defaults: '0',
				functionName: 'rotateX',
			}, {
				name: 'Rotate Y',
				property: 'transform-rotate-y',
				type: 'integer',
				units: ['deg'],
				defaults: '0',
				functionName: 'rotateY',
			}, {
				name: 'Rotate Z',
				property: 'transform-rotate-z',
				type: 'integer',
				units: ['deg'],
				defaults: '0',
				functionName: 'rotateZ',
			}, {
				name: 'Scale X',
				property: 'transform-scale-x',
				type: 'integer',
				defaults: '1',
				functionName: 'scaleX',
			}, {
				name: 'Scale Y',
				property: 'transform-scale-y',
				type: 'integer',
				defaults: '1',
				functionName: 'scaleY',
			}, {
				name: 'Scale Z',
				property: 'transform-scale-z',
				type: 'integer',
				defaults: '1',
				functionName: 'scaleZ',
			}],
		}]
	};

	typography.open = true;

	return {
		textNoElement: __('style_editor.select_el'),
		clearProperties: true,
		sectors: [typography, general, dimensions, decorations, flex, extra],
	}
}
