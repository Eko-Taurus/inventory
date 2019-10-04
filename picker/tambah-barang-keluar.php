<?php session_start();
error_reporting(0);
include_once("../config.php");
$result = mysqli_query($koneksi, "SELECT * FROM barang_keluar ORDER BY kode_barang DESC");
$result2 = mysqli_query($koneksi, "SELECT * FROM gudang ORDER BY kode_barang DESC"); 


if( !isset($_SESSION['user']) )
{
	header('location:./../'.$_SESSION['akses']);
	exit();
}else{
	$nama = $_SESSION['user'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="shortcut icon" href="../images/icon.ico">
	<!--Import Google Icon Font-->
    <link href="../fonts/material.css" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style type="text/css">
	       /* label color */
	       .e-input-field label {
	         color: #000;
	       }
	       /* label focus color */
	       .e-input-field input[type=text]:focus + label,.e-input-field input[type=password]:focus + label {
	         color: #d32f2f !important;
	       }
	       /* label underline focus color */
	       .e-input-field input[type=text]:focus,.e-input-field input[type=password]:focus {
	         border-bottom: 1px solid #d32f2f !important;
	         box-shadow: 0 1px 0 0 #d32f2f !important;
	       }
	       /* valid color */
	       .e-input-field input[type=text].valid,.e-input-field input[type=password].valid {
	         border-bottom: 1px solid #d32f2f !important;
	         box-shadow: 0 1px 0 0 #d32f2f !important;
	       }
	       /* invalid color */
	       .e-input-field input[type=text].invalid,.e-input-field input[type=password].invalid {
	         border-bottom: 1px solid #d32f2f !important;
	         box-shadow: 0 1px 0 0 #d32f2f !important;
	       }
	       /* icon prefix focus color */
	       .e-input-field .prefix.active {
	         color: #d32f2f !important;
	       }
	    </style>
</head>
<body>
	<div class="row">
		<!--header-->
		<header>
			<!--TopNav-->
	        <nav class="row top-nav red darken-2">
	    		<div class="container">
	    			<div class="col offset-l2 nav-wrapper">
	    				<a href="#" data-activates="slide-out" class="button-collapse top-nav full hide-on-large-only"><i class="material-icons">menu</i></a>
	    				<a class="page-title">Input Barang Keluar</a>
	    			</div>
	    		</div>
			</nav>

			<!--Sidenav-->
			<ul id="slide-out" class="side-nav fixed">
	            
	            <li class="no-padding">
		            <ul class="collapsible collapsible-accordion">
		                <li>
		                	<div class="user-view">
		                    	<div class="background" style="margin-bottom:-15%;">
		                    		<img src="../images/bg.jpg">
		                    	</div>
		                		<span class="white-text name"><?php echo $nama; ?><i class="material-icons left">account_circle</i></span>
		                	</div>
		                </li>
		                
		                <li><div class="divider" style="margin-top:15%;"></div></li>

		                <li><a href="index.php" class="collapsible-header">Beranda<i class="material-icons">home</i></a></li>

		                <li>
		                	<a class="collapsible-header">Menu<i class="material-icons">arrow_drop_down</i></a>
		                	<div class="collapsible-body">
		                		<ul>
		                			<li class="active red darken-4"><a>User</a></li>
									<li><a href="barangmasuk.php">Barang Masuk</a></li>
									<li><a href="gudang.php">Gudang</a></li>
									<li><a href="barangkeluar.php">Barang Keluar</a></li>
								</ul>
							</div>
		                </li>
		                <li><a href="kontak.php" class="collapsible-header">Teams<i class="material-icons">contacts</i></a></li>


		                <li><a href="../logout.php" class="collapsible-header">Keluar<i class="material-icons">exit_to_app</i></a></li>

		            </ul>
	            </li>

	        </ul>
		</header>
		<!--end of header-->

		<!--content-->
		<main>
			<div class="row container">
				<div class="col s12 m12 l10 offset-l3"> <br>

					<!--table-->
				<form action="" method="post" name="form1">
					<div class="col s12 m12 l12 card-panel z-depth"> <br>
						<table class="highlight">
							<!--kolom isian table-->
							<tr>
				              <th>Kode Barang</th>
				              <th><input type="text" name="kode_barang" required></th>
				            </tr>
			              	<tr>
			                	<th>Nama Barang</th>
			                	<th><input type="text" name="nama_barang" required></th>
			              	</tr>
			              	<tr>
			                	<th>Tujuan</th>
			                	<th><input type="text" name="tujuan" required></th>
			              	</tr>
			              	<tr>
			                	<th>Tanggal Keluar</th>
			                	<th><input type="date" name="tanggal" required></th>
			              	</tr>
			              	<tr>
			                	<th>Petugas</th>
			                	<th><input type="text" name="operator" required></th>
			              	</tr>
						</table>
						<table>
				            <tr>
				            	<th>
				            		<input type="submit" name="tambah" value="Input Barang" class="right waves-effect waves-light btn green darken-2" style="float: left;">
				            	</th>
				            	<th style="width: 1%;">
				            		<a href="barangkeluar.php"><input type="button" value="Kembali" class="right waves-effect waves-light btn red darken-2"></a> 
				            	</th>
				            </tr>
				        </table>
					</div>
				</form>
				</div>
			</div>
		</main>
        <!--end of content-->

        <?php
 
          // Check If form submitted, insert form data into users table.
          if(isset($_POST['tambah'])) {
            $kode_barang = $_POST['kode_barang'];
            $name = $_POST['nama_barang'];
            $tujuan = $_POST['tujuan'];
            $tanggal = $_POST['tanggal'];
            $operator = $_POST['operator'];

            
            // include database connection file
            include_once("../config.php");
                
            // Insert user data into table
            $result = mysqli_query($koneksi, "INSERT INTO barang_keluar(kode_barang,nama_barang,tujuan,tanggal,operator) VALUES('$kode_barang','$name','$tujuan','$tanggal','$operator')");
            $result2 = mysqli_query($koneksi, "DELETE FROM gudang WHERE kode_barang=$kode_barang"); 
            
            echo "<script>alert('Tambah Barang Keluar Berhasil ! Kode Barang : $kode_barang') </script>";
          }
        ?>

        </div>

	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script type="text/javascript">
	  	$(document).ready(function(){
	    	$('.collapsible').collapsible();
	    	$(".button-collapse").sideNav();
		});
	</script>
</body>
</html>