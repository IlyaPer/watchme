<?php
  require_once("functions.php");
  $connection = mysqli_connect("localhost", "root", "", "TASKER");
  if ($connection == false) {
    print("Ошибка подключения!");
  }
  $errors = [];
  $sql_tasks = "SELECT tasks.content as content, tasks.category_id, categories.id FROM tasks JOIN categories ON categories.id = tasks.category_id WHERE categories.id = 2 ORDER BY date_creation DESC";
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
			$sql = 'INSERT INTO `tasks`( `date_creation`, `content`, `category_id`, `user_id`) VALUES (NOW(), ?, 2, 1);';

			$stmt = db_get_prepare_stmt($connection, $sql, $new_year_task);
			$res = mysqli_stmt_execute($stmt);
      header("Location: month.php");
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
              <li><a class="menu__item" href="year.php">Планы на год</a></li>
              <li><a class="menu__item" href="month.php">Планы на месяц</a></li>
              <li><a class="menu__item" href="day.php">Планы на день</a></li>
              <li><a class="menu__item" href="hhtp:">Настройки и поддержка </a></li>
            </ul>
         </div>

          <h1 class="text">Планы на месяц:</h1>
         <h2>Цели</h2>
        <hr>
         <ul class="flex-container">
					 <?php if(empty($year_tasks)){
						 print('<h2 style="color: grey; text-align: center;">Задач на месяц нет!</h2>');
					 } ?>
					 <?php foreach($year_tasks as $simple): ?>
             <li class="flex-item half"><?= $simple['content']; ?></li>
						 <li class="edit"><svg xmlns="http://www.w3.org/2000/svg" style="display: none;"><symbol id="pencil" viewBox="0 0 512.001 512.001"><title>pencil</title><path d="M496.063,62.299l-46.396-46.4c-21.199-21.199-55.689-21.198-76.888,0C352.82,35.86,47.964,340.739,27.591,361.113 c-2.17,2.17-3.624,5.054-4.142,7.875L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143 L143,488.549c2.895-0.54,5.741-2.008,7.875-4.143l345.188-345.214C517.311,117.944,517.314,83.55,496.063,62.299z M33.721,478.276 l14.033-75.784l61.746,61.75L33.721,478.276z M140.269,452.585L59.41,371.721L354.62,76.488l80.859,80.865L140.269,452.585z M474.85,117.979l-18.159,18.161l-80.859-80.865l18.159-18.161c9.501-9.502,24.96-9.503,34.463,0l46.396,46.4 C484.375,93.039,484.375,108.453,474.85,117.979z"/></symbol><symbol id="trash" viewBox="0 0 512 512"><title>trash</title><path d="m424 64h-88v-16c0-26.467-21.533-48-48-48h-64c-26.467 0-48 21.533-48 48v16h-88c-22.056 0-40 17.944-40 40v56c0 8.836 7.164 16 16 16h8.744l13.823 290.283c1.221 25.636 22.281 45.717 47.945 45.717h242.976c25.665 0 46.725-20.081 47.945-45.717l13.823-290.283h8.744c8.836 0 16-7.164 16-16v-56c0-22.056-17.944-40-40-40zm-216-16c0-8.822 7.178-16 16-16h64c8.822 0 16 7.178 16 16v16h-96zm-128 56c0-4.411 3.589-8 8-8h336c4.411 0 8 3.589 8 8v40c-4.931 0-331.567 0-352 0zm313.469 360.761c-.407 8.545-7.427 15.239-15.981 15.239h-242.976c-8.555 0-15.575-6.694-15.981-15.239l-13.751-288.761h302.44z"/><path d="m256 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/><path d="m336 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/><path d="m176 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z "/></symbol></svg><li>
					<?php endforeach; ?>
        </ul>
				<?= require_once("svg/edit.svg"); ?>
        <hr>
        <form method="post" action="month.php">
            <input type="text" placeholder="Добавить цель" name="content">
						<br>
						<?php if(isset($errors['content'])){
						print('<span style="color: red;">' . $errors['content'] . '</span>');
						}
						?>
					<br>
						<input type="submit" class="button7">
        </form>
        <div class="block right"><a href="month_edit.php" class="button8">Редактировать</a></div>
        <div class="month_grid">
              <div class="month-grid-item cntr"><h1>Январь</h1></div>
              <div class="arrow-2 month-grid-item lft">
                <div class="arrow-2-top"></div>
                <div class="arrow-2-bottom"></div>
              </div>
              <div class="arrow-2 month-grid-item rght">
                <div class="arrow-2-top"></div>
                <div class="arrow-2-bottom"></div>
              </div>
        </div>
        <div class="align-grid">
            <div class="grid">
                    <div class="grid-item">
                        1
												<ul>
													<li>Цель 1 </li>
													<li>Цель 1 </li>
													<li>Цель 1 </li>
												</ul>
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
				<div class="round">circle</div>
    </body>
</html>
