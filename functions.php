<?php
$message_code = array(
    '0'     => 'None',
    '1'     => 'Logged',
    '2'     => 'Email not found',
    '3'     => 'Incorrect password',
    '4'     => 'This email is being used by a user',
    '5'     => 'User successfully registered',
    '6'     => 'You cannot delete your own user',
    '7'     => 'User deleted',
    '8'     => 'You are not allowed to create users',
    '9'     => 'You are not allowed to delete users',
    '10'    => 'You are not allowed to edit users',
    '11'    => 'Password changed',
    '12'    => 'User type changed',
    '13'    => 'User type and password changed',
    '14'    => 'Nothing changed',
    '15'    => 'Enter a different password than the current password',
    '16'    => 'Enter a different password than the current password. Only the user type has been changed'
);

function login($user, $pass) {
    global $message_code;
    $db = file_get_contents('db.json');
    $db = json_decode($db, true);
    $status = '0';
    foreach ($db as $item) {
        if($user == $item['email']){
            if($pass == $item['password']){
                if (!session_id()) {
                    session_start();
                }
                $_SESSION['user'] = $user;
                $_SESSION['type_user'] = $item['type'];
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
    return $message_code[$status];
}

function get_users(){
    $db = file_get_contents('db.json');
    $db = json_decode($db, true);
    $html = '<ul class="user-list">';
    foreach ($db as $item) {
        $html.= '<li>
                    <a href="user-edit.php?user='.$item['email'].'">Edit</a> | 
                    <a href="user-exclude.php?user='.$item['email'].'">Exclude</a> | 
                        Type: '.$item['type'].' | 
                    User: '.$item['email'].
                '</li>';
    }
    $html.= '</ul>';
    return $html;
}

function get_user($user){
    global $message_code;
    $db = file_get_contents('db.json');
    $db = json_decode($db, true);
    $user_data = false;

    foreach ($db as $item) {
        if($user == $item['email']){
            $user_data = array(
                "email"     => $item['email'],
                "password"  => $item['password'],
                "type"      => $item['type']
            );
        }
    }

    if(!$user_data){
        $return = $message_code['2'];
    }else{
        $return =  $user_data;
    }

    return $return;
}

function user_create($user, $pass, $type) {
    global $message_code;
    $db = file_get_contents('db.json');
    $db = json_decode($db, true);
    $status = '0';

    foreach ($db as $item){
        if($item['email'] == $user){
            $status = '4';
        }
    }
    
    if(!$status == '4'){
        $db[] = array(
            "email"     => $user,
            "password"  => $pass,
            "type"      => $type
        );
        $db = json_encode($db);
        file_put_contents('db.json', $db);
        $status = '5';
    }
    return $message_code[$status];
}

function user_exclude($user_exclude) {
    global $message_code;
    $db = file_get_contents('db.json');
    $db = json_decode($db, true);
    $data = array();

    foreach ($db as $item){
        if($item['email'] != $user_exclude){
            $data[] = array(
                "email"     => $item['email'],
                "password"  => $item['password'],
                "type"      => $item['type']
            );
        }
    }

    $data = json_encode($data);
    file_put_contents('db.json', $data);
    $status = '7';
    
    return $message_code[$status];
}

function user_edit($user, $pass, $type){
    global $message_code;
    $db = file_get_contents('db.json');
    $db = json_decode($db, true);
    $status = '0';

    $user_data = get_user($user);

    if($_SESSION['user'] == $user_data['email']){
        if($pass){
            if($pass == $user_data['password']) {
                $status = '15';
            }else {
                foreach ($db as $item => $sub){
                    if($sub['email'] == $user_data['email']){
                        $db[$item]['password'] = $pass;
                        $db = json_encode($db);
                        file_put_contents('db.json', $db);
                        $status = '11';
                    }
                }
            }
        }else{
            $status = '14';
        }
    }elseif($_SESSION['type_user'] == 'adm'){
        $pass_equal = false;
        
        if($type != $user_data['type']){
            $edit_type = true;
        }else{
            $edit_type = false;
        }
        if($pass){
            if($pass != $user_data['password']){
                $edit_pass = true;
            }else{
                $edit_pass = false;
                $pass_equal = true;
            }
        }else{
            $edit_pass = false;
        }
        
        if($edit_type && $edit_pass){
            foreach ($db as $item => $sub){
                if($sub['email'] == $user_data['email']){
                    $db[$item]['password'] = $pass;
                    $db[$item]['type'] = $type;
                    $db = json_encode($db);
                    file_put_contents('db.json', $db);
                    $status = '13';
                }
            }
        }elseif($edit_type && !$edit_pass){
            foreach ($db as $item => $sub){
                if($sub['email'] == $user_data['email']){
                    $db[$item]['type'] = $type;
                    $db = json_encode($db);
                    file_put_contents('db.json', $db);
                    if($pass_equal){
                        $status = '16';
                    }else{
                        $status = '12';
                    }
                }
            }
        }elseif(!$edit_type && $edit_pass){
            foreach ($db as $item => $sub){
                if($sub['email'] == $user_data['email']){
                    $db[$item]['password'] = $pass;
                    $db = json_encode($db);
                    file_put_contents('db.json', $db);
                    $status = '11';
                }
            }
        }elseif(!$edit_type && !$edit_pass){
            if($pass_equal){
                $status = '15';
            }else{
                $status = '14';
            }
        }
    }else{
        $status = '10';
    }

    return $message_code[$status];
}