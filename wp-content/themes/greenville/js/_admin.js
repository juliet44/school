/* global jQuery:false */
/* global GREENVILLE_STORAGE:false */

jQuery(document).ready(function() {
	"use strict";

	// Init Media manager variables
	GREENVILLE_STORAGE['media_id'] = '';
	GREENVILLE_STORAGE['media_frame'] = [];
	GREENVILLE_STORAGE['media_link'] = [];
	jQuery('.greenville_media_selector').on('click', function(e) {
		greenville_show_media_manager(this);
		e.preventDefault();
		return false;
	});
	jQuery('.greenville_override_options_field_preview').on('click', '> span', function(e) {
		var image = jQuery(this);
		var button = image.parent().prev('.greenville_media_selector');
		var field = jQuery('#'+button.data('linked-field'));
		if (field.length == 0) return;
		if (button.data('multiple')==1) {
			var val = field.val().split('|');
			val.splice(image.index(), 1);
			field.val(val.join('|'));
			image.remove();
		} else {
			field.val('');
			image.remove();
		}
		e.preventDefault();
		return false;
	});
	

	// Hide empty override-options
	jQuery('.postbox > .inside').each(function() {
		if (jQuery(this).html().length < 5) jQuery(this).parent().hide();
	});

	// Hide admin notice
	jQuery('#greenville_admin_notice .greenville_hide_notice').on('click', function(e) {
		jQuery('#greenville_admin_notice').slideUp();
		jQuery.post( GREENVILLE_STORAGE['ajax_url'], {'action': 'greenville_hide_admin_notice'}, function(response){});
		e.preventDefault();
		return false;
	});
	
	// TGMPA Source selector is changed
	jQuery('.tgmpa_source_file').on('change', function(e) {
		var chk = jQuery(this).parents('tr').find('>th>input[type="checkbox"]');
		if (chk.length == 1) {
			if (jQuery(this).val() != '')
				chk.attr('checked', 'checked');
			else
				chk.removeAttr('checked');
		}
	});
		
	// Add icon selector after the menu item classes field
	jQuery('.edit-menu-item-classes').each(function() {
		var icon = greenville_get_icon_class(jQuery(this).val());
		jQuery(this).after('<span class="greenville_list_icons_selector'+(icon ? ' '+icon : '')+'" title="'+GREENVILLE_STORAGE['icon_selector_msg']+'"></span>');
	});
	jQuery('.greenville_list_icons_selector').on('click', function(e) {
		var selector = jQuery(this);
		var input_id = selector.prev().attr('id');
		if (input_id === undefined) {
			input_id = ('greenville_icon_field_'+Math.random()).replace(/\./g, '');
			selector.prev().attr('id', input_id)
		}
		var in_menu = selector.parents('.menu-item-settings').length > 0;
		var list = in_menu ? jQuery('.greenville_list_icons') : selector.next('.greenville_list_icons');
		if (list.length > 0) {
			list.find('span.greenville_list_active').removeClass('greenville_list_active');
			var icon = greenville_get_icon_class(selector.attr('class'));
			if (icon != '') list.find('span[class*="'+icon+'"]').addClass('greenville_list_active');
			var pos = in_menu ? selector.offset() : selector.position();
			list.data('input_id', input_id).css({'left': pos.left-(in_menu ? 0 : list.outerWidth()-selector.width()-1), 'top': pos.top+(in_menu ? 0 : selector.height()+4)}).fadeIn();
		}
		e.preventDefault();
		return false;
	});
	jQuery('.greenville_list_icons span').on('click', function(e) {
		var list = jQuery(this).parent().fadeOut();
		var icon = greenville_alltrim(jQuery(this).attr('class').replace(/greenville_list_active/, ''));
		var input = jQuery('#'+list.data('input_id'));
		input.val(greenville_chg_icon_class(input.val(), icon)).trigger('change');
		var selector = input.next();
		selector.attr('class', greenville_chg_icon_class(selector.attr('class'), icon));
		e.preventDefault();
		return false;
	});

	// Standard WP Color Picker
	if (jQuery('.greenville_color_selector').length > 0) {
		jQuery('.greenville_color_selector').wpColorPicker({
			// you can declare a default color here,
			// or in the data-default-color attribute on the input
			//defaultColor: false,
	
			// a callback to fire whenever the color changes to a valid color
			change: function(e, ui){
				jQuery(e.target).val(ui.color).trigger('change');
			},
	
			// a callback to fire when the input is emptied or an invalid color
			clear: function(e) {
				jQuery(e.target).prev().trigger('change')
			},
	
			// hide the color picker controls on load
			//hide: true,
	
			// show a group of common colors beneath the square
			// or, supply an array of colors to customize further
			//palettes: true
		});
	}

	function greenville_chg_icon_class(classes, icon) {
		var chg = false;
		classes = greenville_alltrim(classes).split(' ');
		for (var i=0; i<classes.length; i++) {
			if (classes[i].indexOf('icon-') >= 0) {
				classes[i] = icon;
				chg = true;
				break;
			}
		}
		if (!chg) {
			if (classes.length == 1 && classes[0] == '')
				classes[0] = icon;
			else
				classes.push(icon);
		}
		return classes.join(' ');
	}

	function greenville_get_icon_class(classes) {
		var classes = greenville_alltrim(classes).split(' ');
		var icon = '';
		for (var i=0; i<classes.length; i++) {
			if (classes[i].indexOf('icon-') >= 0) {
				icon = classes[i];
				break;
			}
		}
		return icon;
	}

	function greenville_show_media_manager(el) {
		GREENVILLE_STORAGE['media_id'] = jQuery(el).attr('id');
		GREENVILLE_STORAGE['media_link'][GREENVILLE_STORAGE['media_id']] = jQuery(el);
		// If the media frame already exists, reopen it.
		if ( GREENVILLE_STORAGE['media_frame'][GREENVILLE_STORAGE['media_id']] ) {
			GREENVILLE_STORAGE['media_frame'][GREENVILLE_STORAGE['media_id']].open();
			return false;
		}
		var type = GREENVILLE_STORAGE['media_link'][GREENVILLE_STORAGE['media_id']].data('type') 
						? GREENVILLE_STORAGE['media_link'][GREENVILLE_STORAGE['media_id']].data('type') 
						: 'image';
		var args = {
			// Set the title of the modal.
			title: GREENVILLE_STORAGE['media_link'][GREENVILLE_STORAGE['media_id']].data('choose'),
			// Multiple choise
			multiple: GREENVILLE_STORAGE['media_link'][GREENVILLE_STORAGE['media_id']].data('multiple')==1 
						? 'add' 
						: false,
			// Customize the submit button.
			button: {
				// Set the text of the button.
				text: GREENVILLE_STORAGE['media_link'][GREENVILLE_STORAGE['media_id']].data('update'),
				// Tell the button not to close the modal, since we're
				// going to refresh the page when the image is selected.
				close: true
			}
		};
		// Allow sizes and filters for the images
		if (type == 'image') {
			args['frame'] = 'post';
		}
		// Tell the modal to show only selected post types
		if (type == 'image' || type == 'audio' || type == 'video') {
			args['library'] = {
				type: type
			};
		}
		GREENVILLE_STORAGE['media_frame'][GREENVILLE_STORAGE['media_id']] = wp.media(args);

		// When an image is selected, run a callback.
		GREENVILLE_STORAGE['media_frame'][GREENVILLE_STORAGE['media_id']].on( 'insert select', function(selection) {
			// Grab the selected attachment.
			var field = jQuery("#"+GREENVILLE_STORAGE['media_link'][GREENVILLE_STORAGE['media_id']].data('linked-field')).eq(0);
			var attachment = null, attachment_url = '';
			if (GREENVILLE_STORAGE['media_link'][GREENVILLE_STORAGE['media_id']].data('multiple')===1) {
				GREENVILLE_STORAGE['media_frame'][GREENVILLE_STORAGE['media_id']].state().get('selection').map( function( att ) {
					attachment_url += (attachment_url ? "|" : "") + att.toJSON().url;
				});
				var val = field.val();
				attachment_url = val + (val ? "|" : '') + attachment_url;
			} else {
				attachment = GREENVILLE_STORAGE['media_frame'][GREENVILLE_STORAGE['media_id']].state().get('selection').first().toJSON();
				attachment_url = attachment.url;
				var sizes_selector = jQuery('.media-modal-content .attachment-display-settings select.size');
				if (sizes_selector.length > 0) {
					var size = greenville_get_listbox_selected_value(sizes_selector.get(0));
					if (size != '') attachment_url = attachment.sizes[size].url;
				}
			}
			// Display images in the preview area
			var preview = field.siblings('.greenville_override_options_field_preview');
			if (preview.length == 0) {
				jQuery('<span class="greenville_override_options_field_preview"></span>').insertAfter(field);
				preview = field.siblings('.greenville_override_options_field_preview');
			}
			if (preview.length != 0) preview.empty();
			var images = attachment_url.split("|");
			for (var i=0; i<images.length; i++) {
				if (preview.length != 0) {
					var ext = greenville_get_file_ext(images[i]);
					preview.append('<span>'
									+ (ext=='gif' || ext=='jpg' || ext=='jpeg' || ext=='png' 
											? '<img src="'+images[i]+'">'
											: '<a href="'+images[i]+'">'+greenville_get_file_name(images[i])+'</a>'
										)
									+ '</span>');
				}
			}
			// Update field
			field.val(attachment_url).trigger('change');
		});

		// Finally, open the modal.
		GREENVILLE_STORAGE['media_frame'][GREENVILLE_STORAGE['media_id']].open();
		return false;
	}

});