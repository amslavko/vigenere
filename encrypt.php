<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['text'] ?? '';
    $key = $_POST['key'] ?? '';
    $action = $_POST['action'] ?? 'encrypt';

    if (trim($key) === '') {
        echo "Błąd: pusty klucz.";
    } else {
        $decrypt = ($action === 'decrypt');
        echo vigenere($text, $key, $decrypt);
    }
}
?>
