<?php

require 'lib/db.php';

$db = new db();
$db->connect();

$sql = "INSERT INTO mens(gnavi_id, photo, comment) VALUES(0, null, 'テスト')";
$stmt = $db->prepare($sql);
$stmt->execute(['0', null, 'テスト']);

$sql = 'SELECT * FROM mens';
$rows = $db->query($sql);

foreach ($rows as $row) {
    var_dump($row['comment']);
}