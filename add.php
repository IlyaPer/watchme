<?php
      //require_once("function.php");
      //require_once("init.php");
    //  require_once("helpers.php");
  //
  $is_auth = rand(0, 1);
  $errors = [];
  //if (!$link) {
    //$error = mysqli_connect_error();
  //  show_error($content, $error);
//}
$cats_ids = array_column($categories, 'id');
   $lot = $_POST;
  $rules = [
    'category_id' => function() use ($cats_ids) {
        return validateCategory('category_id', $cats_ids);
    },
    'name' => function() {
        return validateFilled('title');
    },
    'description' => function() {
        return validateFilled('description');
    },
    'image' => function() {
        return validateBet('bet_step'); //
    },
    'date_delection' => function() {
      $date = $_POST['date_delection'];
      if (!is_date_valid($date)){
          return "Неправильный формат даты";
      }
      else{
        return null;
      }
    },
    'lot-img' => function() {
        $lotimg = $_FILES['lot-img']['name'];
        return validateImage($lotimg);// функция наличия файла('lot-img');
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
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $lot = $_POST;
      $filename = uniqid() . $file_name;
      $lot['path'] = $filename;
      if (isset($_FILES['lot-img'])){
        move_uploaded_file($_FILES['lot-img']['tmp_name'], 'uploads/' . $filename);
      }
      $sql = 'INSERT INTO lots (date_creation, title, first_price, category_id, description, bet_step, date_delection, path) VALUES (NOW(), ?, 1, ?, ?, ?, ?, ?)';

      $stmt = db_get_prepare_stmt($link, $sql, $lot);
      $res = mysqli_stmt_execute($stmt);

      if ($res) {
        $lot_id = mysqli_insert_id($link);

        header("Location: project.php?id=" . $lot_id);
      }
    }
  }
$errors = array_filter($errors);
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="pages/addstyle.css">
        <title>Добавление проекта</title>
    </head>
    <body>
        <main>
        <h1>Добавление проекта</h1>
        <form>
          <h3>Введите название проекта</h3>
          <input type="text" placeholder="Введите название проекта">
          <h3>Выберите категорию проекта</h3>
          <select id="category" name="category">
            <option>Социальный</option>
            <option>Коммерческий</option>
          </select>
            <h3>Введите описание проекта</h3>
            <input rows="10" cols="45"  class="description" type="text" placeholder="Введите описание проекта">
            <a href="#" class="button">Загрузить фото</a>
            <a href="#" class="button">Загрузить видео</a>
        </form>
          <a href="#" class="button public">Опубликовать проект</a>
        </main>
        <p style="color: white;"><a href="pricing.php">PRICING</a></p>
    </body>
</html>
