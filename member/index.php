<?php
session_start();

  $user = "localhost";
  $name = "root";
  $pass = "";
  $dbname = "inventori3";
 
  $con = mysqli_connect($user,$name,$pass,$dbname);
 
  if (!$con){
    die ("Database Tidak Ada : " . mysqli_connect_error());
  }

  $kueri = mysqli_query($con, "SELECT * FROM users");
 
  $data = array ();
  while (($row = mysqli_fetch_array($kueri)) != null){
    $data[] = $row;
  }
    $cont = count ($data);
    $jml = "".$cont;

  $kueri2 = mysqli_query($con, "SELECT * FROM barang_masuk");
 
  $data2 = array ();
  while (($row = mysqli_fetch_array($kueri2)) != null){
    $data2[] = $row;
  }
    $cont2 = count ($data2);
    $jml2 = "".$cont2;


  $kueri3 = mysqli_query($con, "SELECT * FROM barang_keluar");
 
  $data3 = array ();
  while (($row = mysqli_fetch_array($kueri3)) != null){
    $data3[] = $row;
  }
    $cont3 = count ($data3);
    $jml3 = "".$cont3;

  $kueri4 = mysqli_query($con, "SELECT * FROM gudang");
 
  $data4 = array ();
  while (($row = mysqli_fetch_array($kueri4)) != null){
    $data4[] = $row;
  }
    $cont4 = count ($data4);
    $jml4 = "".$cont4;

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
              <a class="page-title">Beranda</a>
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

                    <li><a class="collapsible-header">Beranda<i class="material-icons">home</i></a></li>

                    <li>
                      <a class="collapsible-header">Menu<i class="material-icons">arrow_drop_down</i></a>
                      <div class="collapsible-body">
                        <ul>
                          <li><a href="user.php">User</a></li>
                  <li><a href="barangmasuk.php">SalesOrder</a></li>
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
        <div class="col s12 m12 l9 offset-l3">
          <!--content user-->
          <div class="col s12 m6 l6">
                    <div class="card blue-grey lighten-5">
                        <div class="card-content red-text text-darken-2">
                          <span class="card-title">User
                              <i class="medium material-icons left">supervisor_account</i>
                              <p class="right"><?php echo $jml; ?></p>
                          </span>
                        </div>
                        
                        <div class="card-action">
                          <i class="material-icons left red-text text-darken-2">visibility</i>
                          <a href="user.php" class="red-text text-darken-2">Lihat</a>
                        </div>
                    </div>
                  </div>

                  <!--content barang masuk-->
          <div class="col s12 m6 l6">
                    <div class="card blue-grey lighten-5">
                        <div class="card-content red-text text-darken-2">
                          <span class="card-title">SalesOrder
                              <i class="medium material-icons left">archive</i>
                              <p class="right"><?php echo $jml2; ?></p>
                          </span>
                        </div>
                        
                        <div class="card-action">
                          <i class="material-icons left red-text text-darken-2">visibility</i>
                          <a href="barangmasuk.php" class="red-text text-darken-2">Lihat</a>
                        </div>
                    </div>
                  </div>

                  <!--content Gudang-->
          <div class="col s12 m6 l6">
                    <div class="card blue-grey lighten-5">
                        <div class="card-content red-text text-darken-2">
                          <span class="card-title">Gudang
                              <i class="medium material-icons left">inbox</i>
                              <p class="right"><?php echo $jml4; ?></p>
                          </span>
                        </div>
                        
                        <div class="card-action">
                          <i class="material-icons left red-text text-darken-2">visibility</i>
                          <a href="gudang.php" class="red-text text-darken-2">Lihat</a>
                        </div>
                    </div>
                  </div>

                  <!--content barang Keluar-->
          <div class="col s12 m6 l6">
                    <div class="card blue-grey lighten-5">
                        <div class="card-content red-text text-darken-2">
                          <span class="card-title">Barang Keluar
                              <i class="medium material-icons left">inbox</i>
                              <p class="right"><?php echo $jml3; ?></p>
                          </span>
                        </div>
                        
                        <div class="card-action">
                          <i class="material-icons left red-text text-darken-2">visibility</i>
                          <a href="barangkeluar.php" class="red-text text-darken-2">Lihat</a>
                        </div>
                    </div>
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