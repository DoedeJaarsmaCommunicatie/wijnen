<?php
/**
 * Proceed to checkout button
 *
 * @since 1.0.0
 * @file-version 1.0.0
 * @version 2.4.0
 */

defined('ABSPATH') || exit; ?>

<a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="btn primary round large shaded">
    <?php esc_html_e('Proceed to checkout', 'woocommerce'); ?>
</a>
