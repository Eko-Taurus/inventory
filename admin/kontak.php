<?php session_start();
include_once("../config.php");
$result = mysqli_query($koneksi, "SELECT * FROM barang_keluar ORDER BY kode_barang DESC");

if( !isset($_SESSION['admin']) )
{
  header('location:./../'.$_SESSION['akses']);
  exit();
}

$nama = ( isset($_SESSION['user']) ) ? $_SESSION['user'] : '';

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
	    				<a class="page-title">Contact</a>
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
		                			<li><a href="user.php">User</a></li>
									<li><a href="barangmasuk.php">Barang Masuk</a></li>
									<li><a href="gudang.php">Gudang</a></li>
									<li><a href="barangkeluar.php">Barang Keluar</a></li>
								</ul>
							</div>
		                </li>
		                <li><a class="collapsible-header active red">Teams<i class="material-icons">contacts</i></a></li>

		                <li><a href="../logout.php" class="collapsible-header">Keluar<i class="material-icons">exit_to_app</i></a></li>

		            </ul>
	            </li>

	        </ul>
		</header>
		<!--end of header-->

		<!--content-->
		<main>
			<div class="row container"> <br><br>

					<div class="col s12 m12 offset-l2 l12 ">
						<center><h4>TEAMS</h4></center>
				        <div class="card-panel lighten-5 z-depth-1">
				          <div class="row valign-wrapper">
				            <div class="col s2">
				              <img src="../images/1.jpg" alt="Ilman Al Fatehah" class="circle responsive-img"> 
				            </div>
				            <div class="col s12">
				              <span class="black-text">
				                Ilman Al Fatehah
				              </span>
				            </div>
				            <div class="col s2">
				              <img src="../images/3.png" alt="Aris Ardiyanto" class="circle responsive-img"> 
				            </div>
				            <div class="col s12">
				              <span class="black-text">
				                Aris Ardiyan
				              </span>
				            </div>
				          </div>
				        </div>
				    </div>

				<div class="col s12 m12 l12 offset-l2"> <br> <br><br>

					
					<!-- Tabs -->
					<center><h4>Butuh Bantuan ?</h4></center><br>
					<div class="row">
					    <div class="col s12 ">
					      <ul class="tabs">
					        <li class="tab col s3"><a class="active" href="#test1">Facebook</a></li>
					        <li class="tab col s3 disabled"><a href="#test3">Line</a></li>
					        <li class="tab col s3"><a href="#test2">Email</a></li>
					      </ul>
					      <br>
					    </div>
					    <div id="test1" class="col s10 offset-l1 ">

					    	<!-- Content -->
				        <div class="card-panel lighten-5 z-depth-2">
				          <div class="row valign-wrapper">
				            <div class="col s2">
				              <img src="../images/1.jpg" alt="Ilman Al Fatehah" class="circle responsive-img"> 
				            </div>
				            <div class="col s12">
				              <span class="black-text">
				                <a href="https://www.facebook.com/Caca.Arini43" style="text-decoration: none;">Ilman Al Fatehah</a>
				              </span>
				            </div>
				            <div class="col s2">
				              <img src="../images/3.png" alt="Aris Ardiyanto" class="circle responsive-img"> 
				            </div>
				            <div class="col s12">
				              <span class="black-text">
				                <a href="https://www.facebook.com/arissardiyan" style="text-decoration: none;">Aris Ardiyan</a>
				              </span>
				            </div>
				          </div>
				      </div>
					    	<!-- End Content -->

					    </div>
					    <div id="test2" class="col s10 offset-l1">

					    	<!-- Content -->
				        <div class="card-panel lighten-5 z-depth-2">
				          <div class="row valign-wrapper">
				            <div class="col s2">
				              <img src="../images/1.jpg" alt="Ilman Al Fatehah" class="circle responsive-img"> 
				            </div>
				            <div class="col s12">
				              <span class="black-text">
				                <a href="mailto:ilmanvhadam43@gmail.com" style="text-decoration: none;">Ilmanvhadam43@gmail.com</a>
				              </span>
				            </div>
				            <div class="col s2">
				              <img src="../images/3.png" alt="Aris Ardiyanto" class="circle responsive-img"> 
				            </div>
				            <div class="col s12">
				              <span class="black-text">
				                <a href="mailto:72are.is@gmail.com" style="text-decoration: none;">72are.is@gmail.com</a>
				              </span>
				            </div>
				          </div>
				      </div>
					    	<!-- End Content -->

					    </div>
					    <div id="test3" class="col s12">
					    

					    </div>
  					</div>

					<!-- End Of Tabs -->
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