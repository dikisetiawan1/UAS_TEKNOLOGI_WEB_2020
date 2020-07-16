<?php
require 'functions.php';



//ambil data di url
$id = $_GET["id"];

//query data mahasiswa berdasarkan id
$pro = query("SELECT * FROM data_produk WHERE id = $id")[0];





//koneksi ke dbms
// $conn = mysqli_connect("localhost", "root", "", "phpdasar");
//require 'functions.php';


//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	//ambil data dari tiap elemen atau belum



	//query insert data

	//cek apakah data berhasil diubah/tdk
	if (ubah($_POST) > 0) {

		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'index.php';
			</script>
		";
	}
}



?>

<!DOCTYPE html>
<html>

<head>
	<title>ubah Data Produk</title>
</head>

<body>
	<h1>ubah data produk</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $pro["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $pro["gambar"]; ?>">
		<ul>
			<li>
				<label for="merk">Merk :</label>
				<input type="text" name="merk" id="merk" required="" value="<?= $pro["merk"]; ?>">
			</li>
			<li>
				<label for="tipe">Type :</label>
				<input type="text" name="tipe" id="tipe" required="" value="<?= $pro["tipe"]; ?>">

			</li>
			<li>
				<label for="jenis">Jenis kendaraan :</label>
				<input type="text" name="jenis" id="jenis" required="" value="<?= $pro["jenis"]; ?>">

			</li>
			<li>
				<label for="harga">Harga :</label>
				<input type="text" name="harga" id="harga" required="" value="<?= $pro["harga"]; ?>">
			</li>
			<li>
				<label for="gambar">gambar :</label><br>
				<img src="img/<?= $pro['gambar']; ?>" width="40"><br>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Ubah Data!</button>
			</li>

		</ul>



	</form>

</body>

</html>