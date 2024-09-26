<?php
// Menentukan Minimal dan Maksimal Angka
$min = 1;
$max = 25;
$angka = isset($_POST['banyakAngka']) ? max($min, min($_POST['banyakAngka'], $max)) : null;

// Fungsi untuk Menghasilkan Palindrome
function palindrome($reps) {
    $result = "";
    for ($k = 1; $k <= $reps; $k++) {
        $palindrome = str_repeat("1", $k);
        $result .= "<p class='palindrome'>{$palindrome} x {$palindrome} = " . implode("", range(1, $k)) . implode("", range($k - 1, 1)) . "</p>";
    }
    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Palindrome</title>

    <!-- CSS Untuk Mempercantik (Opsional) -->
     <!-- Matikan Comment kalau mau melihat karya estetika ++ -->
      <!-- Untuk Menampilkan agar segitiganya di tengah di Rekomendasikan Menyalakan CSS -->
    <!-- <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ffcc00, #ff6699);
            color: #fff;
            text-align: center;
            margin: 0;
            padding: 50px;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }
        form {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            display: inline-block;
        }
        input[type="number"], input[type="submit"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 1em;
        }
        input[type="number"] {
            width: 220px;
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .palindrome {
            font-size: 1.5em;
            margin: 10px 0;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
    </style> -->
</head>
<body>
    <h1>Palindrome Generator</h1>
    <form action="" method="post">
        <input type="number" name="banyakAngka" placeholder="Total Angka (<?= $min . ' - ' . $max; ?>)" required>
        <input type="submit" name="submit" value="Create Palindrome!">
    </form>
    
    <?php
    // Menampilkan output palindrome jika ada input
    if ($angka) {
        echo palindrome($angka);
    }
    ?>
</body>
</html>
