<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function tampil($select) {
	global $conn;

	$result = mysqli_query($conn, $select);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data) {
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$NIM = htmlspecialchars($data["NIM"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	
	// upload gambar
	$gambar = upload();
	if( !$gambar ) {
		return false;
	}

	$query = "INSERT INTO mahasiswa
			VALUES
			('', '$nama', '$NIM', '$email', '$jurusan', '$gambar')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload() {

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tdk ada gambar yg diupload
	if( $error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu');
			</script>";
		return false;
	}

	// cek apakah yg diupload adlh gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
					alert('yang anda upload bukan gambar!');
				</script>";
		return false;
	}

	// cek jika ukuran terlalu besar
	if( $ukuranFile > 1000000 ) {
		echo "<script>
				alert('ukuran gambar terlalu besar');
			</scritpt>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// membuat nama file baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
	return $namaFileBaru;
}

function hapus($id) {
	global $conn;

	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function ubah($data) {
	global $conn;

	$id = $data['id'];
	$nama = $data['nama'];
	$nim = $data['NIM'];
	$email = $data['email'];
	$jurusan = $data['jurusan'];
	$gambarLama = $data['gambarLama'];

	// cek apakah user ilih gambar baru
	if( $_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$query = "UPDATE mahasiswa SET
			nama = '$nama',
			NIM = '$nim',
			email = '$email',
			jurusan = '$jurusan',
			gambar = '$gambar'
			WHERE id = $id
		";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function cari($keyword) {
	$query = "SELECT * FROM mahasiswa
				WHERE
				nama LIKE '%$keyword%' OR
				NIM LIKE '%$keyword%' OR
				email LIKE '%$keyword%' OR
				jurusan LIKE '%$keyword%'
			";
	return tampil($query);
}

 ?>