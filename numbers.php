<?php
function NamaFuntion(){
    if(isset($_POST['angka1']) && isset($_POST['angka2']) && isset($_POST['menghitung1']) && isset($_POST['menghitung2'])){
        // Untuk mengambil input dan memasukkannya ke dalam Array
        $angka1 = explode(",", $_POST['angka1']);
        $angka2 = explode(",", $_POST['angka2']);
        
        // Sort untuk masing" array
        sort($angka1);
        sort($angka2);
        
        // Supaya bisa na hitung masing" Angkat yang sudah di pilih
        $menghitung1 = (int)$_POST['menghitung1'];
        $menghitung2 = (int)$_POST['menghitung2'];
        
        // Suopaya na Batasi Array yang mau di gabungkan nanti
        $limited_angka1 = array_slice($angka1, 0, $menghitung1);
        $limited_angka2 = array_slice($angka2, 0, $menghitung2);
        
        // Gabungan array
        $combined_array = array_merge($limited_angka1, $limited_angka2);
        sort($combined_array); // ini supaya Disusun Array yang sudah di gabungkan

        return [$limited_angka1, $limited_angka2, $combined_array];
    }
    return null;
}
?>
<!-- ini html untuk tampilan nya, Supaya ada tempat input dengan tombol Insert nya -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Arrayer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"], input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .output {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 20px auto;
        }
    </style>
</head>
<body>

    <h1>Number Arrayer</h1>
    <form method="POST">
        <label for="angka1">Number 1</label>
        <input type="text" id="angka1" name="angka1" pattern="[0-9,]*" title="Only numbers and commas are allowed" required>

        <label for="menghitung1">Count for Number 1 (Number of elements to display)</label>
        <input type="number" id="menghitung1" name="menghitung1" min="1" title="Enter the number of elements to display" required>

        <label for="angka2">Number 2</label>
        <input type="text" id="angka2" name="angka2" pattern="[0-9,]*" title="Only numbers and commas are allowed" required>

        <label for="menghitung2">Count for Number 2 (Number of elements to display)</label>
        <input type="number" id="menghitung2" name="menghitung2" min="1" title="Enter the number of elements to display" required>

        <input type="submit" value="Insert">
    </form>

    <!-- Untuk memberikan Output Sesuai yang Anda Mau -->
    <?php
    $result = NamaFuntion();
    if($result){
        list($limited_angka1, $limited_angka2, $combined_array) = $result;
        echo '<div class="output">';
        echo "<strong>n:</strong> " . implode(", ", $limited_angka1) . "<br>";
        echo "<strong>m:</strong> " . implode(", ", $limited_angka2) . "<br>";
        echo "<strong>Gabungan angka1 dan angka2:</strong> " . implode(", ", $combined_array);
        echo '</div>';
    }
    ?>
</body>
</html>
