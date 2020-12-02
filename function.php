<?php
function getPostVal($name) {
    return $_POST[$name] ?? "";
}

function validateRepeatPassword($password){
  if($_POST[$password] !== $_POST['password']){
    return "Пароли не совпадают";
  }
  else {
    return null;
  }
}

function validateEmail($name) {
    if (!filter_input(INPUT_POST, $name, FILTER_VALIDATE_EMAIL)) {
        return "Введите корректный email";
    }
}

function validateImage($file){
if (!empty($_FILES['lot-img']['name'])) {
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $tmp_name = $_FILES['lot-img']['tmp_name'];
  $file_type = finfo_file($finfo, $tmp_name);
          if($file_type !== "image/jpeg" && $file_type !== "image/png"){;
               return  false;
             }

         }
         else{
           return true;
         }
   }

function isCorrectLength($name) {
    $len = strlen($_POST[$name]);
    $min = 5;
    $max = 120;
    if ($len < $min or $len > $max) {
        return "Значение пароля должно быть от $min до $max символов";
    }
    else{
      return null;
    }
}
function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
        die($errorMsg);
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($link) > 0) {
            $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
            die($errorMsg);
        }
    }

    return $stmt;
}
?>
