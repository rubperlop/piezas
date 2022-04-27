<?php
use FormacionAPP\Pieza;
?>

<div class="contenido-ppal">

    <h2>ACTUALIZAR DATOS</h2>
    <form method="post" action="/update">
        <input type="hidden" name="action" value="update">
        <label for="table_name">Código de pieza:</label><br>
        <input type="text" name="codpie" value="<?= $_REQUEST['codpie'] ?? ''?>"><br><br>
        <label for="column_name">Nombre:</label><br>
        <input type="text" name="nompie" value="<?= $_REQUEST['nompie'] ?? ''?>"><br><br>
        <label for="value">Peso:</label><br>
        <input type="number" name="peso" value="<?= $_REQUEST['peso'] ?? ''?>"><br><br>
        <label for="value">Color:</label><br>
        <input type="text" name="color" value="<?= $_REQUEST['color'] ?? ''?>"><br><br>
        <label for="value">Ciudad:</label><br>
        <input type="text" name="ciudad" value="<?= $_REQUEST['ciudad'] ?? ''?>"><br><br>
        <input type="submit" formtarget="_self" value="Actualizar">
    </form>

    <?php

    $action = $_REQUEST['action'] ?? '';

    if ( $action == "update" ) {

        $codpie = $_REQUEST['codpie'] ?? '';
        $nompie = $_REQUEST['nompie'] ?? '';
        $peso   = floatval( $_REQUEST['peso'] ?? 1 );
        $color  = $_REQUEST['color'] ?? '';
        $ciudad = $_REQUEST['ciudad'] ?? '';

        if ( ! empty( $codpie ) ) {
            $message = ( new Pieza() )->update( $codpie, $nompie, $peso, $color, $ciudad );

            echo $message ?? '';
        }
    }
    ?>
</div>








