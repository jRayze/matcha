<?php
try {
    $conn = new PDO("mysql:host=localhost", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("DROP DATABASE IF EXISTS `matcha` ;");
} catch (PDOException $e) {
    echo "<br>" . $e->getMessage();
}
try {
    $conn = new PDO("mysql:host=localhost", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec(file_get_contents("matcha.sql"));
} catch(PDOException $e) {
    echo "<br>" . $e->getMessage();
}
?>