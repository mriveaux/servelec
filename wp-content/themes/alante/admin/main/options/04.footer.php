<?php
/**
 * Footer functions.
 *
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	FOOTER WIDGETS LAYOUT
---------------------------------------------------------------------------------- */

/* Assign function for widget area 1 */
function alante_thinkup_input_footerw1() {
	echo	'<div id="footer-col1" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w1' ) and current_user_can( 'edit_theme_options' ) ) {
		echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'alante') . '</h3>',
			'<div class="error-icon">',
				'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 1.', 'alante') . '</p>',
				'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'alante' ) . '">' . __( 'Click here to go to Widget area.', 'alante') . '</a>',
			'</div>';
	};
	echo	'</div>';
}

/* Assign function for widget area 2 */
function alante_thinkup_input_footerw2() {
	echo	'<div id="footer-col2" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w2' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'alante') . '</h3>',
			'<div class="error-icon">',
				'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 2.', 'alante') . '</p>',
				'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'alante' ) . '">' . __( 'Click here to go to Widget area.', 'alante') . '</a>',
			'</div>';
	};
	echo	'</div>';
}

/* Assign function for widget area 3 */
function alante_thinkup_input_footerw3() {
	echo	'<div id="footer-col3" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w3' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'alante') . '</h3>',
			'<div class="error-icon">',
				'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 3.', 'alante') . '</p>',
				'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'alante' ) . '">' . __( 'Click here to go to Widget area.', 'alante') . '</a>',
			'</div>';
	};	
	echo	'</div>';
}

/* Assign function for widget area 4 */
function alante_thinkup_input_footerw4() {
	echo	'<div id="footer-col4" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w4' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'alante') . '</h3>',
			'<div class="error-icon">',
				'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 4.', 'alante') . '</p>',
				'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'alante' ) . '">' . __( 'Click here to go to Widget area.', 'alante') . '</a>',
			'</div>';	
	};	
	echo	'</div>';
}

/* Assign function for widget area 5 */
function alante_thinkup_input_footerw5() {
	echo	'<div id="footer-col5" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w5' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'alante') . '</h3>',
			'<div class="error-icon">',
				'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 5.', 'alante') . '</p>',
				'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'alante' ) . '">' . __( 'Click here to go to Widget area.', 'alante') . '</a>',
			'</div>';	
	};	
	echo	'</div>';
}

/* Assign function for widget area 6 */
function alante_thinkup_input_footerw6() {
	echo	'<div id="footer-col6" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w6' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title">' . __( 'Please Add Widgets', 'alante') . '</h3>',
			'<div class="error-icon">',
				'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 6.', 'alante') . '</p>',
				'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'alante' ) . '">' . __( 'Click here to go to Widget area.', 'alante') . '</a>',
			'</div>';	
	};	
	echo	'</div>';
}


/* Add Custom Footer Layout */
function alante_thinkup_input_footerlayout() {	

// Get theme options values.
$thinkup_footer_layout       = alante_thinkup_var ( 'thinkup_footer_layout' );
$thinkup_footer_widgetswitch = alante_thinkup_var ( 'thinkup_footer_widgetswitch' );

	if ( $thinkup_footer_widgetswitch != "1" and ! empty( $thinkup_footer_layout )  ) {
		echo	'<div id="footer">';
			if ( $thinkup_footer_layout == "option1" ) {
				echo	'<div id="footer-core" class="option1">';
						alante_thinkup_input_footerw1();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option2" ) {
				echo	'<div id="footer-core" class="option2">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option3" ) {
				echo	'<div id="footer-core" class="option3">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
						alante_thinkup_input_footerw3();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option4" ) {
				echo	'<div id="footer-core" class="option4">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
						alante_thinkup_input_footerw3();
						alante_thinkup_input_footerw4();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option5" ) {
				echo	'<div id="footer-core" class="option5">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
						alante_thinkup_input_footerw3();
						alante_thinkup_input_footerw4();
						alante_thinkup_input_footerw5();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option6" ) {
				echo	'<div id="footer-core" class="option6">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
						alante_thinkup_input_footerw3();
						alante_thinkup_input_footerw4();
						alante_thinkup_input_footerw5();
						alante_thinkup_input_footerw6();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option7" ) {
				echo	'<div id="footer-core" class="option7">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option8" ) {
				echo	'<div id="footer-core" class="option8">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option9" ) {
				echo	'<div id="footer-core" class="option9">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option10" ) {
				echo	'<div id="footer-core" class="option10">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option11" ) {
				echo	'<div id="footer-core" class="option11">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option12" ) {
				echo	'<div id="footer-core" class="option12">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option13" ) {
				echo	'<div id="footer-core" class="option13">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
						alante_thinkup_input_footerw3();
						alante_thinkup_input_footerw4();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option14" ) {
				echo	'<div id="footer-core" class="option14">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
						alante_thinkup_input_footerw3();
						alante_thinkup_input_footerw4();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option15" ) {
				echo	'<div id="footer-core" class="option15">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
						alante_thinkup_input_footerw3();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option16" ) {
				echo	'<div id="footer-core" class="option16">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
						alante_thinkup_input_footerw3();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option17" ) {
				echo	'<div id="footer-core" class="option17">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
						alante_thinkup_input_footerw3();
						alante_thinkup_input_footerw4();
						alante_thinkup_input_footerw5();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option18" ) {
				echo	'<div id="footer-core" class="option18">';
						alante_thinkup_input_footerw1();
						alante_thinkup_input_footerw2();
						alante_thinkup_input_footerw3();
						alante_thinkup_input_footerw4();
						alante_thinkup_input_footerw5();

				echo	'</div>';
			}
		echo	'</div>';
	}
}


/* ----------------------------------------------------------------------------------
	COPYRIGHT TEXT
---------------------------------------------------------------------------------- */

function alante_thinkup_input_copyright() {

	printf( __( 'Developed by %1$s. Powered by %2$s.', 'alante' ) , '<a href="//www.thinkupthemes.com/" target="_blank">Think Up Themes Ltd</a>', '<a href="//www.wordpress.org/" target="_blank">WordPress</a>'); 
}