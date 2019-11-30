<?php
	include_once("../config.php");
	$form=$_GET['form'];
	//$idform=$_GET['idData'];



	if ($form=='putaway'){
		$idform=$_POST['idData'];
		$kuantitas=$_POST['kuantitas'];
		//VALIDASI
		$sql=mysqli_query($koneksi,"Select RCV.kuantitas-SUM(PA.kuantitas) as Sisa
from tbl_receiving RCV
LEFT Join tbl_putaway PA
on RCV.idrcv like PA.idrcv
where RCV.idrcv like ".$idform."
GROUP BY RCV.idrcv");
		while($res = mysqli_fetch_array($sql)){
			$sisa=$res['Sisa'];
		}		
		
		//if ($sql['Sisa']>=$kuantitas){
		if ($sisa>=$kuantitas){
			$sql=mysqli_query($koneksi,"Insert Into tbl_putaway (idrcv,kuantitas) values ('".$idform."','".$kuantitas."')");
		}else{
			$bl_error=true;
		}
		//debug
		//echo "idform: ".$idform;
		//echo "sisa: ".$sisa;//$sql['Sisa'];
		//echo "<br>kuantitas: ".$kuantitas;
	}
	//Jika sukses, kembali ke url yang manggil
	//jika error muncul pesan

if ($bl_error=="true"){
	$error =  "<script language='javascript'> alert('Password tidak boleh kosong'); </script>";	
	echo $error;
}
	header('location:'.$url.'index.php');
	exit();	

?>