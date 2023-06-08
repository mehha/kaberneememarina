<?php
/*
 * Plugin Name: Admin Language Switcher
 * Version: 0.1
 * Plugin URI:
 * Description:
 * Author:
 * Author URI:
 */

function MehhAdminBarLogo() {
$idinteger = get_current_blog_id();
$language = (get_blog_option($idinteger, 'language'))? get_blog_option($idinteger, 'language') : get_blog_option($idinteger, 'WPLANG');
$language_prefix = ($language)? explode('_', $language) : array('en','en');
echo '<style>
	body #cpt_info_box{
		display:none!important;
	}
	body #wpadminbar #wp-admin-bar-site-name .ab-item:before{
		content: ""!important;
		background: url('.plugins_url( 'flags/'.$language_prefix[0].'.gif' , __FILE__ ).') !important;
		display: block;
		background-size: 16px 11px;
		width: 16px;
		height: 11px;
		margin-top: 8px;
		background-repeat: no-repeat!important;
	}

	@media only screen and (max-width: 782px) and (min-width: 600px){
		.wp-admin #wpadminbar #wp-admin-bar-wp-logo .ab-item .ab-icon:before{
			width: 30px;
			height: 30px;
			top: 8px;
			left: 10px;
			background-size: 30px;
		}
		body #wpadminbar #wp-admin-bar-site-name .ab-item:before{
			content: "\f102";
			top: 6px;
			left: 7px;
			background: none!important;
			width: auto;
			height: auto;
			margin-top: 0;
		}
	}

	@media only screen and (max-width: 599px){
		body #wpadminbar #wp-admin-bar-site-name .ab-item:before{
			content: "\f102";
			top: 6px;
			left: 7px;
			background: none!important;
			width: auto;
			height: auto;
			margin-top: 0;
		}
	}

	body .field_type-post_object select{
		width: 100%!important;
	}

	img.blavatar { display: none;}
	#wpadminbar .quicklinks li div.blavatar {display:none;}
</style>';
}
add_action('admin_head', 'MehhAdminBarLogo');
add_action('wp_head', 'MehhAdminBarLogo');

function MehhAdminBarRefresh() {

global $wp_admin_bar;
$elements = $wp_admin_bar->get_nodes();
foreach( $elements as $element ) {

if ( $element->parent == 'my-sites-list' ) {

// reduce the adminbar Id to the blog ID
$idinteger = str_replace( 'blog-', '', $element->id );
$language_name = get_blog_option($idinteger, 'mehh_general_language_name');
$language = (get_blog_option($idinteger, 'language'))? get_blog_option($idinteger, 'language') : get_blog_option($idinteger, 'WPLANG');
$language_prefix = ($language)? explode('_', $language) : array('en','en');
$language = ($language_name)? $language_name : $language;
$language = ($language)? $language : 'English';
$language_flag = ($idinteger == 1)? '  ' : '<img src="'.plugins_url( 'flags/'.$language_prefix[0].'.gif' , __FILE__ ).'" alt="'.$language.'" /> ';

$newtitle = ($idinteger == 1)? 'Master' : $language_flag.'  '.$element->title;
// define new menu element
$args = array(
'title'     => $newtitle,
'id'        => $element->id,
'parent'    => $element->parent,
'href'      => $element->href,
);
// remove the old one
$wp_admin_bar->remove_node( $element->id );
// add the new one right afterwards.
$wp_admin_bar->add_node( $args );

}elseif($element->parent == 'wp-logo'){
$wp_admin_bar->remove_node( $element->id );
}

}

}
add_action( 'wp_before_admin_bar_render', 'MehhAdminBarRefresh' );

?>