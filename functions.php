<?php

//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "Honda");



function query($query)
{
	global $conn;

	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	return $rows;
}


function tambah($data)
{
	global $conn;

	$merk = htmlspecialchars($data["merk"]);
	$tipe = htmlspecialchars($data["tipe"]);
	$jenis = htmlspecialchars($data["jenis"]);
	$harga = htmlspecialchars($data["harga"]);

	//upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}


	$query = "INSERT INTO data_produk 
				VALUES
				('','$merk','$tipe','$jenis','$harga','$gambar')";
	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);
}


function upload()
{


	$nameFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	//cek apakah tidak ada gambar yang di upload
	if ($error === 4) {

		echo "<script>
				alert('pilih gambar terlebih dahulu!');

		       </script>";
		return false;
	}



	// cek apakah yg diupload gambar

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $nameFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {


		echo "<script>
				alert('yang anda upload bukan gambar!');

		       </script>";
		return false;
	}

	//cek jika ukursn nya terlalu besar
	if ($ukuranFile > 1000000) {

		echo "<script>
				alert('Ukuran gambar terlalu besar!');

		       </script>";
		return false;
	}


	//lolos pengecekan , gambar siap di upload
	// generate nama gambar baru

	$nameFileBaru = uniqid();
	$nameFileBaru .= '.';
	$nameFileBaru .= $ekstensiGambar;




	move_uploaded_file($tmpName, 'img/' . $nameFileBaru);
	return $nameFileBaru;
}





function hapus($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM data_produk WHERE id = $id");

	return mysqli_affected_rows($conn);
}


function ubah($data)
{
	global $conn;

	$id = $data["id"];
	$merk = htmlspecialchars($data["merk"]);
	$tipe = htmlspecialchars($data["tipe"]);
	$jenis = htmlspecialchars($data["jenis"]);
	$harga = htmlspecialchars($data["harga"]);

	$gambarLama = htmlspecialchars($data["gambarLama"]);

	//cek apakah user ubah gambar atau tidak
	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}



	$query = "UPDATE data_produk SET 
					merk = '$merk',
					tipe = '$tipe',
					jenis = '$jenis',
					harga = '$harga',
					gambar = '$gambar'


				WHERE id = $id;
					";
	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);
}

function cari($keyword)
{
	$query = "SELECT * FROM data_produk
					WHERE
					merk LIKE '%$keyword%'  OR 
					jenis LIKE '%$keyword%'  
					
					";
	return  query($query);
}
