<?php
session_start();

# check apakah ada akse post dari halaman login?, jika tidak kembali kehalaman depan
if( !isset($_POST['username']) ) { header('location:index.php'); exit(); }

# set nilai default dari error,
$error = '';

require ( 'config.php' );

$username = trim( $_POST['username'] );
$password = trim( $_POST['password'] );

if( strlen($username) < 2 )
{
	# jika ada error dari kolom username yang kosong
	$error = "<script language='javascript'> alert('Username tidak boleh kosong'); </script>";
}else if( strlen($password) < 2 )
{
	# jika ada error dari kolom password yang kosong
	$error =  "<script language='javascript'> alert('Password tidak boleh kosong'); </script>";
}else{

	# Escape String, ubah semua karakter ke bentuk string
	$username = $koneksi->escape_string($username);
	$password = $koneksi->escape_string($password);
	$password =md5($password);

	# SQL command untuk memilih data berdasarkan parameter $username dan $password yang 
	# di inputkan
	#$sql = "SELECT nama, level FROM users 
	#		WHERE username='$username' 
	#		AND password='$password' LIMIT 1";
	$sql = "SELECT nama,hakakses from tbl_user where username ='$username' and password='$password' limit 1";
	# melakukan perintah
	$query = $koneksi->query($sql);

	# check query
	if( !$query )
	{
		die( 'Oops!! Database gagal '. $koneksi->error );
	}

	# check hasil perintah
	if( $query->num_rows == 1 )
	{	
		# jika data yang dimaksud ada
		# maka ditampilkan
		$row =$query->fetch_assoc();
		
		# data nama disimpan di session browser
		$_SESSION['user'] = $row['nama']; 
		//$_SESSION['akses']	   = $row['level'];
		$_SESSION['hakakses']	   = $row['hakakses'];//level
		
		#---MERUBAH KODE HAKAKSES SESUAI DIRECTORY
		$res="";		
		switch ($row['hakakses']) {
			case '1':
				$res='member';
				break;
			case '9':
				$res='admin';
				break;
			default:
				$res='member';
				break;
		}
		//
		//$_SESSION['navSide'] = $res;
		//next masukan semua bagian dalam sidebar
		//
		$navUser='<li><a href="user.php">User</a></li>';
		$navRCV='<li><a href="barangmasuk.php">Barang Masuk</a></li>';
		$navPA='<li><a href="gudang.php">PUT AWAY</a></li>';
		$navPicker='<li><a href="barangkeluar.php">PICKER</a></li>';
		$navSO='<li><a href="salesorder.php">SALES ORDER</a></li>';
		$navMR='<li><a href="MR.php">MR</a></li>';
		$_SESSION['navSide']=$navUser.$navRCV.$navPA.$navPicker.$navSO.$navMR;
		//
		$_SESSION['akses']	   = $res;//level
		//if( $row['level'] == 'admin')
		if ($res=='admin')
		{
			# data hak Admin di set
			$_SESSION['admin']= 'TRUE';
		}

		# menuju halaman sesuai hak akses
		header('location:'.$url.''.$_SESSION['akses'].'');
		exit();

	}else{
		
		# jika data yang dimaksud tidak ada
		$error = "<script language='javascript'> alert('Username atau password salah !'); </script>";
	}

}

if( !empty($error) )
{
	# simpan error pada session
	$_SESSION['error'] = $error;
	header('location:'.$url.'index.php');
	exit();
}
?>