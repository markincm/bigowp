<?php
/*
[Menu]
#0001 : Desativa as Widgets do Dashboard (inicio) 
#0002 : Adciona Widgets Personalizadas no Dashboard 

	
*/

#0001
#############################################################
#				Desativa as Widgets Padrões 				#
#############################################################


// Desativa os itens do painel inicio do wordpress
// Disable Default Dashboard Widgets
function disable_default_dashboard_widgets() {

	remove_meta_box('dashboard_browser_nag', 'dashboard', 'core');
	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');


#0002 
#############################################################
#		Adciona Widgets Personalizadas no Dashboard			##############################################################

// Function that outputs the contents of the dashboard widget
function dashboard_widget_function() { ?>
	<?php	 
			global $current_user;
			get_currentuserinfo();
			echo 'Bom dia ' . $current_user->display_name . "! Seja bem vindo de volta ao seu site.";
	?>
	
<? }


function dashboard_widget_suporte() {
	echo '<iframe src="http://www.bigodesign.com.br/formulario-suporte-clientes" frameborder="no" width="100%" height="300px"></iframe>';
}


// Function used in the action hook
function add_dashboard_widgets() {
	//Crie quantas widgets quiser
	wp_add_dashboard_widget(
	'dashboard_widget_boasvindas', // $widget_id
	'Painel', // $widget_name
	'dashboard_widget_function' // $callback
							);
	
	wp_add_dashboard_widget(
	'dashboard_widget_suporte', // $widget_id
	'Suporte', // $widget_name
	'dashboard_widget_suporte' // $callback
							);
	
}

// Register the new dashboard widget with the 'wp_dashboard_setup' action
add_action('wp_dashboard_setup', 'add_dashboard_widgets' );


#0003 
#############################################################
#			Carrega Arquivos CSS no Admin					#
#############################################################


function load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', get_bloginfo( 'stylesheet_directory' ) . '/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );