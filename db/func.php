<?php

require("conf.php");

function getConnect() {
	if (!$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS)) {
		die("Произошла ошибка подключения к базе данных!");
	}

	if ($mysqli->query("CREATE DATABASE blog")) {
		//echo "База данных успешно создана.\n";
		$mysqli->close();
	}

	if (!$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME)) {
		die("Произошла ошибка подключения к базе данных!");
	} else {
		//echo "Подключение к базе данных установлено успешно.\n";
	}

	if ($mysqli->query("CREATE TABLE article (id INT AUTO_INCREMENT, title VARCHAR(255), text TEXT, date VARCHAR(255), views INT, PRIMARY KEY(id))")) {
		//echo "Таблица \"Заказы\" успешно создана.\n";
	}

	if ($mysqli->query("CREATE TABLE comment (id INT AUTO_INCREMENT, id_art INT, name VARCHAR(255), text TEXT, date VARCHAR(255), PRIMARY KEY(id))")) {
		//echo "Таблица \"Комментарии\" успешно создана.\n";
	}
	
	return $mysqli;
}



?>