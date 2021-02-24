<?php
		require_once("function.php");
		require_once("init.php");
		require_once("helpers.php");
		$errors = [];
		$cats_ids = array_column($categories, 'id');
		$lot = $_POST;
		$user_id = 1;
		$rules = [
		'content' => function() {
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
			$sql = 'INSERT INTO main_tasks (date_creation, category_id, content, author_id) VALUES (NOW(), 1, ?, 1)';

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
             <div class="main-grid">
            <div class="menu-container">
                <div class="my-account">
                    <div class="my-account-element">Илья</div>
                    <div class="my-account-element up"><a><img src="svg/exit.svg"></a></div>
                    <div></div>
                    <div class="my-account-element up"><a href="setting.html"><img src="svg/settings.svg"></a></div>
                </div>
                <hr>
                <div class="notes-grid">
                    <img style="padding-top: 22px;" src="svg/pencil.svg">
                    <h3 class="pointer-notes">Жизнь</h3>
                </div>
                <h3 class="pointer"><a href="year.html">Цели на год</a></h3>
                <h3 class="pointer"><a href="month.html">План на месяц</a></h3>
                <h3 class="pointer"><a href="day.html">Задачи на день</a></h3>
                <h3 class="pointer"><a href="test_project.html">Учеба</a></h3>
                <h3 class="pointer"><a href="test_project.html">Тестовый проект</a></h3>
                <hr>
                <div class="menu-button">
                     <div>Создать проект</div>
                     <div><img class="width20 up" src="svg/plus.svg"></div>
                </div>
                <div class="rules">
                     <hr>
                     <p>@WatchMe 2021. Все права защищены.</p>
                     <p><a href="politics.html">Политика конфиденциальности</a></p>
                     <p>ООО "Вотч Ми"</p>
                </div>
             </div>
             <div>
                <h2 style="text-align: center;">Задачи на день</h2>
                <hr>
                <div container="align-content">
                        <ul class="flex-container">
                            <li class="half">Сдать анализ мочи</li>
                            <div class="checkbox-first">
                                    <label for="checkbox-one" class="checkbox-first__label">
                                        <input id="checkbox-one" type="checkbox" class="checkbox-first__input">
                                        <div class="checkbox">
                                            <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                <polyline points="4 11 8 15 16 6"></polyline>
                                            </svg>
                                        </div>
                                    </label>
                            </div>

                            <li class="half">Не забыть протестировать мочу</li>
                            <div class="checkbox-first">
                                    <label for="checkbox-two" class="checkbox-first__label">
                                        <input id="checkbox-two" type="checkbox" class="checkbox-first__input">
                                        <div class="checkbox">
                                            <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                <polyline points="4 11 8 15 16 6"></polyline>
                                            </svg>
                                        </div>
                                    </label>
                            </div>
                            <li class="half">Пустая цель</li>
                            <div class="checkbox-first">
                                    <label for="checkbox-one" class="checkbox-first__label">
                                        <input id="checkbox-one" type="checkbox" class="checkbox-first__input">
                                        <div class="checkbox">
                                            <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                                <polyline points="4 11 8 15 16 6"></polyline>
                                            </svg>
                                        </div>
                                    </label>
                            </div>
                         </ul>
                 </div>

                <hr>
                <form class="container-new-task">
                    <input type="task" placeholder="Добавить цель" name="task" required>
                     <div class="month-button">
                        <div class="first-point">
                        <button>
                             Добавить задачу
                        </button>
                        </div>
                        <div class="second-point">
                            <img class="up20" src="svg/plus.svg">
                        </div>
                    </div>
                </form>
                 <hr>
                 <h2>Сделанные задачи</h2>
                 <ul class="done-container">
                    <li class="done-task">Полить цветы</li>
                 </ul>
             </div>

            </div>
        </div>
    </body>
</html>
