<?php

function sfm_dymanic_styles() {
    $custom_css = "";
    $settings = Simple_Floating_Menu::get_settings();

    $button_height = $settings['button_height'];
    $button_width = $settings['button_width'];
    $icon_size = $settings['icon_size'];
    $icon_position = $settings['icon_position'];
    $button_spacing = ($settings['button_spacing']) / 2;
    $top_offset = $settings['top_offset'];
    $bottom_offset = $settings['bottom_offset'];
    $left_offset = $settings['left_offset'];
    $right_offset = $settings['right_offset'];
    $buttons = $settings['buttons'];
    $zindex = $settings['zindex'];

    $custom_css .= ".sfm-floating-menu a.sfm-shape-button{height:{$button_height}px; width:{$button_width}px;}";
    $custom_css .= ".sfm-floating-menu a.sfm-shape-button{font-size:{$icon_size}px;}";
    $custom_css .= ".sfm-floating-menu i{top:{$icon_position}px}";
    $custom_css .= ".sfm-floating-menu.horizontal{margin:0 -{$button_spacing}px}";
    $custom_css .= ".sfm-floating-menu.vertical{margin:-{$button_spacing}px 0}";
    $custom_css .= ".sfm-floating-menu.horizontal .sfm-button{margin:0 {$button_spacing}px}";
    $custom_css .= ".sfm-floating-menu.vertical .sfm-button{margin:{$button_spacing}px 0}";
    $custom_css .= ".sfm-floating-menu.top-left, .sfm-floating-menu.top-right, .sfm-floating-menu.top-middle{top:{$top_offset}px}";
    $custom_css .= ".sfm-floating-menu.bottom-left, .sfm-floating-menu.bottom-right, .sfm-floating-menu.bottom-middle{bottom:{$bottom_offset}px}";
    $custom_css .= ".sfm-floating-menu.top-left, .sfm-floating-menu.bottom-left, .sfm-floating-menu.middle-left {left:{$left_offset}px}";
    $custom_css .= ".sfm-floating-menu.top-right, .sfm-floating-menu.bottom-right, .sfm-floating-menu.middle-right {right:{$right_offset}px}";
    $custom_css .= ".sfm-floating-menu{z-index:{$zindex};}";

    $buttons = $settings['buttons'];
    if ($buttons) {
        foreach ($buttons as $button) {
            $class = $button['id'];

            if (isset($button['button_bg_color'])) {
                $button_bg_color = $button['button_bg_color'];
                $custom_css .= ".sfm-floating-menu .{$class} a.sfm-shape-button{background:{$button_bg_color}}";
            }

            if (isset($button['button_icon_color'])) {
                $button_icon_color = $button['button_icon_color'];
                $custom_css .= ".sfm-floating-menu .{$class} a.sfm-shape-button{color:{$button_icon_color}}";
            }

            if (isset($button['button_bg_color_hover'])) {
                $button_bg_color_hover = $button['button_bg_color_hover'];
                $custom_css .= ".sfm-floating-menu .{$class}:hover a.sfm-shape-button{background:{$button_bg_color_hover}}";
            }

            if (isset($button['button_icon_color_hover'])) {
                $button_icon_color_hover = $button['button_icon_color_hover'];
                $custom_css .= ".sfm-floating-menu .{$class}:hover a.sfm-shape-button{color:{$button_icon_color_hover}}";
            }

            if (isset($button['tooltip_bg_color'])) {
                $tooltip_bg_color = $button['tooltip_bg_color'];
                $custom_css .= ".sfm-floating-menu .{$class} .sfm-tool-tip{background:{$tooltip_bg_color}}";
                $custom_css .= ".sfm-floating-menu.top-left.horizontal .{$class} .sfm-tool-tip:after,
                                .sfm-floating-menu.top-middle.horizontal .{$class} .sfm-tool-tip:after,
                                .sfm-floating-menu.top-right.horizontal .{$class} .sfm-tool-tip:after{border-color: transparent transparent {$tooltip_bg_color} transparent;}";
                $custom_css .= ".sfm-floating-menu.top-left.vertical .{$class} .sfm-tool-tip:after,
                                .sfm-floating-menu.top-middle.vertical .{$class} .sfm-tool-tip:after,
                                .sfm-floating-menu.bottom-left.vertical .{$class} .sfm-tool-tip:after,
                                .sfm-floating-menu.bottom-middle.vertical .{$class} .sfm-tool-tip:after,
                                .sfm-floating-menu.middle-left.vertical .{$class} .sfm-tool-tip:after{border-color: transparent {$tooltip_bg_color} transparent transparent;}";
                $custom_css .= ".sfm-floating-menu.top-right.vertical .{$class} .sfm-tool-tip:after,
                                .sfm-floating-menu.middle-right.vertical .{$class} .sfm-tool-tip:after,
                                .sfm-floating-menu.bottom-right.vertical .{$class} .sfm-tool-tip:after{border-color: transparent transparent transparent {$tooltip_bg_color};}";
                $custom_css .= ".sfm-floating-menu.bottom-left.horizontal .{$class} .sfm-tool-tip:after,
                                .sfm-floating-menu.bottom-middle.horizontal .{$class} .sfm-tool-tip:after,
                                .sfm-floating-menu.bottom-right.horizontal .{$class} .sfm-tool-tip:after,
                                .sfm-floating-menu.middle-left.horizontal .{$class} .sfm-tool-tip:after,
                                .sfm-floating-menu.middle-right.horizontal .{$class} .sfm-tool-tip:after{border-color: {$tooltip_bg_color} transparent transparent transparent;}";
            }

            if (isset($button['tooltip_text_color'])) {
                $tooltip_text_color = $button['tooltip_text_color'];
                $custom_css .= ".sfm-floating-menu .{$class} .sfm-tool-tip a{color:{$tooltip_text_color}}";
            }
        }
    }

    if (isset($settings['tooltip_font']['family'])) {
        $tooltip_font_family = $settings['tooltip_font']['family'];
        $custom_css .= ".sfm-floating-menu .sfm-tool-tip a{font-family:{$tooltip_font_family}}";
    }

    if (isset($settings['tooltip_font']['style'])) {
        $tooltip_font_style = $settings['tooltip_font']['style'];
        $font_italic = 'normal';
        if (strpos($tooltip_font_style, 'italic')) {
            $font_italic = 'italic';
        }

        $tooltip_font_weight = absint($tooltip_font_style);
        $custom_css .= ".sfm-floating-menu .sfm-tool-tip a{font-weight:{$tooltip_font_weight}; font-style:{$font_italic}}";
    }

    if (isset($settings['tooltip_font']['transform'])) {
        $tooltip_font_transform = $settings['tooltip_font']['transform'];
        $custom_css .= ".sfm-floating-menu .sfm-tool-tip a{text-transform:{$tooltip_font_transform}}";
    }

    if (isset($settings['tooltip_font']['decoration'])) {
        $tooltip_font_decoration = $settings['tooltip_font']['decoration'];
        $custom_css .= ".sfm-floating-menu .sfm-tool-tip a{text-decoration:{$tooltip_font_decoration}}";
    }

    if (isset($settings['tooltip_font']['size'])) {
        $tooltip_font_size = $settings['tooltip_font']['size'];
        $custom_css .= ".sfm-floating-menu .sfm-tool-tip a{font-size:{$tooltip_font_size}px}";
    }

    if (isset($settings['tooltip_font']['line_height'])) {
        $tooltip_font_line_height = $settings['tooltip_font']['line_height'];
        $custom_css .= ".sfm-floating-menu .sfm-tool-tip a{line-height:{$tooltip_font_line_height}}";
    }

    if (isset($settings['tooltip_font']['letter_spacing'])) {
        $tooltip_font_letter_spacing = $settings['tooltip_font']['letter_spacing'];
        $custom_css .= ".sfm-floating-menu .sfm-tool-tip a{letter-spacing:{$tooltip_font_letter_spacing}px}";
    }

    if (isset($settings['tooltip_font']['color'])) {
        $tooltip_font_color = $settings['tooltip_font']['color'];
        $custom_css .= ".sfm-floating-menu .sfm-tool-tip a{color:{$tooltip_font_color}}";
    }

    return sfm_css_strip_whitespace($custom_css);
}

function sfm_css_strip_whitespace($css) {
    $replace = array(
        "#/\*.*?\*/#s" => "", // Strip C style comments.
        "#\s\s+#" => " ", // Strip excess whitespace.
    );
    $search = array_keys($replace);
    $css = preg_replace($search, $replace, $css);

    $replace = array(
        ": " => ":",
        "; " => ";",
        " {" => "{",
        " }" => "}",
        ", " => ",",
        "{ " => "{",
        ";}" => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} " => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys($replace);
    $css = str_replace($search, $replace, $css);

    return trim($css);
}
