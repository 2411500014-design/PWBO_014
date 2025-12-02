<?php
$mysqli = new mysqli('localhost','root','','penyuluhan');
if ($mysqli->connect_error) die('conn fail');
$tables = ['ortu', 'anak', 'kunjungan', 'pengukuran'];
foreach ($tables as $table) {
    echo "=== $table ===\n";
    $res = $mysqli->query("DESCRIBE $table");
    while ($row = $res->fetch_assoc()) {
        echo $row['Field'] . " | " . $row['Type'] . " | " . ($row['Null'] === 'YES' ? 'NULL' : 'NOT NULL') . " | " . ($row['Key'] ?: '') . "\n";
    }
    echo "\n";
}
?>
