<?php

    session_start();
    include('functions.php');
    
    $date = $_POST['date'] ?? null;
    
    $auth = $_SESSION['auth'] ?? null;
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body> 
<div class="welcome">Добро пожаловать, <?php echo getCurrentUser(); ?></div>
<div> Ваш день рождения <?php echo $date; 

$secsTillBirthDay = strtotime($date) - time();

        if ($auth && date("md", time()) - date("md", strtotime($date)) !== 0) {
         echo '</br>До вашего дня рождения <strong>[' . date("d.m.", strtotime($date)) . ']</strong> осталось: ' . timeToSale($date, 0);
        } 
        elseif ($auth && date("md", time()) === date("md", strtotime($date))) {
            $deadline = $_SESSION['firstTime'] + 24 * 3600;
            $secs = $deadline - time();
            $h = (int)($secs / 3600) % 24;
            $m = (int)($secs / 60) % 60;
            $s = $secs % 60;

            echo '<p>До истечения персональной скидки осталось: <strong>' . $h . '</strong> часов, <strong>' . $m . '</strong> минут, <strong>' . $s . '</strong> секунд.</p>';
        }
        if ($auth && $_SESSION['currentUser'] === 'Admin') {
            $discount = 30;
        } elseif ($auth && $_SESSION['currentUser'] !== 'Admin') {
            $discount = 20;
        } echo '<h3> Персональная скидка на все услуги в день рождения ' . $discount . ' процентов</h3>';

        ?>
        <div class="welcome"><a href="index.php">На главную</a></div>
    </body>
</html>
