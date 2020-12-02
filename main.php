<?php

session_start();
if (isset($_SESSION['username'])) {
  print($_SESSION['username']);
}

$_SESSION['username'] = "Админ";
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
         <title>Tasker Club</title>
 	</head>
 	<body>
          <h1 class="text">Более <span style="color:red">80% людей не успевают</span> закончить свои дела на день.</h1>
          <h1 class="text">Более 90% людей не добиваются своих целей за год.</h1>
          <h2 class="text">И главной причиной было то, что не все осознают объем работ.</h2>
                          <div class="Iam">

                 <p>Таскер</p>
                 <b>
                   <div class="innerIam">
                     удобный интерфейс<br />
                     низкая цена<br />
                     отслеживание прогресса<br />
                     планирование дня<br />
                     отсутствие рекламы
                     </div>
                 </b>

                 </div>
          <main>
             <h1 class="text">TaskerX - Ваше решение проблемы.</h1>
             <h2 class="text">Мы создали для вас инструмент, позволяющий не только распланировать ваш год, но и отслеживать прогресс вашего развития каждый день.</h2>
             <div class="container">
                  <h2>Простой интерфейс</h2>
                  <div>FOTO</div>
                  <h3>Для планирования своего дня нужно всего 5 минут в день. Система автоматически определяет ваш прогресс. </h3>
                  <h2>Возможность оценить свой прогресс и понять слабые места</h2>
                  <div>FOTO</div>
                  <h3>Мы не просто напоминаем вам о задачах. Каждый день вы вы подводите итоги, отслеживая статистику своего развития. </h3>

                  <h2>Методики планирования</h2>
                  <div>FOTO</div>
                  <h3>У нас собраны лучшие методики планирования, которые применяются как крупными корпорациями, так и великими людьми отдельно.</h3>
             </div>
             <h1 class="text">Стоимость - 49₽ в месяц. Попробуйте 2 недели бесплатно.</h1>
              <div class="block"><a href="registration.php" class="button7">Попробовать бесплатно</a></div>
          </main>
     </body>
 </html>
