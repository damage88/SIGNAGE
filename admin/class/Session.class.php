<?php 
/**
* Pour gerer les sessions des differents utilisateurs
*/
class Session{

	public $styles = array('error'=>'error','success'=>'success','warning'=>'warn','information'=>'info');
	
	public function __construct(){
		//ini_set('session.gc_maxlifetime', 60);
		//session_save_path('/var/www/clients/client2956/web4328/web');
		session_start();		

	}

	public function checkSession($key_to_check_array = array('id')){	
		$errors = true;	
		foreach ($key_to_check_array as $key) {
			!isset($_SESSION['user'][$key]) ? $errors = false : null;
		}
		return $errors;
	}

	public function createCsrfToken(){
		if (!isset($_SESSION['csrf'])) {
      		//On génére un jeton totalement unique
        	$token = uniqid(rand(), true);
        	//Et on le stocke
        	$_SESSION['csrf'] = $token;
    	}
	}

	public function csrf(){ 
		//On enregistre aussi le timestamp correspondant au moment de la création du token		  
		//$_SESSION['token_time'] = time();
		return 'csrf='.$_SESSION['csrf'].''; 
	}

	public function checkCsrf(){
		if (!isset($_GET['csrf']) || $_GET['csrf'] != $_SESSION['csrf']) {
			//header("location:login.php");
			//flash('error','error',true,10);
			echo '<script>window.location = "login.php";</script>';
    		exit();
		}
	}

	public function set($name,$var){
		$_SESSION[$name] = $var;
	}

	
	public function setFlash($message,$type = 'error'){
		$_SESSION['flash'] = array(
							'message' => $message,
							'type' 	  => $type);
	}


	public function __flash(){
		if (isset($_SESSION['flash'])) {
			?>
			
			<section id="notification" class="notification container">
            	<div class="message <?= $_SESSION['flash']['type'] ?>">
            		<span>
            			<i class="fa fa-pencil"></i>
            		</span>
            		<p>
            			<?= $_SESSION['flash']['message'] ?>
            		</p>
            	</div>
       		</section>			 	
			
			<?php
			unset($_SESSION['flash']);
		}
	}



	public function flash(){
		if (isset($_SESSION['flash'])) {
			?>
			
			<!--<section id="notification" class="notification container">
            	<div class="message <?= $_SESSION['flash']['type'] ?>"><?= $_SESSION['flash']['message'] ?></div>
       		</section>-->

       		<!--<div class="uk-alert uk-alert-<?= $_SESSION['flash']['type'] ?>" uk-alert>
			    <a class="uk-alert-close" uk-close></a>
			    <p><?= $_SESSION['flash']['message'] ?></p>
			</div>-->

			<script>
       			Swal({
				  position: 'center-center',
				  type: '<?= $_SESSION['flash']['type'] ?>',
				  title: "<?= $_SESSION['flash']['message'] ?>",
				  showConfirmButton: true,
				  timer: 3500
				})
       		</script>			 	
			
			<?php
			unset($_SESSION['flash']);
		}
	}

	public function ___flash(){
		if (isset($_SESSION['flash'])) {
			?>

       		<script>
       			$.notify.defaults( {elementPosition: 'top center',  globalPosition: 'top center'} );
       			$.notify("<?= $_SESSION['flash']['message'] ?>","<?= $this->styles[$_SESSION['flash']['type']] ?>");
       		</script>		 	
			
			<?php
			unset($_SESSION['flash']);
		}
	}










}



