<?php
if (is_user_logged_in()) {
    $user = wp_get_current_user();
    if ($user->ID) {
        $name = $user->display_name;
    }
    ?>
    <li id="desktop_primary_logout">
        <a class="search-toggle_btn czr-overlay-toggle_btn" title="<?php echo __('Salir de la sesión') ?>"
           href="<?php echo wp_logout_url(); ?>">
            <i class="fas fa-fw fa-1x fa-sign-out-alt"> <?php //echo $name; ?></i></a>
    </li>
    <?php
} else {
    ?>
    <li id="desktop_primary_login">
        <a class="search-toggle_btn czr-overlay-toggle_btn" title="<?php echo __('Iniciar la sesión') ?>"
           href="<?php echo wp_login_url(); ?>">
            <i class="fas fa-fw fa-1x fa-user"></i></a>
    </li>
<?php }
