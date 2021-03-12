<?php
require_once('functions.php');
session_start();

if(isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = md5($_POST['password']);
    login($user, $pass);
}
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
    <title>Simple Login PHP/JSON</title>
</head>

<body>
    <h1>Simple Login PHP/JSON</h1>
    <?php
    if(!empty($_SESSION['user'])):
    ?>
    <p>
        Logged: <?php echo $_SESSION['user'] ?>
    </p>

    <form action="" method="post">
        <input type="submit" name="logout" value="Logout" />
    </form>

    <?php
    else:
?>
    <form action="" method="post">
        <input type="email" name="user" placeholder="email@test.com" required />
        <input type="password" name="password" placeholder="******" required />
        <input type="submit" name="login" value="Login" />
    </form>
    <p>
        Use for test:
    </p>
    <p>
        <bold>Email:</bold> test@test.com <br />
        <bold>Password:</bold> passtest
    </p>
    <p>
        <bold>Or email:</bold> test2@test.com <br />
        <bold>Password:</bold> passtest
    </p>
    <?php
    endif;
?>
</body>

</html>