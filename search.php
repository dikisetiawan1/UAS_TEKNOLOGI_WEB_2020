<?php

require 'functions.php';
//pagination
//konfigurasi
$jumlahDataPerhalaman = 2;
$jumlahData = count(query("SELECT * FROM data_produk"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;




$produk = query("SELECT * FROM data_produk LIMIT $awalData, $jumlahDataPerhalaman");


//tombol cari ditekan
if (isset($_POST["cari"]))

	$produk = cari($_POST["keyword"]);


?>





<!DOCTYPE html>
<html>

<head>
	<title>Halaman Produk</title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">

<body>


	<h1>Daftar Produk</h1>
	<a href="tambah.php">Tambah Data Produk</a>
	<br><br>

	<form action="" method="post">
		<input type="tetx" name="keyword" size="40" autofocus autocomplete="off" placeholder="masukan keyword pencarian...">
		<button type="submit" name="cari">cari!</button>

	</form>








	<br>


	<table border="1" cellpadding="10" cellspacing="0">

		<tr>
			<th>No.</th>
			<th>Aksi</th>
			<th>Gambar</th>
			<th>Merk</th>
			<th>Type</th>
			<th>Jenis kendaraan</th>
			<th>Harga</th>

		</tr>
		<?php $i = 1; ?>

		<?php foreach ($produk as $row) : ?>
			<tr>
				<td><?= $i ?></td>
				<td>
					<a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
					<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">hapus</a>
				</td>
				<td>
					<img src="gambar/<?= $row["gambar"]; ?>" width="80">
				</td>
				<td><?= $row["merk"]; ?></td>
				<td><?= $row["tipe"]; ?></td>
				<td><?= $row["jenis"]; ?></td>
				<td><?= $row["harga"]; ?></td>
			</tr>
			<?php $i++; ?>
		<?php endforeach; ?>

	</table>
	<br><br>

	<!--navigasi-->
	<div class="navigasi">
		<?php if ($halamanAktif > 1) : ?>
			<a href="?halaman=<?= $halamanAktif - 1; ?>">
				&lt;</a> <?php endif; ?> <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?> <a href="?halaman=<?= $i; ?>"><?= $i; ?>
			</a>

		<?php endfor; ?>

		<?php if ($halamanAktif < $jumlahHalaman) : ?>
			<a href="?halaman=<?= $halamanAktif + 1; ?>">&gt;</a>
		<?php endif; ?>

	</div>



</body>

</html>