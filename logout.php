<?php

include ("functions.php");  
//После нажатия на ссылку Выход уничтожаем все данные сессии

if ( null !== getCurrentUser() ) {  //Если пользователь авторизован, то уничтожаем все данные сессии
    session_destroy();
}

header('Location: /index.php');
?>