<?php

/**
 * Front Page
 *
 * @package Total
 */
get_header();

$total_enable_frontpage = get_theme_mod('total_enable_frontpage', false);

if ($total_enable_frontpage) {
    $total_home_sections = total_home_section();

    get_template_part('template-parts/section', 'slider');

    foreach ($total_home_sections as $total_home_section) {
        $total_home_section = str_replace('total_', '', $total_home_section);
        $total_home_section = str_replace('_section', '', $total_home_section);
        get_template_part('template-parts/section', $total_home_section);
    }
} else {
    if ('posts' == get_option('show_on_front')) {
        include( get_home_template() );
    } else {
        include( get_page_template() );
    }
}

get_footer();
