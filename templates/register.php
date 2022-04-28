<?php

use FormacionAPP\BaseQuery;

?>
<div class="contenido-ppal">

    <?php
    if ( isset( $_POST['register'] ) ) {
        $name          = $_POST['name'];
        $email         = $_POST['email'];
        $password      = $_POST['password'];
        $password_hash = password_hash( $password, PASSWORD_BCRYPT );
        $base_query    = new BaseQuery();

        $query = $base_query->conn->prepare( "SELECT * FROM users WHERE EMAIL=:email" );
        $query->bindParam( "email", $email, PDO::PARAM_STR );
        $query->execute();

        if ( $query->rowCount() > 0 ) {
            echo '<p class="error">Este email ya ha sido registrado</p>';
        }

        if ( $query->rowCount() == 0 ) {
            $query = $base_query->conn->prepare( "INSERT INTO users(NAME,PASSWORD,EMAIL) VALUES (:name,:password_hash,:email)" );
            $query->bindParam( "name", $name, PDO::PARAM_STR );
            $query->bindParam( "password_hash", $password_hash, PDO::PARAM_STR );
            $query->bindParam( "email", $email, PDO::PARAM_STR );
            $result = $query->execute();

            if ( $result ) {
                echo '<p class="success">Registrado correctamente.</p>';
            } else {
                echo '<p class="error">¡Ups! Algo ha ido mal.</p>';
            }
        }
    }

    ?>


    <form method="post" action="/register" name="signup-form">
        <div class="form-element">
            <label>Nombre</label><br>
            <input type="text" name="name" " required/>
        </div>
        <br><br>
        <div class="form-element">
            <label>Email</label><br>
            <input type="email" name="email" required/>
        </div>
        <br><br>
        <div class="form-element">
            <label>Password</label><br>
            <input type="password" name="password" required/>
        </div>
        <br><br>
        <button type="submit" name="register" value="register">Registro</button>
    </form>
</div>
