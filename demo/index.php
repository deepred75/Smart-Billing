<link rel="stylesheet" href="style.css" type="text/css" media="all">

<?php
include_once 'database.php';
$result = mysqli_query($conn,"SELECT * FROM tagihan_pembayaran");
?>
<!DOCTYPE html>
<html>
 <head>
 <title>Menampilkan Data</title>
 </head>
<body>
<?php
if (mysqli_num_rows($result) > 0) {
?>
  <table>
  
  <tr>
    <td>ID Invoice</td>
    <td>Tgl Invoice</td>
    <td>Nomor Siswa</td>
    <td>Nama Siswa</td>
    <td>Nominal Tagihan</td>
    <td>Jurusan</td>
  </tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
    <td><?php echo $row["id_invoice"]; ?></td>
    <td><?php echo $row["tanggal_invoice"]; ?></td>
    <td><?php echo $row["nomor_siswa"]; ?></td>
    <td><?php echo $row["nama"]; ?></td>
    <td><?php echo $row["nominal_tagihan"]; ?></td>
    <td><?php echo $row["informasi"]; ?></td>
</tr>
<?php
$i++;
}
?>
</table>
 <?php
}
else{
    echo "No result found";
}
?>
 </body>
</html>