<?php
// Class Diriku
class Diriku {
    public $nama;
    public $jenisKelamin;
    public $ipk;
    public $isStudent;

    public function __construct($nama, $jenisKelamin, $ipk, $isStudent) {
        $this->nama = $nama;
        $this->jenisKelamin = $jenisKelamin;
        $this->ipk = $ipk;
        $this->isStudent = $isStudent;
    }

    // Untuk Menghitung Umur dalam tahun
    public function hitungUmur($tanggalLahir, $bulanLahir, $tahunLahir) {
        $tanggalSekarang = new DateTime();
        $tanggalLahir = new DateTime("$tahunLahir-$bulanLahir-$tanggalLahir");
        $umur = $tanggalSekarang->diff($tanggalLahir);
        return $umur->y; // Mengembalikan umur dalam tahun
    }
}
?>

<!-- HTML untuk Input -->
<!DOCTYPE html>
<html>
<head>
    <title>Hitung Usia dan Biodata</title>
</head>
<body>
    <h2>Hitung Usia Anda</h2>
    <form method="post" action="">
        <label for="tanggal">Tanggal Lahir:</label>
        <input type="number" id="tanggal" name="tanggal" min="1" max="31" required><br><br>

        <label for="bulan">Bulan Lahir:</label>
        <input type="number" id="bulan" name="bulan" min="1" max="12" required><br><br>

        <label for="tahun">Tahun Lahir:</label>
        <input type="number" id="tahun" name="tahun" min="1900" max="<?php echo date('Y'); ?>" required><br><br>

        <input type="submit" name="submit" value="Hitung Umur">
    </form>

<?php
// Set Diriku untuk dijadikan sebagai Output
$diriku = new Diriku("Apryadi", "Male", 3.60, true);

if (isset($_POST['submit'])) {
    $tanggal = $_POST['tanggal'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    // Menampilkan biodata
    echo "<h3>Biodata:</h3>";
    echo "<p>Nama: " . $diriku->nama . "</p>";
    echo "<p>Jenis Kelamin: " . $diriku->jenisKelamin . "</p>";
    echo "<p>IPK: " . $diriku->ipk . "</p>";
    echo "<p>Mahasiswa: " . ($diriku->isStudent ? 'Ya' : 'Tidak') . "</p>";

    // Menghitung dan menampilkan umur
    $umur = $diriku->hitungUmur($tanggal, $bulan, $tahun);
    echo "<p>Umur Anda: $umur tahun</p>";

    include "funcion-array.php";
}
?>
</body>
</html>
