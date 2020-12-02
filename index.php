<?php
require_once("init.php");
if (isset($_SESSION['username'])) {
  print($_SESSION['username']);
}

$_SESSION['username'] = "Админ";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if($_POST['login'] !== "Admin" && "Ilya" and $_POST['password'] !== "01-02-03"){
    $access = false;
  }else {
    $access = true;
  }
  if($access === true){
    header("Location: main.php");
  }
  else{
    $error = '<span style="color:red;">' . "Ошибка авторизации администратора: неправильный пароль" . '</span>';
  }
}
 /*  $projects = [
  [
    'image' => "background: url(osel.png) no-repeat;",
    'title' => 'Осел'
  ],
  [
    'image' => "background: url(osel.png) no-repeat;",
    'title' => 'Очень'
  ],
  [
    'image' => "background: url(osel.png) no-repeat;",
    'title' => 'Крутой'
  ],
  [
    'image' => "background: url(osel.png) no-repeat;",
    'title' => 'Что еще написать'
  ]
];
  $titles = ['hello', 'it is', 'me'];
  require_once("pages/init.php");
  $image_url = "background: url(osel.png) no-repeat;";
  */
 ?>
 <!DOCTYPE html>
 <html>
 	<head>
 		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
         <link href="style.css" rel="stylesheet">
         <title>Админ-вход</title>
 	</head>
 	<body>
          <h1>Вход для администратора:</h1>
          <form method="post" action="index.php">
                <input name="login" type="text" placeholder="Логин Администратора">
                <input name="password" type="password" placeholder="Пароль Администратора">
                <input type="submit">
          </form>
          <?php if(isset($error)){
            print($error);
          } ?>
  </body>
 </html>
