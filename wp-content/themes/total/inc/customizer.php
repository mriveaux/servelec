<?php
/**
 * Total Theme Customizer
 *
 * @package Total
 */

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function total_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
    $wp_customize->get_setting('custom_logo')->transport = 'refresh';
    $wp_customize->get_control('background_color')->section = 'background_image';
    $wp_customize->get_section('static_front_page')->priority = 2;

    global $wp_registered_sidebars;

    $total_widget_list[] = esc_html__("-- Don't Replace --", "total");
    foreach ($wp_registered_sidebars as $wp_registered_sidebar) {
        $total_widget_list[$wp_registered_sidebar['id']] = $wp_registered_sidebar['name'];
    }

    $total_categories = get_categories(array('hide_empty' => 0));
    foreach ($total_categories as $total_category) {
        $total_cat[$total_category->term_id] = $total_category->cat_name;
    }

    $total_pages = get_pages(array('hide_empty' => 0));
    foreach ($total_pages as $total_pages_single) {
        $total_page_choice[$total_pages_single->ID] = $total_pages_single->post_title;
    }

    for ($i = 1; $i <= 100; $i++) {
        $total_percentage[$i] = $i;
    }

    $total_post_count_choice = array(3 => 3, 6 => 6, 9 => 9);

    $total_pro_features = '<ul class="upsell-features">
	<li>' . esc_html__("One click demo import", "total") . '</li>
	<li>' . esc_html__("18 Front page sections with lots of variations", "total") . '</li>
	<li>' . esc_html__("Section reorder", "total") . '</li>
	<li>' . esc_html__("Video background, Image Motion background, Parallax background, Gradient background option for each section", "total") . '</li>
	<li>' . esc_html__("4 icon pack for icon picker (5000+ Icons)", "total") . '</li>
	<li>' . esc_html__("Unlimited slider with linkable button", "total") . '</li>
	<li>' . esc_html__("Add unlimited blocks(like slider, team, testimonial) for each Section", "total") . '</li>
	<li>' . esc_html__("Fully customizable options for Front Page blocks", "total") . '</li>
	<li>' . esc_html__("15+ Shape divider to choose from for each section", "total") . '</li>
	<li>' . esc_html__("Remove footer credit Text", "total") . '</li>
	<li>' . esc_html__("6 header layouts and advanced header settings", "total") . '</li>
	<li>' . esc_html__("4 blog layouts", "total") . '</li>
	<li>' . esc_html__("In-built MegaMenu", "total") . '</li>
	<li>' . esc_html__("Advanced Typography options", "total") . '</li>
	<li>' . esc_html__("Advanced color options", "total") . '</li>
	<li>' . esc_html__("Top header bar", "total") . '</li>
	<li>' . esc_html__("PreLoader option", "total") . '</li>
	<li>' . esc_html__("Sidebar layout options", "total") . '</li>
	<li>' . esc_html__("Website layout (Fullwidth or Boxed)", "total") . '</li>
	<li>' . esc_html__("Advanced blog settings", "total") . '</li>
	<li>' . esc_html__("Advanced footer setting", "total") . '</li>
	<li>' . esc_html__("Front page sections with full window height", "total") . '</li>
	<li>' . esc_html__("26 custom widgets", "total") . '</li>
	<li>' . esc_html__("Blog single page - Author Box, Social Share and Related Post", "total") . '</li>
	<li>' . esc_html__("Google map option", "total") . '</li>
	<li>' . esc_html__("WooCommerce Compatible", "total") . '</li>
	<li>' . esc_html__("Fully Multilingual and Translation ready", "total") . '</li>
	<li>' . esc_html__("Fully RTL(Right to left) languages compatible", "total") . '</li>
	</ul>
	<a class="ht-implink" href="https://hashthemes.com/wordpress-theme/total-plus/#theme-comparision-tab" target="_blank">' . esc_html__("Comparision - Free Vs Pro", "total") . '</a>';


    $wp_customize->register_section_type('Total_Customize_Section_Pro');
    $wp_customize->register_section_type('Total_Customize_Upgrade_Section');

    $wp_customize->add_section(new Total_Customize_Section_Pro($wp_customize, 'total-pro-section', array(
        'priority' => 0,
        'pro_text' => esc_html__('Upgrade to Pro', 'total'),
        'pro_url' => 'https://hashthemes.com/wordpress-theme/total-plus/?utm_source=wordpress&utm_medium=total-customizer-button&utm_campaign=total-upgrade'
    )));

    $wp_customize->add_section(new Total_Customize_Section_Pro($wp_customize, 'total-doc-section', array(
        'title' => esc_html__('Documentation', 'total'),
        'priority' => 1000,
        'pro_text' => esc_html__('View', 'total'),
        'pro_url' => 'https://hashthemes.com/documentation/total-documentation/'
    )));

    $wp_customize->add_section(new Total_Customize_Section_Pro($wp_customize, 'total-demo-import-section', array(
        'title' => esc_html__('Import Demo Content', 'total'),
        'priority' => 1001,
        'pro_text' => esc_html__('Import', 'total'),
        'pro_url' => admin_url('admin.php?page=total-welcome')
    )));
    
    /* ============HOMEPAGE SETTINGS PANEL============ */
    $wp_customize->add_setting('total_enable_frontpage', array(
        'sanitize_callback' => 'total_sanitize_checkbox'
    ));

    $wp_customize->add_control(new Total_Toggle_Control($wp_customize, 'total_enable_frontpage', array(
        'section' => 'static_front_page',
        'label' => esc_html__('Enable FrontPage', 'total'),
        'description' => esc_html__('Overwrites the homepage displays setting and shows the frontpage', 'total')
    )));

    /* ============GENERAL SETTINGS PANEL============ */
    $wp_customize->add_panel('total_general_settings_panel', array(
        'title' => esc_html__('General Settings', 'total'),
        'priority' => 10
    ));

    //TITLE AND TAGLINE SETTINGS
    $wp_customize->add_section('title_tagline', array(
        'title' => esc_html__('Site Logo, Title & Tagline', 'total'),
        'panel' => 'total_general_settings_panel',
    ));

    $wp_customize->get_control('header_text')->label = esc_html__('Display Site Title and Tagline(Only Displays if Logo is Removed)', 'total');

    //BACKGROUND IMAGE
    $wp_customize->add_section('background_image', array(
        'title' => esc_html__('Background Image', 'total'),
        'panel' => 'total_general_settings_panel',
    ));

    //COLOR SETTINGS
    $wp_customize->add_section('colors', array(
        'title' => esc_html__('Colors', 'total'),
        'panel' => 'total_general_settings_panel',
    ));

    $wp_customize->add_setting('total_template_color', array(
        'default' => '#FFC107',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'total_template_color', array(
        'settings' => 'total_template_color',
        'section' => 'colors',
        'label' => esc_html__('Theme Primary Color ', 'total'),
    )));

    $wp_customize->add_setting('total_color_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_color_upgrade_text', array(
        'section' => 'colors',
        'label' => esc_html__('For more color options,', 'total'),
        'priority' => 100
    )));

    //HEADER SETTINGS
    $wp_customize->add_section('total_header_settings', array(
        'title' => esc_html__('Header Settings', 'total'),
        'priority' => 15
    ));

    //ENABLE/DISABLE STICKY HEADER
    $wp_customize->add_setting('total_sticky_header_enable', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => 'off'
    ));

    $wp_customize->add_control(new Total_Switch_Control($wp_customize, 'total_sticky_header_enable', array(
        'settings' => 'total_sticky_header_enable',
        'section' => 'total_header_settings',
        'label' => esc_html__('Sticky Header', 'total'),
        'on_off_label' => array(
            'on' => esc_html__('Yes', 'total'),
            'off' => esc_html__('No', 'total')
    ))));

    $wp_customize->add_setting('total_header_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_header_upgrade_text', array(
        'section' => 'total_header_settings',
        'label' => esc_html__('For more header layouts and settings,', 'total'),
        'choices' => array(
            esc_html__('6 header styles', 'total'),
            esc_html__('Option to enable/disable top header', 'total'),
            esc_html__('Increase/Decrease logo and header height', 'total'),
            esc_html__('Search and social button option on header', 'total'),
            esc_html__('7 menu hover styles', 'total'),
            esc_html__('Mega menu', 'total'),
            esc_html__('Advanced header color options', 'total'),
            esc_html__('Option for different header banner on each post/page', 'total'),
        ),
        'priority' => 100
    )));

    /* ============HOME PANEL============ */
    $wp_customize->add_panel('total_home_panel', array(
        'title' => esc_html__('Home Sections', 'total'),
        'priority' => 20,
        'description' => esc_html__('Drag and Drop to Reorder', 'total') . '<img class="total-drag-spinner" src="' . admin_url('/images/spinner.gif') . '">',
    ));

    /* ============SLIDER IMAGES SECTION============ */
    $wp_customize->add_section('total_slider_section', array(
        'title' => esc_html__('Home Slider', 'total'),
        'panel' => 'total_home_panel',
        'priority' => -1
    ));

    //SLIDERS
    for ($i = 1; $i < 4; $i++) {

        $wp_customize->add_setting('total_slider_heading' . $i, array(
            'sanitize_callback' => 'total_sanitize_text'
        ));

        $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_slider_heading' . $i, array(
            'settings' => 'total_slider_heading' . $i,
            'section' => 'total_slider_section',
            'label' => esc_html__('Slider ', 'total') . $i,
        )));

        $wp_customize->add_setting('total_slider_page' . $i, array(
            'sanitize_callback' => 'absint'
        ));

        $wp_customize->add_control('total_slider_page' . $i, array(
            'settings' => 'total_slider_page' . $i,
            'section' => 'total_slider_section',
            'type' => 'dropdown-pages',
            'label' => esc_html__('Select a Page', 'total'),
        ));
    }

    $wp_customize->add_setting('total_slider_info', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Info_Text($wp_customize, 'total_slider_info', array(
        'settings' => 'total_slider_info',
        'section' => 'total_slider_section',
        'label' => esc_html__('Note:', 'total'),
        'description' => wp_kses_post(__('The Page featured image works as a slider banner and the title & content work as a slider caption. <br/> Recommended Image Size: 1900X600', 'total')),
    )));

    $wp_customize->add_setting('total_slider_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_slider_upgrade_text', array(
        'section' => 'total_slider_section',
        'label' => esc_html__('To add unlimited slider block and for more settings,', 'total'),
        'choices' => array(
            esc_html__('Unlimited slider blocks', 'total'),
            esc_html__('Repeatable slider block with image, caption and button fields instead of page', 'total'),
            esc_html__('Option for Revolution slider or single banner display with text', 'total'),
            esc_html__('Option to link slider externally with button', 'total'),
            esc_html__('Option to configure slider pause duration', 'total'),
            esc_html__('Option to change caption background and text color', 'total'),
            esc_html__('Advanced slider settings', 'total'),
        ),
        'priority' => 100
    )));

    /* ============ABOUT US SECTION============ */
    $wp_customize->add_section('total_about_section', array(
        'title' => esc_html__('About Us Section', 'total'),
        'panel' => 'total_home_panel',
        'priority' => total_get_section_position('total_about_section')
    ));

    //ENABLE/DISABLE ABOUT US PAGE
    $wp_customize->add_setting('total_about_page_disable', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => 'off'
    ));

    $wp_customize->add_control(new Total_Switch_Control($wp_customize, 'total_about_page_disable', array(
        'settings' => 'total_about_page_disable',
        'section' => 'total_about_section',
        'label' => esc_html__('Disable Section', 'total'),
        'on_off_label' => array(
            'on' => esc_html__('Yes', 'total'),
            'off' => esc_html__('No', 'total')
        )
    )));

    //ABOUT US PAGE
    $wp_customize->add_setting('total_about_page', array(
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('total_about_page', array(
        'settings' => 'total_about_page',
        'section' => 'total_about_section',
        'type' => 'dropdown-pages',
        'label' => esc_html__('Select a Page', 'total'),
    ));

    for ($i = 1; $i < 6; $i++) {
        $wp_customize->add_setting('total_about_progressbar_heading' . $i, array(
            'sanitize_callback' => 'total_sanitize_text'
        ));

        $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_about_progressbar_heading' . $i, array(
            'settings' => 'total_about_progressbar_heading' . $i,
            'section' => 'total_about_section',
            'label' => esc_html__('Progress Bar ', 'total') . $i,
        )));

        $wp_customize->add_setting('total_about_progressbar_disable' . $i, array(
            'sanitize_callback' => 'absint'
        ));

        $wp_customize->add_control('total_about_progressbar_disable' . $i, array(
            'settings' => 'total_about_progressbar_disable' . $i,
            'section' => 'total_about_section',
            'label' => esc_html__('Check to Disable', 'total'),
            'type' => 'checkbox'
        ));

        $wp_customize->add_setting('total_about_progressbar_title' . $i, array(
            'sanitize_callback' => 'total_sanitize_text',
            'default' => sprintf(
                    /* translators: Progress bar count */
                    esc_html__('Progress Bar %d', 'total'), $i
        )));

        $wp_customize->add_control('total_about_progressbar_title' . $i, array(
            'settings' => 'total_about_progressbar_title' . $i,
            'section' => 'total_about_section',
            'type' => 'text',
            'label' => esc_html__('Title', 'total')
        ));

        $wp_customize->add_setting('total_about_progressbar_percentage' . $i, array(
            'sanitize_callback' => 'total_sanitize_choices',
            'default' => rand(60, 100)
        ));

        $wp_customize->add_control(new Total_Dropdown_Chooser($wp_customize, 'total_about_progressbar_percentage' . $i, array(
            'settings' => 'total_about_progressbar_percentage' . $i,
            'section' => 'total_about_section',
            'label' => esc_html__('Percentage', 'total'),
            'choices' => $total_percentage
        )));

        $wp_customize->add_setting('total_about_image_heading', array(
            'sanitize_callback' => 'total_sanitize_text'
        ));

        $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_about_image_heading', array(
            'settings' => 'total_about_image_heading',
            'section' => 'total_about_section',
            'label' => esc_html__('Right Image', 'total'),
        )));

        $wp_customize->add_setting('total_about_image', array(
            'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'total_about_image', array(
            'section' => 'total_about_section',
            'settings' => 'total_about_image',
            'description' => esc_html__('Recommended Image Size: 500X600px', 'total')
        )));

        $wp_customize->add_setting('total_about_widget', array(
            'default' => '0',
            'sanitize_callback' => 'total_sanitize_choices'
        ));

        $wp_customize->add_control('total_about_widget', array(
            'settings' => 'total_about_widget',
            'section' => 'total_about_section',
            'type' => 'select',
            'label' => esc_html__('Replace Image by widget', 'total'),
            'choices' => $total_widget_list
        ));
    }

    $wp_customize->add_setting('total_about_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_about_upgrade_text', array(
        'section' => 'total_about_section',
        'label' => esc_html__('For more settings,', 'total'),
        'choices' => array(
            esc_html__('Option to disable the Right Image', 'total'),
            esc_html__('Multiple background option(image, gradient, video) for the section', 'total')
        ),
        'priority' => 100
    )));

    /* ============FEATURED SECTION PANEL============ */
    $wp_customize->add_section('total_featured_section', array(
        'title' => esc_html__('Featured Section', 'total'),
        'panel' => 'total_home_panel',
        'priority' => total_get_section_position('total_featured_section')
    ));

    //ENABLE/DISABLE FEATURED SECTION
    $wp_customize->add_setting('total_featured_section_disable', array(
        'sanitize_callback' => 'total_sanitize_text',
    ));

    $wp_customize->add_control(new Total_Switch_Control($wp_customize, 'total_featured_section_disable', array(
        'settings' => 'total_featured_section_disable',
        'section' => 'total_featured_section',
        'label' => esc_html__('Disable Section', 'total'),
        'on_off_label' => array(
            'on' => esc_html__('Yes', 'total'),
            'off' => esc_html__('No', 'total')
        )
    )));

    $wp_customize->add_setting('total_featured_title_sub_title_heading', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_featured_title_sub_title_heading', array(
        'settings' => 'total_featured_title_sub_title_heading',
        'section' => 'total_featured_section',
        'label' => esc_html__('Section Title & Sub Title', 'total'),
    )));

    $wp_customize->add_setting('total_featured_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Featured Section', 'total')
    ));

    $wp_customize->add_control('total_featured_title', array(
        'settings' => 'total_featured_title',
        'section' => 'total_featured_section',
        'type' => 'text',
        'label' => esc_html__('Title', 'total')
    ));

    $wp_customize->add_setting('total_featured_sub_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Featured Section SubTitle', 'total')
    ));

    $wp_customize->add_control('total_featured_sub_title', array(
        'settings' => 'total_featured_sub_title',
        'section' => 'total_featured_section',
        'type' => 'textarea',
        'label' => esc_html__('Sub Title', 'total'),
    ));

    //FEATURED PAGES
    for ($i = 1; $i < 4; $i++) {
        $wp_customize->add_setting('total_featured_header' . $i, array(
            'sanitize_callback' => 'total_sanitize_text'
        ));

        $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_featured_header' . $i, array(
            'settings' => 'total_featured_header' . $i,
            'section' => 'total_featured_section',
            'label' => esc_html__('Featured Page ', 'total') . $i
        )));

        $wp_customize->add_setting('total_featured_page' . $i, array(
            'sanitize_callback' => 'absint'
        ));

        $wp_customize->add_control('total_featured_page' . $i, array(
            'settings' => 'total_featured_page' . $i,
            'section' => 'total_featured_section',
            'type' => 'dropdown-pages',
            'label' => esc_html__('Select a Page', 'total')
        ));

        $wp_customize->add_setting('total_featured_page_icon' . $i, array(
            'default' => 'fa fa-bell',
            'sanitize_callback' => 'total_sanitize_text'
        ));

        $wp_customize->add_control(new Total_Fontawesome_Icon_Chooser($wp_customize, 'total_featured_page_icon' . $i, array(
            'settings' => 'total_featured_page_icon' . $i,
            'section' => 'total_featured_section',
            'type' => 'icon',
            'label' => esc_html__('FontAwesome Icon', 'total'),
        )));
    }

    $wp_customize->add_setting('total_featured_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_featured_upgrade_text', array(
        'section' => 'total_featured_section',
        'label' => esc_html__('For more settings,', 'total'),
        'choices' => array(
            esc_html__('Unlimited featured block', 'total'),
            esc_html__('Display featured block with repeater instead of page with option of external url field', 'total'),
            esc_html__('7 featured block layouts', 'total'),
            esc_html__('5000+ icon to choose from(5 icon packs)', 'total'),
            esc_html__('Configure no of column to display in a row', 'total'),
            esc_html__('Multiple background option(image, gradient, video) for the section', 'total'),
        ),
        'priority' => 100
    )));

    /* ============PORTFOLIO SECTION PANEL============ */
    $wp_customize->add_section('total_portfolio_section', array(
        'title' => esc_html__('Portfolio Section', 'total'),
        'panel' => 'total_home_panel',
        'priority' => total_get_section_position('total_portfolio_section')
    ));

    //ENABLE/DISABLE PORTFOLIO
    $wp_customize->add_setting('total_portfolio_section_disable', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => 'off'
    ));

    $wp_customize->add_control(new Total_Switch_Control($wp_customize, 'total_portfolio_section_disable', array(
        'settings' => 'total_portfolio_section_disable',
        'section' => 'total_portfolio_section',
        'label' => esc_html__('Disable Section', 'total'),
        'on_off_label' => array(
            'on' => esc_html__('Yes', 'total'),
            'off' => esc_html__('No', 'total')
        )
    )));

    $wp_customize->add_setting('total_portfolio_title_sec_heading', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_portfolio_title_sec_heading', array(
        'settings' => 'total_portfolio_title_sec_heading',
        'section' => 'total_portfolio_section',
        'label' => esc_html__('Section Title & Sub Title', 'total'),
    )));

    $wp_customize->add_setting('total_portfolio_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Portfolio Section', 'total')
    ));

    $wp_customize->add_control('total_portfolio_title', array(
        'settings' => 'total_portfolio_title',
        'section' => 'total_portfolio_section',
        'type' => 'text',
        'label' => esc_html__('Title', 'total')
    ));

    $wp_customize->add_setting('total_portfolio_sub_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Portfolio Section SubTitle', 'total')
    ));

    $wp_customize->add_control('total_portfolio_sub_title', array(
        'settings' => 'total_portfolio_sub_title',
        'section' => 'total_portfolio_section',
        'type' => 'textarea',
        'label' => esc_html__('Sub Title', 'total')
    ));

    //PORTFOLIO CHOICES
    $wp_customize->add_setting('total_portfolio_cat_heading', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_portfolio_cat_heading', array(
        'settings' => 'total_portfolio_cat_heading',
        'section' => 'total_portfolio_section',
        'label' => esc_html__('Portfolio Category', 'total'),
    )));

    $wp_customize->add_setting('total_portfolio_cat', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Checkbox_Multiple($wp_customize, 'total_portfolio_cat', array(
        'label' => esc_html__('Select Category', 'total'),
        'section' => 'total_portfolio_section',
        'settings' => 'total_portfolio_cat',
        'choices' => $total_cat
    )));

    $wp_customize->add_setting('total_portfolio_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_portfolio_upgrade_text', array(
        'section' => 'total_portfolio_section',
        'label' => esc_html__('For more settings,', 'total'),
        'choices' => array(
            esc_html__('Link portfolio to external url', 'total'),
            esc_html__('Option to select active category in the tab', 'total'),
            esc_html__('4 portfolio tab styles', 'total'),
            esc_html__('6 portfolio masonary styles', 'total'),
            esc_html__('Order portfolio by date, title or random in ascending or descending order', 'total'),
            esc_html__('Option to show/hide zoom and link button', 'total'),
            esc_html__('Enable/Disable gap between portfolio images', 'total'),
            esc_html__('Multiple background option(image, gradient, video) for the section', 'total'),
        ),
        'priority' => 100
    )));

    /* ============SERVICE SECTION PANEL============ */
    $wp_customize->add_section('total_service_section', array(
        'title' => esc_html__('Service Section', 'total'),
        'panel' => 'total_home_panel',
        'priority' => total_get_section_position('total_service_section')
    ));

    //ENABLE/DISABLE SERVICE SECTION
    $wp_customize->add_setting('total_service_section_disable', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => 'off'
    ));

    $wp_customize->add_control(new Total_Switch_Control($wp_customize, 'total_service_section_disable', array(
        'settings' => 'total_service_section_disable',
        'section' => 'total_service_section',
        'label' => esc_html__('Disable Section', 'total'),
        'on_off_label' => array(
            'on' => esc_html__('Yes', 'total'),
            'off' => esc_html__('No', 'total')
        )
    )));

    $wp_customize->add_setting('total_service_section_heading', array(
        'sanitize_callback' => 'total_sanitize_text',
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_service_section_heading', array(
        'settings' => 'total_service_section_heading',
        'section' => 'total_service_section',
        'label' => esc_html__('Section Title & Sub Title', 'total'),
    )));

    $wp_customize->add_setting('total_service_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Service Section', 'total')
    ));

    $wp_customize->add_control('total_service_title', array(
        'settings' => 'total_service_title',
        'section' => 'total_service_section',
        'type' => 'text',
        'label' => esc_html__('Title', 'total')
    ));

    $wp_customize->add_setting('total_service_sub_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Service Section', 'total')
    ));

    $wp_customize->add_control('total_service_sub_title', array(
        'settings' => 'total_service_sub_title',
        'section' => 'total_service_section',
        'type' => 'textarea',
        'label' => esc_html__('Sub Title', 'total')
    ));

    //SERVICE PAGES
    for ($i = 1; $i < 7; $i++) {
        $wp_customize->add_setting('total_service_header' . $i, array(
            'default' => '',
            'sanitize_callback' => 'total_sanitize_text'
        ));

        $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_service_header' . $i, array(
            'settings' => 'total_service_header' . $i,
            'section' => 'total_service_section',
            'label' => esc_html__('Service Page ', 'total') . $i
        )));

        $wp_customize->add_setting('total_service_page' . $i, array(
            'default' => '',
            'sanitize_callback' => 'absint'
        ));

        $wp_customize->add_control('total_service_page' . $i, array(
            'settings' => 'total_service_page' . $i,
            'section' => 'total_service_section',
            'type' => 'dropdown-pages',
            'label' => esc_html__('Select a Page', 'total')
        ));

        $wp_customize->add_setting('total_service_page_icon' . $i, array(
            'default' => 'fa-bell',
            'sanitize_callback' => 'total_sanitize_text'
        ));

        $wp_customize->add_control(new Total_Fontawesome_Icon_Chooser($wp_customize, 'total_service_page_icon' . $i, array(
            'settings' => 'total_service_page_icon' . $i,
            'section' => 'total_service_section',
            'type' => 'icon',
            'label' => esc_html__('FontAwesome Icon', 'total')
        )));
    }
    $wp_customize->add_setting('total_service_left_bg_heading', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_service_left_bg_heading', array(
        'settings' => 'total_service_left_bg_heading',
        'section' => 'total_service_section',
        'label' => esc_html__('Left Image', 'total'),
    )));

    $wp_customize->add_setting('total_service_left_bg', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => get_template_directory_uri() . '/images/banner.jpg'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'total_service_left_bg', array(
        'section' => 'total_service_section',
        'settings' => 'total_service_left_bg',
        'description' => esc_html__('Recommended Image Size: 770X650px', 'total')
    )));

    $wp_customize->add_setting('total_service_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_service_upgrade_text', array(
        'section' => 'total_service_section',
        'label' => esc_html__('For more settings,', 'total'),
        'choices' => array(
            esc_html__('Unlimited service block', 'total'),
            esc_html__('Display service block with repeater instead of page with option of external url field', 'total'),
            esc_html__('4 service block layouts', 'total'),
            esc_html__('5000+ icon to choose from(5 icon packs)', 'total'),
            esc_html__('Display image postion in left or right', 'total'),
            esc_html__('Multiple background option(image, gradient, video) for the section', 'total'),
        ),
        'priority' => 100
    )));

    /* ============TEAM SECTION PANEL============ */
    $wp_customize->add_section('total_team_section', array(
        'title' => esc_html__('Team Section', 'total'),
        'panel' => 'total_home_panel',
        'priority' => total_get_section_position('total_team_section')
    ));

    //ENABLE/DISABLE TEAM SECTION
    $wp_customize->add_setting('total_team_section_disable', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => 'off'
    ));

    $wp_customize->add_control(new Total_Switch_Control($wp_customize, 'total_team_section_disable', array(
        'settings' => 'total_team_section_disable',
        'section' => 'total_team_section',
        'label' => esc_html__('Disable Section', 'total'),
        'on_off_label' => array(
            'on' => esc_html__('Yes', 'total'),
            'off' => esc_html__('No', 'total')
        )
    )));

    $wp_customize->add_setting('total_team_title_subtitle_heading', array(
        'sanitize_callback' => 'total_sanitize_text',
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_team_title_subtitle_heading', array(
        'settings' => 'total_team_title_subtitle_heading',
        'section' => 'total_team_section',
        'label' => esc_html__('Section Title & Sub Title', 'total'),
    )));

    $wp_customize->add_setting('total_team_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Team Section', 'total')
    ));

    $wp_customize->add_control('total_team_title', array(
        'settings' => 'total_team_title',
        'section' => 'total_team_section',
        'type' => 'text',
        'label' => esc_html__('Title', 'total')
    ));

    $wp_customize->add_setting('total_team_sub_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Team Section SubTitle', 'total')
    ));

    $wp_customize->add_control('total_team_sub_title', array(
        'settings' => 'total_team_sub_title',
        'section' => 'total_team_section',
        'type' => 'textarea',
        'label' => esc_html__('Sub Title', 'total')
    ));

    //TEAM PAGES
    for ($i = 1; $i < 5; $i++) {
        $wp_customize->add_setting('total_team_heading' . $i, array(
            'sanitize_callback' => 'total_sanitize_text'
        ));

        $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_team_heading' . $i, array(
            'settings' => 'total_team_heading' . $i,
            'section' => 'total_team_section',
            'label' => esc_html__('Team Member ', 'total') . $i,
        )));

        $wp_customize->add_setting('total_team_page' . $i, array(
            'sanitize_callback' => 'absint'
        ));

        $wp_customize->add_control('total_team_page' . $i, array(
            'settings' => 'total_team_page' . $i,
            'section' => 'total_team_section',
            'type' => 'dropdown-pages',
            'label' => esc_html__('Select a Page', 'total')
        ));

        $wp_customize->add_setting('total_team_designation' . $i, array(
            'sanitize_callback' => 'total_sanitize_text'
        ));

        $wp_customize->add_control('total_team_designation' . $i, array(
            'settings' => 'total_team_designation' . $i,
            'section' => 'total_team_section',
            'type' => 'text',
            'label' => esc_html__('Team Member Designation', 'total')
        ));

        $wp_customize->add_setting('total_team_facebook' . $i, array(
            'default' => 'https://facebook.com',
            'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control('total_team_facebook' . $i, array(
            'settings' => 'total_team_facebook' . $i,
            'section' => 'total_team_section',
            'type' => 'url',
            'label' => esc_html__('Facebook Url', 'total')
        ));

        $wp_customize->add_setting('total_team_twitter' . $i, array(
            'default' => 'https://twitter.com',
            'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control('total_team_twitter' . $i, array(
            'settings' => 'total_team_twitter' . $i,
            'section' => 'total_team_section',
            'type' => 'url',
            'label' => esc_html__('Twitter Url', 'total')
        ));

        $wp_customize->add_setting('total_team_google_plus' . $i, array(
            'default' => 'https://plus.google.com',
            'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control('total_team_google_plus' . $i, array(
            'settings' => 'total_team_google_plus' . $i,
            'section' => 'total_team_section',
            'type' => 'url',
            'label' => esc_html__('Google Plus Url', 'total')
        ));

        $wp_customize->add_setting('total_team_linkedin' . $i, array(
            'default' => 'https://linkedin.com',
            'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control('total_team_linkedin' . $i, array(
            'settings' => 'total_team_linkedin' . $i,
            'section' => 'total_team_linkedin' . $i,
            'type' => 'url',
            'label' => esc_html__('Linkedin Url', 'total')
        ));
    }

    $wp_customize->add_setting('total_team_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_team_upgrade_text', array(
        'section' => 'total_team_section',
        'label' => esc_html__('For more settings,', 'total'),
        'choices' => array(
            esc_html__('Unlimited team block', 'total'),
            esc_html__('Display team block with repeater instead of page with option of external url field', 'total'),
            esc_html__('6 team block layouts', 'total'),
            esc_html__('Configure no of column to display in a row', 'total'),
            esc_html__('Display team in grid or carousel slider', 'total'),
            esc_html__('Multiple background option(image, gradient, video) for the section', 'total'),
        ),
        'priority' => 100
    )));

    /* ============COUNTER SECTION PANEL============ */
    $wp_customize->add_section('total_counter_section', array(
        'title' => esc_html__('Counter Section', 'total'),
        'panel' => 'total_home_panel',
        'priority' => total_get_section_position('total_counter_section')
    ));

    $wp_customize->add_setting('total_counter_title_subtitle_heading', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    //ENABLE/DISABLE COUNTER SECTION
    $wp_customize->add_setting('total_counter_section_disable', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => 'off'
    ));

    $wp_customize->add_control(new Total_Switch_Control($wp_customize, 'total_counter_section_disable', array(
        'settings' => 'total_counter_section_disable',
        'section' => 'total_counter_section',
        'label' => esc_html__('Disable Section', 'total'),
        'on_off_label' => array(
            'on' => esc_html__('Yes', 'total'),
            'off' => esc_html__('No', 'total')
        )
    )));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_counter_title_subtitle_heading', array(
        'settings' => 'total_counter_title_subtitle_heading',
        'section' => 'total_counter_section',
        'label' => esc_html__('Section Title & Sub Title', 'total'),
    )));

    $wp_customize->add_setting('total_counter_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Counter Section', 'total')
    ));

    $wp_customize->add_control('total_counter_title', array(
        'settings' => 'total_counter_title',
        'section' => 'total_counter_section',
        'type' => 'text',
        'label' => esc_html__('Title', 'total')
    ));

    $wp_customize->add_setting('total_counter_sub_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Counter Section SubTitle', 'total')
    ));

    $wp_customize->add_control('total_counter_sub_title', array(
        'settings' => 'total_counter_sub_title',
        'section' => 'total_counter_section',
        'type' => 'textarea',
        'label' => esc_html__('Sub Title', 'total')
    ));

    $wp_customize->add_setting('total_counter_bg_heading', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_counter_bg_heading', array(
        'settings' => 'total_counter_bg_heading',
        'section' => 'total_counter_section',
        'label' => esc_html__('Section Background', 'total'),
    )));

    $wp_customize->add_setting('total_counter_bg', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => get_template_directory_uri() . '/images/banner.jpg'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'total_counter_bg', array(
        'label' => esc_html__('Upload Image', 'total'),
        'section' => 'total_counter_section',
        'settings' => 'total_counter_bg',
        'description' => esc_html__('Recommended Image Size: 1800X400px', 'total')
    )));

    //COUNTERS
    for ($i = 1; $i < 5; $i++) {

        $wp_customize->add_setting('total_counter_heading' . $i, array(
            'sanitize_callback' => 'total_sanitize_text'
        ));

        $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_counter_heading' . $i, array(
            'settings' => 'total_counter_heading' . $i,
            'section' => 'total_counter_section',
            'label' => esc_html__('Counter', 'total') . $i,
        )));

        $wp_customize->add_setting('total_counter_title' . $i, array(
            'sanitize_callback' => 'total_sanitize_text'
        ));

        $wp_customize->add_control('total_counter_title' . $i, array(
            'settings' => 'total_counter_title' . $i,
            'section' => 'total_counter_section',
            'type' => 'text',
            'label' => esc_html__('Title', 'total')
        ));

        $wp_customize->add_setting('total_counter_count' . $i, array(
            'sanitize_callback' => 'absint'
        ));

        $wp_customize->add_control('total_counter_count' . $i, array(
            'settings' => 'total_counter_count' . $i,
            'section' => 'total_counter_section',
            'type' => 'number',
            'label' => esc_html__('Counter Value', 'total')
        ));

        $wp_customize->add_setting('total_counter_icon' . $i, array(
            'default' => 'fa fa-bell',
            'sanitize_callback' => 'total_sanitize_text'
        ));

        $wp_customize->add_control(new Total_Fontawesome_Icon_Chooser($wp_customize, 'total_counter_icon' . $i, array(
            'settings' => 'total_counter_icon' . $i,
            'section' => 'total_counter_section',
            'type' => 'icon',
            'label' => esc_html__('Counter Icon', 'total')
        )));
    }

    $wp_customize->add_setting('total_counter_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_counter_upgrade_text', array(
        'section' => 'total_counter_section',
        'label' => esc_html__('For more settings,', 'total'),
        'choices' => array(
            esc_html__('Unlimited counter block', 'total'),
            esc_html__('4 counter block layouts', 'total'),
            esc_html__('5000+ icon to choose from(5 icon packs)', 'total'),
            esc_html__('Multiple background option(image, gradient, video) for the section', 'total'),
        ),
        'priority' => 100
    )));

    /* ============TESTIMONIAL PANEL============ */
    $wp_customize->add_section('total_testimonial_section', array(
        'title' => esc_html__('Testimonial Section', 'total'),
        'panel' => 'total_home_panel',
        'priority' => total_get_section_position('total_testimonial_section')
    ));

    //ENABLE/DISABLE TESTIMONIAL SECTION
    $wp_customize->add_setting('total_testimonial_section_disable', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => 'off'
    ));

    $wp_customize->add_control(new Total_Switch_Control($wp_customize, 'total_testimonial_section_disable', array(
        'settings' => 'total_testimonial_section_disable',
        'section' => 'total_testimonial_section',
        'label' => esc_html__('Disable Section', 'total'),
        'on_off_label' => array(
            'on' => esc_html__('Yes', 'total'),
            'off' => esc_html__('No', 'total')
        )
    )));

    $wp_customize->add_setting('total_testimonial_title_subtitle_heading', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_testimonial_title_subtitle_heading', array(
        'settings' => 'total_testimonial_title_subtitle_heading',
        'section' => 'total_testimonial_section',
        'label' => esc_html__('Section Title & Sub Title', 'total'),
    )));

    $wp_customize->add_setting('total_testimonial_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Testimonial Section', 'total')
    ));

    $wp_customize->add_control('total_testimonial_title', array(
        'settings' => 'total_testimonial_title',
        'section' => 'total_testimonial_section',
        'type' => 'text',
        'label' => esc_html__('Title', 'total')
    ));

    $wp_customize->add_setting('total_testimonial_sub_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Testimonial Section SubTitle', 'total')
    ));

    $wp_customize->add_control('total_testimonial_sub_title', array(
        'settings' => 'total_testimonial_sub_title',
        'section' => 'total_testimonial_section',
        'type' => 'textarea',
        'label' => esc_html__('Sub Title', 'total')
    ));

    //TESTIMONIAL PAGES
    $wp_customize->add_setting('total_testimonial_header', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_testimonial_header', array(
        'settings' => 'total_testimonial_header',
        'section' => 'total_testimonial_section',
        'label' => esc_html__('Testimonial', 'total')
    )));

    $wp_customize->add_setting('total_testimonial_page', array(
        'sanitize_callback' => 'total_sanitize_choices_array'
    ));

    $wp_customize->add_control(new Total_Dropdown_Multiple_Chooser($wp_customize, 'total_testimonial_page', array(
        'settings' => 'total_testimonial_page',
        'section' => 'total_testimonial_section',
        'choices' => $total_page_choice,
        'label' => esc_html__('Select the Pages', 'total'),
        'placeholder' => esc_html__('Select Some Pages', 'total')
    )));

    $wp_customize->add_setting('total_testimonial_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_testimonial_upgrade_text', array(
        'section' => 'total_testimonial_section',
        'label' => esc_html__('For more settings,', 'total'),
        'choices' => array(
            esc_html__('Display testimonial block with repeater instead of page with option of external url field', 'total'),
            esc_html__('4 testiminial block layouts', 'total'),
            esc_html__('Multiple background option(image, gradient, video) for the section', 'total'),
        ),
        'priority' => 100
    )));

    /* ============BLOG PANEL============ */
    $wp_customize->add_section('total_blog_section', array(
        'title' => esc_html__('Blog Section', 'total'),
        'panel' => 'total_home_panel',
        'priority' => total_get_section_position('total_blog_section')
    ));

    //ENABLE/DISABLE BLOG SECTION
    $wp_customize->add_setting('total_blog_section_disable', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => 'off'
    ));

    $wp_customize->add_control(new Total_Switch_Control($wp_customize, 'total_blog_section_disable', array(
        'settings' => 'total_blog_section_disable',
        'section' => 'total_blog_section',
        'label' => esc_html__('Disable Section', 'total'),
        'on_off_label' => array(
            'on' => esc_html__('Yes', 'total'),
            'off' => esc_html__('No', 'total')
        )
    )));

    $wp_customize->add_setting('total_blog_title_subtitle_heading', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_blog_title_subtitle_heading', array(
        'settings' => 'total_blog_title_subtitle_heading',
        'section' => 'total_blog_section',
        'label' => esc_html__('Section Title & Sub Title', 'total'),
    )));

    $wp_customize->add_setting('total_blog_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Blog Section', 'total')
    ));

    $wp_customize->add_control('total_blog_title', array(
        'settings' => 'total_blog_title',
        'section' => 'total_blog_section',
        'type' => 'text',
        'label' => esc_html__('Title', 'total')
    ));

    $wp_customize->add_setting('total_blog_sub_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Blog Section SubTitle', 'total')
    ));

    $wp_customize->add_control('total_blog_sub_title', array(
        'settings' => 'total_blog_sub_title',
        'section' => 'total_blog_section',
        'type' => 'textarea',
        'label' => esc_html__('Sub Title', 'total')
    ));

    //BLOG SETTINGS
    $wp_customize->add_setting('total_blog_post_count', array(
        'default' => '3',
        'sanitize_callback' => 'total_sanitize_choices'
    ));

    $wp_customize->add_control(new Total_Dropdown_Chooser($wp_customize, 'total_blog_post_count', array(
        'settings' => 'total_blog_post_count',
        'section' => 'total_blog_section',
        'label' => esc_html__('Number of Posts to show', 'total'),
        'choices' => $total_post_count_choice
    )));

    $wp_customize->add_setting('total_blog_cat_exclude', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Checkbox_Multiple($wp_customize, 'total_blog_cat_exclude', array(
        'label' => esc_html__('Exclude Category from Blog Posts', 'total'),
        'section' => 'total_blog_section',
        'settings' => 'total_blog_cat_exclude',
        'choices' => $total_cat
    )));

    $wp_customize->add_setting('total_blog_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_blog_upgrade_text', array(
        'section' => 'total_blog_section',
        'label' => esc_html__('For more settings,', 'total'),
        'choices' => array(
            esc_html__('4 blog layouts', 'total'),
            esc_html__('Configure no of column to display in a row', 'total'),
            esc_html__('Control excerpt character', 'total'),
            esc_html__('Show/Hide date, author and comment', 'total'),
            esc_html__('Multiple background option(image, gradient, video) for the section', 'total'),
        ),
        'priority' => 100
    )));

    /* ============CLIENTS LOGO SECTION============ */
    $wp_customize->add_Section('total_client_logo_section', array(
        'title' => esc_html__('Clients Logo Section', 'total'),
        'panel' => 'total_home_panel',
        'priority' => total_get_section_position('total_client_logo_section')
    ));

    //ENABLE/DISABLE LOGO SECTION
    $wp_customize->add_setting('total_client_logo_section_disable', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => 'off'
    ));

    $wp_customize->add_control(new Total_Switch_Control($wp_customize, 'total_client_logo_section_disable', array(
        'settings' => 'total_client_logo_section_disable',
        'section' => 'total_client_logo_section',
        'label' => esc_html__('Disable Section', 'total'),
        'on_off_label' => array(
            'on' => esc_html__('Yes', 'total'),
            'off' => esc_html__('No', 'total')
        )
    )));

    $wp_customize->add_setting('total_client_logo_title_subtitle_heading', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'total_client_logo_title_subtitle_heading', array(
        'settings' => 'total_client_logo_title_subtitle_heading',
        'section' => 'total_client_logo_section',
        'label' => esc_html__('Section Title & Sub Title', 'total'),
    )));

    $wp_customize->add_setting('total_logo_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Client Logo Section', 'total')
    ));

    $wp_customize->add_control('total_logo_title', array(
        'settings' => 'total_logo_title',
        'section' => 'total_client_logo_section',
        'type' => 'text',
        'label' => esc_html__('Title', 'total')
    ));

    $wp_customize->add_setting('total_logo_sub_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Clients Logo Section SubTitle', 'total')
    ));

    $wp_customize->add_control('total_logo_sub_title', array(
        'settings' => 'total_logo_sub_title',
        'section' => 'total_client_logo_section',
        'type' => 'textarea',
        'label' => esc_html__('Sub Title', 'total')
    ));

    //CLIENTS LOGOS
    $wp_customize->add_setting('total_client_logo_image', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Display_Gallery_Control($wp_customize, 'total_client_logo_image', array(
        'settings' => 'total_client_logo_image',
        'section' => 'total_client_logo_section',
        'label' => esc_html__('Upload Clients Logos', 'total'),
    )));

    $wp_customize->add_setting('total_client_logo_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_client_logo_upgrade_text', array(
        'section' => 'total_client_logo_section',
        'label' => esc_html__('For more settings,', 'total'),
        'choices' => array(
            esc_html__('Option to link the client logos to external url', 'total'),
            esc_html__('4 client logo layouts', 'total'),
            esc_html__('Multiple background option(image, gradient, video) for the section', 'total'),
        ),
        'priority' => 100
    )));

    /* ============CALL TO ACTION PANEL============ */
    $wp_customize->add_section('total_cta_section', array(
        'title' => esc_html__('Call To Action Section', 'total'),
        'panel' => 'total_home_panel',
        'priority' => total_get_section_position('total_cta_section')
    ));

    //ENABLE/DISABLE LOGO SECTION
    $wp_customize->add_setting('total_cta_section_disable', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => 'off'
    ));

    $wp_customize->add_control(new Total_Switch_Control($wp_customize, 'total_cta_section_disable', array(
        'settings' => 'total_cta_section_disable',
        'section' => 'total_cta_section',
        'label' => esc_html__('Disable Section', 'total'),
        'on_off_label' => array(
            'on' => esc_html__('Yes', 'total'),
            'off' => esc_html__('No', 'total')
        )
    )));

    $wp_customize->add_setting('total_cta_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Call To Action Section', 'total')
    ));

    $wp_customize->add_control('total_cta_title', array(
        'settings' => 'total_cta_title',
        'section' => 'total_cta_section',
        'type' => 'text',
        'label' => esc_html__('Title', 'total')
    ));

    $wp_customize->add_setting('total_cta_sub_title', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Call To Action Section SubTitle', 'total')
    ));

    $wp_customize->add_control('total_cta_sub_title', array(
        'settings' => 'total_cta_sub_title',
        'section' => 'total_cta_section',
        'type' => 'textarea',
        'label' => esc_html__('Sub Title', 'total')
    ));

    $wp_customize->add_setting('total_cta_button1_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control('total_cta_button1_text', array(
        'settings' => 'total_cta_button1_text',
        'section' => 'total_cta_section',
        'type' => 'text',
        'label' => esc_html__('Button 1 Text', 'total')
    ));

    $wp_customize->add_setting('total_cta_button1_link', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('total_cta_button1_link', array(
        'settings' => 'total_cta_button1_link',
        'section' => 'total_cta_section',
        'type' => 'url',
        'label' => esc_html__('Button 1 Link', 'total')
    ));

    $wp_customize->add_setting('total_cta_button2_text', array(
        'default' => '',
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control('total_cta_button2_text', array(
        'settings' => 'total_cta_button2_text',
        'section' => 'total_cta_section',
        'type' => 'text',
        'label' => esc_html__('Button 2 Text', 'total')
    ));

    $wp_customize->add_setting('total_cta_button2_link', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('total_cta_button2_link', array(
        'settings' => 'total_cta_button2_link',
        'section' => 'total_cta_section',
        'type' => 'url',
        'label' => esc_html__('Button 2 Link', 'total')
    ));

    $wp_customize->add_setting('total_cta_bg', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => get_template_directory_uri() . '/images/banner.jpg'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'total_cta_bg', array(
        'label' => esc_html__('Background Image', 'total'),
        'section' => 'total_cta_section',
        'settings' => 'total_cta_bg',
        'description' => esc_html__('Recommended Image Size: 1800X800px', 'total')
    )));

    $wp_customize->add_setting('total_cta_upgrade_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Upgrade_Text($wp_customize, 'total_cta_upgrade_text', array(
        'section' => 'total_cta_section',
        'label' => esc_html__('For more settings,', 'total'),
        'choices' => array(
            esc_html__('4 CTA layouts', 'total'),
            esc_html__('Option to display vide in CTA with popup', 'total'),
            esc_html__('Multiple background option(image, gradient, video) for the section', 'total'),
        ),
        'priority' => 100
    )));

    $wp_customize->add_section(new Total_Customize_Upgrade_Section($wp_customize, 'total-upgrade-section', array(
        'title' => esc_html__('More Sections on Premium', 'total'),
        'panel' => 'total_home_panel',
        'priority' => 1000,
        'options' => array(
            esc_html__('- Highlight Section', 'total'),
            esc_html__('- Pricing Section', 'total'),
            esc_html__('- News and Update Section', 'total'),
            esc_html__('- Tab Section', 'total'),
            esc_html__('- Contact Section with Google Map', 'total'),
            esc_html__('- Custom Elementor Section', 'total')
        )
    )));

    /* ============PRO FEATURES============ */
    $wp_customize->add_section('total_pro_feature_section', array(
        'title' => esc_html__('Pro Theme Features', 'total'),
        'priority' => 1
    ));

    $wp_customize->add_setting('total_pro_features', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Info_Text($wp_customize, 'total_pro_features', array(
        'settings' => 'total_pro_features',
        'section' => 'total_pro_feature_section',
        'description' => $total_pro_features
    )));
}

add_action('customize_register', 'total_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function total_customize_preview_js() {
    wp_enqueue_script('total-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), TOTAL_VERSION, true);
}

add_action('customize_preview_init', 'total_customize_preview_js');

function total_customizer_script() {
    wp_enqueue_script('total-customizer-script', get_template_directory_uri() . '/inc/js/customizer-scripts.js', array('jquery'), TOTAL_VERSION, true);
    wp_enqueue_script('total-customizer-chosen-script', get_template_directory_uri() . '/inc/js/chosen.jquery.js', array('jquery'), TOTAL_VERSION, true);
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), TOTAL_VERSION);
    wp_enqueue_style('total-customizer-chosen-style', get_template_directory_uri() . '/inc/css/chosen.css', array(), TOTAL_VERSION);
    wp_enqueue_style('total-customizer-style', get_template_directory_uri() . '/inc/css/customizer-style.css', array(), TOTAL_VERSION);
}

add_action('customize_controls_enqueue_scripts', 'total_customizer_script');

add_action('wp_ajax_total_order_sections', 'total_order_sections');

function total_order_sections() {
    if (isset($_POST['sections'])) {
        set_theme_mod('total_frontpage_sections', $_POST['sections']);
    }
    wp_die();
}

function total_get_section_position($key) {
    $sections = total_home_section();
    $position = array_search($key, $sections);
    $return = ( $position + 1 ) * 10;
    return $return;
}

if (class_exists('WP_Customize_Control')) {

    class Total_Dropdown_Chooser extends WP_Customize_Control {

        public $type = 'dropdown_chooser';

        public function render_content() {
            if (empty($this->choices))
                return;
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <select class="hs-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ($this->choices as $value => $label)
                        echo '<option value="' . esc_attr($value) . '"' . selected($this->value(), $value, false) . '>' . esc_html($label) . '</option>';
                    ?>
                </select>
            </label>
            <?php
        }

    }

    class Total_Fontawesome_Icon_Chooser extends WP_Customize_Control {

        public $type = 'icon';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <div class="total-selected-icon">
                    <i class="fa <?php echo esc_attr($this->value()); ?>"></i>
                    <span><i class="fa fa-angle-down"></i></span>
                </div>

                <ul class="total-icon-list clearfix">
                    <?php
                    $total_font_awesome_icon_array = total_font_awesome_icon_array();
                    foreach ($total_font_awesome_icon_array as $total_font_awesome_icon) {
                        $icon_class = $this->value() == $total_font_awesome_icon ? 'icon-active' : '';
                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($total_font_awesome_icon) . '"></i></li>';
                    }
                    ?>
                </ul>
                <input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
            </label>
            <?php
        }

    }

    class Total_Display_Gallery_Control extends WP_Customize_Control {

        public $type = 'gallery';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <div class="gallery-screenshot clearfix">
                    <?php {
                        $ids = explode(',', $this->value());
                        foreach ($ids as $attachment_id) {
                            $img = wp_get_attachment_image_src($attachment_id, 'thumbnail');
                            echo '<div class="screen-thumb"><img src="' . esc_url($img[0]) . '" /></div>';
                        }
                    }
                    ?>
                </div>

                <input id="edit-gallery" class="button upload_gallery_button" type="button" value="<?php esc_attr_e('Add/Edit Gallery', 'total') ?>" />
                <input id="clear-gallery" class="button upload_gallery_button" type="button" value="<?php esc_attr_e('Clear', 'total') ?>" />
                <input type="hidden" class="gallery_values" <?php echo esc_attr($this->link()) ?> value="<?php echo esc_attr($this->value()); ?>">
            </label>
            <?php
        }

    }

    class Total_Customize_Checkbox_Multiple extends WP_Customize_Control {

        public $type = 'checkbox-multiple';

        public function render_content() {

            if (empty($this->choices))
                return;
            ?>

            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

            <?php if (!empty($this->description)) : ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>

            <?php $multi_values = !is_array($this->value()) ? explode(',', $this->value()) : $this->value(); ?>

            <ul>
                <?php foreach ($this->choices as $value => $label) : ?>

                    <li>
                        <label>
                            <input type="checkbox" value="<?php echo esc_attr($value); ?>" <?php checked(in_array($value, $multi_values)); ?> /> 
                            <?php echo esc_html($label); ?>
                        </label>
                    </li>

                <?php endforeach; ?>
            </ul>

            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr(implode(',', $multi_values)); ?>" />
            <?php
        }

    }

    class Total_Customize_Heading extends WP_Customize_Control {

        public $type = 'heading';

        public function render_content() {
            if (!empty($this->label)) :
                ?>
                <h3 class="total-accordion-section-title"><?php echo esc_html($this->label); ?></h3>
                <?php
            endif;

            if ($this->description) {
                ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }
        }

    }

    class Total_Dropdown_Multiple_Chooser extends WP_Customize_Control {

        public $type = 'dropdown_multiple_chooser';
        public $placeholder = '';

        public function __construct($manager, $id, $args = array()) {
            $this->placeholder = $args['placeholder'];

            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            if (empty($this->choices))
                return;

            $saved_value = $this->value();
            if (!is_array($saved_value)) {
                $saved_value = array();
            }
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <select data-placeholder="<?php echo esc_html($this->placeholder); ?>" multiple="multiple" class="hs-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ($this->choices as $value => $label) {
                        $selected = '';
                        if (in_array($value, $saved_value)) {
                            $selected = 'selected="selected"';
                        }
                        echo '<option value="' . esc_attr($value) . '"' . esc_attr($selected) . '>' . esc_html($label) . '</option>';
                    }
                    ?>
                </select>
            </label>
            <?php
        }

    }

    class Total_Category_Dropdown extends WP_Customize_Control {

        private $cats = false;

        public function __construct($manager, $id, $args = array(), $options = array()) {
            $this->cats = get_categories($options);

            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            if (!empty($this->cats)) {
                ?>
                <label>
                    <span class="customize-control-title">
                        <?php echo esc_html($this->label); ?>
                    </span>

                    <?php if ($this->description) { ?>
                        <span class="description customize-control-description">
                            <?php echo wp_kses_post($this->description); ?>
                        </span>
                    <?php } ?>

                    <select <?php $this->link(); ?>>
                        <?php
                        foreach ($this->cats as $cat) {
                            printf('<option value="%s" %s>%s</option>', esc_attr($cat->term_id), selected($this->value(), $cat->term_id, false), esc_html($cat->name));
                        }
                        ?>
                    </select>
                </label>
                <?php
            }
        }

    }

    class Total_Switch_Control extends WP_Customize_Control {

        public $type = 'total-switch';
        public $on_off_label = array();

        public function __construct($manager, $id, $args = array()) {
            $this->on_off_label = $args['on_off_label'];
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            ?>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>

            <?php
            $switch_class = ($this->value() == 'on') ? 'total-switch-on' : '';
            $on_off_label = $this->on_off_label;
            ?>
            <div class="total-onoffswitch <?php echo esc_attr($switch_class); ?>">
                <div class="total-onoffswitch-inner">
                    <div class="total-onoffswitch-active">
                        <div class="total-onoffswitch-switch"><?php echo esc_html($on_off_label['on']) ?></div>
                    </div>

                    <div class="total-onoffswitch-inactive">
                        <div class="total-onoffswitch-switch"><?php echo esc_html($on_off_label['off']) ?></div>
                    </div>
                </div>	
            </div>
            <input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr($this->value()); ?>"/>
            <?php
        }

    }

    class Total_Info_Text extends WP_Customize_Control {

        public function render_content() {
            ?>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }
        }

    }
    
    class Total_Toggle_Control extends WP_Customize_Control {

        /**
         * Control type
         *
         * @var string
         */
        public $type = 'total-toggle';

        /**
         * Control method
         *
         */
        public function render_content() {
            ?>
            <div class="total-checkbox-toggle">
                <div class="total-toggle-switch">
                    <input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="total-toggle-checkbox" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> <?php checked($this->value()); ?>>
                    <label class="total-toggle-label" for="<?php echo esc_attr($this->id); ?>"><span></span></label>
                </div>
                <span class="customize-control-title toggle-title"><?php echo esc_html($this->label); ?></span>
                <?php if (!empty($this->description)) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>
            </div>
            <?php
        }

    }

    // Upgrade Text
    class Total_Upgrade_Text extends WP_Customize_Control {

        public $type = 'total-upgrade-text';

        public function render_content() {
            ?>
            <label>
                <span class="dashicons dashicons-info"></span>

                <?php if ($this->label) { ?>
                    <span>
                        <?php echo wp_kses_post($this->label); ?>
                    </span>
                <?php } ?>

                <a href="<?php echo esc_url('https://hashthemes.com/wordpress-theme/total-plus/?utm_source=wordpress&utm_medium=total-link&utm_campaign=total-upgrade'); ?>" target="_blank"> <strong><?php echo esc_html__('Upgrade to PRO', 'total'); ?></strong></a>
            </label>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }

            $choices = $this->choices;
            if ($choices) {
                echo '<ul>';
                foreach ($choices as $choice) {
                    echo '<li>' . esc_html($choice) . '</li>';
                }
                echo '</ul>';
            }
        }

    }

}

if (class_exists('WP_Customize_Section')) {

    /**
     * Pro customizer section.
     *
     * @since  1.0.0
     * @access public
     */
    class Total_Customize_Section_Pro extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'total-pro-section';

        /**
         * Custom button text to output.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_text = '';

        /**
         * Custom pro button URL.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_url = '';

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();

            $json['pro_text'] = $this->pro_text;
            $json['pro_url'] = $this->pro_url;

            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() {
            ?>

            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

                <h3 class="accordion-section-title">
                    <# if ( data.title ) { #>
                    {{ data.title }}
                    <# } #>

                    <# if ( data.pro_text && data.pro_url ) { #>
                    <a href="{{ data.pro_url }}" class="button button-primary" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            </li>
            <?php
        }

    }

    class Total_Customize_Upgrade_Section extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'total-upgrade-section';

        /**
         * Custom button text to output.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $text = '';
        public $options = array();

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();

            $json['text'] = $this->text;
            $json['options'] = $this->options;

            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
                <label>
                    <# if ( data.title ) { #>
                    {{ data.title }}
                    <# } #>
                </label>

                <# if ( data.text ) { #>
                {{ data.text }}
                <# } #>

                <# _.each( data.options, function(key, value) { #>
                {{ key }}<br/>
                <# }) #>

                <a href="<?php echo esc_url('https://hashthemes.com/wordpress-theme/total-plus/?utm_source=wordpress&utm_medium=total-link&utm_campaign=total-upgrade'); ?>" class="button button-primary" target="_blank"><?php echo esc_html__('Upgrade to Pro', 'total'); ?></a>
            </li>
            <?php
        }

    }

}

//SANITIZATION FUNCTIONS
function total_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

function total_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}

function total_sanitize_integer($input) {
    if (is_numeric($input)) {
        return intval($input);
    }
}

function total_sanitize_choices($input, $setting) {
    global $wp_customize;

    $control = $wp_customize->get_control($setting->id);

    if (array_key_exists($input, $control->choices)) {
        return $input;
    } else {
        return $setting->default;
    }
}

function total_sanitize_choices_array($input, $setting) {
    global $wp_customize;

    if (!empty($input)) {
        $input = array_map('absint', $input);
    }

    return $input;
}
