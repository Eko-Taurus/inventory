<?php session_start();
include_once("../config.php");
//reff--> receiving
$result = mysqli_query($koneksi, "select RCV.idrcv, RCV.Tanggal, RCV.NoSurat, RCV.Kuantitas as MasukRCV, SUM(PA.Kuantitas) as ProsesPA, RCV.kuantitas-SUM(PA.kuantitas) as Sisa
from tbl_receiving RCV
LEFT Join tbl_putaway PA
on RCV.idrcv like PA.idrcv
GROUP BY RCV.idrcv
");

//Outstanding Putaway = Receiving-Putaway by barangmasuk.idrcv - putaway.idrcv

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
	    				<a class="page-title">MR</a>
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
		                			<!--<li><a href="user.php">User</a></li>
									<li><a href="barangmasuk.php">Barang Masuk</a></li>
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
						<form name="cari" method="post" action="cari-digudang.php" class="row">
	                    	<div class="e-input-field col s12 m12 l12">
	                    		<input type="text" name="cari" placeholder="Masukkan Kode Barang / Nama Barang / Pengirim / Penerima / Tanggal Terima" class="validate" required title="Cari User">
	                    		<input type="submit" name="cari2" value="cari" class="btn right red darken-2"> 
	                    	</div>
						</form>
					</div>

					<!--table-->
					<div class="col s12 m12 l12 card-panel z-depth"> <br>
						<table class="highlight">
							<!--kolom header table-->
							<tr>
			                  <th hidden>NO_PO</th>	
			                  	<th>
			                  		<li><a href="mr_entry.php">Supplier</a></li></th>
								<th>kode_barang</th>
								<th>nama barang</th>
								<th>IDXPO</th>
								<th>Jumlah</th>
								<th>Terkirim</th>
								<th>Belum Terkirim</th>
				            </tr>

							<?php 

							//while($user_data = mysqli_fetch_array($result)) { 
			                //    $test = $user_data['nama_barang'];      
				            //    echo "<tr>";
			                //    echo "<td hidden>".$user_data['id']."</td>";
				            //    echo "<td>".$user_data['kode_barang']."</td>";
				            //    echo "<td>".$user_data['nama_barang']."</td>";
				            //    echo "<td>".$user_data['pengirim']."</td>";
			                //    echo "<td>".$user_data['tanggal']."</td>"; 
			                //    echo "<td>".$user_data['penerima']."</td>";    
				            //    echo "</tr>";  
				            //}
							while($OSPutaway=mysqli_fetch_array($result))
							{
								echo "<tr>";
									echo "<td><li><a href=mr_entry.php?idrcv=".$OSPutaway['idrcv'].">".$OSPutaway['idrcv']."</a></li></td>";
									echo "<td>".$OSPutaway['Tanggal']."</td>";
									echo "<td>".$OSPutaway['NoSurat']."</td>";
									echo "<td>".$OSPutaway['MasukRCV']."</td>";
									echo "<td>".$OSPutaway['ProsesPA']."</td>";
									echo "<td>".$OSPutaway['Sisa']."</td>";
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