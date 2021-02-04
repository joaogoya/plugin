<?php
/*
Plugin Name: Settings plugin
Plugin URI: http://goole.com
Description: Apenas mais um teste wordpress
Author: TW
licence: GPL2
*/



// // add the admin settings and such
// add_action('admin_init', 'wp_your_plugin_admin_init');
// function wp_your_plugin_admin_init(){
// register_setting( 'wp_your_plugin_settings', 'wp_your_plugin_settings', 'wp_your_plugin_settings_validate');
// add_settings_field('wp_your_plugin_user_custom_text', __('Enter your message','wp_your_plugin'), 'wp_your_plugin_user_custom_text', 'wp_your_plugin', 'wp_your_plugin_main');

// function wp_your_plugin_user_custom_text() {
// $options = get_option('wp_your_plugin_settings');
// $settings  = array('media_buttons' => true,'textarea_rows' => 5,'textarea_name' => 'user_custom_text');
// wp_editor( $options['user_custom_text'],'user_custom_text', $settings  );}  

// // validate  
// function wp_your_plugin_settings_validate() {
// $options = get_option('wp_your_plugin_settings');


// if ( empty($_POST['user_custom_text']) ){
//     $options['user_custom_text'] =  __('Enter your own content, it will be below the original message','wp_your_plugin');// as set when the plugin activated
// }else{
//     $options['user_custom_text'] =  wp_kses_post($_POST['user_custom_text']) ;
// }// u need to Sanitize to be able to get the media to work



/*adiciona o menu*/
add_action('admin_menu','settings_menu');

function settings_menu(){
    add_menu_page(
        'Página de configuração',// Título_da_pagina
        'SettingsAPI', //Título_do_menu
        'manage_options', //Permissão
        'settings_api', // slug
        'settings_api_start', // callback
        'dashicons-admin-tools',
        '63'
    );
}


function settings_api_start(){
    require_once('page/admin_form.php');
}

/*  fim add menu  */

add_action('admin_init', 'lorem_add_section');

function lorem_add_section(){
    add_settings_section(
        'section_principal', // identificação unica da seçao - id
        'Configurações de registro', // nome/titulo que será exibido
        'exibe_section_principal', //callback
        'dados_registro' // o nome que as configurações da secção serao gravados no banco utilizando a options api
    );

    // função de cima cria a seção
    // função de baixo registra a seção

    register_setting(
        'dados_registro', //nome que foi registrado acime
        'dados_registro' // nome que será gravado no banco
        // aqui estamos ligando o nome do grupo com o nome que sera gravado no banco, por isso é o mesmo
    );

    //adiciona um campo
    add_settings_field(
        'pipe_name', //id do campo
        'Nome', // label
        'input_pipe_name', // calback
        'dados_registro', // conjunto de configurações que criamos
        'section_principal', // id da seção onde será inserido
        //'argumentos'
    );

    //adiciona um campo
    add_settings_field(
        'pipe_email', //id do campo
        'Email', // label
        'input_pipe_email', // calback
        'dados_registro', // conjunto de configurações que criamos
        'section_principal', // id da seção onde será inserido
        //'argumentos'
    );


    //adiciona um campo
    add_settings_field(
        'pipe_texto', //id do campo
        'Texto', // label
        'input_pipe_texto', // calback
        'dados_registro', // conjunto de configurações que criamos
        'section_principal', // id da seção onde será inserido
        //'argumentos'
    );
}

function exibe_section_principal(){
    echo '<h5>Olá settings</h5>';
}

// calback da function que cria o campo
function input_pipe_name(){

    // a primeira coisa a fazer é pegar as configurações que estão gravadas na options api
    $configuracoes = get_option('dados_registro');

    /* verifica se o input ja foi criado no banco - se existe, exibe, se nao exibe vazio */
    $pipe_name = isset($configuracoes['pipe_name']) ? $configuracoes['pipe_name'] : '';  
    
    echo '<input class="regular-text" name="dados_registro[pipe_name]" value="' . esc_attr($pipe_name) . '" type="text"';
    /*
        sobre o atributo name
            como estamos utilizando, e vamos gravar os dados em forma de array nós precisamos passar o pipe_name dentro de um array de campo
            o array é o do get options, neste caso o dados_registro

    */
}

// calback da function que cria o campo
function input_pipe_email(){

    // a primeira coisa a fazer é pegar as configurações que estão gravadas na options api
    $configuracoes = get_option('dados_registro');

    /* verifica se o input ja foi criado no banco - se existe, exibe, se nao exibe vazio */
    $pipe_email = isset($configuracoes['pipe_email']) ? $configuracoes['pipe_email'] : '';  
    
    echo '<input class="regular-text" name="dados_registro[pipe_email]" value="' . esc_attr($pipe_email) . '" type="text"';
    /*
        sobre o atributo name
            como estamos utilizando, e vamos gravar os dados em forma de array nós precisamos passar o pipe_name dentro de um array de campo
            o array é o do get options, neste caso o dados_registro

    */


} 


function input_pipe_texto(){




    // a primeira coisa a fazer é pegar as configurações que estão gravadas na options api
    $configuracoes = get_option('dados_registro');

    /* verifica se o input ja foi criado no banco - se existe, exibe, se nao exibe vazio */
    $pipe_texto = isset($configuracoes['pipe_texto']) ? $configuracoes['pipe_texto'] : '';  



    $options = get_option('dados_registro');
    $settings  = array('media_buttons' => true);
   // wp_editor( $pipe_texto, 'pipe_texto',  $settings );

    wp_editor( $pipe_texto , 'pipe_texto', array('pipe_texto'=>'pipe_texto') ); 


    //wp_editor( $options['pipe_texto'],'pipe_texto', $settings  );



    
    //echo '<input class="regular-text" name="dados_registro[pipe_texto]" value="' . esc_attr($pipe_texto) . '" type="text"';
    /*
        sobre o atributo name
            como estamos utilizando, e vamos gravar os dados em forma de array nós precisamos passar o pipe_name dentro de um array de campo
            o array é o do get options, neste caso o dados_registro

    */


} 


?>
