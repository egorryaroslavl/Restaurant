/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ){
	config.filebrowserBrowseUrl = '/elfinder/ckeditor';
	//	config.filebrowserBrowseUrl = '/public/_admin/js/plugins/ckeditor';
	config.language = 'ru';
	config.toolbarCanCollapse = true;
	config.filebrowserUploadUrl = '/uploads';
	/*	config.toolbar = 'CustomToolbarMin';
	 config.toolbar = 'CustomToolbarMax';*/
	config.toolbar_CustomToolbarMin =

		[
			{ name: 'document', items: [ 'Source', 'Templates', 'Image', 'Flash', 'Iframe' ] },
			{
				name : 'align',
				items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'Bold', 'Italic', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ]
			},
			{ name: 'links', items: [ 'Link', 'Unlink' ] }

		];
	config.toolbarGroups = [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];
	config.toolbar_CustomToolbarMax =
		[
			{ name: 'document', items: [ 'Source' ] },

			{
				name: 'clipboard', items: [
				'Cut',
				'Copy',
				'Paste',
				'PasteText',
				'PasteFromWord',
				'Templates'

			]
			},

			{
				name : 'insert',
				items: [
					'Table',
					'Image',
					'Flash',
					'Youtube',
					'HorizontalRule',
					'SpecialChar',
					'PageBreak',
					'Iframe' ]
			},


			{
				name: 'basicstyles', items: [
				'Bold',
				'Italic',
				'Strike',
				'Subscript',
				'Superscript',
				'-',
				'RemoveFormat' ]
			},
			{
				name : 'paragraph',
				items: [
					'JustifyLeft',
					'JustifyCenter',
					'JustifyRight',
					'JustifyBlock',
					'NumberedList',
					'BulletedList',
					'-',
					'Outdent',
					'Indent',
					'-',
					'Blockquote' ]
			}, {
			name: 'styles', items: [
				'Styles',
				'Format',
				'Font',
				'FontSize' ]
		},
			{
				name: 'colors', items: [
				'TextColor',
				'BGColor'
			]
			},
			{
				name: 'links', items: [
				'Link',
				'Unlink',
				'Anchor'
			]
			},
			{
				name: 'tools', items: [
				'Maximize' ]
			}
		];

	config.removeButtons = 'Underline, PageBreak,Smiley,Print,Save,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,About,Find,Replace,SelectAll,Preview,Scayt,NewPage,Undo,Redo,BidiLtr,BidiRtl';


};
