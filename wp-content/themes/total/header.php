<?php
/**
 * The header for our theme.
 *
 * @package Total
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <div id="ht-page">
            <a class="skip-link screen-reader-text" href="#ht-content"><?php esc_html_e('Skip to content', 'total'); ?></a>
            <header id="ht-masthead" class="ht-site-header">
                <div class="ht-container ht-clearfix">
                    <div id="ht-site-branding">
                        <?php
                        if (function_exists('has_custom_logo') && has_custom_logo()) :
                            the_custom_logo();
                        else :
                            if (is_front_page()) :
                                ?>
                                <h1 class="ht-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                            <?php else : ?>
                                <p class="ht-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                            <?php endif; ?>
                            <p class="ht-site-description"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('description'); ?></a></p>
                        <?php endif; ?>
                    </div><!-- .site-branding -->
                    
                    <a href="#" class="toggle-bar"><span></span></a>
                    <nav id="ht-site-navigation" class="ht-main-navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container_class' => 'ht-menu ht-clearfix',
                            'menu_class' => 'ht-clearfix',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        ));
                        ?>
                    </nav><!-- #ht-site-navigation -->
                </div>
            </header><!-- #ht-masthead -->

            <div id="ht-content" class="ht-site-content ht-clearfix">