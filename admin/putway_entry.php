<?php session_start();
include_once("../config.php");
$result = mysqli_query($koneksi, "SELECT * FROM gudang ORDER BY kode_barang DESC");

if( !isset($_SESSION['admin']) )
{
  header('location:./../'.$_SESSION['akses']);
  exit();
}
$idRCV=$_GET['idrcv'];
$nama = ( isset($_SESSION['user']) ) ? $_SESSION['user'] : '';
$navSide = ( isset($_SESSION['navSide']) ) ? $_SESSION['navSide'] : '';

$resRCV=mysqli_query($koneksi,"select * from tbl_receiving where idrcv=".$idRCV);
	//kalau yang validasi sudah ketemu, pindahkan data ini ke table bawah
	$data_RCV = mysqli_fetch_array($resRCV); 
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
	    				<a class="page-title">PUT AWAY ENTRY</a>
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
									<!--<li><a href="barangmasuk.php">Barang Masuk</a></li>
									<li class="active red darken-4"><a>PUT AWAY</a></li>
									<li><a href="barangkeluar.php">PICKER</a></li>
								-->
								<?php echo $navSide;?>
								</ul>

							</div>
		                </li>
		            </ul>
	            </li>

	        </ul>
		</header>
		<!--end of header-->

		<!--content-->
		<main>
			<!--
				onsubmit="alert('submit!');return false" 
			-->
			<form method="post" action="control_data.php?form=putaway">
				<div class="row container">
					<div class="col s12 m12 l12 offset-l2"> <br>
						<!--kolom search-->
						<div class="col s12 m12 l12">						 
						</div>

						<!--table-->
						<div class="col s12 m12 l12 card-panel z-depth"> <br>
							<table class="highlight">
								<!--kolom header table-->							
								<tr>
									<td>Rcv. Number</td>
									<td>:</td>
									<td><input class="form-control" type="text" name="idData" value=<?php echo $idRCV; ?>></td>
									<td></td>
									<td>Kode Barang</td>
									<td>:</td>
									<td>isi_dari_db</td>
					            </tr>
					            <tr>
									<td>Tanggal</td>
									<td>:</td>
									<td><?php echo $data_RCV['tanggal']; ?></td>
									<td></td>
									<td>Nama Barang</td>
									<td>:</td>
									<td>isi_dari_db</td>
					            </tr>
					            <tr>
									<td>Lokasi Rencana</td>
									<td>:</td>
									<td>isi_dari_db</td>
									<td></td>
									<td>Jumlah</td>
									<td>:</td>
									<td><input class="form-control" type="text" name="kuantitas" value="">
									</td>
					            </tr>							
							</table>
						</div>

						<button type="Submit" class="btn btn-success" data-toggle="modal" data-target="#Tambah">Submit</button>
						<a class="btn btn-primary" href="gudang.php" role="button">Back to Menu</a>
					</div>
				</div>
			</form>
			<!-- pr kekurangan 
				1. ketika text brgmasuk berubah melakukan validasi 
				2. jika "true" next "sukses" , lalu ketikan "salah" kembali tanpa save -->

		</main>
        <!--end of content-->


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