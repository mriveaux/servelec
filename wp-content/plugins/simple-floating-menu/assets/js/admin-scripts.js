(function ($) {

    $('#sfm-tab-wrapper .sfm-tab').click(function () {
        var id = $(this).attr('href');
        $(this).parent().find('.sfm-tab').removeClass('sfm-tab-active');
        $(this).addClass('sfm-tab-active');

        $('.sfm-form-page').hide();
        $(id).fadeIn()
        return false;
    });

    $('body').on('click', '.sfm-add-new-button-fields a', function () {
        var $this = $('.sfm-button-repeater');
        var count = parseInt($this.attr('data-count'));
        $this.attr('data-count', count + 1);

        if (typeof $this != 'undefined') {
            var field = $this.find('.sfm-button-fields:first').clone();
            field.find('[name]').each(function () {
                var name = $(this).attr('name');
                name = name.split('[');

                name[2] = name[2].replace(/[0-9]/g, count + 1);
                name = name.join('[');
                $(this).attr('name', name);

                var defaultVal = $(this).attr('data-default');

                var checkClasss = $(this).attr('class');
                if (checkClasss == 'sfm-unique-id') {
                    var id = 'sfm-' + Date.now();
                    $(this).val(id);
                } else {
                    if (defaultVal) {
                        $(this).val(defaultVal);
                    } else {
                        $(this).val('');
                    }
                }

            });
            field.find('.placeholder').each(function () {
                $(this).removeClass('hidden');
            });
            field.find('.thumbnail-image').each(function () {
                $(this).html('');
            });
            field.find('.sfm-color-picker').each(function () {
                $colorPicker = $(this);
                $colorPicker.closest('.wp-picker-container').after($(this));
                $colorPicker.prev('.wp-picker-container').remove();
                $(this).wpColorPicker({
                    change: function (event, ui) {
                        var $input = $(this);
                        if (jQuery('html').hasClass('colorpicker-ready')) {
                            setTimeout(function () {
                                $input.trigger('change');
                            }, 100);
                        }
                    },
                });
            });
            field.find('.sfm-customizer-icon-box').each(function () {
                var iconClass = $(this).find('[name]').attr('data-default');
                $(this).find('.sfm-selected-icon > i').attr('class', iconClass);
                $(this).find('.sfm-icon-search-input').val('');
                $(this).find('.sfm-icon-list li').show();
            });
            $this.append(field);
        }

        var value = sfm_refresh_repeater_values();
        sfm_live_preview(value);
        return false;
    });

    $('body').on('click', '.sfm-remove', function () {
        var $el = $(this);
        $el.closest('.sfm-button-fields').fadeOut()
        setTimeout(function () {
            $el.closest('.sfm-button-fields').remove()
            var value = sfm_refresh_repeater_values();
            sfm_live_preview(value);
        }, 1000);
    });

    jQuery('.sfm-button-repeater').sortable({
        axis: 'y',
        helper: 'clone',
        cursor: 'move',
        handle: '.sfm-button-fields-header',
        update: function (event, ui) {
            jQuery(this).find('.sfm-button-fields').each(function (index) {
                jQuery(this).find('[name]').each(function () {
                    var name = jQuery(this).attr('name');
                    name = name.split('[');

                    name[2] = name[2].replace(/[0-9]/g, index + 1);
                    name = name.join('[');
                    jQuery(this).attr('name', name);
                });

                var value = sfm_refresh_repeater_values();
                sfm_live_preview(value);
            });
        }
    });

    var $viewMap = {
        'top-left': $('.sfm-top-offset-wrap, .sfm-left-offset-wrap'),
        'top-middle': $('.sfm-top-offset-wrap'),
        'top-right': $('.sfm-top-offset-wrap, .sfm-right-offset-wrap'),
        'bottom-left': $('.sfm-bottom-offset-wrap, .sfm-left-offset-wrap'),
        'bottom-middle': $('.sfm-bottom-offset-wrap'),
        'bottom-right': $('.sfm-bottom-offset-wrap, .sfm-right-offset-wrap'),
        'middle-left': $('.sfm-left-offset-wrap'),
        'middle-right': $('.sfm-right-offset-wrap')
    };

    $('.sfm-button-position').change(function () {
        // hide all
        $.each($viewMap, function () {
            this.hide();
        });

        // show current
        $viewMap[$(this).val()].show();
    }).change();

    $('#enable_sfm').change(function () {
        if ($(this).is(':checked')) {
            $('#enable_sfm_setting').parents('.sfm-form-row').show();
        } else {
            $('#enable_sfm_setting').parents('.sfm-form-row').hide();
        }
    }).change();

    $(document).on('change', '.typography_face', function () {
        var font_family = $(this).val();
        var $this = $(this);
        $.ajax({
            url: ajaxurl,
            data: {
                action: 'get_google_font_variants',
                font_family: font_family,
            },
            beforeSend: function () {
                $this.closest('.sfm-typography-font-family').next('.sfm-typography-font-style').addClass('typography-loading');
            },
            success: function (response) {
                $this.closest('.sfm-typography-font-family').next('.sfm-typography-font-style').removeClass('typography-loading');
                $this.closest('.sfm-typography-font-family').next('.sfm-typography-font-style').find('select').html(response).trigger("chosen:updated");
            }
        });
        if (font_family != 'Courier' && font_family != 'Times' && font_family != 'Arial' && font_family != 'Verdana' && font_family != 'Trebuchet' && font_family != 'Georgia' && font_family != 'Tahoma' && font_family != 'Palatino' && font_family != 'Helvetica') {
            WebFont.load({
                google: {
                    families: [font_family]
                }
            });
        }
    });

    $(".typography_face, .typography_font_style, .typography_text_transform, .typography_text_decoration").chosen({width: "95%"});

    $('.sfm-sticky-button a').click(function (e) {
        e.preventDefault();
    });

    jQuery('html').addClass('colorpicker-ready');

    $('.sfm-color-picker').wpColorPicker({
        change: function (event, ui) {
            var $input = $(this);
            if (jQuery('html').hasClass('colorpicker-ready')) {
                setTimeout(function () {
                    $input.trigger('change');
                }, 100);
            }
        },
    });

    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    // FontAwesome Icon Control JS
    $('body').on('click', '.sfm-customizer-icon-box .sfm-icon-list li', function () {
        var icon_class = $(this).find('i').attr('class');
        $(this).closest('.sfm-icon-box').find('.sfm-icon-list li').removeClass('icon-active');
        $(this).addClass('icon-active');
        $(this).closest('.sfm-icon-box').prev('.sfm-selected-icon').children('i').attr('class', '').addClass(icon_class);
        $(this).closest('.sfm-icon-box').next('input').val(icon_class).trigger('change');
        $(this).closest('.sfm-icon-box').slideUp();
    });

    $('body').on('click', '.sfm-customizer-icon-box .sfm-selected-icon', function () {
        $(this).next().slideToggle();
    });

    $('body').on('change', '.sfm-customizer-icon-box .sfm-icon-search select', function () {
        var selected = $(this).val();
        $(this).closest('.sfm-icon-box').find('.sfm-icon-search-input').val('');
        $(this).closest('.sfm-icon-box').find('.sfm-icon-list li').show();
        $(this).closest('.sfm-icon-box').find('.sfm-icon-list').hide().removeClass('active');
        $(this).closest('.sfm-icon-box').find('.' + selected).fadeIn().addClass('active');
    });

    $('body').on('keyup', '.sfm-customizer-icon-box .sfm-icon-search input', function (e) {
        var $input = $(this);
        var keyword = $input.val().toLowerCase();
        search_criteria = $input.closest('.sfm-icon-box').find('.sfm-icon-list.active i');

        delay(function () {
            $(search_criteria).each(function () {
                if ($(this).attr('class').indexOf(keyword) > -1) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        }, 500);
    });

    $('.range-input').each(function () {
        var $dis = $(this);
        var defaultValue = parseFloat($dis.attr('value'));
        var handle = $dis.find(".ui-slider-handle");
        $dis.slider({
            range: "min",
            value: defaultValue,
            min: parseFloat($dis.attr('data-min')),
            max: parseFloat($dis.attr('data-max')),
            step: parseFloat($dis.attr('data-step')),
            create: function () {
                $dis.find(".ui-slider-handle").html('<span>' + $(this).slider("value") + '</span>');
            },
            slide: function (event, ui) {
                $dis.siblings(".range-input-selector").val(ui.value).trigger('change');
                $dis.find(".ui-slider-handle").html('<span>' + ui.value + '</span>');
            }
        });
    });

    $('body').on('change', '#sfm-form-wrap [name]', function () {
        setTimeout(function () {
            var value = sfm_refresh_repeater_values();
            sfm_live_preview(value);
        }, 1000);
    });

    function sfm_live_preview(value) {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {action: 'sfm_live_preview', values: value},
            beforeSend: function () {
                $('.sfm-live-demo').addClass('sfm-loading');
                $('.submit .button').attr('disabled', 'disabled');
            },
            success: function (result) {
                $('.sfm-live-demo').html(result).removeClass('sfm-loading');
                $('.submit .button').removeAttr('disabled', 'disabled');
            }
        });
    }

    function sfm_refresh_repeater_values() {
        var values = [];
        var $this = $(this);

        $(".sfm-button-repeater").find(".sfm-button-fields").each(function () {
            var valueToPush = {};

            $(this).find('[name]').each(function (index) {
                var name = $(this).attr('name');
                name = name.split('[');
                name = name[3].replace(']', '');
                var dataValue = $(this).val();
                valueToPush[name] = dataValue;
            });

            values.push(valueToPush);
        });

        var valueToPush = {};
        $('#tab-sfm-settings').find('[name]').each(function () {
            var name = $(this).attr('name');
            var dataValue = $(this).val();
            name = name.split('[');
            name.shift();

            var newname = [];
            $.each(name, function (index, value) {
                if (value.indexOf(']') > -1) {
                    newname.push(value.replace(']', ''));
                }
            });

            var name = newname.join('_');
            valueToPush[name] = dataValue;
        });
        values.push(valueToPush);

        return JSON.stringify(values);
    }
})(jQuery);

