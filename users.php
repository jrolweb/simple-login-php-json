<?php
require_once('functions.php');
session_start();

if(isset($_POST['logout'])) {
    session_destroy();
    header("Refresh:0");
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

        <h2>Users</h2>

        <?php 
            echo get_users();
        ?>

        <a href="user-create.php">New User</a>
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