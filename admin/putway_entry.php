<?php session_start();
include_once("../config.php");
$result = mysqli_query($koneksi, "SELECT * FROM gudang ORDER BY kode_barang DESC");

if( !isset($_SESSION['admin']) )
{
  header('location:./../'.$_SESSION['akses']);
  exit();
}

$nama = ( isset($_SESSION['user']) ) ? $_SESSION['user'] : '';
$navSide = ( isset($_SESSION['navSide']) ) ? $_SESSION['navSide'] : '';

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
								<td>isi_dari_db</td>
								<td></td>
								<td>Kode Barang</td>
								<td>:</td>
								<td>isi_dari_db</td>
				            </tr>
				            <tr>
								<td>Tanggal Rcv</td>
								<td>:</td>
								<td>isi_dari_db</td>
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
								<td>isi_dari_db</td>
				            </tr>							
						</table>
					</div>

					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#Tambah">Tambah Baris</button>

					<div id="Tambah" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
							         <h4 class="modal-title"> Tambah Baris</h4>		
					      </div>
					      <form method="post" enctype="multipart/form-data">
					      	<div class="modal-body">
					      		<div class="form-group">
					      			<label class="control-label" for="Lokasi">Lokasi</label>
					      			<input type="text" name="Lokasi" class="form-control" id="Lokasi" required>
					      		</div>
					      		<div class="form-group">
					      			<label class="control-label" for="Jumlah">Jumlah</label>
					      			<input type="text" name="Jumlah" class="form-control" id="Jumlah" required>
					      		</div>
					      	</div>
					      	<div class="form-footer">
					      		<button type="reset" class="btn btn-danger">Reset</button>
					      		<input type="submit" class="btn btn-success" name="Tambah" value="simpan">
					      	</div>
					      </form>
					  </div>		
					</div>
				</div>	

					<!--table-->
					<div class="col s12 m12 l12 card-panel z-depth"> <br>
						<table class="highlight">
							<!--kolom header table-->
							<tr>
			                  <th hidden>IDXRCV</th>	
			                  	<th>OP_RCV</th> 
			                  	<th>Kode Barang</th>
								<th>Lokasi Rencana</th>
								<th>Nama Barang</th>
								<th>Jumlah</th>
							
				            </tr>

							<?php 

							while($user_data = mysqli_fetch_array($result)) { 
			                    $test = $user_data['nama_barang'];      
				                echo "<tr>";
			                    echo "<td hidden>".$user_data['id']."</td>";
				                echo "<td>".$user_data['kode_barang']."</td>";
				                echo "<td>".$user_data['nama_barang']."</td>";
				                echo "<td>".$user_data['pengirim']."</td>";
			                    echo "<td>".$user_data['tanggal']."</td>"; 
			                    echo "<td>".$user_data['penerima']."</td>";    
				                echo "</tr>";  
				            }

							?>
							
						</table>
					</div>
				</div>
			</div>
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