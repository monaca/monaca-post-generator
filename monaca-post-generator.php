<?php
/*
Plugin Name: MonacaPostGenerator
Plugin URI: http://press.monaca.mobi/
  Description: The MonacaPost Plugin is generator smart devices application's source code for upload WordPress.
  MonacaPost is dependency MonacaPress and Monaca.
  MonacaPress can upload source code on Monaca And Monaca can build HTML5 based Application.
Version: 0.1
Author: YUKI OKAMOTO (HN:Justice)
Author URI: http://j801.com
License: GPL2
*/

add_action('admin_menu', 'monaca_post_admin_menu');
register_activation_hook( __FILE__, 'monaca_post_activate' );
register_uninstall_hook(__FILE__, 'monaca_post_uninstall_hook'); 

function monaca_post_generator_uninstall_hook() 
{
  $projects = get_option('monaca_press_projects');
  unset($projects['monaca-post-generator']);
  update_option('monaca_press_projects', $projects);
}

function monaca_post_generator_activate() 
{
  $projects = get_option('monaca_press_projects');
  $projects['monaca-post-generator'] = array(
    'path' => __file__,
    'info' => 'MonacaPostGenerator',
  );
  update_option('monaca_press_projects', $projects);
}

function monaca_post_admin_menu() 
{
  add_menu_page(
    'MonacaPostG',
    'MonacaPostG',
    'administrator',
    'monaca_post_generator_admin_menu',
    'monaca_post_generator_setting'
  );
}

function monaca_post_generator_setting() 
{
  global $blog_id;
  global $current_user;


  $setting = array(
    'blog_id' => $blog_id,
    'author' => $current_user->ID,
    'xmlrpc_endpoint' => site_url('xmlrpc.php'),
    'post_status' => 'publish',
    'local_config' => 'true',
    'thumbnail' => array('targetWidth' => 100, 'targetHeight' => 100),
    'category' => array( 1 => '未分類'),
  );

  // フォーム処理
  if (isset($_POST['submit'])) {
    ?><pre><?php
    ob_start();
    include('config.php');
    $source = ob_get_clean();
    file_put_contents(WP_PLUGIN_DIR . '/monaca-post/project/js/config.js', $source);

    var_dump($_POST);
    ?></pre><?php
  }

  // 表示処理
  include 'setting.php';
}

?>
