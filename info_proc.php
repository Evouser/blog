<?php

require("db/func.php");

if ((isset($_POST['title'])) and (isset($_POST['text']))) {
	$title = $_POST['title'];
	$text = $_POST['text'];
	$date = getdate();
	if ($date['minutes'] < 10) {
		$date['minutes'] = "0" . $date['minutes'];
	}
	$date = $date['mday'] . " " . $date['month'] . " " . $date['year'] . ", " . $date['hours'] . ":" . $date['minutes'];

	$mysqli = getConnect();

	$mysqli->query("INSERT INTO article VALUES ('', '$title', '$text', '$date', '0')");

	$mysqli->close();

	unset($_POST['title'], $_POST['text']);
	header("Location: http://" . $_SERVER['SERVER_NAME']);
}

if ((isset($_POST['name'])) and (isset($_POST['textcom'])) and (isset($_POST['id_art']))) {
	$name = $_POST['name'];
	$textcom = $_POST['textcom'];
	$id_art = $_POST['id_art'];
	$date = getdate();
	if ($date['minutes'] < 10) {
		$date['minutes'] = "0" . $date['minutes'];
	}
	$date = $date['mday'] . " " . $date['month'] . " " . $date['year'] . ", " . $date['hours'] . ":" . $date['minutes'];

	$mysqli = getConnect();

	$mysqli->query("INSERT INTO comment VALUES ('', '$id_art', '$name', '$textcom', '$date')");

	$mysqli->close();

	unset($_POST['name'], $_POST['textcom']);
	header("Location: http://" . $_SERVER['SERVER_NAME'] . "/post.php?post=$id_art");
}

if ((isset($_POST['id'])) and (isset($_POST['id_art']))) {
	$id = $_POST['id'];
	$id_art = $_POST['id_art'];

	$mysqli = getConnect();

	$mysqli->query("DELETE FROM comment WHERE id = '$id'");

	$mysqli->close();

	header("Location: http://" . $_SERVER['SERVER_NAME'] . "/post.php?post=$id_art");
}

if ((isset($_POST['delete_art_id'])) and (isset($_POST['delete_page'])) and (isset($_POST['page_posts']))) {
	$id = $_POST['delete_art_id'];
	$page = $_POST['delete_page'];
	$page_posts = $_POST['page_posts'];

	$mysqli = getConnect();

	$mysqli->query("DELETE FROM article WHERE id = '$id'");
	$mysqli->query("DELETE FROM comment WHERE id_art = '$id'");

	$mysqli->close();

	if ($page != 1) {
		if ($page_posts != 1) {
			header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?page=$page");
		} else {
			$page--;
			header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?page=$page");
		}
	} else {
		header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?page=$page");
	}
}

?>