<?php

use FormacionAPP\BaseQuery;

?>

<div class="contenido-ppal">


    <?php
    if ( isset( $_POST['login'] ) ) {
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        $base_query = new BaseQuery();

        $query = $base_query->conn->prepare( "SELECT * FROM users WHERE email=:email" );
        $query->bindParam( "email", $email, PDO::PARAM_STR );
        $query->execute();

        $result = $query->fetch( PDO::FETCH_ASSOC );

        if ( ! $result ) {
            echo '<p class="error">Email o contraseña incorrectos</p>';
        } else {
            if ( password_verify( $password, $result['password'] ) ) {
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['name']    = $result['name'];
                echo '<p class="success">Congratulations, you are logged in!</p>';
                header( "Location: app.php" );
            } else {
                echo '<p class="error">Email o contraseña incorrectos</p>';
            }
        }
    }

    ?>

    <form method="post" action="" name="signin-form">
        <div class="form-element">
            <label>email</label><br>
            <input type="email" name="email" required/>
        </div>
        <br><br>
        <div class="form-element">
            <label>Password</label><br>
            <input type="password" name="password" required/>
        </div>
        <br><br>
        <button type="submit" name="login" value="login">Log In</button>
    </form>
</div>