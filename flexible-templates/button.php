<?php
if ( $button_text && $button_url ) {

	$button_class = $button_class ? $button_class : null;

	if ( str_contains( $button_class, 'btn-big' ) ) {
		$button_icon_code = icon_power_right();
		$button_icon_code2 = icon_power_left();
	}

	$icon = isset($button_icon_code) ? $button_icon_code : null;
	$icon2 = isset($button_icon_code2) ? $button_icon_code2 : null;
	
	$link_url = esc_url( $button_url['url'] );
	// $link_title  = esc_html( $button_url['title'] );
	$link_target = $button_url['target'] ? esc_attr( $button_url['target'] ) : '_self';

	echo '<a href="' . $link_url . '" title="' . $button_text . '" class="btn ' . ( ( $button_class ) ? $button_class : 'btn-primary' ) . ( ( isset($cta_background) ) ? ' background-' . $cta_background : '' ) . '" target="' . $link_target . '">' . $icon . $button_text . $icon2 . '</a>';
}

