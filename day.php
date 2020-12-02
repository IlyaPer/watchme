<?php
  $link = 2;
  require_once("functions.php");
  $connection = mysqli_connect("localhost", "root", "", "TASKER");
  if ($connection == false) {
    print("Ошибка подключения!");
  }
  $today = date("m-d");
  $errors = [];
  $sql_tasks = "SELECT tasks.content as content, tasks.category_id, categories.id FROM tasks JOIN categories ON categories.id = tasks.category_id WHERE categories.id = 4, date_creation = $today ORDER BY date_creation DESC";
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
			$sql = 'INSERT INTO `tasks`( `date_creation`, `content`, `category_id`, `user_id`) VALUES (NOW(), ?, 4, 1);';

			$stmt = db_get_prepare_stmt($connection, $sql, $new_year_task);
			$res = mysqli_stmt_execute($stmt);
      header("Location: day.php");
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
              <li><a class="menu__item" href="tarif.html">Настройки и поддержка </a></li>
            </ul>
         </div>
         <div class="month_grid">
               <div class="month-grid-item cntr"><h1>Задачи на сегодня</h1></div>
               <div class="arrow-2 month-grid-item lft">
                 <a href="year.php" class="arrow-2-top"></a>
                 <a href="year.php" class="arrow-2-bottom"></a>
               </div>
               <div class="arrow-2 month-grid-item rght">
                 <a href="year.php" class="arrow-2-top"></a>
                 <a href="day.php?=<? $link; ?>" class="arrow-2-bottom"></a>
               </div>
         </div>
         <h1 class="text">Задачи на сегодня</h1>
         <h2 class="text"><?= $today; ?></h2>
        <hr>
         <ul class="flex-container">
					 <?php if(empty($year_tasks)){
						 print('<span style="color: grey; text-align: center;">Задач на сегодня нет!</span>');
					 } ?>
					 <?php foreach($year_tasks as $simple): ?>
            <li class="half"><?= $simple['content']; ?></li>
					<?php endforeach; ?>
        </ul>
         <input type="checkbox" name="t1" id="t1"/>
             <label for="t1"></label>
        <hr>
        <form action="day.php" method="post">
            <input type="task" placeholder="Добавить цель" name="content">
						<?php if(isset($errors['content'])){
						print('<span style="color: red;">' . $errors['content'] . '</span>');
						}
						?>
						<br>
							<input type="submit" class="button7">
        </form>
        <div class="block right"><a href="day_.php" class="button8">Редактировать</a></div>
         <h2 class="text">Дневные заметки:</h2>
         <form class="text" method="post" action="day_notes.php">
             <textarea name="message" cols="50" rows="10" placeholder="Ваши мысли о сегодняшнем дне. Помните, что фиксируя ваши"></textarea>
						 <input type="submit" value="Сохранить" class="button7">
         </form>
    </body>
</html>
