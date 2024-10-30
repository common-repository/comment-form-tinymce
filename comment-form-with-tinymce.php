<?php
/*
Plugin Name:   Comment Form with TinyMCE
Plugin URI : https://profiles.wordpress.org/mehtashail/
Description:  Comment Form with TinyMCE Editor
Version: 1.0.0
Author: Shail Mehta
Text Domain: wporg
Author URL : https://profiles.wordpress.org/mehtashail/
*/
// Prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}
defined('COMMENT_FORM_WITH_TINYMICE_ROOT') or define('COMMENT_FORM_WITH_TINYMICE_ROOT', plugin_dir_path(__FILE__));
/*Activation & Deactivation */
function __construct()
{
    register_activation_hook(__FILE__, 'comment_form_with_tinymice_install');
    register_deactivation_hook(__FILE__, 'comment_form_with_tinymice_install');
}
/*Plugin Install*/
function comment_form_with_tinymice_install()
{
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
}
add_filter( 'comment_form_defaults', 'comment_form_with_tinymice' );
function comment_form_with_tinymice( $args ) {
    ob_start();
    wp_editor( '', 'comment', array(
        'media_buttons' => true,
        'textarea_rows' => '10',
        'dfw' => false,
        'tinymce' => array(
            'theme_advanced_buttons1' => 'bold,italic,underline,strikethrough,bullist,numlist,code,blockquote,link,unlink,outdent,indent,|,undo,redo,fullscreen',
            'theme_advanced_buttons2' => '', // 2nd row, if needed
            'theme_advanced_buttons3' => '', // 3rd row, if needed
            'theme_advanced_buttons4' => '' // 4th row, if needed
        )
    ) );
    $args['comment_field'] = ob_get_clean();
    return $args;
}
?>
