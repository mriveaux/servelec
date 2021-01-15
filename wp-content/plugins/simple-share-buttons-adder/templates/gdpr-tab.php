<?php
/**
 * GDPR tab template.
 *
 * The template wrapper for the gdpr tab.
 *
 * @package SimpleShareButtonsAdder
 */

$propertyid = get_option('ssba_property_id');
$ssba_settings = get_option('ssba_settings', true);
$gdpr_config = isset($ssba_settings['ssba_gdpr_config']) ?
    $ssba_settings['ssba_gdpr_config'] :
    '';
?>
<div class="tab-pane gdpr-platform fade <?php echo 'active' === $gdpr ? esc_attr($gdpr . ' in'): ''; ?>" id="gdpr">
    <div class="col-sm-12 ssba-tab-container">
        <?php if (empty($propertyid)) : ?>
            <div class="gdpr-landing">
                <?php include plugin_dir_path(__FILE__) . 'config/gdpr/landing.php'; ?>
            </div>
            <div style="display:none;" class="gdpr-register">
                <?php include plugin_dir_path(__FILE__) . 'config/gdpr/register.php'; ?>
            </div>
        <?php endif; ?>
        <div
            <?php if (empty($propertyid)) : ?>
                style="display:none;"
            <?php endif; ?>
            class="gdpr-config"
        >
            <?php include plugin_dir_path(__FILE__) . 'config/gdpr/config.php'; ?>
        </div>
    </div>
</div>
