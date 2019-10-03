<?php

 $dbhost = 'localhost';
 $dbuser = 'root';
 $dbpass = '';
 $dbname = 'inventori3';
 
 $koneksi = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
 
 if( $koneksi->connect_error )
 {
 	die( 'Oops!! Koneksi Gagal : '. $koneksi->connect_error );
 }
 ?>
