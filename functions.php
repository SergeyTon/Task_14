<?php
    session_start();

    /* возвращает массив всех пользователей и хэшей их паролей*/
    function getUserList(){
        $users = json_decode(file_get_contents('users.json'), true);

        return $users;
    };    

    /* проверяет, существует ли пользователь с указанным логином;*/
    function existsUser($login){

        $loginExists = false;
        $users = getUserList();

        foreach($users as $user)
        {
            if($user['login'] === $login){
                $loginExists = true;
                break;
            }
        }

        return $loginExists;
    };    

    /* возвращает true тогда, когда существует пользователь с указанным логином и введенный им пароль прошел проверку, иначе — false; */
    function checkPassword($login, $password){
        $_SESSION['currentUser'] = null;
        $_SESSION['auth'] = false;
        $users = getUserList(); // get userslist;

        foreach($users as $user)
        {
            if($user['login'] === $login && $user['password'] === sha1($password)){
                $_SESSION['currentUser'] = $user['name']; // save User Name
                $_SESSION['auth'] = true;        // authenticated
                $_SESSION['firstTime'] = time(); // set session start time
                $auth=true;
                break;
            }
        }

        return $_SESSION['auth'];
    };    

    /* возвращает либо имя вошедшего на сайт пользователя, либо null. */
    function getCurrentUser(){
        return $_SESSION['currentUser'];
    };
    /* считаем дни до скидки */
           function timeToSale($date, $opt = 0) {
            $delta = date("md", time()) - date("md", strtotime($date));
            $m = abs(intdiv($delta, 100));
            $d = abs($delta%100);
            if($opt === 0){
                return "$m месяцев $d дней ";
            }else{
                return "$d дней ";
            }
    
         };
?>