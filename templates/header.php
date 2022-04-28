<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piezas</title>
    <link rel="stylesheet" href="/templates/stylesheet.css?id=<?=rand(0, 1000)?>">
</head>
<body>
<div class="cabecera"><h1>EL MARAVILLOSO MUNDO DE LAS PIEZAS</h1></div>
<div class="barra-sup">
    <table>
        <?php if ( isset( $_SESSION['user_id'] ) ) { ?>
            <th>Bienvenido, <?php echo $_SESSION['name']; ?></th>
            <th><a href="/logout">Log out</a></th>
        <?php } else { ?>
            <th><a href="/register">Registro</a></th>
            <th><a href="/login">Login</a></th>
        <?php } ?>
    </table>
</div>
<div class="barra-nav">
    <a href="/">Inicio</a>
    <a href="/search">Buscar</a>
    <a href="/insert">Insertar</a>
    <a href="/update">Actualizar</a>
    <a href="/delete">Borrar</a>
</div>