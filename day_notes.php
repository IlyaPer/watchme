<?php
  require_once("functions.php");
  $connection = mysqli_connect("localhost", "root", "", "TASKER");
  if ($connection == false) {
    print("Ошибка подключения!");
  }
  $errors = [];
  $sql_tasks = "SELECT tasks.content as content, tasks.category_id, categories.id FROM tasks JOIN categories ON categories.id = tasks.category_id WHERE categories.id = 4 ORDER BY date_creation DESC";
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
      $id =
			$sql = "INSERT INTO `notes`(`date_creation` `content`, `task_id`) VALUES (NOW(), ?, $id);";

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
