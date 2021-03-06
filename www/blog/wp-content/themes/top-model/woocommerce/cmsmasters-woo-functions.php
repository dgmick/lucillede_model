<?php
/**
 * @package 	WordPress
 * @subpackage 	Top Model
 * @version 	1.0.1
 * 
 * Website WooCommerce Functions
 * Created by CMSMasters
 * 
 */


/* Woocommerce Dynamic Cart */
function top_model_woocommerce_cart_dropdown() {
	global $woocommerce;
	
	
	$cart_link = $woocommerce->cart->get_cart_url();
	
	
	$cart_count = $woocommerce->cart->get_cart_contents_count();
	
	$cart_subtotal = $woocommerce->cart->get_cart_subtotal();
	
	
	$cart_currency_symbol = get_woocommerce_currency_symbol();
	
	$cart_currency_symbol_pos = get_option('woocommerce_currency_pos');
	
	$cart_currency = $cart_currency_symbol;
	
	
	if ($cart_currency_symbol_pos == 'left_space') {
		$cart_currency = $cart_currency_symbol . ' ';
	} elseif ($cart_currency_symbol_pos == 'right_space') {
		$cart_currency = ' ' . $cart_currency_symbol;
	}
	
	
	$cart_price = str_replace($cart_currency, '', $cart_subtotal);
	
	
	$cart_subtotal_html = '';
	
	
	if ($cart_currency_symbol_pos == 'left') {
		$cart_subtotal_html .= '<span class="currency">' . esc_html($cart_currency_symbol) . '</span>' . esc_html($cart_price);
	} elseif ($cart_currency_symbol_pos == 'right') {
		$cart_subtotal_html .= esc_html($cart_price) . '<span class="currency">' . esc_html($cart_currency_symbol) . '</span>';
	} elseif ($cart_currency_symbol_pos == 'left_space') {
		$cart_subtotal_html .= '<span class="currency">' . esc_html($cart_currency_symbol) . '</span> ' . esc_html($cart_price);
	} elseif ($cart_currency_symbol_pos == 'right_space') {
		$cart_subtotal_html .= esc_html($cart_price) . ' <span class="currency">' . esc_html($cart_currency_symbol) . '</span>';
	}
	
	
	$output = '<div class="cmsmasters_dynamic_cart">' .  
		'<a href="' . esc_url($woocommerce->cart->get_cart_url()) . '" class="cmsmasters_dynamic_cart_button"><span class="cmsmasters_theme_icon_basket">' . esc_html($cart_count) . '</span></a>' . 
		'<div class="widget_shopping_cart_content"></div>' . 
	'</div>';
	
	
	echo $output;
}


/* Woocommerce Add to Cart Button */
function top_model_woocommerce_add_to_cart_button() {
	global $woocommerce, 
		$product;
	
	
	if ( 
		$product->is_purchasable() && 
		$product->product_type == 'simple' && 
		$product->is_in_stock() 
	) {
		echo '<div class="button_to_cart_wrap">' . 
			'<a href="' . esc_url($product->add_to_cart_url()) . '" data-product_id="' . esc_attr($product->id) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="button_to_cart add_to_cart_button cmsmasters_add_to_cart_button ajax_add_to_cart product_type_simple" title="' . esc_attr__('Add to Cart', 'top-model') . '">' . 
				'<span>' . esc_html__('Add to Cart', 'top-model') . '</span>' . 
			'</a>' . 
			'<a href="' . esc_url($woocommerce->cart->get_cart_url()) . '" class="button_to_cart added_to_cart wc-forward" title="' . esc_attr__('View Cart', 'top-model') . '">' . 
				'<span>' . esc_html__('View Cart', 'top-model') . '</span>' . 
			'</a>' . 
		'</div>';
	}
}


/* Woocommerce Rating */
function top_model_woocommerce_rating($icon_trans = '', $icon_color = '', $in_review = false, $comment_id = '', $show = true) {
	global $product;
	
	
	if (get_option( 'woocommerce_enable_review_rating') === 'no') {
		return;
	}
	
	
	$rating = (($in_review) ? intval(get_comment_meta($comment_id, 'rating', true)) : ($product->get_average_rating() ? $product->get_average_rating() : '0'));
	
	$itemprop = $in_review ? 'reviewRating' : 'aggregateRating';
	
	$itemtype = $in_review ? 'Rating' : 'AggregateRating';
	
	
	$out = "
<div class=\"cmsmasters_star_rating\" itemscope itemtype=\"http://schema.org/{$itemtype}\" title=\"" . sprintf(esc_html__('Rated %s out of 5', 'top-model'), $rating) . "\">
<div class=\"cmsmasters_star_trans_wrap\">
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
</div>
<div class=\"cmsmasters_star_color_wrap\" style=\"width:" . (($rating / 5) * 100) . "%\">
	<div class=\"cmsmasters_star_color_inner\">
		<span class=\"{$icon_color} cmsmasters_star\"></span>
		<span class=\"{$icon_color} cmsmasters_star\"></span>
		<span class=\"{$icon_color} cmsmasters_star\"></span>
		<span class=\"{$icon_color} cmsmasters_star\"></span>
		<span class=\"{$icon_color} cmsmasters_star\"></span>
	</div>
</div>
<span class=\"rating dn\"><strong itemprop=\"ratingValue\">" . esc_html($rating) . "</strong> " . esc_html__('out of 5', 'top-model') . "</span>
</div>
";
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}


/* Woocommerce Price Format */
function top_model_woocommerce_price_format($format, $currency_pos) {
	$format = '%2$s<span>%1$s</span>';

	switch ( $currency_pos ) {
		case 'left' :
			$format = '<span>%1$s</span>%2$s';
		break;
		case 'right' :
			$format = '%2$s<span>%1$s</span>';
		break;
		case 'left_space' :
			$format = '<span>%1$s&nbsp;</span>%2$s';
		break;
		case 'right_space' :
			$format = '%2$s<span>&nbsp;%1$s</span>';
		break;
	}
	
	return $format;
}
 
add_action('woocommerce_price_format', 'top_model_woocommerce_price_format', 1, 2);


add_theme_support('woocommerce');


add_filter('woocommerce_enqueue_styles', '__return_false');


/* Woocommerce Onsale Filter */
add_filter( 'woocommerce_sale_flash', 'top_model_change_on_sale' );

function top_model_change_on_sale() {
	return '<span class="onsale"><span>' . esc_html__('Sale!', 'woocommerce') . '</span></span>';
}


/* Woocommerce Dynamic cart count update after ajax */
function woocommerce_header_add_to_cart_count( $dynamic_count ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<span class="cmsmasters_theme_icon_basket"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
	<?php
	
	$dynamic_count['.cmsmasters_dynamic_cart_button span'] = ob_get_clean();
	
	return $dynamic_count;
}

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_count');
