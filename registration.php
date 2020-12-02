<?php
require_once("function.php");
$errors =[];
$rules = [
'email' => function(){
		return validateEmail('email');
},
'password' => function(){
		return isCorrectLength('password');
},
'password-repeat' => function(){
		return validateRepeatPassword('password-repeat');
}
];
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	foreach ($_POST as $key => $value) {
			 if (isset($rules[$key])) {
					 $rule = $rules[$key];
					 $errors[$key] = $rule($value);
			 }
	 }
	}

if (empty($errors)){
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  	$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
	  $new_user = [$_POST['email'], $passwordHash];

		$sql = 'INSERT INTO users `users`(`id`, `register_date`, `email`, `password`, `tarif`, `tarif_add`, `tarif_delect`) VALUES (?, NOW(), ?, ?, 1, NOW(), "2020-12-12")';
		$stmt = db_get_prepare_stmt($link, $sql, $new_user);
		$res = mysqli_stmt_execute($stmt);
		if ($res) {
			$user_id = mysqli_insert_id($link);
			header("Location:year.php");
		}
	}
}
$errors = array_filter($errors);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="style.css" rel="stylesheet">
        <title>Registration</title>
	</head>
	<body>
        <form action="registration.php" method="post">
        <div class="container">
        <h1>Регистрация</h1>
            <p>Пожалуйста, заполните эту форму для регистрации.</p>
            <hr>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Введите ваш Email" name="email" value="<?= htmlspecialchars(getPostVal('email')); ?>">
						<?php if(isset($errors['email'])){
							print('<span style="color:red;">' . $errors['email'] . '</span>');
						}
						?>
						<p></p>
            <label for="password"><b>Пароль</b></label>
            <input type="password" placeholder="Введите Ваш пароль" name="password" value="<?= htmlspecialchars(getPostVal('password')); ?>">
						<?php if(isset($errors['password'])){
							print('<span style="color:red;">' . $errors['password'] . '</span>');
						}
						?>
						<p></p>
            <label for="password-repeat"><b>Повторите пароль</b></label>
            <input type="password" placeholder="Повторите пароль" name="password-repeat" value="<?= htmlspecialchars(getPostVal('password-repeat')); ?>">
						<?php if(isset($errors['password-repeat'])){
							print('<span style="color:red;">' . $errors['password-repeat'] . '</span>');
						}
						?>
						<hr>
            <p>Создавая аккаунт, вы соглашаетесь с условиями пользования и политикой конфиденциальности <a href="#">Пользовательское соглашение </a>.</p>
            <button type="submit" class="registerbtn">Зарегистрироваться </button>
          </div>

          <div class="container signin">
            <p>Уже есть аккаунт<a href="#">Войти</a>.</p>
          </div>
        </form>
    </body>
</html>
