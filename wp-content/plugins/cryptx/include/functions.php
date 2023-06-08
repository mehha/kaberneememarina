<?php
/**
 *  Don't load this file direct!
 */
if (!defined('ABSPATH')) {
    return ;
}

/**
 *  Define some global variables
 */
$cryptx_imageCounter = 0;

/**
 *  Set settings-defaults and return as array
 *
 *  @return array
 */
function rw_Defaults() {
    $firstFont = rw_cryptx_listDir(CRYPTX_DIR_PATH.'fonts', "ttf");
    $defaults = array(
                'version' => CRYPTX_VERSION,
                'at' => ' [at] ',
                'dot' => ' [dot] ',
                'css_id' => '',
                'css_class' => '',
                'the_content' => 1,
                'the_meta_key' => 1,
                'the_excerpt' => 1,
                'comment_text' => 1,
                'widget_text' => 1,
                'java' => 1,
                'load_java' => 1,
                'opt_linktext' => 0,
                'autolink' => 1,
                'alt_linktext' => '',
                'alt_linkimage' => '',
                'http_linkimage_title' => '',
                'alt_linkimage_title' => '',
                'excludedIDs' => '',
                'metaBox' => 1,
                'alt_uploadedimage' => '0',
                'c2i_font' => $firstFont[0],
                'c2i_fontSize' => 10,
                'c2i_fontRGB' => '#000000',
                'echo' => 1,
                'filter' => array('the_content','the_meta_key','the_excerpt','comment_text','widget_text'),
                'whiteList' => 'jpeg,jpg,png,gif',
            );
    return $defaults;
}

/**
 *  Loading defaults and parse with given seetings
 *
 *  @param  array   $options    given settings that should be completed with defaults
 *
 *  @return array
 */
function rw_loadDefaults($options='') {
    $return = wp_parse_args( get_option('cryptX'), rw_Defaults() );
    $return = (is_array($options))? wp_parse_args( $options, $return ) : $return ;

    return $return;
}

/**
 *  Add support for Shortcode
 *
 *  @param  array   $atts    options
 *  @param  string  $content content that should be encrypted
 *
 *  @return string
 */
function rw_cryptx_shortcode( $atts, $content=null) {
    global $cryptX_var;

    if (@$cryptX_var['autolink']) $content = rw_cryptx_autolink($content, true);
    $content = rw_cryptx_encryptx($content, true);
    $content = rw_cryptx_linktext($content, true);

    return $content;
}

/**
 *  create image from tinyurl
 *
 *  @return image
 */
function rw_cryptx_init_tinyurl() {
    $cryptX_var = rw_loadDefaults();
    $url = $_SERVER['REQUEST_URI'];
    $params = explode( '/', $url );
    if ( count( $params ) > 1 ) {
        $tiny_url = $params[count( $params ) -2];
        if ( $tiny_url == md5( get_bloginfo('url') ) ) {
            $font = CRYPTX_DIR_PATH . 'fonts/' . $cryptX_var['c2i_font'];
            $msg = $params[count( $params ) -1];
            $size = $cryptX_var['c2i_fontSize'];
            $pad = 1;
            $transparent = 1;
            $rgb = str_replace("#", "", $cryptX_var['c2i_fontRGB']);
            $red = hexdec(substr($rgb,0,2));
            $grn = hexdec(substr($rgb,2,2));
            $blu = hexdec(substr($rgb,4,2));
            $bg_red = 255 - $red;
            $bg_grn = 255 - $grn;
            $bg_blu = 255 - $blu;
            $width = 0;
            $height = 0;
            $offset_x = 0;
            $offset_y = 0;
            $bounds = array();
            $image = "";
            $bounds = ImageTTFBBox($size, 0, $font, "W");
            $font_height = abs($bounds[7]-$bounds[1]);
            $bounds = ImageTTFBBox($size, 0, $font, $msg);
            $width = abs($bounds[4]-$bounds[6]);
            $height = abs($bounds[7]-$bounds[1]);
            $offset_y = $font_height+abs(($height - $font_height)/2)-1;
            $offset_x = 0;
            $image = imagecreatetruecolor($width+($pad*2),$height+($pad*2));
            imagesavealpha($image, true);
            $foreground = ImageColorAllocate($image, $red, $grn, $blu);
            $background = imagecolorallocatealpha($image, 0, 0, 0, 127);
            imagefill($image, 0, 0, $background);
            ImageTTFText($image, $size, 0, $offset_x+$pad, $offset_y+$pad, $foreground, $font, $msg);
            Header("Content-type: image/png");
            imagePNG($image);
            die;
        }
    }
}

/**
 *  acivate needed filter
 *
 *  @param  string   $apply wordpress filter hook
 *
 *  @return nothing
 */
function rw_cryptx_filter($apply) {
    global $cryptX_var, $shortcode_tags;
    if (@$cryptX_var['autolink']) {
        add_filter($apply, 'rw_cryptx_autolink', 5);
        if (!empty($shortcode_tags) || is_array($shortcode_tags)) {
            add_filter($apply, 'rw_cryptx_autolink', 11);
        }
    }
    add_filter($apply, 'rw_cryptx_encryptx', 12);
    add_filter($apply, 'rw_cryptx_linktext', 13);
}

/**
 *  check if given ID is excuded from CryptX
 *
 *  @param  int   $ID post/page ID
 *
 *  @return bool
 */
function rw_cryptx_excluded($ID) {
    global $cryptX_var;
    $return = false;
    $exIDs = explode(",", $cryptX_var['excludedIDs']);
    if(in_array($ID, $exIDs) > 0 ) $return = true;
    return $return;
}

/**
 *  search for link texts
 *
 *  @param  string  $content    content given by post/page
 *  @param  bool    $shortcode  overwrite exclude list if call from shortcode
 *
 *  @return string
 */
function rw_cryptx_linktext($content, $shortcode=false) {
    global $post;
    $postID = (is_object($post))? $post->ID : -1;
    if (!rw_cryptx_excluded($postID) OR $shortcode!=false) {
        $content = preg_replace_callback("/([_a-zA-Z0-9-+]+(\.[_a-zA-Z0-9-+]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,}))/i", 'rw_cryptx_do_Linktext', $content );
    }
    return $content;
}

/**
 *  replace linktexts
 */
function rw_cryptx_do_linktext($Match) {
    global $cryptX_var, $cryptx_imageCounter;
    $vars = $cryptX_var;
    // workaround for the retina issue with @-symbol in filename like xxx-@2x.jpg
    $whiteList = array_filter(array_map('trim', explode(",", $vars['whiteList']) ));
    $tmp = explode(".", $Match[0]);
    if(in_array( end($tmp) , $whiteList ) ) return $Match[1];
    unset($tmp);
    switch ($vars['opt_linktext']) {

        case 1: // alternative text for mail link
            $linktext = $vars['alt_linktext'];
            break;

        case 2: // alternative image for mail link
            $linktext = "<img src=\"" . $vars['alt_linkimage'] . "\" class=\"cryptxImage\" alt=\"" . $vars['alt_linkimage_title'] . "\" title=\"" . antispambot($vars['alt_linkimage_title']) . "\" />";
            break;

        case 3: // uploaded image for mail link
            $imgurl = wp_get_attachment_url( $vars['alt_uploadedimage'] );
            $linktext = "<img src=\"" . $imgurl . "\" class=\"cryptxImage cryptxImage_" . $cryptx_imageCounter . "\" alt=\"" . $vars['http_linkimage_title'] . " title=\"" .antispambot( $vars['http_linkimage_title']) . "\" />";
            $cryptx_imageCounter++;
            break;

        case 4: // text scrambled by antispambot
            $linktext = antispambot($Match[1]);
            break;

        case 5: // convert to image
            $linktext = "<img src=\"" . get_bloginfo('url') . "/" . md5( get_bloginfo('url') ) . "/" . antispambot($Match[1]) . "\" class=\"cryptxImage cryptxImage_" . $cryptx_imageCounter . "\" alt=\"" . antispambot($Match[1]) . "\" title=\"" . antispambot($Match[1]) . "\" />";
            $cryptx_imageCounter++;
            break;

        default:
            $linktext = str_replace( "@", $vars['at'], $Match[1]);
            $linktext = str_replace( ".", $vars['dot'], $linktext);

    }
    return $linktext;
}

/**
 *  get filtered content of directory
 */
function rw_cryptx_listDir( $path, $filter) {
    if(!is_array($filter)) $filter = (array)$filter;
    $fh = opendir($path);
    $verzeichnisinhalt = array();
    while (true == ($file = readdir($fh)))
    {
        if ( in_array( substr( strtolower($file), -3), $filter ))
            {
            $verzeichnisinhalt[] = $file;
            }
    }
    return $verzeichnisinhalt;
}

/**
 *  search for mailto tags
 */
function rw_cryptx_encryptx($content, $shortcode=false) {
    global $post;
    $postID = (is_object($post))? $post->ID : -1;

    if (!rw_cryptx_excluded($postID) OR $shortcode!=false) {
        $content = preg_replace_callback('/<a (.*?)(href=("|\')mailto:(.*?)("|\')(.*?)|)>\s*(.*?)\s*<\/a>/i', 'rw_cryptx_mailtocrypt', $content );
    }
    return $content;
}

/**
 *  encryptx adresses with javascript
 */
function rw_cryptx_mailtocrypt($Match) {
    global $cryptX_var;
    $return = $Match[0];
    if(strpos($Match[4], '@') === false) return $return; // Do nothing if no email found, like mailto-links from Shariff.
    $mailto = "mailto:" . $Match[4];
    if (substr($Match[4], 0, 9) =="?subject=") return $return;
    if (@$cryptX_var['java']) {
        $javascript="javascript:DeCryptX('" . rw_cryptx_generate_hash($Match[4]) . "')";
        $return = str_replace( "mailto:".$Match[4], $javascript, $return);
    } else {
            $return = str_replace( $mailto, antispambot($mailto), $return);
    }
    if(!empty($cryptX_var['css_id'])) {
        $return = preg_replace( '/(.*)(">)/i', '$1" id="'.$cryptX_var['css_id'].'">', $return );
    }
    if(!empty($cryptX_var['css_class'])) {
        $return = preg_replace( '/(.*)(">)/i', '$1" class="'.$cryptX_var['css_class'].'">', $return );
    }
    return $return;
}

/**
 *  generate the unique hash
 */
function rw_cryptx_generate_hash($string) {
		$string = str_replace("&", "&", $string);
		$blacklist = array(
							'32',	// Space
							'34',	// Double quote
							'39',	// Single quote
							'60',	// Less than
							'62',	// Greater than
							'63',	// Question mark
							'92',	// Backslash
							'94',	// Caret - circumflex
							'96',	// Grave accent
							'127',	// Delete
						);
        $crypt	= '';
        $ascii	= 0;

        for ($i = 0; $i < strlen( $string ); $i++) {

            do {
    	    	$salt	= mt_rand(0, 3);
                $ascii = ord ( substr ( $string, $i ) ) + $salt;
                if (8364 <= $ascii) {
                    $ascii = 128;
                }

            } while ( in_array($ascii, $blacklist) ); // blacklisted chars are impossible for hash! retry with new random...

            $crypt .= $salt.chr($ascii);
        }
        return $crypt;
}

/**
 *  add link to email adresses
 */
function rw_cryptx_autolink($content, $shortcode=false) {
    global $post;
    $postID = (is_object($post))? $post->ID : -1;
    if (rw_cryptx_excluded($postID) AND $shortcode==false) return $content;
    $src[]="/([\s])([_a-zA-Z0-9-+]+(\.[_a-zA-Z0-9-+]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,}))/si";
    $src[]="/(>)([_a-zA-Z0-9-+]+(\.[_a-zA-Z0-9-+]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,}))(<)/si";
    $src[]="/(\()([_a-zA-Z0-9-+]+(\.[_a-zA-Z0-9-+]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,}))(\))/si";
    $src[]="/(>)([_a-zA-Z0-9-+]+(\.[_a-zA-Z0-9-+]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,}))([\s])/si";
    $src[]="/([\s])([_a-zA-Z0-9-+]+(\.[_a-zA-Z0-9-+]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,}))(<)/si";
    $src[]="/^([_a-zA-Z0-9-+]+(\.[_a-zA-Z0-9-+]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,}))/si";
    $src[]="/(<a[^>]*>)<a[^>]*>/";
    $src[]="/(<\/A>)<\/A>/i";

    $tar[]="\\1<a href=\"mailto:\\2\">\\2</a>";
    $tar[]="\\1<a href=\"mailto:\\2\">\\2</a>\\6";
    $tar[]="\\1<a href=\"mailto:\\2\">\\2</a>\\6";
    $tar[]="\\1<a href=\"mailto:\\2\">\\2</a>\\6";
    $tar[]="\\1<a href=\"mailto:\\2\">\\2</a>\\6";
    $tar[]="<a href=\"mailto:\\0\">\\0</a>";
    $tar[]="\\1";
    $tar[]="\\1";
    $content = preg_replace($src,$tar,$content);
    return $content;
}

/**
 *  needed stuff for install process
 */
function rw_cryptx_install() {
    global $cryptX_var, $wpdb;
    $cryptX_var = rw_loadDefaults(); // reread Options
    $cryptX_var['admin_notices_deprecated']=true;
    if ($cryptX_var['excludedIDs'] == "") {
        $tmp = array();
        $excludes = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'cryptxoff' AND meta_value = 'true'");
        if(count($excludes) > 0) {
            foreach ($excludes as $exclude) {
                $tmp[] = $exclude->post_id;
            }
            sort($tmp);
            $cryptX_var['excludedIDs'] = implode(",", $tmp);
            update_option( 'cryptX', $cryptX_var);
            $cryptX_var = rw_loadDefaults(); // reread Options
            $wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = 'cryptxoff'");
        }
    }
    if (empty($cryptX_var['c2i_font'])) {
        $cryptX_var['c2i_font'] = CRYPTX_DIR_PATH . 'fonts/' . $firstFont[0];
    }
    if (empty($cryptX_var['c2i_fontSize'])) {
        $cryptX_var['c2i_fontSize'] = 10;
    }
    if (empty($cryptX_var['c2i_fontRGB'])) {
        $cryptX_var['c2i_fontRGB'] = '000000';
    }
    update_option( 'cryptX', $cryptX_var);
    $cryptX_var = rw_loadDefaults(); // reread Options
}

/**
 *  add support for CryptX MetaBox
 */
function rw_cryptx_meta_box() {
    if ( function_exists('add_meta_box') ) {
        add_meta_box('cryptx','CryptX', 'rw_cryptx_meta','post');
        add_meta_box('cryptx','CryptX', 'rw_cryptx_meta','page');
    } else {
        add_action('dbx_post_sidebar', 'rw_cryptx_option');
        add_action('dbx_page_sidebar', 'rw_cryptx_option');
    }
}

/**
 *  the MetaBox new-style
 */
function rw_cryptx_meta() {
    global $post;
    ?>
    <input type="checkbox" name="cryptxoff" <?php if (rw_cryptx_excluded($post->ID)) { echo 'checked="checked"'; } ?>/> Disable CryptX for this post/page
    <?php
}

/**
 *  the MetaBox old-style
 */
function rw_cryptx_option() {
    global $post;
    if ( current_user_can('edit_posts') ) { ?>
    <fieldset id="cryptxoption" class="dbx-box">
    <h3 class="dbx-handle">CryptX</h3>
    <div class="dbx-content">
        <input type="checkbox" name="cryptxoff" <?php if (rw_cryptx_excluded($post->ID)) { echo 'checked="checked"'; } ?>/> Disable CryptX for this post/page
    </div>
    </fieldset>
<?php
    }
}

/**
 *  add ID to exclude list
 */
function rw_cryptx_insert_post($pID) {
    global $cryptX_var, $post;
    $rev = wp_is_post_revision($pID);
    if($rev) $pID = $rev;
    $b = explode(",", $cryptX_var['excludedIDs']);
    if($b[0] == '') unset($b[0]);
    foreach($b as $x=>$y) {
        if($y == $pID) {
            unset($b[$x]);
            break;
        }
    }
    if (isset($_POST['cryptxoff'])) $b[] = $pID;
    $b = array_unique($b);
    sort($b);
    $cryptX_var['excludedIDs'] = implode(",", $b);
    update_option( 'cryptX', $cryptX_var);
    $cryptX_var = rw_loadDefaults(); // reread Options
}

/**
 *  print admin notice
 */
function rw_cryptx_showMessage($message, $errormsg = false)
{
    if ($errormsg) {
        echo '<div id="message" class="error">';
    }
    else {
        echo '<div id="message" class="updated fade">';
    }

    echo "$message</div>";
}

function rw_cryptx_getDomain()
{
    $domain = preg_replace( '|https?://|', '', get_option( 'siteurl' ) );
    if ( $slash = strpos( $domain, '/' ) ) {
        $domain = substr( $domain, 0, $slash );
    }
    return $domain;
}

/**
 *  New Template functions...
 *  $content = string to convert
 *  $args    = array with options
 */
function encryptx( $content, $args="" ) {
    global $cryptX_var;
    $args = (array) $args;
    $cryptX_var = wp_parse_args( $args, $cryptX_var);
    $return = do_shortcode('[cryptx]'.$content.'[/cryptx]');
    $cryptX_var = rw_loadDefaults();
    return $return;
}

/**
 *  Template function that encrypt the get_post_meta result
 *  call it with the default get_post_meta parameters
 */
function get_encryptx_meta( $post_id, $key, $single=false ) {

    $values = get_post_meta( $post_id, $key, $single );

    if(is_array($values)) {
        $return = array();
        foreach( $values as $value) {
            $return[] = encryptx($value);
        }
    } else {
        $return = encryptx($values);
    }

    return $return;

}

/**
 *  get CryptX Version
 */
function rw_cryptx_version() {
    if ( ! function_exists( 'get_plugins' ) )
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
    $plugin_file = CRYPTX_BASENAME;
    return $plugin_folder[$plugin_file]['Version'];
}

/**
 *  Enqueue CryptX Frontend JavaScript
 */
function cryptx_javascripts_load() {
    global $cryptX_var;
    wp_enqueue_script( 'cryptx-js', CRYPTX_DIR_URL . 'js/cryptx.min.js', false, false, $cryptX_var['load_java'] );
    wp_enqueue_style( 'cryptx-styles', CRYPTX_DIR_URL . 'css/cryptx.css');
}

/**
 *  Do needed settings updates after new CryptX version is installed
 */
function cryptx_do_updates() {
    $cryptX_var = get_option('cryptX');
    if( isset( $cryptX_var['version'] ) && version_compare(CRYPTX_VERSION, $cryptX_var['version']) > 0 ) {
        // Update settings version
        if( isset($cryptX_var['version']) ) unset($cryptX_var['version']);
        // reset Font to new Font selection
        if( isset($cryptX_var['c2i_font']) ) unset($cryptX_var['c2i_font']);
        // reset font color to new color picker value format
        if( isset($cryptX_var['c2i_fontRGB']) ) $cryptX_var['c2i_fontRGB'] = "#".$cryptX_var['c2i_fontRGB'];
        // reset uploaded image setting to the WP MediaLibrary requirement
        if( isset($cryptX_var['alt_uploadedimage']) && !is_int($cryptX_var['alt_uploadedimage'])) {
            unset($cryptX_var['alt_uploadedimage']);
            // reset link option to default if uploaded image was selected
            if( $cryptX_var['opt_linktext'] == 3 ) unset($cryptX_var['opt_linktext']);
        }
        $cryptX_var = wp_parse_args( $cryptX_var, rw_Defaults() );
        update_option( 'cryptX', $cryptX_var);
    }
}