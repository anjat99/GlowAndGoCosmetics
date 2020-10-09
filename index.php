<?php
 ob_start();
 session_start();


 require_once("setup/konekcija.php");
 require_once("modules/functions.php");
 require_once("modules/proizvodi/functions.php"); 
 

 
 require_once("views/head.php");
 require_once("views/nav.php");
 

if(isset($_GET['page'])){
	$page=$_GET['page'];
	switch($page){
		case 'home':
			
			require_once("views/pocetna.php");
			break;
		case 'kontakt':
			require_once("views/kontakt.php");
		 	break;
		case 'registracija':
			require_once("views/register.php");
			break;
		case 'login':
			require_once("views/login.php");
			break;
		case 'korisnik':
			require_once("modules/anketa/functions.php"); 
			require_once("views/korisnik.php");
			break;
		case 'shop':
			require_once("views/shop.php");
			break;
		case 'listazelja':
			require_once("views/wishlist.php");
			break;
		case 'korpa':
			require_once("views/korpa.php");
			break;
		case 'update-user':
			require_once("views/admin/korisnici/updateUser.php");
			break;
		default:
			require_once("views/pocetna.php");
			break;
	}
}else{
	
	require_once("views/pocetna.php");
}

	
   ?>

