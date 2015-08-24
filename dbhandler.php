<?php

class DBHandler {
	protected $pdo;

	function __construct(){
		$this->pdo = new PDO('mysql:host=localhost;dbname=unvisit_korgen;charset=utf8', "root", "");
	}

	function read($url){
		$stmt = $this->pdo->prepare('SELECT title, body FROM cached WHERE url = :url');
		$stmt->execute(array('url' => $url));
		foreach ($stmt as $row) {
		    return array("title" => $row[0], "body" => $row[1]);
		}
		return null;
	}

	function cache($url, $title, $body){
		$stmt = $this->pdo->prepare("INSERT INTO cached (url, title, body) VALUES (:url, :title, :body)");
		$stmt->bindParam(':url', $url);
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':body', $body);
		$stmt->execute();
	}
}
