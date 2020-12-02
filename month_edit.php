<?php
  require_once("functions.php");
  $connection = mysqli_connect("localhost", "root", "", "TASKER");
  if ($connection == false) {
    print("Ошибка подключения!");
  }
  $errors = [];
  $sql_tasks = "SELECT tasks.content as content, tasks.category_id, tasks.id as id_key, categories.id FROM tasks JOIN categories ON categories.id = tasks.category_id WHERE categories.id = 2 ORDER BY date_creation DESC";
  $result_task = mysqli_query($connection, $sql_tasks);
  if (!$result_task) {
    print("Ошибка формирования массива!");
  }
  $year_tasks = mysqli_fetch_all($result_task, MYSQLI_ASSOC);
  $task = $_POST;
	$rules = [
	'content' => function(){
			return validateFilled('content');
	}
];

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		foreach ($task as $key => $value) {
				 if (isset($rules[$key])) {
						 $rule = $rules[$key];
             $not_yet_errors = [];
             $not_yet_errors[$key] = $rule($value);
             if($not_yet_errors[$key] !== null){
						 $errors[$key] = $rule($value);
           }
				 }
		 }
		}

	if (empty($errors)){
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $new_year_task = [$_POST['content']];
      print($new_year_task);
      $safe_id = mysqli_real_escape_string($connection, $year_tasks['id_key']);
      $safe_content = mysqli_real_escape_string($connection, $_POST['content']);
			$sql = "UPDATE `tasks` SET content = 'Hello, Dolly!)' WHERE id = 21;";
      mysqli_prepare($connection, $sql);
      if(empty($_POST['content'])){
      print("ijdeow");
      }
      header("Location: month_edit.php");
			if ($res) {
				$lot_id = mysqli_insert_id($connection);
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
        <title>Планы на месяц</title>
	</head>
	<body>
        <div class="hamburger-menu">
            <input id="menu__toggle" type="checkbox" />
            <label class="menu__btn" for="menu__toggle">
              <span></span>
            </label>
            <ul class="menu__box">
              <li><a class="menu__item" href="index.php">Планы на год</a></li>
              <li><a class="menu__item" href="page.php">Планы на месяц</a></li>
              <li><a class="menu__item" href="hhtp:">Планы на неделю</a></li>
              <li><a class="menu__item" href="community.php">Планы на день</a></li>
              <li><a class="menu__item" href="hhtp:">Настройки и поддержка </a></li>
            </ul>
         </div>

          <h1 class="text">Планы на месяц:</h1>
         <h2>Цели</h2>
        <hr>
        <form method="post" action="month_edit.php">
         <ul class="flex-container">
					 <?php if(empty($year_tasks)){
						 print('<h2 style="color: grey; text-align: center;">Задач на месяц нет!</h2>');
					 } ?>
  					 <?php foreach($year_tasks as $simple): ?>
               <li class="flex-item"><input name="content" value="<?= $simple['content'];?>"></li>
  					<?php endforeach; ?>
          </ul>
          <input type="submit" class="button7" value="Завершить редактирование">
          </form>
        <hr>
        <div class="align-grid">
            <div class="grid">
                    <div class="grid-item">
                        1
                        <button href="year.php" >
                    </div>
                    <div class="grid-item active-day">
                        2
                        <input type="checkbox" name="c2" id="c2" />
                        <label for="c2"></label>
                    </div>
                    <div class="grid-item">
                        3
                        <input type="checkbox" name="c3" id="c3" />
                        <label for="c3"></label>
                   </div>
                    <div class="grid-item">
                        4
                        <input type="checkbox" name="c4" id="c4" />
                        <label for="c4"></label>
                </div>
                    <div class="grid-item">
                        5
                        <input type="checkbox" name="c5" id="c5" />
                        <label for="c5"></label>
                </div>
                    <div class="grid-item">
                        6
                        <input type="checkbox" name="c6" id="c6" />
                        <label for="c"></label>
                    </div>
                    <div class="grid-item">
                        7
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        8
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        9
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        10
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        11
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        12
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        13
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        14
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        15
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        16
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        17
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        18
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        19
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        20
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        21
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        22
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        23
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        24
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        25
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        26
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        27
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        28
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        29
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        30
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        31
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
            </div>
        </div>
    </body>
</html>
