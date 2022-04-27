<?php

use FormacionAPP\Pieza;

$field_select = $_REQUEST['field_select'] ?? 'codpie';
?>

<div class="contenido-ppal">
    <h2>CONSULTAR PIEZAS</h2>
    <br>
    <form method="post" action="/search">
        <input type="hidden" name="action" value="search">
        <label for="field_select">Buscar por:</label>
        <select name="field_select">
            <option value="codpie" <?= ( "codpie" == $field_select ) ? 'selected' : '' ?>>Código</option>
            <option value="nompie" <?= ( "nompie" == $field_select ) ? 'selected' : '' ?>>Nombre de pieza</option>
            <option value="color" <?= ( "color" == $field_select ) ? 'selected' : '' ?>>Color</option>
            <option value="ciudad" <?= ( "ciudad" == $field_select ) ? 'selected' : '' ?>>Ciudad</option>
        </select>
        <input type="text" name="search" value="<?= $_REQUEST['search'] ?? '' ?>"><br><br>
        <input type="submit" formtarget="_self" value="Consultar">
    </form>
    <?php

    $message = $_REQUEST['message'] ?? '';

    if ( ! empty( $message ) ) {
        echo $message;
    }

    $action = $_REQUEST['action'] ?? '';

    if ( $action == "search" ) {
        $search  = $_REQUEST['search'] ?? '';
        $results = ( new Pieza() )->search( $search, $field_select ); ?>


        <?php if ( ! empty( $results ) ) : ?>
            <h3>Resultados de búsqueda</h3>
            <table>
                <thead style="background: rgba(128, 255, 0, 0.3); border: 1px solid rgba(100, 200, 0, 0.3);">
                <tr>
                    <?php foreach ( array_keys( $results[0] ) as $columnName ) : ?>
                        <th>
                            <?php echo $columnName; ?>
                        </th>
                    <?php endforeach; ?>
                    <th colspan="2">acciones</th>
                </tr>
                </thead>
                <tbody style="background: rgba(255, 128, 0, 0.3); border: 1px solid rgba(200, 100, 0, 0.3);">
                <?php foreach ( $results as $numFila => $row ) : ?>
                    <tr>
                        <?php foreach ( $row as $columnName => $columnValue ) : ?>
                            <td>
                                <?php echo $columnValue; ?>
                            </td>
                        <?php endforeach; ?>
                        <td style="background: rgba(128, 255, 0, 0.3); border: 1px solid rgba(100, 200, 0, 0.3)">
                            <a href="/update?codpie=<?php echo $row['codpie'] ?>&nompie=<?= $row['nompie'] ?>&color=<?= $row['color'] ?>&peso=<?= $row['peso'] ?>&ciudad=<?= $row['ciudad'] ?>">Editar</a>
                        </td>
                        <td style="background: rgba(128, 245, 0, 0.3); border: 1px solid rgba(100, 200, 0, 0.3)">
                            <a href="/delete?codpie=<?= $row['codpie'] ?>&action=delete&field_select=<?= $field_select ?>&search=<?= $search ?>">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <br>

        <?php else: ?>
            <p>No se han encontrado resultados</p>
        <?php endif;
    }
    ?>

</div>











