<?php
include 'db.php'; 

function vigenere($text, $key, $decrypt = false) {
    $result = '';
    $key = strtoupper($key);
    $keyLen = strlen($key);
    $j = 0;

    for ($i = 0; $i < strlen($text); $i++) {
        $c = $text[$i];

        if (ctype_alpha($c)) {
            $isLower = ctype_lower($c);
            $offset = ord($isLower ? 'a' : 'A');
            $p = ord($c) - $offset;
            $k = ord($key[$j % $keyLen]) - ord('A');
            $k = $decrypt ? -$k : $k;
            $ch = chr(($p + $k + 26) % 26 + $offset);
            $result .= $ch;
            $j++;
        } else {
            $result .= $c;
        }
    }
    return $result;
}


$text = $_POST['text'] ?? '';
$key = $_POST['key'] ?? '';
$action = $_POST['action'] ?? 'encrypt';

if (trim($key) === '') {
    echo "Błąd: pusty klucz.";
    exit;
}

$decrypt = ($action === 'decrypt');
$result = vigenere($text, $key, $decrypt);


$stmt = $conn->prepare("INSERT INTO szyfrowania (text, klucz, akcja, wynik) VALUES (?, ?, ?, ?)");
if ($stmt) {
    $stmt->bind_param("ssss", $text, $key, $action, $result);
    $stmt->execute();
    $stmt->close();
    echo htmlspecialchars($result); 
} else {
    echo "Błąd podczas zapisu do bazy: " . $conn->error;
}

$conn->close();
?>
