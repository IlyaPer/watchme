<?php
  require_once("functions.php");
  $connection = mysqli_connect("localhost", "root", "", "TASKER");
  if ($connection == false) {
    print("Ошибка подключения!");
  }
  $errors = [];
  $sql_tasks = "SELECT tasks.content as content, tasks.category_id, categories.id FROM tasks JOIN categories ON categories.id = tasks.category_id WHERE categories.id = 1 ORDER BY date_creation DESC";
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
			$sql = 'INSERT INTO `main_tasks`( `date_creation`, `content`, `category_id`, `user_id`) VALUES (NOW(), ?, 1, 1);';

			$stmt = db_get_prepare_stmt($connection, $sql, $new_year_task);
			$res = mysqli_stmt_execute($stmt);
      header("Location: year.php");
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
        <title>Tasker Club</title>
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

          <h1 class="text">Планы на год!:</h1>
         <h2>Цели</h2>
         <input type="checkbox" style="border:2px dotted #00f;display:block;background:#ff0000;" />
        <hr>
         <ul class="flex-container">
           <?php foreach($year_tasks as $page): ?>
            <li class="flex-item"><?= $page['content']; ?></li>
          <?php endforeach; ?>
        </ul>
        <div class="center-task">
            <form method="post">
                <input type="text" placeholder="Добавить цель" name="content">
								<input type="submit" class="button7">
            </form>
        </div>
        <?php if(isset($errors['content'])){
				print('<span style="color: red;">' . $errors['content'] . '</span>');
        }
        ?>
        <div class="block right"><a href="add_target.php" class="button8">Редактировать</a></div>
        <h1 class="text">Цели на месяц</h1>
        <div class="align-grid">
            <div class="grid-year">
                    <div class="grid-item">
                        Декабрь
                        <ul>
                          <li></li>
                        </ul>
                        <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label>
                    </div>
                    <div class="grid-item active-day">
                        Январь
                        <input type="checkbox" name="c2" id="c2" />
                        <label for="c2"></label>
                    </div>
                    <div class="grid-item">
                        Февраль
                        <input type="checkbox" name="c3" id="c3" />
                        <label for="c3"></label>
                   </div>
                    <div class="grid-item">
                        Март
                        <input type="checkbox" name="c4" id="c4" />
                        <label for="c4"></label>
                </div>
                    <div class="grid-item">
                        Апрель
                        <input type="checkbox" name="c5" id="c5" />
                        <label for="c5"></label>
                </div>
                    <div class="grid-item">
                        Май
                        <input type="checkbox" name="c6" id="c6" />
                        <label for="c"></label>
                    </div>
                    <div class="grid-item">
                        Июнь
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        Июль
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        Август
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        Сентябрь
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        Октябрь
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
                    <div class="grid-item">
                        Ноябрь
                <input type="checkbox" name="c1" id="c1" />
                        <label for="c1"></label></div>
            </div>
        </div>
    </body>
</html>
