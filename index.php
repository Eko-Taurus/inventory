<?php
session_start();

if( isset($_SESSION['akses']) )
{
  header('location:'.$_SESSION['akses']);
  exit();
}

$error = '';
if( isset($_SESSION['error']) ) {

  $error = $_SESSION['error']; 

  unset($_SESSION['error']);
} ?>

<?php echo $error;?>
<!DOCTYPE html>
<html>
<head>
	<title>Masuk</title>
	<link rel="shortcut icon" href="images/icon.ico">
	<!--Import Google Icon Font-->
      <link href="fonts/material.css" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

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

	       body {
	          background: url(images/bg.jpg) no-repeat fixed;
	          -webkit-background-size: 100% 100%;
	          -moz-background-size: 100% 100%;
	          -o-background-size: 100% 100%;
	          background-size: 100% 100%;
	        }
	    </style>

</head>
<body>
	<div class="row" style="margin-top:10%;">
		<div class="container">
			<!--Form Login-->
			<form method="POST" action="check-login.php">
				<div class="col s12 m12 l6 offset-l3 card-panel z-depth white">
					<div class="card-title center">
						<h4>Masuk</h4>
					</div>

					<!--input text nama pengguna-->
					<div class="col s12 m12 l12 input-field e-input-field">
						<i class="material-icons prefix">account_circle</i>
						<input type="text" name="username" id="icon_prefix" class="validate">
						<label for="icon_prefix">Nama Pengguna</label>
					</div>

					<!--input text password-->
					<div class="col s12 m12 l12 input-field e-input-field">
						<i class="material-icons prefix">lock</i>
						<input type="password" name="password" id="icon_prefix" class="validate">
						<label for="icon_prefix">Kata Sandi</label>
					</div>

					<!--Button-->
					<div class="row">
						<div class="col s12 m12 l12 center">
							<input name="login" type="submit" value="Masuk" class="modal-action modal-close waves-effect waves-light btn red darken-2">
						</div>
                  	</div>

				</div>
			</form>
		</div>		
	</div>



	<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
        $( document ).ready(function(){
          Materialize.updateTextFields();
          $('.modal').modal();
        })
      </script>
</body>
</html>