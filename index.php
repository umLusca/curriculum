<?php

function con(): PDO
{
	//return mysqli_connect($_ENV["DBHOST"], $_ENV["DBUSER"], $_ENV["DBPASS"], $_ENV["DBNAME"]);

	$pdo = new PDO("mysql:host=localhost;dbname=idk",
		"root",
		"");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->query("SET time_zone = '-04:00';");
	return $pdo;
}

function normalize_accentuation($string): string
{
	$unwanted_array = [
		'Á' => 'Á', 'É' => 'É', 'Í' => 'Í', 'Ó' => 'Ó', 'Ú' => 'Ú',
		'á' => 'á', 'é' => 'é', 'í' => 'í', 'ó' => 'ó', 'ú' => 'ú',
		'À' => 'À', 'È' => 'È', 'Ì' => 'Ì', 'Ò' => 'Ò', 'Ù' => 'Ù',
		'à' => 'à', 'è' => 'è', 'ì' => 'ì', 'ò' => 'ò', 'ù' => 'ù',
		'Ã' => 'Ã', 'Õ' => 'Õ', 'ã' => 'ã', 'õ' => 'õ',
		'Ç' => 'Ç', 'ç' => 'ç',
	];
	$arr2 = array_values($unwanted_array);
	$unwanted_array2 = [];
	foreach ($arr2 as $value) {
		$unwanted_array2[$value] = $value;
	}
	$st = strtr($string, $unwanted_array2);
	$st = strtr($st, $unwanted_array);
	return $st;
}
$nome = normalize_accentuation("Í");

$c = con();

$c->exec("SET NAMES 'utf8mb4'");
$a=$c->prepare("SELECT * from aluno WHERE nome like ?;");
$a->execute([$nome]);
if ($a->rowCount()){
	var_dump($a->fetchAll(2));
} else {
	echo "não encontrado";
}


echo "ok";