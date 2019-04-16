<?php
/**
 * Divi child enhanced basic
 * functions
 */
function set_child_theme_styles() {

    $parent_style = 'divi-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'divi-child-enhanced-basic-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );

}
add_action( 'wp_enqueue_scripts', 'set_child_theme_styles' );



function dce_basic_add_theme_menu_item()
{
	add_menu_page("DCE Basic Panel", "DCE Basic", "manage_options", "theme-panel", "dce_basic_theme_settings_page", null, 99999);
}
add_action("admin_menu", "dce_basic_add_theme_menu_item");



function dce_basic_theme_settings_page()
{
    ?>
	    <div class="wrap">
	    <h1>DCE Basic Theme Panel</h1>
	    <form method="post" action="">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");
	            submit_button();
	        ?>
	    </form>
		</div>
	<?php
}


// >> https://www.sitepoint.com/create-a-wordpress-theme-settings-page-with-the-settings-api/
// >> https://wpreset.com/programmatically-automatically-download-install-activate-wordpress-plugins/



function  install_plugins_text() {

	echo '<p>The Divi Child Enhanced Basic theme comes with a list of recommended plugins.</p>';
	//echo '<p>Check separate plugins or install all</p>';


}
function install_plugins_element()
{


    if( isset( $_POST['install_plugins'] ) ){
            update_option('install_plugins', '1' );
        }else{
            update_option('install_plugins', '0' );
        }
        ?>
        <input type="checkbox" name="install_plugins" value="1" <?php checked(1, get_option('install_plugins'), true); ?> />
        <?php


}

function display_theme_panel_fields()
{
	add_settings_section("section", "Install plugins", 'install_plugins_text', "theme-options");

//	/add_settings_section('main_section', 'Main Settings', 'section_text_intro', __FILE__);

    add_settings_field("install_plugins", "(Re)Install all above listed plugins", "install_plugins_element", "theme-options", "section");

    register_setting("section", "install_plugins");
}

add_action("admin_init", "display_theme_panel_fields");



