<?php
require "dp.php";
$data = $_POST;
if(isset($data['do_signup']))
{
    $errors=array();
    if (trim($data['login']) == '') {
        $errors[] = 'Введите логин!';
    }

    if (trim($data['email']) == '') {
        $errors[] = 'Введите email!';
    }

    if (($data['password_1']) == '') {
        $errors[] = 'Введите пароль!';
    }

    if (($data['password_2']) != $data['password_1']) {
        if (($data['password_2']) == ''){
        $errors[] = 'Введите повторный пароль!';
            }
        else {

        $errors[] = 'Повторный пароль введён не верно!';
             }
    }

    if (R::count('users', "login = ?",  array($data['login']))>0){
        $errors[] = 'Пользователь с таким логином уже существует.';

    }

    if (R::count('users', "email = ?",  array($data['email']))>0){
        $errors[] = 'Пользователь с таким email уже существует.';

    }

    if(empty($errors)) {

        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email= $data['email'];
        $user->password_1 = password_hash($data['password_1'], PASSWORD_DEFAULT);
        R::store($user);
        $_SESSION['logged_user'] = $user;
        header('Location: /authorithation/index.php');
        echo '<div style="color: green;">Вы зарегистрировались!</div><hr>';





    } else {
        echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }


}

?>

<form action="signup.php" method="POST">
    <p>
    <p><strong>Ваш логин:</strong></p>
    <input type="text" name="login" value="<?php echo @$data['login']; ?>">
    </p>

    <p>
    <p><strong>Ваш email:</strong></p>
    <input type="email" name="email" value="<?php echo @$data['email']; ?>">
    </p>

    <p>
    <p><strong>Ваш пароль:</strong></p>
    <input type="password" name="password_1" value="<?php echo @$data['password_1']; ?>">
    </p>

    <p>
    <p><strong>Введите ваш пароль ещё раз:</strong></p>
    <input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
    </p>

    <p>
        <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>
</form>
