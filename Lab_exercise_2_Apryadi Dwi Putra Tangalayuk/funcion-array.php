<?php
include 'control-flow.php';
class Student { //Class Student
    private array $names = ["Apry", "Adi", "Dwi", "Putra", "Apryadi"];

    public function getNames() {
        return $this->names;
    }
}

function greet($nama) {
    echo "Hello $nama!<br>";
}

// Contoh penggunaan fungsi greet untuk semua siswa
echo "<h3>Greetings:</h3>";
$studentNames = (new Student())->getNames();
foreach ($studentNames as $name) {
    greet($name);
}
?>