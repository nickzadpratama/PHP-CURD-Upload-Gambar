<?php 
require "functions.php";


if( isset($_POST["submit"]) ) {

// cara cek data berhasil masuk ke database atau tidak
	if( tambah($_POST) > 0 ) {
		echo "
		<script>
			alert('data berhasil ditambah!')
			document.location = 'indeks.php';
		</script>
	";
	} else {
		echo "
		<script>
			alert('data gagal ditambah!')
			document.location = 'indeks.php';
		</script>
	";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>tambah data mahasiswa</title>
</head>
<body>
	<h1>Tambah Data Mahasiswa</h1>

	<form action="" method="post" enctype="multipart/form-data">
	<ul>
		<li>
			<label for="nama">Nama :</label>
			<input type="text" name="nama" id="nama" required>
		</li>
		<br>	
		<li>
			<label for="NIM">NIM :</label>
			<input type="text" name="NIM" id="NIM" required>
		</li>
		<br>
		<li>
			<label for="email">Email :</label>
			<input type="text" name="email" id="email" required>
		</li>
		<br>
		<li>
			<label for="jurusan">Jurusan :</label>
			<input type="text" name="jurusan" id="jurusan" required>
		</li>
		<br>
		<li>
			<label for="gambar">Gambar :</label>
			<input type="file" name="gambar" id="gambar" required>
		</li>
		<br>
		<li>
			<button type="submit" name="submit">Tambah data!</button>
		</li>
	</ul>
</form>

</body>
</html>