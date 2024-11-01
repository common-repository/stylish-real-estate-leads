'use strict';

const { createElement, Fragment } = wp.element;
const { registerBlockType } = wp.blocks;
const { useBlockProps } = wp.blockEditor || wp.editor;
const { SelectControl, ToggleControl, PanelBody, Placeholder } = wp.components;

const srelIcon = createElement( 'svg', { width: 20, height: 20, viewBox: '0 0 612 612', className: 'dashicon' },
    createElement( 'path', {
        fill: 'currentColor',
        d: 'M405.333 85.333h-128v-64C277.333 9.551 267.782 0 256 0c-11.782 0-21.333 9.551-21.333 21.333v64h-128c-11.782 0-21.333 9.551-21.333 21.333v384c0 11.782 9.551 21.333 21.333 21.333h298.667c11.782 0 21.333-9.551 21.333-21.333v-384c0-11.781-9.552-21.333-21.334-21.333zm-21.333 384H128V128h106.667v21.333c0 11.782 9.551 21.333 21.333 21.333 11.782 0 21.333-9.551 21.333-21.333V128H384v341.333z',
    } ),
    createElement( 'path', {
        fill: 'currentColor',
        d: 'M256 213.333c-35.355 0-64 28.645-64 64s28.645 64 64 64c11.791 0 21.333 9.542 21.333 21.333S267.791 384 256 384h-42.667C201.551 384 192 393.551 192 405.333c0 11.782 9.551 21.333 21.333 21.333H256c35.355 0 64-28.645 64-64s-28.645-64-64-64c-11.791 0-21.333-9.542-21.333-21.333S244.209 256 256 256h42.667c11.782 0 21.333-9.551 21.333-21.333 0-11.782-9.551-21.333-21.333-21.333H256z',
    } )
);

registerBlockType( 'stylish-real-estate-leads/lead-forms-picker', {
	title: "Stylish Real Estate Leads",
	description: "Add Stylish Real Estate Leads to your page.",
	icon: srelIcon,
	keywords: [ 'stylish real estate leads', 'lead form', 'financial calculator', 'calculator' ],
	category: 'widgets',
attributes: {
    leadFormId: {
      type: "string"
    },
  },
  example: {
    attributes: {
      leadFormId: "1"
    }
  },
	edit: function( props ) {
		const { attributes: { leadFormId = '' }, setAttributes } = props;
		let jsx = [<Placeholder
			key="df-srel-gutenberg--wrap"
			className="df-srel-gutenberg--wrap">
			<img src={ srel_data.logo }/>
            <p>The Real Estate Lead Form will show up on the page.</p>
		</Placeholder>];
		return jsx;
    },
	save() {
		return null;
	},
} );
