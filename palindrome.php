<?php
//Menentukan Minimal dan maksimal Angka
$max = 20; //Atur Maksimal
$min = 1; //Atur Minimal
if (isset($_POST['submit'])) {
    if (isset($_POST['banyakAngka'])) {
        $angka = $_POST['banyakAngka'];
        if ($angka < $min) $angka = $min;
        if ($angka > $max) $angka = $max;
    }
}

//Untuk Menghasilkan Palindrome
function palindrome($reps) //Funcion untuk Membuat Palindrome
{
    $result = "";
    for ($k = 1; $k <= $reps; $k++) {
        $palindrome = "";
        for ($l = 0; $l < $k; $l++) {
            $palindrome .= "1";
        }
        $result .= '<p style="text-align: center; margin: auto">' . $palindrome . ' x ' . $palindrome . ' = ';
        for ($i = 0; $i < $k; $i++) {
            $result .= $i + 1;
        }
        for ($j = $i - 1; $j > 0; $j--) {
            $result .= $j;
        }
        $result .= "</p>";
    }
    return $result;
}
?>

<!-- Membuat Tampilang dan Form Input -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>

<body>
    <form action="" method="post">
        <input type="number" name="banyakAngka" placeholder="Total Angka (<?= $min . ' - ' . $max; ?>)">
        <input type="submit" name="submit" value="Create Palindrome!">
    </form>
</body>

</html>

<!-- Membuat Output palindrome yang tadi di buat -->
<?php
if (isset($angka)) {
    echo palindrome($angka);
}
?>