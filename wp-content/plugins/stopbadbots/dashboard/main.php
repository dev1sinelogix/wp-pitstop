<?php 
/**
* @author William Sergio Minozzi
* @copyright 2017
*/
if (!defined('ABSPATH'))
exit; // Exit if accessed directly
// ob_start();
if (!defined('STOPBADBOTSHOMEURL'))
   define('STOPBADBOTSHOMEURL', admin_url());

$sbb_urlsettings = STOPBADBOTSHOMEURL."/admin.php?page=sbb_settings33";
add_action( 'admin_init', 'stopbadbots_settings_init' );
add_action( 'admin_menu', 'stopbadbots_add_admin_menu' );
function stopbadbots_enqueue_scripts() {
    wp_enqueue_style( 'bill-help-dashboard' , STOPBADBOTSURL.'/dashboard/css/help.css');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-dialog');
    
    if( !class_exists('TM_Builder_Core') )
    {


        $stopbadbots_jqueryurl = STOPBADBOTSURL . 'assets/css/jquery-ui.css';


    }


    wp_register_style( 'bill-jquery-help', $stopbadbots_jqueryurl , array(), '20120208', 'all' );
    wp_enqueue_style( 'bill-jquery-help' );
    /*
    if(! is_bill_theme())
       wp_register_script( 'fix-config-manager',STOPBADBOTSURL.'/dashboard/js/fix-config-manager.js' , array( 'jquery' ), STOPBADBOTSVERSION, true );
       wp_enqueue_script( 'fix-config-manager' );
    */
 }
add_action('admin_init', 'stopbadbots_enqueue_scripts');
function stopbadbots_add_admin_menu(  ) {
    Global $menu;
    add_menu_page(
        'Stop Bad Bots22', 
        'Stop Bad Bots', 
        'manage_options', 
        'stop_bad_bots_plugin', // slug 
        'stopbadbots_options_page', 
        STOPBADBOTSIMAGES.'/protect.png' , 
        '100' 
    );
    include_once(ABSPATH . 'wp-includes/pluggable.php');
    $link_our_new_CPT = urlencode('edit.php?post_type=stopbadbotsfields');
}
function stopbadbots_settings_init(  ) { 
	register_setting( 'stopbadbots', 'stopbadbots_settings' );
}
function stopbadbots_options_page(  ) { 
    global $activated, $stopbadbots_update_theme;
    global $stop_bad_bots_active; 
    global $stop_bad_bots_ip_active; 
    global $stopbadbots_checkversion;
    global $stop_bad_bots_firewall;
    global $stop_bad_bots_referer_active;
    global $stopbadbots_block_enumeration;
    global$stopbadbots_block_pingbackrequest;

    if (!function_exists('wp_get_current_user')) {
        require_once(ABSPATH . "wp-includes/pluggable.php");
    }

    $wpversion = get_bloginfo('version');
    $current_user = wp_get_current_user();
    $plugin = plugin_basename(__FILE__); 
    $email = $current_user->user_email;
    $username =  trim($current_user->user_firstname);
    $user = $current_user->user_login;
    $user_display = trim($current_user->display_name);
    if(empty($username))
    $username = $user;
    if(empty($username))
    $username = $user_display;
    $theme = wp_get_theme( );
    $themeversion = $theme->version ; 
    ?>
    <!-- Begin Page -->
    <div id = "stopbadbots-theme-help-wrapper">   
    <div id="stopbadbots-not-activated"></div>

    <div id="stopbadbots-logo">
    <img alt="logo" src="<?php echo esc_attr(STOPBADBOTSIMAGES);?>/logo.png" width="250px" />
    </div>

    <div id="stopbadbots-social">
    <a href="https://stopbadbots.com/share/"><img alt="social bar" src="<?php echo esc_attr(STOPBADBOTSIMAGES);?>/social-bar.png" width="250px" /></a>
    </div>


    <div id="stopbadbots-nocloud">
        <img alt="No Cloud" src="<?php echo esc_attr(STOPBADBOTSIMAGES);?>/no_cloud.png" width="200px" />
        </div>

    <div id="stopbadbots_help_title">
    Help and Support Page
    </div> 
    <?php


    if( isset( $_GET[ 'tab' ] ) ) 


    $active_tab = sanitize_text_field($_GET[ 'tab' ]);
    else
    $active_tab = 'dashboard';


    if(is_multisite())
        $url = esc_url(STOPBADBOTSHOMEURL)  . "plugin-install.php?s=sminozzi&tab=search&type=author";
    else
        $url = esc_url(STOPBADBOTSHOMEURL).'/admin.php?page=stopbadbots_new_more_plugins';


    ?>
    <h2 class="nav-tab-wrapper">
    <a href="?page=stop_bad_bots_plugin&tab=memory&tab=dashboard" class="nav-tab">Dashboard</a>
    <a href="?page=stop_bad_bots_plugin&tab=memory" class="nav-tab">Memory Check Up</a>
    <a href="?page=stop_bad_bots_plugin&tab=notifications" class="nav-tab">Notifications</a>


    <a href="<?php echo esc_url($url);?>" class="nav-tab">More Plugins Same Author</a>

    </h2>
    <?php  
    if($active_tab == 'memory') {   
        echo '<div id="stopbadbots-dashboard-wrap">';
        echo '<div id="stopbadbots-dashboard-left">';    
        require_once (STOPBADBOTSPATH . 'dashboard/memory.php');
    } 
    elseif($active_tab == 'notifications') {  
        echo '<div id="stopbadbots-dashboard-wrap">';
        echo '<div id="stopbadbots-dashboard-left">';     
        require_once (STOPBADBOTSPATH . 'dashboard/notifications.php');
    } 
    else
    { 
        echo '<div id="stopbadbots-dashboard-wrap">';
        echo '<div id="stopbadbots-dashboard-left">';  
        require_once (STOPBADBOTSPATH . 'dashboard/dashboard.php');
    }

    ?>
    </div> <!-- "stopbadbots-dashboard-left"> -->
    <div id="stopbadbots-dashboard-right">
        <div id="stopbadbots-containerright-dashboard">
            <?php 
            if (empty($stopbadbots_checkversion))
            require_once(STOPBADBOTSPATH . "dashboard/mybanners.php"); 
            ?>
        </div>
    </div> <!-- "stopbadbots-dashboard-right"> -->
    </div> <!-- "car-dealer-dashboard-wrap"> -->
    <?php

   // }

 ////////////////////////////////////




    echo '</div> <!-- "stopbadbots-theme_help-wrapper"> -->';








} // end Function stopbadbots_options_page






require_once(ABSPATH . 'wp-admin/includes/screen.php');
// ob_end_clean();
include_once(ABSPATH . 'wp-includes/pluggable.php');
function sbb_add_admin_menu()
{
    add_submenu_page('stop_bad_bots_plugin', // $parent_slug
    'Bad Bots Table', // string $page_title
    'Add Bad Bot to Table', // string $menu_title
    'manage_options', 'Add New Bad Bot', // Page Title
    'sbb_options_page');
}
function sbb_add_admin_menu2()
{
    add_submenu_page('stop_bad_bots_plugin', // $parent_slug
    'Bad IPs Table', // string $page_title
    'Add Bad IP to Table', // string $menu_title
    'manage_options', 'Add New Bad IP', // Page Title
    'sbb_options_page2'); 
}
function sbb_add_admin_menu3()
{
    add_submenu_page('stop_bad_bots_plugin', // $parent_slug
    'Bad Referer Table', // string $page_title
    'Add Bad Referer to Table', // string $menu_title
    'manage_options', 'Add New Bad Referer', // Page Title
    'sbb_options_page3'); 
}
if(! function_exists('is_bill_theme'))
{
    function is_bill_theme()
    {
        $my_theme = wp_get_theme();
        $theme = trim($my_theme->get( 'Name' ));
        $mythemes = array (
        'boatdealer',
        'KarDealer',
        'verticalmenu',
        'fordummies',
        'Real Estate Right Now');
        // boatseller
        $count = count( $mythemes);
        $theme =  strtolower(trim($theme));
        for($i=0; $i < $count; $i++)
        {
        if ($theme == strtolower(trim($mythemes[$i])))
            return true;
        }
        return false;
    }
 }
?>