<?php
require 'functions.php';
//koneksi ke dbms
// $conn = mysqli_connect("localhost", "root", "", "phpdasar");
//require 'functions.php';
//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	//ambil data dari tiap elemen atau belum




	//query insert data

	//cek apakah data berhasil ditambahkan/tdk
	if (tambah($_POST) > 0) {

		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	}
}



?>

<!DOCTYPE html>
<html>

<head>
	<title>Tambah Porduk</title>
</head>

<body>
	<h1>Tambah data Produk</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="merk">Merk:</label>
				<input type="text" name="merk" id="merk" required="">
			</li>
			<li>
				<label for="tipe">Type:</label>
				<input type="text" name="tipe" id="tipe" required="">

			</li>
			<li>
				<label for="jenis">Jenis kendaraan :</label>
				<input type="text" name="jenis" id="jenis" required="">

			</li>
			<li>
				<label for="harga">harga :</label>
				<input type="angka" name="harga" id="harga" required="">
			</li>
			<li>
				<label for="gambar">gambar :</label>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Tambah Data!</button>
			</li>

		</ul>



	</form>

</body>

</html>