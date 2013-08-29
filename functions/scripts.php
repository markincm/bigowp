<?php
// Cadastrando Scripts
add_action( 'wp_print_scripts', 'my_theme_load_scripts' );

function my_theme_load_scripts(){
//Use para incluir scripts e estilos.

       if (!is_admin()){
                  
				//desregistrando o jquery nativo e registrando o do CDN do Google.
				wp_deregister_script('jquery');
				wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', false, '1.7.2');
				wp_enqueue_script('jquery');	

//				os demais js
				wp_enqueue_script('jsbootstrap', get_template_directory_uri(). '/js/bootstrap.min.js', array('jquery'));
				wp_enqueue_script('codigo', get_template_directory_uri(). '/js/codigo.js', array('jquery'));
      }

}



function add_custom_image_sizes() {
//     add_image_size('thumb-facebook', 200, 200, true); //repita o processo para quantos tipos de thumbs quiser criar
 }

add_action('init', 'add_custom_image_sizes');



/*
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */
if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
    $optionsframework_settings = get_option('optionsframework');
    // Gets the unique option id
    $option_name = $optionsframework_settings['id'];
    if ( get_option($option_name) ) {
        $options = get_option($option_name);
    }
    if ( isset($options[$name]) ) {
        return $options[$name];
    } else {
        return $default;
    }
}
}
