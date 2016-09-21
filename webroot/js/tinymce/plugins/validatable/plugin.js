/**
 * Validatable
 *
 * Fix/workaround for the problem where a form may not submit in case the
 * targeted element has validation rules applied.
 *
 * Licensed under The MIT License.
 *
 * @author  Oliver Nowak <info@nowak-media.de>
 * @see     https://github.com/ndm2/tinymce-validatable
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * @preserve https://github.com/ndm2/tinymce-validatable
 */

/*global tinymce:true */

tinymce.PluginManager.add('validatable', function(editor)
{
	"use strict";

	if(editor.settings.inline)
	{
		return;
	}

	var defaults = {
		validatable_exclude_from_validation: false,
		validatable_hide_completely: false
	};
	editor.settings = tinymce.util.Tools.extend(defaults, editor.settings);

	var DOM = tinymce.DOM;
	var target = editor.getElement();

	editor.on('submit', function()
	{
		if(editor.settings.validatable_exclude_from_validation)
		{
			DOM.setAttrib(target, 'disabled', '');
		}
	});

	editor.on('init', function()
	{
		if(editor.settings.validatable_exclude_from_validation)
		{
			DOM.setAttrib(target, 'disabled', 'disabled');
			return;
		}

		var container = this.getContainer();
		DOM.add(container, target);

		var id = DOM.getAttrib(container, 'id', null);
		var body = DOM.get(id + '-body', container);

		DOM.setStyles(body, {
			position: 'relative',
			zIndex: 1
		});

		var opacity = editor.settings.validatable_hide_completely ? 0 : 1;

		DOM.setStyles(target, {
			display: 'block',
			visibility: 'visible',
			position: 'absolute',
			zIndex: 0,
			top: 0,
			left: 0,
			width: '100%',
			height: '100%',
			margin: 0,
			padding: 0,
			color: 'transparent',
			fontSize: 0,
			opacity: opacity,
			border: 'none',
			borderRadius: '2px'
		});
	});

	editor.on('change Undo Redo SetContent', function()
	{
		this.save();
	});
});