<?php
require_once('functions.php');
session_start();
$return = false;
global $message_code;

$user_edit = $_GET['user'];


if(isset($_POST['logout'])) {
    session_destroy();
    header("Refresh:0");
}

if(isset($_POST['edit'])) {
    if(empty($_POST['password'])){
        $pass = false;
    }else{
        $pass = md5($_POST['password']);
    }
    $type = isset($_POST['type']) ? $_POST['type'] : $_SESSION['type_user'];
    $return = user_edit($user_edit, $pass, $type);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simples sistema de login com PHP e JSON">
    <link href="style.css" type="text/css" rel="stylesheet" />
    <title>Simple Login PHP/JSON</title>
</head>

<body>
    <div id="page">
        <h1>Simple Login PHP/JSON</h1>
        <?php
        if(!empty($_SESSION['user'])):
    ?>
        <p>
            Logged: <?php echo $_SESSION['user'] ?> <br />
            Type user: <?php echo $_SESSION['type_user'] ?>
        </p>

        <h2>Edit User</h2>
        <?php 
            if($_SESSION['user'] == $user_edit):
        ?>
        <form action="" method="post">
            <input type="email" name="user_edit" value="<?php echo $_SESSION['user'] ?>" disabled />
            <input type="password" name="password" placeholder="New password" />
            <select name="type" disabled>
                <option value="<?php echo $_SESSION['type_user'] ?>" selected><?php echo $_SESSION['type_user'] ?>
                </option>
                <option value="adm">Adm</option>
                <option value="user">User</option>
            </select>
            <input type="submit" name="edit" value="Save" />
        </form>
        <?php 
                if($return){
                    echo '<p>'.$return.'</p>';
                };

            elseif($_SESSION['type_user'] == 'adm'):
                $user_edit_data = get_user($user_edit);
        ?>
        <form action="" method="post">
            <input type="email" name="user_edit" value="<?php echo $user_edit ?>" disabled />
            <input type="password" name="password" placeholder="New password" />
            <select name="type">
                <option value="<?php echo $user_edit_data['type']; ?>" selected ><?php echo $user_edit_data['type']; ?>
                </option>
                <option value="adm">adm</option>
                <option value="user">user</option>
            </select>
            <input type="submit" name="edit" value="Save" />
        </form>
        <?php 
                if($return){
                    echo '<p>'.$return.'</p>';
                };

            else:
                echo '<p>'.$message_code['10'].'</p>';
            endif;
        ?>

        <a href="users.php">Users</a>
        <a href="index.php">Home</a>

        <form action="" method="post">
            <input type="submit" name="logout" value="Logout" />
        </form>
        <?php
        else:
            header("location: index.php");
        endif;
    ?>
        <div class="readme">
            <h1>README.md</h1>
            <h1>Simple Login PHP/JSON</h1>
            <p>PT-BR</p>

            <h2>Introdu????o</h2>
            <p>Simples sistema de login e gerenciamento de usu??rios usando PHP e JSON criado para estudo e utiliza????o em
                pequenos projetos. O sistema conta com dois tipos de usu??rios para diferentes n??veis de acesso a ??reas
                restritas.</p>

            <h2>Tipos de Usu??rio</h2>
            <ul>
                <li>adm</li>
                <li>user</li>
            </ul>
            <h3>adm</h3>
            <p>Usu??rio com permis??o para cadastro, edi????o e exclus??o de outros usu??rios.
            <p>

            <h3>user</h3>
            <p>Usu??rio com permis??es b??sicas de acesso.</p>

            <h2>Gerenciamento de Usu??rios</h2>
            <ul>
                <li>Cadastro de novos usu??rios</li>
                <li>Edi????o de usu??rios (senha e tipo de usu??rio)</li>
                <li>Exclus??o de usu??rios</li>
            </ul>
            <h2>Dados</h2>
            <p>Este projeto n??o utiliza banco de dados, em vez disso, todos os dados dos usu??rios ficam armazenados no
                arquivo <strong>db.json</strong>.</p>

            <h2>Seguran??a</h2>
            <p>As senhas dos usu??rios cadastrados s??o criptografadas com <strong>MD5</strong>. O acesso direto ao
                arquivo <strong>db.json</strong> atrav??s do navegador ?? bloqueado pelo arquivo
                <strong>.htaccess</strong>.
            <p>

            <h2>Instru????es</h2>
            <p>N??o precisa de instala????o de pacotes, basta baixar e usar em seu projeto.</p>
            <p>Para o primeiro acesso utilize:</p>
            <ul>
                <li>Usu??rio: test@test.com</li>
                <li>Senha: passtest</li>
            </ul>

            <h2>Licen??a</h2>
            <ul>
                <li>MIT</li>
            </ul>
        </div>

        <p>Este script ?? gratuito e foi criado por <a href="https://oliveiraweb.com.br" target="_blank">Oliveira Web</a>
        </p>
    </div>

</body>

</html>