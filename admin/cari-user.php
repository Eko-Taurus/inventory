<?php session_start();
include_once("../config.php");
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$result = mysqli_query($koneksi, "SELECT * FROM users ORDER BY nik DESC");

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
	    				<a class="page-title">Cari User</a>
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
		                			<li class="active red darken-4"><a href="user.php">User</a></li>
									<li><a href="barangmasuk.php">Barang Masuk</a></li>
									<li><a href="gudang.php">PUT AWAY</a></li>
									<li><a href="barangkeluar.php">PICKER</a></li>
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
						<form name="cari" method="post" action="" class="row">
	                    	<div class="e-input-field col s12 m12 l12">
	                    		<input type="text" name="cari" placeholder="Cari Berdasarkan Nama / NIK / Telepon / Status / Devisi / Loker " class="validate" required title="Cari User">
	                    		<input type="submit" name="cari2" value="cari" class="btn right red darken-2"> 
	                    	</div>
						</form>
					</div>

					<!--table-->
					<div class="col s12 m12 l12 card-panel z-depth"> <br>
						<table class="highlight">
							<!--kolom header table-->
							

							<?php 
			                    if(isset($_POST['cari2'])){
			                    $cari = $_POST['cari'];
			                    $pnjng = 100;
			                    $substr = substr($cari, 0, $pnjng).' ...';
			                    $sql = "SELECT * FROM users WHERE id LIKE '%$cari%' OR nik LIKE '%$cari%' OR nama LIKE '%$cari%' OR alamat LIKE '%$cari%' OR telepon LIKE '%$cari%' OR level LIKE '%$cari%' OR divisi LIKE '%$cari%' OR loker LIKE '%$cari%'";
			                    $query = mysqli_query($conn,$sql);


			                      if($data = mysqli_fetch_array($query)){
			                        $test = $data['nama'];

			                        echo "
			                        	<tr>
						                	<th hidden>ID</th>
											<th>NIK</th>
											<th>Nama</th>
											<th>Alamat</th>
											<th>Telepon</th>
											<th>Status</th>
											<th>Divisi</th>
											<th>LOKER</th>
											<th>Pengaturan</th>
							            </tr>
				            		";

			                        echo "<tr>";
			                        echo "<td hidden>".$data['id']."</td>";
			                        echo "<td>".$data['nik']."</td>";
			                        echo "<td>".$data['nama']."</td>";
					                $lenght = 15;
					                $alamat = $data['alamat'];
					                echo "<td>".substr($alamat, 0, $lenght).' ...'."</td>";
			                        echo "<td>".$data['telepon']."</td>";
			                        echo "<td>".$data['level']."</td>";
			                        echo "<td>".$data['divisi'];
			                        echo "<td>".$data['loker'];  
			                        echo "<td>  <a href='edit-user.php?id=$data[id]' style='text-decoration: none;'><i class='material-icons' title='Edit $test'>mode_edit</i></a> | <a data-id='1' class='hapus' href='delete.php?id=$data[id]' style='text-decoration: none;'><i class='material-icons' title='Hapus $test'>delete</i></a> | <a href='edit-password.php?id=$data[id]' style='text-decoration: none;'><i class='material-icons' title='Ganti Kata Sandi $test'>lock</i></a> </td></tr>";
			                        echo "</table>";
			                      }else{
			                      	echo "<table>";
			                        echo "<tr><td colspan='4'><center><h6><b>'$substr'</b> Tidak Ditemukan. Silahkan Periksa Kembali Keyword Anda</h6></center></td></tr>";
			                      }
			                    }
			                ?>

							
						</table>
						<table>
							<tr>
				            	<td colspan='9'>
				            		<a href='user.php' class="right waves-effect waves-light btn red darken-2">KEMBALI</a>
				            	</td>
				            </tr>
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
	<script>
        $(".hapus").click(function () {
        var jawab = confirm("Anda Yakin Ingin Menghapus User ?");
        if (jawab === true) {
        // konfirmasi
            var hapus = false;
            if (!hapus) {
                hapus = true;
                $.post('delete.php', {id: $(this).attr('data-id')},
                function (data) {
                    alert(data);
                });
                hapus = false;
            }
        } else {
            return false;
        }
        });
      </script>
</body>
</html>