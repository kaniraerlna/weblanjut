<?php

//mysqli_connect - connect ke db
$conn = mysqli_connect("localhost","root","","akademik");

if(!$conn) {
    die ('Gagagl terhubung MySQL: '.mysqli_connect_error());
} else {
    echo "Terkoneksi ke MySQL !<br>";
}


//mysqli_query - operasi CRUD di db
$table_name = 'mahasiswa';

$sql = 'CREATE TABLE IF NOT EXISTS `' . $table_name . '` (
        `nim` INT(5) NOT NULL PRIMARY KEY,
        `nama` VARCHAR(20) NOT NULL,
        `tugas` INT(5) NOT NULL,
        `uts` INT(5) NOT NULL,
        `uas` INT(5) NOT NULL)';

$query = mysqli_query($conn, $sql);  

if(!$query) {
    die ('ERROR: Tabel ' . $table_name . ' gagal dibuat: ' .mysqli_error($conn));
}
echo 'Tabel' . $table_name . ' berhasil dibuat <br/>';

$sql = "INSERT INTO `$table_name` (`nim`, `nama`, `tugas`, `uts`, `uas`)
        VALUES (10011, 'Kanira Eliana', 100, 100, 100),
        (10012, 'Asep', 90, 100, 80),
        (10013, 'Ucup', 85, 90, 88),
        (10014, 'Tiara', 78, 87, 90),
        (10015, 'Yaya', 90, 89, 98)";

$query = mysqli_query($conn, $sql);

if(!$query) {
    die ('ERROR: Tabel ' . $table_name . ' gagal dibuat: ' .mysqli_error($conn));
}
echo 'Data berhasil dimasukkan pada tabel ' . $table_name . '';


// mysqli_fetch_array - mengambil nilai dari tabel di db 
$sql = 'SELECT * FROM mahasiswa';

$query = mysqli_query($conn, $sql);

if(!$query) {
    die ('SQL Error: '.mysqli_error($conn));
}

echo 
    '<html>
        <head>
            <title>List Mahasiswa</title>
            <style>

            </style>
        </head>
        <body>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tugas</th>
                        <th>UTS</th>
                        <th>UAS</th>
                    </tr>
                </thead>
                <tbody>';

            while ($row = mysqli_fetch_array($query)) {
                echo '<tr>
                        <td>'.$row['nim'].'</td>
                        <td>'.$row['nama'].'</td>
                        <td>'.$row['tugas'].'</td>
                        <td>'.$row['uts'].'</td>
                        <td>'.$row['uas'].'</td>
                    </tr>';
            }
echo '
                </tbody>
            </table>
        </body>
    </html>'
        ;


// data temporary field
$sql = 'SELECT nim, nama, tugas, uts, uas, (tugas+uts+uas)/3 AS nilai_akhir FROM mahasiswa';

$query = mysqli_query($conn, $sql);

if(!$query) {
    die ('SQL Error: '.mysqli_error($conn));
}

echo 
    '<html>
        <head>
            <title>List Mahasiswa</title>
            <style>

            </style>
        </head>
        <body>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tugas</th>
                        <th>UTS</th>
                        <th>UAS</th>
                        <th>Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>';

            while ($row = mysqli_fetch_array($query)) {
                echo '<tr>
                        <td>'.$row['nim'].'</td>
                        <td>'.$row['nama'].'</td>
                        <td>'.$row['tugas'].'</td>
                        <td>'.$row['uts'].'</td>
                        <td>'.$row['uas'].'</td>
                        <td>'.number_format($row['nilai_akhir'], 0, ',', '.').'</td>
                    </tr>';
            }
echo '
                </tbody>
            </table>
        </body>
    </html>'
        ;

?>
