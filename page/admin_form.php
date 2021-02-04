<form method="post" action="options.php">
    <!-- <h1>Configurações do plugin</h1> -->

    <?php //wp_nonce_field('Dp', 'campo_nonce'); ?>
    <!-- 
        Primeiro parametro é o nome da página - pegar na url, ou no slug que definimos qd setamos os dados do menu
        o segundo é o nome do campo
     -->
     
    <table class="form-table">
        <?php do_settings_sections('dados_registro'); ?>
        <?php settings_fields('dados_registro'); ?>
        <?php submit_button(); ?>
    </table>


</form>