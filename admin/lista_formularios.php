<?php
    global $wpdb;
    $query ="SELECT * FROM {$wpdb->prefix}formularios";
    $lista_formularios = $wpdb->get_results($query,ARRAY_A);
    if (empty($lista_formularios)){
        $lista_formularios = array();
    }


?>

<div class="wrap">
    <?php
             echo "<h1 class='wp-heading-inline'>" . get_admin_page_title() . "</h1>";
    ?>
     <a class="page-title-action">Añadir nuevo</a>
     <br><br><br>

     <table class="wp-list-table widefeat fixed striped pages">
        <thead>
            <th>Nombre del formulario</th>
            <th>Shortcode</th>
            <th>Acciones</th>
        </thead>
        <tbody id="the-list">
            <?php 
                foreach ($lista_formularios as $key => $value) {
                 $nombre = $value['Nombre'];
                 $shortcode = $value['Shortcode'];
                    echo "   
                        <tr>
                            <td>$nombre</td>
                            <td>$shortcode</td>
                            <td>
                                <a class='page-title-action'>Datos</a>
                                <a class='page-title-action'>Borrar</a>
                            </td>
                        </tr>
                        ";
                        
                    }

            ?>
        </tbody>
    </table>

</div>


