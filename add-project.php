<?php
    require_once("function.php");
    require_once("init.php");
    require_once("helpers.php");
    $errors = [];
    $cats_ids = array_column($categories, 'id');
    $lot = $_POST;
    $user_id = 1;
    $rules = [
    'name' => function() {
        return validateFilled('title');
    }
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($lot as $key => $value) {
       if (isset($rules[$key])) {
           $rule = $rules[$key];
           $errors[$key] = $rule($value);
       }
    }
    }

    if (empty($errors)){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $sql = 'INSERT INTO projects (date_creation, name, author_id, invited_users_id) VALUES (NOW(), 1, ?, NOW)';
      $stmt = db_get_prepare_stmt($link, $sql, $lot);
      $res = mysqli_stmt_execute($stmt);
      if ($res) {
        $lot_id = mysqli_insert_id($link);
        header("Location: day.php/user?=" . $user_id);
      }
    }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Watch Me</title>
	</head>
	<body>
         <div class="main-grid">
            <div class="menu-container">
                <div class="my-account">
                    <div class="my-account-element">Илья</div>
                    <div class="my-account-element up"><a><img src="svg/exit.svg"></a></div>
                    <div></div>
                    <div class="my-account-element up"><img src="svg/settings.svg"></div>
                </div>
                <hr class="menu-">
                <h3 class="pointer"><a href="index.html">Цели на год</a></h3>
                <h3 class="pointer"><a href="month.html">План на месяц</a></h3>
                <h3 class="pointer"><a href="day.html">Задачи на день</a></h3>
                <h3 class="pointer"><a href="day.html">Учеба</a></h3>
                <h3 class="pointer"><a href="day.html">Тестовый проект</a></h3>
                <hr>
                <div class="menu-button">
                     <div>Создать проект</div>
                     <div><img class="width20 up" src="svg/plus.svg"></div>
                </div>
                <form method="post" action="add-project.php">
                    <input class="add-button" type="text" id="name" name="name" placeholder="Введите название проекта" autofocus>
                    <?php if(isset($errors){
                      print('<span style="color: red;">Введите название проекта</span>');
                    })
                    ?>
                    <br>
                    <input class="submit-button" type="submit" value="Создать">
                 </form>
             </div>
             <div>
             </div>
        </div>
    </body>
</html>
