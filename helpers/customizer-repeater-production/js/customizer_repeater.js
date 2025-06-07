jQuery(document).ready(function($){
    $(".latest_enabled").change(function() {
        if(this.checked) {
            $(".latest_enabled").val(1);
        } else {
            $(".latest_enabled").val(0);
        }
        customizer_repeater_refresh_general_control_values();
    });

    $(".latest_ads_enabled").change(function() {
        if(this.checked) {
            $(".latest_ads_enabled").val(1);
        } else {
            $(".latest_ads_enabled").val(0);
        }
        customizer_repeater_refresh_general_control_values();
    });

    $(".tags_enabled").change(function() {
        if(this.checked) {
            $(".tags_enabled").val(1);
        } else {
            $(".tags_enabled").val(0);
        }
        customizer_repeater_refresh_general_control_values();
    });

    $(".categories_enabled").change(function() {
        if(this.checked) {
            $(".categories_enabled").val(1);
        } else {
            $(".categories_enabled").val(0);
        }
        customizer_repeater_refresh_general_control_values();
    });

    $(".pornstar_enabled").change(function() {
        if(this.checked) {
            $(".pornstar_enabled").val(1);
        } else {
            $(".pornstar_enabled").val(0);
        }
        customizer_repeater_refresh_general_control_values();
    });
    $(".channel_enabled").change(function() {
        if(this.checked) {
            $(".channel_enabled").val(1);
        } else {
            $(".channel_enabled").val(0);
        }
        customizer_repeater_refresh_general_control_values();
    });
    $(".movies_enabled").change(function() {
        if(this.checked) {
            $(".movies_enabled").val(1);
        } else {
            $(".movies_enabled").val(0);
        }
        customizer_repeater_refresh_general_control_values();
    });
  
})


/* global jQuery */
/* global wp */
function media_upload(button_class) {
    'use strict';
    jQuery('body').on('click', button_class, function () {
        var button_id = '#' + jQuery(this).attr('id');
        var display_field = jQuery(this).parent().children('input:text');
        var _custom_media = true;

        wp.media.editor.send.attachment = function (props, attachment) {

            if (_custom_media) {
                if (typeof display_field !== 'undefined') {
                    switch (props.size) {
                        case 'full':
                            display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
                            break;
                        case 'medium':
                            display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
                            break;
                        case 'thumbnail':
                            display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
                            break;
                        default:
                            display_field.val(attachment.url);
                            display_field.trigger('change');
                    }
                }
                _custom_media = false;
            } else {
                return wp.media.editor.send.attachment(button_id, [props, attachment]);
            }
        };
        wp.media.editor.open(button_class);
        window.send_to_editor = function (html) {

        };
        return false;
    });
}

/********************************************
 *** Generate unique id ***
 *********************************************/
function customizer_repeater_uniqid(prefix, more_entropy) {
    'use strict';
    if (typeof prefix === 'undefined') {
        prefix = '';
    }

    var retId;
    var php_js;
    var formatSeed = function (seed, reqWidth) {
        seed = parseInt(seed, 10)
            .toString(16); // to hex str
        if (reqWidth < seed.length) { // so long we split
            return seed.slice(seed.length - reqWidth);
        }
        if (reqWidth > seed.length) { // so short we pad
            return new Array(1 + (reqWidth - seed.length))
                .join('0') + seed;
        }
        return seed;
    };

    // BEGIN REDUNDANT
    if (!php_js) {
        php_js = {};
    }
    // END REDUNDANT
    if (!php_js.uniqidSeed) { // init seed with big random int
        php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
    }
    php_js.uniqidSeed++;

    retId = prefix; // start with prefix, add current milliseconds hex string
    retId += formatSeed(parseInt(new Date()
        .getTime() / 1000, 10), 8);
    retId += formatSeed(php_js.uniqidSeed, 5); // add seed hex string
    if (more_entropy) {
        // for more entropy we add a float lower to 10
        retId += (Math.random() * 10)
            .toFixed(8)
            .toString();
    }

    return retId;
}


/********************************************
 *** General Repeater ***
 *********************************************/
function customizer_repeater_refresh_social_icons(th) {
    'use strict';
    var icons_repeater_values = [];
    th.find('.customizer-repeater-social-repeater-container').each(function () {
        var icon = jQuery(this).find('.icp').val();
        var link = jQuery(this).find('.customizer-repeater-social-repeater-link').val();
        var id = jQuery(this).find('.customizer-repeater-social-repeater-id').val();

        if (!id) {
            id = 'customizer-repeater-social-repeater-' + customizer_repeater_uniqid();
            jQuery(this).find('.customizer-repeater-social-repeater-id').val(id);
        }

        if (icon !== '' && link !== '') {
            icons_repeater_values.push({
                'icon': icon,
                'link': link,
                'id': id
            });
        }
    });

    th.find('.social-repeater-socials-repeater-colector').val(JSON.stringify(icons_repeater_values));
    customizer_repeater_refresh_general_control_values();
}


function customizer_repeater_refresh_general_control_values() {
    console.log('cambio');
    'use strict';
    jQuery('.customizer-repeater-general-control-repeater').each(function () {
        var values = [];
        var th = jQuery(this);
        th.find('.customizer-repeater-general-control-repeater-container').each(function () {

            var icon_value = jQuery(this).find('.icp').val();
            var text = jQuery(this).find('.customizer-repeater-text-control').val();
            var link = jQuery(this).find('.customizer-repeater-link-control').val();
            var text2 = jQuery(this).find('.customizer-repeater-text2-control').val();
            var link2 = jQuery(this).find('.customizer-repeater-link2-control').val();
            var color = jQuery(this).find('input.customizer-repeater-color-control').val();
            var color2 = jQuery(this).find('input.customizer-repeater-color2-control').val();
            var image_url = jQuery(this).find('.custom-media-url').val();
            var choice = jQuery(this).find('.customizer-repeater-image-choice').val();
            var title = jQuery(this).find('.customizer-repeater-title-control').val();
            var hidden = jQuery(this).find('.customizer-repeater-hidden-control').val();

            /* latest */
            var latest_title = jQuery(this).find('.latest_title').val();
            var latest_url = jQuery(this).find('.latest_url').val();
            var latest_enabled = jQuery(this).find('.latest_enabled').val();
            var latest_ads_enabled = jQuery(this).find('.latest_ads_enabled').val();
            var latest_ads= jQuery(this).find('.latest_ads').val();
            var latest_number= jQuery(this).find('.latest_number').val();

            /* tags */
            var tags_enabled= jQuery(this).find('.tags_enabled').val();
            var tags_select = jQuery(this).find('.tags_select').val();
            var tags_number = jQuery(this).find('.tags_number').val();
            var tags_order  = jQuery(this).find('.tags_order').val();

            /* categories */
            var categories_enabled= jQuery(this).find('.categories_enabled').val();
            var categories_select = jQuery(this).find('.categories_select').val();
            var categories_number = jQuery(this).find('.categories_number').val();
            var categories_order  = jQuery(this).find('.categories_order').val();
            var categories_title  = jQuery(this).find('.categories_title').val();
            var categories_url    = jQuery(this).find('.categories_url').val();

            /* pornmstar */
            var pornstar_title = jQuery(this).find('.pornstar_title').val();
            var pornstar_url = jQuery(this).find('.pornstar_url').val();
            var pornstar_enabled = jQuery(this).find('.pornstar_enabled').val();
            var pornstar_number= jQuery(this).find('.pornstar_number').val();


            /* channel */
            var channel_title = jQuery(this).find('.channel_title').val();
            var channel_url = jQuery(this).find('.channel_url').val();
            var channel_enabled = jQuery(this).find('.channel_enabled').val();
            var channel_number= jQuery(this).find('.channel_number').val();

            /* movies */
            var movies_title = jQuery(this).find('.movies_title').val();
            var movies_url = jQuery(this).find('.movies_url').val();
            var movies_enabled = jQuery(this).find('.movies_enabled').val();
            var movies_number= jQuery(this).find('.movies_number').val();

            //var latest_enabled = jQuery(this).attr('checked');

            var subtitle = jQuery(this).find('.customizer-repeater-subtitle-control').val();
            var id = jQuery(this).find('.social-repeater-box-id').val();
            if (!id) {
                id = 'social-repeater-' + customizer_repeater_uniqid();
                jQuery(this).find('.social-repeater-box-id').val(id);
            }
            var social_repeater = jQuery(this).find('.social-repeater-socials-repeater-colector').val();
            var shortcode = jQuery(this).find('.customizer-repeater-shortcode-control').val();

            if (text !== '' || image_url !== '' || hidden !== '' || title !== '' || subtitle !== '' || icon_value !== '' || link !== '' || choice !== '' || social_repeater !== '' || shortcode !== '' || color !== '' || latest_title !== '' || latest_url !== '' || latest_enabled !== '' || latest_ads_enabled !== '' || latest_ads !== '' || latest_number !== '' || tags_select !== '' || tags_number !== '' || tags_enabled !== '' || tags_order !== '' || categories_select !== '' || categories_number !== '' || categories_enabled !== '' || categories_order !== '' || pornstar_title !== '' || pornstar_url !== '' || pornstar_enabled !== '' || pornstar_number !== '' || channel_title !== '' || channel_url !== '' || channel_enabled !== '' || channel_number !== '' || categories_title !== '' || categories_url !== '') {
                values.push({
                    'icon_value': (choice === 'customizer_repeater_none' ? '' : icon_value),
                    'color': color,
                    'color2': color2,
                    'text': escapeHtml(text),
                    'link': link,
                    'hidden': hidden,
                    'latest_title' : latest_title,
                    'latest_url' : latest_url,
                    'latest_enabled' : latest_enabled,
                    'latest_ads_enabled' : latest_ads_enabled,
                    'latest_ads' : latest_ads,
                    'latest_number' : latest_number,

                    'channel_title' : channel_title,
                    'channel_url' : channel_url,
                    'channel_enabled' : channel_enabled,
                    'channel_number' : channel_number,
                    'pornstar_title' : pornstar_title,
                    'pornstar_url' : pornstar_url,
                    'pornstar_enabled' : pornstar_enabled,
                    'pornstar_number' : pornstar_number,

                    'movies_title'  : movies_title,
                    'movies_url'    : movies_url,
                    'movies_enabled': movies_enabled,
                    'movies_number' : movies_number,

                    'tags_enabled' : tags_enabled,
                    'tags_select' : tags_select,
                    'tags_number' : tags_number,
                    'tags_order' : tags_order,
                    'categories_enabled' : categories_enabled,
                    'categories_select' : categories_select,
                    'categories_number' : categories_number,
                    'categories_order' : categories_order,
                    'categories_title' : categories_title,
                    'categories_url' : categories_url,
                    'text2': escapeHtml(text2),
                    'link2': link2,
                    'image_url': (choice === 'customizer_repeater_none' ? '' : image_url),
                    'choice': choice,
                    'title': escapeHtml(title),
                    'subtitle': escapeHtml(subtitle),
                    'social_repeater': escapeHtml(social_repeater),
                    'id': id,
                    'shortcode': escapeHtml(shortcode)
                });
            }

        });
        th.find('.customizer-repeater-colector').val(JSON.stringify(values));
        th.find('.customizer-repeater-colector').trigger('change');
    });
}


jQuery(document).ready(function () {
    'use strict';
    var theme_conrols = jQuery('#customize-theme-controls');
    theme_conrols.on('click', '.customizer-repeater-customize-control-title', function () {
        jQuery(this).next().slideToggle('medium', function () {
            if (jQuery(this).is(':visible')){
                jQuery(this).prev().addClass('repeater-expanded');
                jQuery(this).css('display', 'block');
            } else {
                jQuery(this).prev().removeClass('repeater-expanded');
            }
        });
    });

    theme_conrols.on('change', '.icp',function(){
        customizer_repeater_refresh_general_control_values();
        return false;
    });

    theme_conrols.on('change', '.tags_select', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });
    theme_conrols.on('change', '.tags_order', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });
    theme_conrols.on('change', '.categories_select', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });
    theme_conrols.on('change', '.categories_order', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });

    theme_conrols.on('change', '.customizer-repeater-image-choice', function () {
        if (jQuery(this).val() === 'customizer_repeater_image') {
            jQuery(this).parent().parent().find('.social-repeater-general-control-icon').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-image-control').show();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').prev().prev().hide();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').hide();

        }
        if (jQuery(this).val() === 'customizer_repeater_icon') {
            jQuery(this).parent().parent().find('.social-repeater-general-control-icon').show();
            jQuery(this).parent().parent().find('.customizer-repeater-image-control').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').prev().prev().show();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').show();
        }
        if (jQuery(this).val() === 'customizer_repeater_none') {
            jQuery(this).parent().parent().find('.social-repeater-general-control-icon').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-image-control').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').prev().prev().hide();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').hide();
        }

        customizer_repeater_refresh_general_control_values();
        return false;
    });
    media_upload('.customizer-repeater-custom-media-button');
    jQuery('.custom-media-url').on('change', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });

    var color_options = {
        change: function(event, ui){
            customizer_repeater_refresh_general_control_values();
        }
    };

    /**
     * This adds a new box to repeater
     *
     */
    theme_conrols.on('click', '.customizer-repeater-new-field', function () {
        var th = jQuery(this).parent();
        var id = 'customizer-repeater-' + customizer_repeater_uniqid();
        if (typeof th !== 'undefined') {
            /* Clone the first box*/
            var field = th.find('.customizer-repeater-general-control-repeater-container:first').clone( true, true );

            if (typeof field !== 'undefined') {
                /*Set the default value for choice between image and icon to icon*/
                field.find('.customizer-repeater-image-choice').val('customizer_repeater_icon');

                /*Show icon selector*/
                field.find('.social-repeater-general-control-icon').show();

                /*Hide image selector*/
                if (field.find('.social-repeater-general-control-icon').length > 0) {
                    field.find('.customizer-repeater-image-control').hide();
                }

                /*Show delete box button because it's not the first box*/
                field.find('.social-repeater-general-control-remove-field').show();

                /* Empty control for icon */
                field.find('.input-group-addon').find('.fa').attr('class', 'fa');


                /*Remove all repeater fields except first one*/

                field.find('.customizer-repeater-social-repeater').find('.customizer-repeater-social-repeater-container').not(':first').remove();
                field.find('.customizer-repeater-social-repeater-link').val('');
                field.find('.social-repeater-socials-repeater-colector').val('');

                /*Remove value from icon field*/
                field.find('.icp').val('');

                /*Remove value from text field*/
                field.find('.customizer-repeater-text-control').val('');

                /*Remove value from link field*/
                field.find('.customizer-repeater-link-control').val('');

                /*Remove value from text field*/
                field.find('.customizer-repeater-text2-control').val('');

                /*Remove value from link field*/
                field.find('.customizer-repeater-link2-control').val('');

                /*Set box id*/
                field.find('.social-repeater-box-id').val(id);

                /*Remove value from media field*/
                field.find('.custom-media-url').val('');

                /*Remove value from title field*/
                field.find('.customizer-repeater-title-control').val('');


                /*Remove value from color field*/
                field.find('div.customizer-repeater-color-control .wp-picker-container').replaceWith('<input type="text" class="customizer-repeater-color-control ' + id + '">');
                field.find('input.customizer-repeater-color-control').wpColorPicker(color_options);


                field.find('div.customizer-repeater-color2-control .wp-picker-container').replaceWith('<input type="text" class="customizer-repeater-color2-control ' + id + '">');
                field.find('input.customizer-repeater-color2-control').wpColorPicker(color_options);

                // field.find('.customize-control-notifications-container').remove();


                /*Remove value from subtitle field*/
                field.find('.customizer-repeater-subtitle-control').val('');

                /*Remove value from shortcode field*/
                field.find('.customizer-repeater-shortcode-control').val('');
                field.find('.customizer-repeater-hidden-control').val('');

                /* latest videos */
                field.find('.latest_title').val('');
                field.find('.latest_url').val('');
                field.find('.latest_enabled').val('');
                field.find('.latest_ads_enabled').val('');
                field.find('.latest_ads').val('');
                field.find('.latest_number').val('');
                field.find('.tags_enabled').val('');
                field.find('.tags_select').val('');
                field.find('.tags_number').val('');
                field.find('.tags_order').val('');
                field.find('.categories_enabled').val('');
                field.find('.categories_select').val('');
                field.find('.categories_number').val('');
                field.find('.categories_order').val('');
                field.find('.categories_title').val('');
                field.find('.categories_url').val('');

                field.find('.pornstar_title').val('');
                field.find('.pornstar_url').val('');
                field.find('.pornstar_enabled').val('');
                field.find('.pornstar_number').val('');

                field.find('.channel_title').val('');
                field.find('.channel_url').val('');
                field.find('.channel_enabled').val('');
                field.find('.channel_number').val('');

                field.find('.movies_title').val('');
                field.find('.movies_url').val('');
                field.find('.movies_enabled').val('');
                field.find('.movies_number').val('');

                /*Append new box*/
                th.find('.customizer-repeater-general-control-repeater-container:first').parent().append(field);

                /*Refresh values*/
                customizer_repeater_refresh_general_control_values();
            }

        }
        return false;
    });


    theme_conrols.on('click', '.social-repeater-general-control-remove-field', function () {
        if (typeof    jQuery(this).parent() !== 'undefined') {
            jQuery(this).parent().hide(500, function(){
                jQuery(this).parent().remove();
                customizer_repeater_refresh_general_control_values();

            });
        }
        return false;
    });


    theme_conrols.on('keyup', '.customizer-repeater-title-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    jQuery('input.customizer-repeater-color-control').wpColorPicker(color_options);
    jQuery('input.customizer-repeater-color2-control').wpColorPicker(color_options);

    theme_conrols.on('keyup', '.customizer-repeater-subtitle-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.customizer-repeater-shortcode-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.customizer-repeater-text-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.customizer-repeater-link-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.customizer-repeater-text2-control', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.customizer-repeater-hidden-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    /* latest */

    theme_conrols.on('keyup', '.latest_title', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.latest_url', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.latest_enabled', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.latest_ads_enabled', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.latest_ads', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.latest_number', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.pornstar_title', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.pornstar_url', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.pornstar_enabled', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.pornstar_number', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.channel_title', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.channel_url', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.channel_enabled', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.channel_number', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.movies_title', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.movies_url', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.movies_enabled', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.movies_number', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.tags_enabled', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.tags_select', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.tags_number', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.tags_order', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.categories_enabled', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.categories_select', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.categories_number', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.categories_order', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.categories_title', function () {
        customizer_repeater_refresh_general_control_values();
    });
    theme_conrols.on('keyup', '.categories_url', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.customizer-repeater-link2-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    /*Drag and drop to change icons order*/

    jQuery('.customizer-repeater-general-control-droppable').sortable({
        axis: 'y',
        update: function () {
            customizer_repeater_refresh_general_control_values();
        }
    });


    /*----------------- Socials Repeater ---------------------*/
    theme_conrols.on('click', '.social-repeater-add-social-item', function (event) {
        event.preventDefault();
        var th = jQuery(this).parent();
        var id = 'customizer-repeater-social-repeater-' + customizer_repeater_uniqid();
        if (typeof th !== 'undefined') {
            var field = th.find('.customizer-repeater-social-repeater-container:first').clone( true, true );
            if (typeof field !== 'undefined') {
                field.find( '.icp' ).val('');
                field.find( '.input-group-addon' ).find('.fa').attr('class','fa');
                field.find('.social-repeater-remove-social-item').show();
                field.find('.customizer-repeater-social-repeater-link').val('');
                field.find('.customizer-repeater-social-repeater-id').val(id);
                th.find('.customizer-repeater-social-repeater-container:first').parent().append(field);
            }
        }
        return false;
    });

    theme_conrols.on('click', '.social-repeater-remove-social-item', function (event) {
        event.preventDefault();
        var th = jQuery(this).parent();
        var repeater = jQuery(this).parent().parent();
        th.remove();
        customizer_repeater_refresh_social_icons(repeater);
        return false;
    });

    theme_conrols.on('keyup', '.customizer-repeater-social-repeater-link', function (event) {
        event.preventDefault();
        var repeater = jQuery(this).parent().parent();
        customizer_repeater_refresh_social_icons(repeater);
        return false;
    });

    theme_conrols.on('change', '.customizer-repeater-social-repeater-container .icp', function (event) {
        event.preventDefault();
        var repeater = jQuery(this).parent().parent().parent();
        customizer_repeater_refresh_social_icons(repeater);
        return false;
    });

});

var entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    '\'': '&#39;',
    '/': '&#x2F;'
};

function escapeHtml(string) {
    'use strict';
    //noinspection JSUnresolvedFunction
    string = String(string).replace(new RegExp('\r?\n', 'g'), '<br />');
    string = String(string).replace(/\\/g, '&#92;');
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });

}


