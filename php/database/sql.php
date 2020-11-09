<?php
function get_connection() {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=matcha", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return ($conn);
    } catch(PDOException $e) {
        return (null);
    }
}
?>