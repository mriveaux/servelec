<?php
/**
 * Social media functions.
 *
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	SEARCH - DISABLE SEARCH
---------------------------------------------------------------------------------- */
function alante_thinkup_input_headersearch() {

// Get theme options values.
$thinkup_header_searchswitch = alante_thinkup_var ( 'thinkup_header_searchswitch' );

	if ( $thinkup_header_searchswitch == '1' ) {
		echo '<div id="pre-header-search">',
		     get_search_form(),
		     '</div>';
	}
}

/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - DISPLAY MESSAGE
---------------------------------------------------------------------------------- */

/* Message Settings */
function alante_thinkup_input_socialmessage(){

// Get theme options values.
$thinkup_header_socialmessage   = alante_thinkup_var ( 'thinkup_header_socialmessage' );
$thinkup_header_facebookswitch  = alante_thinkup_var ( 'thinkup_header_facebookswitch' );
$thinkup_header_twitterswitch   = alante_thinkup_var ( 'thinkup_header_twitterswitch' );
$thinkup_header_googleswitch    = alante_thinkup_var ( 'thinkup_header_googleswitch' );
$thinkup_header_instagramswitch = alante_thinkup_var ( 'thinkup_header_instagramswitch' );
$thinkup_header_linkedinswitch  = alante_thinkup_var ( 'thinkup_header_linkedinswitch' );
$thinkup_header_flickrswitch    = alante_thinkup_var ( 'thinkup_header_flickrswitch' );
$thinkup_header_youtubeswitch   = alante_thinkup_var ( 'thinkup_header_youtubeswitch' );

	if ( empty( $thinkup_header_facebookswitch ) 
		and empty( $thinkup_header_twitterswitch ) 
		and empty( $thinkup_header_googleswitch ) 
		and empty( $thinkup_header_instagramswitch ) 
		and empty( $thinkup_header_linkedinswitch ) 
		and empty( $thinkup_header_flickrswitch ) 
		and empty( $thinkup_header_lastfmswitch ) 
		and empty( $thinkup_header_youtubeswitch ) ) {	
		return '';
	} else if ( ! empty( $thinkup_header_socialmessage ) ) {	
		return esc_html( $thinkup_header_socialmessage );
	} else if ( empty( $thinkup_header_socialmessage ) ) {
		return '';
	}
}


/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - CUSTOM ICONS
---------------------------------------------------------------------------------- */

/* Facebook - Custom Icon */
function alante_thinkup_input_facebookicon(){

// Get theme options values.
$thinkup_header_facebookiconswitch = alante_thinkup_var ( 'thinkup_header_facebookiconswitch' );
$thinkup_header_facebookcustomicon = alante_thinkup_var ( 'thinkup_header_facebookcustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_facebookiconswitch == '1' and ! empty( $thinkup_header_facebookcustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.facebook a,';
		$output .= '#pre-header-social li.facebook a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_facebookcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.facebook i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.facebook a,';
		$output .= '#post-footer-social li.facebook a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_facebookcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.facebook i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Twitter - Custom Icon */
function alante_thinkup_input_twittericon(){

// Get theme options values.
$thinkup_header_twittericonswitch = alante_thinkup_var ( 'thinkup_header_twittericonswitch' );
$thinkup_header_twittercustomicon = alante_thinkup_var ( 'thinkup_header_twittercustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_twittericonswitch == '1' and ! empty( $thinkup_header_twittercustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.twitter a,';
		$output .= '#pre-header-social li.twitter a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_twittercustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.twitter i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.twitter a,';
		$output .= '#post-footer-social li.twitter a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_twittercustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.twitter i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Google+ - Custom Icon */
function alante_thinkup_input_googleicon(){

// Get theme options values.
$thinkup_header_googleiconswitch = alante_thinkup_var ( 'thinkup_header_googleiconswitch' );
$thinkup_header_googlecustomicon = alante_thinkup_var ( 'thinkup_header_googlecustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_googleiconswitch == '1' and ! empty( $thinkup_header_googlecustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.google-plus a,';
		$output .= '#pre-header-social li.google-plus a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_googlecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.google-plus i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.google-plus a,';
		$output .= '#post-footer-social li.google-plus a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_googlecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.google-plus i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Instagram - Custom Icon */
function alante_thinkup_input_instagramicon(){

// Get theme options values.
$thinkup_header_instagramiconswitch = alante_thinkup_var ( 'thinkup_header_instagramiconswitch' );
$thinkup_header_instagramcustomicon = alante_thinkup_var ( 'thinkup_header_instagramcustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_instagramiconswitch == '1' and ! empty( $thinkup_header_instagramcustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.instagram a,';
		$output .= '#pre-header-social li.instagram a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_instagramcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.instagram i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.instagram a,';
		$output .= '#post-footer-social li.instagram a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_instagramcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.instagram i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* LinkedIn - Custom Icon */
function alante_thinkup_input_linkedinicon(){

// Get theme options values.
$thinkup_header_linkediniconswitch = alante_thinkup_var ( 'thinkup_header_linkediniconswitch' );
$thinkup_header_linkedincustomicon = alante_thinkup_var ( 'thinkup_header_linkedincustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_linkediniconswitch == '1' and ! empty( $thinkup_header_linkedincustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.linkedin a,';
		$output .= '#pre-header-social li.linkedin a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_linkedincustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.linkedin i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.linkedin a,';
		$output .= '#post-footer-social li.linkedin a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_linkedincustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.linkedin i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Flickr - Custom Icon */
function alante_thinkup_input_flickricon(){

// Get theme options values.
$thinkup_header_flickriconswitch = alante_thinkup_var ( 'thinkup_header_flickriconswitch' );
$thinkup_header_flickrcustomicon = alante_thinkup_var ( 'thinkup_header_flickrcustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_flickriconswitch == '1' and ! empty( $thinkup_header_flickrcustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.flickr a,';
		$output .= '#pre-header-social li.flickr a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_flickrcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.flickr i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.flickr a,';
		$output .= '#post-footer-social li.flickr a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_flickrcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.flickr i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* YouTube - Custom Icon */
function alante_thinkup_input_youtubeicon(){

// Get theme options values.
$thinkup_header_youtubeiconswitch = alante_thinkup_var ( 'thinkup_header_youtubeiconswitch' );
$thinkup_header_youtubecustomicon = alante_thinkup_var ( 'thinkup_header_youtubecustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_youtubeiconswitch == '1' and ! empty( $thinkup_header_youtubecustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.youtube a,';
		$output .= '#pre-header-social li.youtube a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_youtubecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.youtube i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.youtube a,';
		$output .= '#post-footer-social li.youtube a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_youtubecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.youtube i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Input Custom Social Media Icons */
function alante_thinkup_input_socialicon(){

	$output = NULL;
	
	$output .= alante_thinkup_input_facebookicon();
	$output .= alante_thinkup_input_twittericon();
	$output .= alante_thinkup_input_googleicon();
	$output .= alante_thinkup_input_instagramicon();
	$output .= alante_thinkup_input_linkedinicon();
	$output .= alante_thinkup_input_flickricon();
	$output .= alante_thinkup_input_youtubeicon();

	if ( ! empty( $output ) ) {
		echo    '<style type="text/css">' . "\n" . $output . '</style>';
	}
}
add_action( 'wp_head', 'alante_thinkup_input_socialicon', 13 );


/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - OUTPUT SOCIAL MEDIA SELECTIONS
---------------------------------------------------------------------------------- */

function alante_thinkup_input_socialmedia() {

// Get theme options values.
$thinkup_header_socialswitch    = alante_thinkup_var ( 'thinkup_header_socialswitch' );
$thinkup_header_socialmessage   = alante_thinkup_var ( 'thinkup_header_socialmessage' );
$thinkup_header_facebookswitch  = alante_thinkup_var ( 'thinkup_header_facebookswitch' );
$thinkup_header_facebooklink    = alante_thinkup_var ( 'thinkup_header_facebooklink' );
$thinkup_header_twitterswitch   = alante_thinkup_var ( 'thinkup_header_twitterswitch' );
$thinkup_header_twitterlink     = alante_thinkup_var ( 'thinkup_header_twitterlink' );
$thinkup_header_googleswitch    = alante_thinkup_var ( 'thinkup_header_googleswitch' );
$thinkup_header_googlelink      = alante_thinkup_var ( 'thinkup_header_googlelink' );
$thinkup_header_instagramswitch = alante_thinkup_var ( 'thinkup_header_instagramswitch' );
$thinkup_header_instagramlink   = alante_thinkup_var ( 'thinkup_header_instagramlink' );
$thinkup_header_linkedinswitch  = alante_thinkup_var ( 'thinkup_header_linkedinswitch' );
$thinkup_header_linkedinlink    = alante_thinkup_var ( 'thinkup_header_linkedinlink' );
$thinkup_header_flickrswitch    = alante_thinkup_var ( 'thinkup_header_flickrswitch' );
$thinkup_header_flickrlink      = alante_thinkup_var ( 'thinkup_header_flickrlink' );
$thinkup_header_youtubeswitch   = alante_thinkup_var ( 'thinkup_header_youtubeswitch' );
$thinkup_header_youtubelink     = alante_thinkup_var ( 'thinkup_header_youtubelink' );

// Reset count values used in foreach loop
$i = 0;
$j = 0;

	if ( $thinkup_header_socialswitch == '1' ) {

		// Assign social media link to an array
		$social_links = array( 
			array( 'social' => __( 'Facebook', 'alante' ),  'icon' => 'facebook',     'toggle' => $thinkup_header_facebookswitch,  'link' => $thinkup_header_facebooklink ),
			array( 'social' => __( 'Twitter', 'alante' ),   'icon' => 'twitter',      'toggle' => $thinkup_header_twitterswitch,   'link' => $thinkup_header_twitterlink ),
			array( 'social' => __( 'Google+', 'alante' ),   'icon' => 'google-plus',  'toggle' => $thinkup_header_googleswitch,    'link' => $thinkup_header_googlelink ),
			array( 'social' => __( 'Instagram', 'alante' ), 'icon' => 'instagram',    'toggle' => $thinkup_header_instagramswitch, 'link' => $thinkup_header_instagramlink ),
			array( 'social' => __( 'LinkedIn', 'alante' ),  'icon' => 'linkedin',     'toggle' => $thinkup_header_linkedinswitch,  'link' => $thinkup_header_linkedinlink ),
			array( 'social' => __( 'Flickr', 'alante' ),    'icon' => 'flickr',       'toggle' => $thinkup_header_flickrswitch,    'link' => $thinkup_header_flickrlink ),
			array( 'social' => __( 'YouTube', 'alante' ),   'icon' => 'youtube',      'toggle' => $thinkup_header_youtubeswitch,   'link' => $thinkup_header_youtubelink ),
		);


		// Output social media links if any link is set
		foreach( $social_links as $social ) {	
			if ( ! empty( $social['link'] ) and $j == 0 ) {
				echo '<div id="pre-header-social"><ul>'; $j = 1;

				if ( ! empty ( $thinkup_header_socialmessage ) ) {
					echo '<li class="social message">' . alante_thinkup_input_socialmessage() . '</li>';
				}
			}

			if ( ! empty( $social['link'] ) and $social['toggle'] == '1' ) {

			echo '<li class="social ' . esc_attr( $social['icon'] ) . '">',
				 '<a href="' . esc_url( $social['link'] ) . '" data-tip="bottom" data-original-title="' . esc_attr( $social['social'] ) . '" target="_blank">',
				 '<i class="fa fa-' . esc_attr( $social['icon'] ) . '"></i>',
				 '</a>',
				 '</li>';
			}
		}

		// Close list output of social media links if any link is set
		if ( $j !== 0 ) echo '</ul></div>';
	}
}