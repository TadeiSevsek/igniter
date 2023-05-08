<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login');
	}

	public function login(){
		$this->load->database();
		//if logged in to store
		$this->load->view('login');
	}

	public function register(){
		$this->load->view('register');
	}
	public function store(){
		$this->load->model('baza');
		$data = $this->baza->allGames();
		$sez['igre'] = $data->result();
		$data = $this->baza->featuredGames();
		$sez['featured'] = $data->result();
		$data = $this->baza->sportGames();
		$sez['sport'] = $data->result();
		$data = $this->baza->actionGames();
		$sez['action'] = $data->result();
		$data = $this->baza->shooterGames();
		$sez['shooter'] = $data->result();
		$this->load->view('store',$sez);
		
	}
	public function registracija(){
		$this->load->model('baza');
		$username=$_POST['username'];
		$pass=$_POST['pass'];
		$cpass =$_POST['conPass'];
		$email = $_POST['email'];
		$rezultat=$this->baza->preveriUporabnika($username,$email);
		if($pass != $cpass){ //preveri če sta vnesena gesla enaka
			$error['error'] = "passwords do not match!";
			$this->load->view('register',$error);
			
		}else if(!empty($rezultat->result())){
			$error['error'] = "user already exists!";
			$this->load->view('register',$error);

		}else{
			$pass = md5($pass);
			$this->baza->novUporabnik($username,$email,$pass);
			$this->load->view('login');
		}

		
	}

	public function preveriLogin(){
		$this->load->model('baza');
		$username=$_POST['username'];
		$pass=$_POST['pass'];
		$pass = md5($pass);
		$rezultat=$this->baza->preveriUporabnika($username,$username);
		if(!empty($rezultat->result())){
			if($pass== $rezultat->row()->password){
				$username = $rezultat->row()->username;
				$balance = $rezultat->row()->balance;
				$userid= $rezultat->row()->iduser;
				$this->session->set_userdata('username',$username);
				$this->session->set_userdata('balance',$balance);
				$this->session->set_userdata('userid',$userid);
				if($rezultat->row()->userType =="admin"){
					$this->session->set_userdata('vrstaRacuna','admin');	
				}else{
					$this->session->set_userdata('vrstaRacuna','user');
				}
				$data = $this->baza->allGames();
				$sez['igre'] = $data->result();
				$data = $this->baza->featuredGames();
				$sez['featured'] = $data->result();
				$data = $this->baza->sportGames();
				$sez['sport'] = $data->result();
				$data = $this->baza->actionGames();
				$sez['action'] = $data->result();
				$data = $this->baza->shooterGames();
				$sez['shooter'] = $data->result();
				$_SESSION['cart']= array();
				$this->load->view('store',$sez);
			}else{
				$error['error'] = "password is incorrect";
			$this->load->view('login',$error);
			}
		}else{
			$error['error'] = "user does not exist!";
			$this->load->view('login',$error);
		}

		
	}
	public function rezultati(){
		$this->load->model('baza');
		$game= $_POST['search'];
		$rezultat=$this->baza->filterGame($game);
		$sez['igre'] = $rezultat->result();
		$this->load->view('results',$sez);


		
	}
	public function  library(){
		$this->load->model('baza');
		$rezultat=$this->baza->ownedGames($_SESSION['userid']);
		$sez['igre'] = $rezultat->result();
		$this->load->view('library',$sez);
	}

	public function libFilter(){
		$this->load->model('baza');
		$game= $_POST['search'];
		$rezultat=$this->baza->libFilter($game,$_SESSION['userid']);
		$sez['igre'] = $rezultat->result();
		$this->load->view('libFilter',$sez);
	}

	public function addFunds(){
		$this->load->view('addFunds');
	}

	public function credit(){
		$this->session->set_userdata('money',$_POST['money']);
		$this->load->view('credit');
	}

	public function preveriCredit(){
		
		$this->load->model('baza');
		$cardDate = DateTime::createFromFormat('m/y', $_POST['exp']);
		$cardNumber=md5( $_POST['stKartice']);
		$cvv = $_POST['cvv'];
		$name = $_POST['uporabnik'];
		$rezultat=$this->baza->preveriCredit($cardNumber);
		if(!empty($rezultat->result())){
			if($cardDate->format('m/y')!=$rezultat->row('exp') ||  $cvv!= $rezultat->row('cvv') || $name != $rezultat->row('name')){
				$error['error'] = "The information is incorect.";         // in če se podatki ne ujemejo ga zavže
				$this->load->view('credit',$error);
			}else{
				$balance= $_SESSION['balance'];
								$ime= $_SESSION['username'];
								$sestevek=$balance+$_SESSION['money'];
								
								$this->session->set_userdata('balance',$sestevek);
								$_SESSION['balance']=$sestevek;
								$this->baza->updateUser($ime,$sestevek);
								$this->store();
			}
		}else{
			$currentDate = new DateTime('now');
			$check = "false";
			$interval = $currentDate->diff($cardDate);
			if ( $interval->invert == 1 ) {    //če teh podatkov nimamo preverimo ali je kartica še veljavna 
			
				$error['error'] = "The card is expired.";
				$this->load->view('credit',$error);
			}
			if(strlen($_POST['cvv'])==3 || strlen($_POST['cvv'])==4){       // preverimo ali je cvv prave dolžine 
				for($i=0;$i<strlen($_POST['cvv']);$i++){
					if($_POST['cvv'][$i] != 0 && $_POST['cvv'][$i] != 1 && $_POST['cvv'][$i] != 2 && $_POST['cvv'][$i] != 3 && $_POST['cvv'][$i] != 4 && $_POST['cvv'][$i] != 5 && $_POST['cvv'][$i] != 6 && $_POST['cvv'][$i] != 7 && $_POST['cvv'][$i] != 8 && $_POST['cvv'][$i] != 9){
						$check = "true"; //prevrimo da so v cvv samo števike
					}
				}
				if($check == "true"){
					$error['error'] = "cvv must only contain numbers.";
					$this->load->view('credit',$error);
				}else{
					$prefix=$_POST['stKartice'][0].$_POST['stKartice'][1]; //vzamemo prve dve števke in glede tega ločimo katera kartica je

					$sum=0;
					$double= "";


					if($prefix[0]==4){
						//visa
						if(strlen($_POST['stKartice']) != 13 && strlen($_POST['stKartice']) != 16){
							$error['error'] = "card number is wrong.";
							$this->load->view('credit',$error);
						}else{
						for($i=0;$i<strlen($_POST['stKartice']);$i++){ //luhn algoritem zacetek 
							if($i%2==0){
								if(strlen($_POST['stKartice'][$i]*2)==2){
									$double=strval($_POST['stKartice'][$i]*2) ;
									$sum+=$double[0]+$double[1];
								}else{
									$sum+=$_POST['stKartice'][$i]*2;
								}
							}else{
								$sum+=$_POST['stKartice'][$i];
							}
						}if($sum%10==0){ // luhn algoritem konec
							$balance= $_SESSION['balance']; 
							$ime= $_SESSION['username'];
							$sestevek=$balance+$_SESSION['money'];
							$cardDate = $cardDate->format("m/y");
							$this->baza->insertCard($name,$cardNumber,$cardDate,$cvv);
							$this->session->set_userdata('balance',$sestevek);
							$_SESSION['balance']=$sestevek;
							$this->baza->updateUser($ime,$sestevek);
							$this->store();
						}
						
						else{
						   $error[] = "card number is wrong. ";
						}
						}
						
					}elseif($prefix==51 || $prefix==52 ||$prefix==53 || $prefix==54 || $prefix==55){
						if(strlen($_POST['stKartice']) != 13 || strlen($_POST['stKartice']) != 16){
							$error['error'] = "card number is wrong.";
							$this->load->view('credit',$error);
					}else{
					
						for($i=0;$i<strlen($_POST['stKartice']);$i++){
							if($i%2==0){
								if(strlen($_POST['stKartice'][$i]*2)==2){
									$double=strval($_POST['stKartice'][$i]*2) ;
									$sum+=$double[0]+$double[1];
								}else{
									$sum+=$_POST['stKartice'][$i]*2;
								}
							}else{
								$sum+=$_POST['stKartice'][$i];
							}
						}if($sum%10==0){
							$balance= $_SESSION['balance'];
							$ime= $_SESSION['username'];
							$sestevek=$balance+$_SESSION['money'];
							
							$cardDate = $cardDate->format("m/y");
							$this->baza->insertCard($name,$cardNumber,$cardDate,$cvv);
							$this->session->set_userdata('balance',$sestevek);
								$_SESSION['balance']=$sestevek;
								$this->baza->updateUser($ime,$sestevek);
								$this->store();
						}
						
						else{
						   $error['error'] = "card number is wrong. ";
						   $this->load->view('card',$error);
						}
						
					
					}
					}
					elseif($prefix == 34 || $prefix == 37){
						//amex
						if(strlen($_POST['stKartice']) != 15){
							$error['error'] = "card number is wrong.";
							$this->load->view('card',$error);
						}else{
							$balance= $_SESSION['balance'];
								$ime= $_SESSION['username'];
								$sestevek=$balance+$_SESSION['money'];
								
								$cardDate = $cardDate->format("m/y");
								$this->baza->insertCard($name,$cardNumber,$cardDate,$cvv);
								$this->session->set_userdata('balance',$sestevek);
								$_SESSION['balance']=$sestevek;
								$this->baza->updateUser($ime,$sestevek);
								$this->store();
		;                }
					}else{
						$error['error'] = "card number is wrong or unsupported.";
						$this->load->view('credit',$error);
					}
				}
				
				


		}else{
			$error['error'] = "cvv is incorrect.";
			$this->load->view('credit',$error);
		}
		}
	}

	public function addGames(){
		$this->load->view('addGames');
	}

	public function upload(){
		$this->load->model('baza');
		$dat = $_FILES['file-upload'];
		$datName=$dat['name'];
		$datTmpName=$dat['tmp_name'];
		$datError=$dat['error'];
		 echo ($datPath);
		if($datError == 0){
			$datPath = pathinfo($datName, PATHINFO_EXTENSION); //dobi pot coverimga 
			$novIme= uniqid("",true).".".$datPath; //generira novo random ime
			$pot = "uploads/".$novIme;
			move_uploaded_file($datTmpName,$pot); //premakne datoteko na to pot
			if($_POST['price'] == 0){ //če je cena niš shrani display ceno kot free drugače pa $+cena
				$displayPrice = "free";
			}else{
	
				$dat = $_FILES['file-upload2'];
				$ime =$dat['name'];
				move_uploaded_file($dat['tmp_name'],"uploads/".$ime );
				$displayPrice = $_POST['price'].'$';
			}
			$dat = $_FILES['file-upload2'];
			$ime =$dat['name'][0];
			$tmp = $dat['tmp_name'][0];
			print_r($dat);
			move_uploaded_file($tmp,"uploads/".$ime );
			$name = $_POST['name'];
			$description = $_POST['description'];
			$price = $_POST['price'];
			$genre = $_POST['genre'];
			$datePublished=$_POST['date'];
			$developer = $_POST['developer'];
			$studio = $_POST['studio'];
			$exe = $ime;
			$this->baza->uploadGame($name,$description, $novIme,$exe,$displayPrice,$price,$datePublished,$genre,$developer,$studio);
			$rezultat = $this->baza->gameid();
			$idGame = $rezultat->row('idgame');
			$slike =$_FILES['file-upload1'];
   			 $stslik = count($slike['name']);

					
			for($i=0;$i<$stslik;$i++){
			$slikeName=$slike['name'][$i];
			$slikeTmpName=$slike['tmp_name'][$i];
			$slikeError=$slike['error'][$i];
			if($slikeError == 0){
				$slikePath = pathinfo($slikeName, PATHINFO_EXTENSION);
				echo $slikePath;
				$novIme= uniqid("",true).".".$slikePath;
				
				$pot = "uploads/".$novIme;
				move_uploaded_file($slikeTmpName,$pot);
				$this->baza->uploadImg($novIme,$idGame);
				$this->store();
				
				
			
			}
			
			}




	}
}

public function featuredGames(){
	$this->load->model('baza');
	$data = $this->baza->allGames();
	$sez['igre'] = $data->result();
	$this->load->view('featuredGames',$sez);

}

public function editFeatured(){

	$this->load->model('baza');
	foreach($_SESSION['featured'] as $row){
		if(filter_has_var(INPUT_POST, 'check'.$row->idgame)){
			$this->baza->check($row->idgame);
		}else{
			$this->baza->uncheck($row->idgame);
		}

	}

	$this->store();
}



public function logout(){
	unset($_SESSION['userid']);
	unset($_SESSION['balance']);
	unset($_SESSION['username']);
	unset($_SESSION['money']);
	unset($_SESSION['featured']);
	unset($_SESSION['gameid']);
	unset($_SESSION['owned']);
	unset($_SESSION['cart']);
	$this->login();
}

public function gamepage(){
	$this->load->model('baza');
	$id= $_POST['submit'];
	$userid = $_SESSION['userid'];
	$this->session->set_userdata('gameid',$id);
	$data = $this->baza->gameInfo($id);
	$sez['info'] = $data->result();
	$data = $this->baza->gameImgs($id);
	$sez['img'] = $data->result();
	$data = $this->baza->gameComments($id);
	$sez['comment'] = $data->result();
	$data = $this->baza->owned($id, $userid);

	if(!empty($data->result())){
		$this->session->set_userdata('owned',1);
	}else{
		$this->session->set_userdata('owned',0);
	}
	$this->load->view('gamepage',$sez);
}

public function refresh(){
	$this->load->model('baza');
	$id= $_SESSION['gameid'];
	$this->session->set_userdata('gameid',$id);
	$data = $this->baza->gameInfo($id);
	$sez['info'] = $data->result();
	$data = $this->baza->gameImgs($id);
	$sez['img'] = $data->result();
	$data = $this->baza->gameComments($id);
	$sez['comment'] = $data->result();
	$data = $this->baza->owned($gameid, $userid);


	$this->load->view('gamepage',$sez);
}

public function comment(){
	$this->load->model('baza');
	$comment = $_POST['comment'];
	$rating = $_POST['rating'];
	$rating-=6;
	$userid = $_SESSION['userid'];
	$gameid= $_SESSION['gameid'];
	$this->baza->insertComment($comment,$rating,$userid,$gameid);
	$this->refresh();
}

public function cart(){
	$this->load->model('baza');
	$ids="";
	for ($i =0;$i<count($_SESSION['cart']);$i++){
		if($i!=count($_SESSION['cart'])-1){
			$ids.= $_SESSION['cart'][$i]."','";
		}else{
			$ids.= $_SESSION['cart'][$i];
		}
		
	}
	$data=$this->baza->cartGames($ids);
	$sez['cart'] = $data->result();
	$this->load->view('cart',$sez);
}

public function addToCart(){
	$_SESSION['cart'][count($_SESSION['cart'])]= $_SESSION['gameid'];
	$this->refresh();
}

public function removeFromCart(){
	$id = $_POST['remove'];
	$temp = array();
	for ($i =0;$i<count($_SESSION['cart']);$i++){
		if($_SESSION['cart'][$i]!=$id){
			$temp[count($temp)]= $_SESSION['cart'][$i];
		}
	}
	$_SESSION['cart']=$temp;
	$this->cart();

}

public function addToLibrary(){
	$this->load->model('baza');
	$id = $_SESSION['userid'];
	$money= $_POST['submit'];
	$balance = $_SESSION['balance'];
	$money = rtrim($money,'$');
	if($balance<$money){
		$ids="";
		for ($i =0;$i<count($_SESSION['cart']);$i++){
			if($i!=count($_SESSION['cart'])-1){
				$ids.= $_SESSION['cart'][$i]."','";
			}else{
				$ids.= $_SESSION['cart'][$i];
			}
			
		}
		$data=$this->baza->cartGames($ids);
		$sez['cart'] = $data->result();
		$sez['error']="not enough money!";
		$this->load->view('cart',$sez);
		}	
		$balance-=$money;
		$this->baza->updateBalance($id,$balance);
		for ($i =0;$i<count($_SESSION['cart']);$i++){
			$this->baza->updateOwned($id,$_SESSION['cart'][$i]);
		}
		
		$_SESSION['cart']=array();
		$this->library();
	}




}