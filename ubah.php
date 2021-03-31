<?php
require 'functions.php';

$id = $_GET["id"];

$mhs = tampil("SELECT * FROM mahasiswa WHERE id = $id")[0];

if( isset( $_POST['submit'] ) ) {

	if( ubah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil diubah!')
				document.location = 'indeks.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data berhasil diubah!')
				document.location = 'indeks.php';
			</script>
		";
	}
}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>mengubah data</title>
</head>
<body>

<h1>Ubah Data Mahasiswa</h1>

<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $mhs['id']; ?>">
	<input type="hidden" name="gambarLama" value="<?= $mhs['gambar']; ?>">
	<ul>
		<li>
			<lable for='nama'>Nama :</lable>
			<input name='nama' type='text' id='nama' required value="<?= $mhs['nama']; ?>">
		</li>
		<li>
			<lable for='NIM'>NIM :</lable>
			<input name='NIM' type='text' id='NIM' required value="<?= $mhs['NIM']; ?>">
		</li>
		<li>
			<lable for='email'>Email :</lable>
			<input name='email' type='text' id='email' required value="<?= $mhs['email']; ?>">
		</li>
		<li>
			<lable for='jurusan'>Jurusan :</lable>
			<input name='jurusan' type='text' id='jurusan' required value="<?= $mhs['jurusan']; ?>">
		</li>
		<li>
			<lable for='gambar'>Gambar :</lable><br>
			<img src="img/<?= $mhs['gambar']; ?>" width='40'><br>
			<input name='gambar' type='file' id='gambar'>
		</li>
		<li>
			<button name='submit' type='submit'>ubah data!</button>
		</li>
	</ul>

</form>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>