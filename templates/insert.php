<?php
use FormacionAPP\Pieza;
?>

<div class="contenido-ppal">
    <h2>INSERTAR PIEZA</h2>
    <form method="post" action="/insert">
        <input type="hidden" name="action" value="insert">
        <label for="codpie">Código de pieza:</label><br>
        <input type="text" name="codpie"><br><br>
        <label for="nompie">Nombre:</label><br>
        <input type="text" name="nompie"> <br><br>
        <label for="color">Color:</label><br>
        <input type="text" name="color"><br><br>
        <label for="peso">Peso:</label><br>
        <input type="number" name="peso"> <br><br>
        <label for="ciudad">Ciudad:</label><br>
        <input type="text" name="ciudad"><br><br>
        <input type="submit" formtarget="_self" value="Insertar">
    </form>

    <?php
    $action = $_REQUEST['action'] ?? '';

    if ( $action == "insert" ) {
        $codpie = $_REQUEST['codpie'] ?? '';
        $nompie = $_REQUEST['nompie'] ?? '';
        $color  = $_REQUEST['color'] ?? '';
        $peso   = floatval( $_REQUEST['peso'] ?? '' );
        $ciudad = $_REQUEST['ciudad'] ?? '';

        $message = ( new Pieza() )->insert( $codpie, $nompie, $color, $peso, $ciudad );

        echo $message ?? '';
    }
    ?>
</div>



