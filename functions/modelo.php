<?php
/*
[Menu]
#0001 : Desativa as Widgets do Dashboard (inicio) 
#0002 : Carrega Arquivos CSS no Admin

	
*/

/* 0001 - Desativa as Widgets do Dashboard */
/* ----------------------------------------- */

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
	
/* ----------------------------------------- 0001 - Desativa as Widgets do Dashboard */		

/* 0002 - Carrega Arquivos CSS no Admin */
/* ----------------------------------------- */
	
	function load_custom_wp_admin_style() {
	        wp_register_style( 'custom_wp_admin_css', get_bloginfo( 'stylesheet_directory' ) . '/css/admin-style.css', false, '1.0.0' );
	        wp_enqueue_style( 'custom_wp_admin_css' );
	}
	add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

/* ----------------------------------------- 0002 - Carrega Arquivos CSS no Admin */		
