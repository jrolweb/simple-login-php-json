<?php

function login($user, $pass) {
    $db = file_get_contents('db.json');
    $db = json_decode($db, true);
    $message_code = array(
        '0' => 'Disconnected',
        '1' => 'Logged',
        '2' => 'Email not found',
        '3' => 'Incorrect password'
    );
    $status = '0';

    foreach ($db as $item) {
        if($user == $item['email']){
            if($pass == $item['password']){
                if (!session_id()) {
                    session_start();
                }
                $_SESSION['user'] = $user;
                header("Refresh:0");
                $status = '1';
            }else{
                $status = '3';
            }
            break;
        }else{
            $status = '2';
        }
    }

    echo $message_code[$status];
}