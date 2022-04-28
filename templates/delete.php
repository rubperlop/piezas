<?php
use FormacionAPP\Pieza;
?>

<div class="contenido-ppal">

    <h2>BORRAR PIEZA</h2>
    <form method="post" action="/delete">
        <input type="hidden" name="action" value="delete">
        <label for="codpie">Código de pieza:</label><br>
        <input type="text" name="codpie"><br><br>
        <input type="submit" formtarget="_self" value="Borrar">
    </form>

</div>

<?php

$action = $_REQUEST['action'] ?? '';

delete( $action );

/**
 * @param string $action
 * Delete a piece when it receives a 'codpie'
 * @return void
 */
function delete( string $action ): void {
    if ( $action == "delete" ) {

        $codpie = $_REQUEST['codpie'] ?? '';

        $message = ( new Pieza() )->delete( $codpie );
        $search  = $_REQUEST['search'] ?? '';

        if ( empty( $search ) ) {
            echo $message ?? 'Ha habido algún error';
        } else {
            header( 'Location: ?page=search&field_select=' . $_REQUEST['field_select'] . '&search=' . $_REQUEST['search'] . '&action=search&message=' . $message );
        }
    }
}

?>


