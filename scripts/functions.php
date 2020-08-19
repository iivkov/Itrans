<?php 
session_start();

$user_name = "";
$user_surname = "";
$user_personal_number = "";
$user_telephone = "";
$user_address = "";
$user_postal_code = "";
$user_town = "";
$user_country = "";
$email    = "";
$errors   = array(); 

$id_vehicle="";
$type="";
$set_up="";
$length="";
$width="";
$capacity="";

$departure_date="";
$departure_place="";
$arrival_date="";
$arrival_place="";
$order_info="";
include "connect.php";

if (isset($_POST['register_btn'])) {
	register();
}

// registracija korisnika
function register(){
	
	global $db, $errors, $email, $user_name, $user_surname, $user_personal_number, $user_telephone, $user_address, $user_postal_code, $user_town, $user_country;
	
	$email       =  mysqli_real_escape_string($db, $_POST['email']);
	$password_1  =  mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2  =  mysqli_real_escape_string($db, $_POST['password_2']);
	$user_name       =  mysqli_real_escape_string($db, $_POST['user_name']);
	$user_surname  =  mysqli_real_escape_string($db, $_POST['user_surname']);
	$user_personal_number  =  mysqli_real_escape_string($db, $_POST['user_personal_number']);
	$user_telephone       =  mysqli_real_escape_string($db, $_POST['user_telephone']);
	$user_address  =  mysqli_real_escape_string($db, $_POST['user_address']);
	$user_postal_code  =  mysqli_real_escape_string($db, $_POST['user_postal_code']);
	$user_town  =  mysqli_real_escape_string($db, $_POST['user_town']);
	$user_country  =  mysqli_real_escape_string($db, $_POST['user_country']);

	if (empty($user_name)) { array_push($errors, "Potrebno je unijeti ime."); }
  	if (empty($user_surname)) { array_push($errors, "Potrebno je unijeti prezime."); }
  	if (empty($email)){ array_push($errors, "Potrebno je unijeti adresu e-pošte."); }
  	if (empty($user_personal_number)) { array_push($errors, "Potrebno je unijeti OIB."); }
  	if (empty($user_telephone)) { array_push($errors, "Potrebno je unijeti broj telefona."); }
  	if (empty($user_address)) { array_push($errors, "Potrebno je unijeti adresu."); }
  	if (empty($user_postal_code)) { array_push($errors, "Potrebno je unijeti poštanski broj."); }
  	if (empty($user_town)) { array_push($errors, "Potrebno je unijeti mjesto."); }
  	if (empty($user_country)) { array_push($errors, "Potrebno je unijeti državu."); }
  	if (empty($password_1)) { array_push($errors, "Potrebno je unijeti zaporku."); }
  	if ($password_1 != $password_2) {
		array_push($errors, "Unesene zaporke se ne podudaraju.");
  	}

  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['email'] === $email) {
      array_push($errors, "Već je registriran korisnik s navedenim e-mailom.");
    }
  }

	
	if (count($errors) == 0) 
	{
		$password = md5($password_1);
		$query = "INSERT INTO users (email, password, user_name, user_surname, user_personal_number, user_telephone, user_address, user_postal_code, user_town, user_country) VALUES('$email', '$password', '$user_name', '$user_surname', '$user_personal_number', '$user_telephone', '$user_address', '$user_postal_code', '$user_town', '$user_country')";
		mysqli_query($db, $query);
		header('location: login.php');
	}
}

function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id_user=" . $id;
	$result = mysqli_query($db, $query);
	$user = mysqli_fetch_assoc($result);
	return $user;
}

function display_error() {
	global $errors;
	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// odjava
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

// poziv funkcije ako je kliknut
if (isset($_POST['login_btn'])) {
	login();
}

// prijava korisnika
function login()
{
	global $db, $email, $errors;
	
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	if (empty($email))
	{
		array_push($errors, "Potrebno je unijeti e-mail.");
	}
	if (empty($password))
	{
		array_push($errors, "Potrebno je unijeti zaporku.");
	}

	// prijava - provjera
	if (count($errors) == 0) 
	{
		$password = md5($password);
		$query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) 
		{ 	
			$logged_in_user = mysqli_fetch_assoc($results);
			$_SESSION['user'] = $logged_in_user;
			header('location: profile.php');
		}
		else
		{
			array_push($errors, "Uneseni su krivi podatci.");
		}
	}
}

// ...
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

function isCustomer()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'customer' ) {
		return true;
	}else{
		return false;
	}
}