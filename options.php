<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_check'),
		'two' => __('Two', 'options_check'),
		'three' => __('Three', 'options_check'),
		'four' => __('Four', 'options_check'),
		'five' => __('Five', 'options_check')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_check'),
		'two' => __('Pancake', 'options_check'),
		'three' => __('Omelette', 'options_check'),
		'four' => __('Crepe', 'options_check'),
		'five' => __('Waffle', 'options_check')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();


	$options[] = array(
		'name' => __('Config Básicas', 'options_check'),
		'type' => 'heading');
	

	$options[] = array(
		'name' => __('Logo', 'options_check'),
		'desc' => __('Essa é a logo do blog de vocês. Caso queiram alterar algum dia. O tamanho padrão é de 625x201px.', 'options_check'),
		'id' => 'logo_header',
		'type' => 'upload');
	
	
	$options[] = array(
			'name' => __('Anúncio Topo', 'options_check'),
			'type' => 'heading');
		
	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */
	
	$wp_editor_settings = array(
		'wpautop' => false, // Default
		'textarea_rows' => 7,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	
	/*		
	$options[] = array(
		'name' => __('Código', 'options_check'),
		'desc' => __('Cole o código do banner referente ao anuncio do topo. As dimensões devem ser de 728x90px. Obs: Caso não seja um código, use as opções de upload de imagem e link abaixo.', 'options_check'),
		'id' => 'codigo_anuncio_topo',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
	*/	
	
	$options[] = array(
		'name' => __('Imagem e link', 'options_check'),
		'desc' => __('Use o uploader para atribuir a imagem do banner. As dimensões devem ser de 728x90px. Só é permitido o upload de imagens.', 'options_check'),
		'id' => 'imagem_anuncio_topo',
		'type' => 'upload');
	
	$options[] = array(
		//'name' => __('Link', 'options_check'),
		'desc' => __('Cole o link ao qual o usuário deve ser redirecionado após o clique.', 'options_check'),
		'id' => 'link_anuncio_topo',
		'type' => 'text');
		
		
	$options[] = array(
			'name' => __('Anúncios Entre Posts', 'options_check'),
			'type' => 'heading');
	
	/*
	Primeiro Post
	*/
	$options[] = array(
		'name' => __('Primeiro post', 'options_check'),
		'desc' => __('Use o uploader para atribuir a imagem do banner. As dimensões devem ser de 468x60px. Só é permitido o upload de imagens.', 'options_check'),
		'id' => 'imagem_primeiro_post',
		'type' => 'upload');
	
	$options[] = array(
		//'name' => __('Link', 'options_check'),
		'desc' => __('Cole o link ao qual o usuário deve ser redirecionado após o clique.', 'options_check'),
		'id' => 'link_primeiro_post',
		'type' => 'text');
	
	/*
	Segundo Post
	*/
	$options[] = array(
		'name' => __('Segundo post', 'options_check'),
		'desc' => __('Use o uploader para atribuir a imagem do banner. As dimensões devem ser de 468x60px. Só é permitido o upload de imagens.', 'options_check'),
		'id' => 'imagem_segundo_post',
		'type' => 'upload');
	
	$options[] = array(
		//'name' => __('Link', 'options_check'),
		'desc' => __('Cole o link ao qual o usuário deve ser redirecionado após o clique.', 'options_check'),
		'id' => 'link_segundo_post',
		'type' => 'text');
	
	/*
	Terceiro Post
	*/
	
	$options[] = array(
		'name' => __('Terceiro post', 'options_check'),
		'desc' => __('Use o uploader para atribuir a imagem do banner. As dimensões devem ser de 468x60px. Só é permitido o upload de imagens.', 'options_check'),
		'id' => 'imagem_terceiro_post',
		'type' => 'upload');
	
	$options[] = array(
		//'name' => __('Link', 'options_check'),
		'desc' => __('Cole o link ao qual o usuário deve ser redirecionado após o clique.', 'options_check'),
		'id' => 'link_terceiroo_post',
		'type' => 'text');	
	
	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */


	
	return $options;
}