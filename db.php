<?php
$host = 'sql100.infinityfree.com'; 
$user = 'if0_39077274';           
$pass = 'Tfki9lwTbaQ66jH';             
$db   = 'if0_39077274_vigenere';  

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}
?>
