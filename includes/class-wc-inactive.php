<?php

defined( 'ABSPATH' ) || exit;

class TB_Free_Gift_WC_Inactive {

	/**
	 * Bootstraps the class and hooks required actions
	 */
	public static function init() {
		add_action( 'admin_notices', __CLASS__ . '::wc_inactive_admin_notice' );
	}

	/**
	 * Admin notice if WooCommerce is inactive
	 */
	public static function wc_inactive_admin_notice() {
		$class   = 'notice notice-warning is-dismissible';
		$message = __( 'Free Gift for WooCommerce needs WooCommerce to run. Please, install and active WooCommerce plugin.', 'free-gift-for-woocommerce' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}
}

TB_Free_Gift_WC_Inactive::init();