<?php
require "dp.php";
$data = $_POST;

if(isset($data['do_login'])) {
    $errors = array();
    if (trim($data['login']) == '') {
        $errors[] = 'Введите логин!';
    }

    if (($data['password_1']) == '') {
        $errors[] = 'Введите пароль!';
    }
    $user = R::findOne('users', 'login = ?', array($data['login']) );
        if ($user) {

            if(password_verify($data['password_1'], $user->password_1)) {

                $_SESSION['logged_user'] = $user;

                echo '<div style="color: green;">Вы авторизовались!<br/> Переход на <a href="/authorithation/index.php"главную</a> страницу!</div><hr>';


            } else
                {

                $errors[] = 'Пароль введён не верно.';

            }

        } else

        {
            $errors[] = 'Пользователь с таким логином не найден.';
        }
}

if( ! empty($errors)) {

    echo '<div style="color:red;">'.array_shift($errors).'</div>';
}

?>



<form action="login.php" method="POST">
    <p>
    <p><strong>Ваш логин:</strong></p>
    <input type="text" name="login" value="<?php echo @$data['login']; ?>">
    </p>

    <p>
    <p><strong>Ваш пароль:</strong></p>
    <input type="password" name="password_1" value="<?php echo @$data['password_1']; ?>">
    </p>

    <p>
        <button type="submit" name="do_login">Войти</button>
    </p>

</form>


