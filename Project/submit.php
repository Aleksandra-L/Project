<?php
  $login = trim(strip_tags($_POST["login"]));
  $password = trim(strip_tags($_POST["password"]));
  $first_name = trim(strip_tags($_POST["first-name"]));
  $name = trim(strip_tags($_POST["name"]));
  $sex = trim(strip_tags($_POST["sex"]));
  $birthdate = trim(strip_tags($_POST["birthdate"]));
  $phone = trim(strip_tags($_POST["phone"]));
  if(isset($_POST["email"])) {
    $email = trim(strip_tags($_POST["email"]));
  }
  else {
    $email = "NULL";
  }
  $city = trim(strip_tags($_POST["city"]));
  if (($_POST["checkbox"]) == '') {
    //echo 'Для продолжения примите условия соглашения';
    //header("location: ".$_SERVER['HTTP_REFERER']);
    header("location:http://project/Registration.html");
    exit;
  }
  $host = "localhost";
  $user = "mysql";
  $pass = "mysql";
  $db_name = "forms";
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  $link = new mysqli($host, $user, $pass, $db_name);
    if(!$link) {
      echo "We have problems. Error code: " . mysqli_errno($link) . ", error name" . mysqli_error($link);
      exit;
    }
  $fields = "login, password, surname, name, sex, birthdate, phone, email, city";
  $stmt = $link->prepare("INSERT INTO registration_data(" . $fields . ") VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssissss", $login, $password, $first_name, $name, $sex, $birthdate, $phone, $email, $city);
  $stmt->execute();
    if (!mysqli_error($link)) {
      echo '<p>Данные добавлены в таблицу.</p>';
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }

  echo "Регистрация прошла успешно!";
  mysqli_close($link);
?>