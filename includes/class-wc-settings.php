<?php

defined( 'ABSPATH' ) || exit;

class TB_Free_Gift_WC_Settings {

	/**
	 * Bootstraps the class and hooks required actions
	 */
	public static function init() {
		add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
		add_action( 'woocommerce_settings_tabs_tb_free_gift_settings', __CLASS__ . '::settings_tab' );
		add_action( 'woocommerce_update_options_tb_free_gift_settings', __CLASS__ . '::update_settings' );
	}

	/**
	 * Add a new settings tab to the WooCommerce settings tabs array.
	 *
	 * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Free Gift tab.
	 *
	 * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Free Gift tab.
	 */
	public static function add_settings_tab( $settings_tabs ) {
		$settings_tabs['tb_free_gift_settings'] = __( 'Free Gift', 'free-gift-for-woocommerce' );

		return $settings_tabs;
	}

	/**
	 * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
	 *
	 * @uses woocommerce_admin_fields()
	 * @uses self::get_settings()
	 */
	public static function settings_tab() {
		woocommerce_admin_fields( self::get_settings() );
	}

	/**
	 * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
	 *
	 * @uses woocommerce_update_options()
	 * @uses self::get_settings()
	 */
	public static function update_settings() {
		woocommerce_update_options( self::get_settings() );
	}

	/**
	 * Get all the settings for this plugin for @return array Array of settings for @see woocommerce_admin_fields() function.
	 *
	 * @see woocommerce_admin_fields() function.
	 *
	 */
	public static function get_settings() {
		$settings = [
			// Products and Quantity.
			[
				'title' => __( 'Products and Quantity', 'free-gift-for-woocommerce' ),
				'desc'  => __( 'Specify the IDs of the products which will be the gifts.', 'free-gift-for-woocommerce' ),
				'id'    => 'woocommerce_tb_free_gift_prod_qty_section',
				'type'  => 'title',
			],
	
			[
				'title'    => __( 'Product IDs', 'free-gift-for-woocommerce' ),
				// translators: %s is the link to an article explaining how to find product category IDs.
				'desc'     => sprintf( __( 'For more information read %s this article.', 'free-gift-for-woocommerce' ), '<a href="https://docs.woocommerce.com/document/find-product-category-ids/" target="_blank">' ),
				'desc_tip' => __( 'Set IDs of products to be a gift separated by a comma (without spaces).', 'free-gift-for-woocommerce' ),
				'id'       => 'woocommerce_tb_free_gift_ids',
				'type'     => 'text',
				'default'  => '',
			],
	
			[
				'title'    => __( 'Quantity', 'free-gift-for-woocommerce' ),
				'desc'     => __( 'Leave the field blank to set the quantity of each gift equal to 1.', 'free-gift-for-woocommerce' ),
				'desc_tip' => __( 'Set quantity for each gift separated by a comma (without spaces).', 'free-gift-for-woocommerce' ),
				'id'       => 'woocommerce_tb_free_gift_quantity',
				'type'     => 'text',
				'default'  => '1',
			],
	
			[
				'id'   => 'woocommerce_tb_free_gift_prod_qty_section',
				'type' => 'sectionend',
			],
	
			// Conditions.
			[
				'title' => __( 'Conditions', 'free-gift-for-woocommerce' ),
				'desc'  => __( 'Select the conditions for displaying and working gifts.', 'free-gift-for-woocommerce' ),
				'id'    => 'woocommerce_tb_free_gift_conditions_section',
				'type'  => 'title',
			],
	
			[
				// Translators: This is a label that appears in the cart for free gifts.
				'title'   => __( 'Label in Cart', 'free-gift-for-woocommerce' ),
				'desc' => __( 'Show Free Gift labels for the gifts in cart?', 'free-gift-for-woocommerce' ),
				'id'      => 'woocommerce_tb_free_gift_show_gift_label_in_cart',
				'type'    => 'checkbox',
				'default' => 'no',
			],								
	
			[
				'title'   => __( 'Only for Authorized', 'free-gift-for-woocommerce' ),
				'desc'    => __( 'Give the gifts only for authorized users?', 'free-gift-for-woocommerce' ),
				'id'      => 'woocommerce_tb_free_gift_only_for_authorized',
				'type'    => 'checkbox',
				'default' => 'no',
			],
	
			[
				// translators: %s is the WooCommerce currency.
				'title'             => sprintf( __( 'Minimum Order Amount in %s', 'free-gift-for-woocommerce' ), esc_html( get_woocommerce_currency() ) ),
				'desc'              => __( 'Set minimum order amount for adding gifts.', 'free-gift-for-woocommerce' ),
				'desc_tip'          => __( 'You can leave the field blank to hide this limit.', 'free-gift-for-woocommerce' ),
				'id'                => 'woocommerce_tb_free_gift_minimum_order_amount',
				'type'              => 'number',
				'custom_attributes' => [
					'min'  => 0,
					'step' => '0.01',
				],
				'css'               => 'width: 80px;',
			],
	
			[
				'desc'    => __( 'Order amount type.', 'free-gift-for-woocommerce' ),
				'id'      => 'woocommerce_tb_free_gift_order_total_type',
				'type'    => 'select',
				'default' => 'subtotal',
				'options' => [
					'subtotal' => __( 'Subtotal', 'free-gift-for-woocommerce' ),
					'total'    => __( 'Total', 'free-gift-for-woocommerce' ),
				],
				'css'     => 'width: 120px;',
			],
	
			[
				'title'    => __( 'Message About Gift', 'free-gift-for-woocommerce' ),
				'desc'     => __( 'Leave the field blank to hide the message.', 'free-gift-for-woocommerce' ),
				'desc_tip' => __( 'Set text about free gift in WooCommerce notification area.', 'free-gift-for-woocommerce' ),
				'id'       => 'woocommerce_tb_free_gift_message',
				'type'     => 'textarea',
				'default'  => __( 'Congratulations! You have received a free gift!', 'free-gift-for-woocommerce' ),
			],
	
			[
				'id'   => 'woocommerce_tb_free_gift_conditions_section',
				'type' => 'sectionend',
			],
		];
	
		return apply_filters( 'woocommerce_tb_free_gift_settings', $settings );
	}
	
}

TB_Free_Gift_WC_Settings::init();