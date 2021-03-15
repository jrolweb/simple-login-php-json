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

            <h2>Introdução</h2>
            <p>Simples sistema de login e gerenciamento de usuários usando PHP e JSON criado para estudo e utilização em
                pequenos projetos. O sistema conta com dois tipos de usuários para diferentes níveis de acesso a áreas
                restritas.</p>

            <h2>Tipos de Usuário</h2>
            <ul>
                <li>adm</li>
                <li>user</li>
            </ul>
            <h3>adm</h3>
            <p>Usuário com permisão para cadastro, edição e exclusão de outros usuários.
            <p>

            <h3>user</h3>
            <p>Usuário com permisões básicas de acesso.</p>

            <h2>Gerenciamento de Usuários</h2>
            <ul>
                <li>Cadastro de novos usuários</li>
                <li>Edição de usuários (senha e tipo de usuário)</li>
                <li>Exclusão de usuários</li>
            </ul>
            <h2>Dados</h2>
            <p>Este projeto não utiliza banco de dados, em vez disso, todos os dados dos usuários ficam armazenados no
                arquivo <strong>db.json</strong>.</p>

            <h2>Segurança</h2>
            <p>As senhas dos usuários cadastrados são criptografadas com <strong>MD5</strong>. O acesso direto ao
                arquivo <strong>db.json</strong> através do navegador é bloqueado pelo arquivo
                <strong>.htaccess</strong>.
            <p>

            <h2>Instruções</h2>
            <p>Não precisa de instalação de pacotes, basta baixar e usar em seu projeto.</p>
            <p>Para o primeiro acesso utilize:</p>
            <ul>
                <li>Usuário: test@test.com</li>
                <li>Senha: passtest</li>
            </ul>

            <h2>Licença</h2>
            <ul>
                <li>MIT</li>
            </ul>
        </div>

        <p>Este script é gratuito e foi criado por <a href="https://oliveiraweb.com.br" target="_blank">Oliveira Web</a>
        </p>
    </div>

</body>

</html>