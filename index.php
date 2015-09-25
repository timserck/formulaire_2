<!DOCTYPE html>

<html lang="fr">
<head>

 <?php include('head.php');  ?>
        
</head>

	
	<body>
		<div class="container-fluid">



<div class="row">
<div class="col-md-3"></div>

        <div class="col-md-6" role="main">

 		 <div class="jumbotron">
  <h1>Recrutement des bleues</h1>
  <p>Le Cercle des étudiants de l’ ESIAJ recrute. Ils souhaitent publier une page résumant les bonnes raisons de devenir membre, avec un formulaire d’inscription. 
Ce formulaire sera, une fois validé par le client, transmis notamment par les réseaux sociaux mais également utilisé par les recruteurs du cercle lors de leurs démarches à l’école via leur smartphone.
</p>
  <p><a class="btn btn-primary btn-lg" href="https://github.com/timserck/formulaire_2" role="button">lien github</a></p>
</div>      


<?php 

function is_valid_email($email){			
return filter_var($email, FILTER_VALIDATE_EMAIL) ;
}


function nettoyage($value){
return trim(strip_tags($value));
}

if($_SERVER['REQUEST_METHOD'] === "POST" && $_POST){

		// echo "<pre>".print_r($_POST)."</pre>";


		// 1. nettoyage 


$email = nettoyage($_POST["email"]);

$prenom = nettoyage($_POST["prenom"]);
$nom = nettoyage($_POST["nom"]);

$add = nettoyage($_POST["add"]);
$ville = nettoyage($_POST["ville"]);
$commune = nettoyage($_POST["commune"]);
$question = nettoyage($_POST["question"]);

$honey = nettoyage($_POST["honey"]);


$error=false;

	// 2. validation (plus de post)
	if (!(is_valid_email($email))){
	echo "<div class='alert alert-danger alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>danger!</strong> Encode your email correctly.
</div>";
	$error = true;

	}
	//verfi des champs
	if ($prenom == '') {
echo  "<div class='alert alert-danger alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>danger!</strong> Encode your first name.
</div>";
	$error = true;
	}
	if ($nom == '') {
echo  "<div class='alert alert-danger alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>danger!</strong> Encode your second name.
</div>";
	$error = true;

	}

	if ($question == '') {
echo  "<div class='alert alert-danger alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>danger!</strong> Please answerd to the question.
</div>";
	$error = true;

	}
	if (!($honey == '')) {
		echo  "<div class='alert alert-danger alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>danger!</strong> Go back spammer your not welcome here.
</div>";
	$error = true;

	}

	if( $error == false ){
	
	

	$to = 'timserck@gmail.com';
	$sujet = 'new bleue';
	$message =  'Je suis '.$prenom.' '.$nom.'. Mon mail est'.$email.'. Je vie à '.$add.' '.$commune.' '.$ville.'. je veux devenir un bleu : '.$question;
	$send = mail($to, $sujet, $message);



	if ($send) {
	echo  "<div class='alert alert-success alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>Success!</strong> Message send.
</div>";

	} else{
 "<div class='alert alert-danger alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>danger!</strong> Somthing going wrong please try to send again the form.
</div>";
	}
	
	
	}
}	
			
?>


		<form method="POST" action="index.php">

		<fieldset class="form-group required" >
		<legend>Profil</legend>

		<div class="form-group">

			<div class="input-group">
  <label for="prenom" class="input-group-addon" id="basic-addon1">Prenom</label>
  <input type="text"  placeholder="Timothée" class="form-control"  id="prenom" name="prenom" type="text" required>
</div>
			
		</div>
			
<div class="form-group">
<div class="input-group">
			<label class="input-group-addon" id="basic-addon1" for="nom">Nom</label>
			<input  class="form-control"  placeholder="Serck" id="nom" name="nom" type="text" required>
</div>
</div>
<div class="form-group">
<div class="input-group">
			<label for="email" class="input-group-addon" id="basic-addon1" >email</label>
			<input id="email" class="form-control"  placeholder="timserck@gmail.com" name="email" type="email" required>
</div>
</div>
		</fieldset>


		<fieldset class="form-group">
		<legend>Adresse</legend>
		<div class="form-group">
		<div class="input-group">
			<label for="add" class="input-group-addon" id="basic-addon1">adresse</label>
			<input id="add" placeholder="48 av Charles-Quint" class="form-control" name="add" type="text">
		</div>
			</div>

			
		
		<div class="form-group">
		<div class="input-group">
			<label for="ville" class="input-group-addon" id="basic-addon1">ville</label>
			<input id="ville" placeholder="Wavre" class="form-control" name="ville" type="text">
		</div>

			</div>

		
			
			<div class="form-group">
			<div class="input-group">
				<label for="commune" class="input-group-addon" id="basic-addon1">commune</label>
			<input id="commune"  placeholder="Brabant Wallon" class="form-control" name="commune" type="text">
		</div>

			</div>

			

			</fieldset>
		<fieldset class="form-group required">

		<legend>Souhaites-tu devenir un "bleu" ?</legend>
			 <label class="radio-inline" for="q_1">
			<input type="radio" name="question" id="q_1" value="oui" required <?php if( $_POST['question']  && $_POST['question'] == 'oui' ){ echo 'checked="checked"';} ?>   >
			 oui
			 </label>
             
             <label class="radio-inline" for="q_2">
			<input type="radio" name="question" id="q_2" value="non"  <?php if( $_POST['question']  &&  $_POST['question'] == 'non' ){ echo 'checked="checked"';} ?> >
            non
            </label>
             
             <label class="radio-inline" for="q_3">
			<input type="radio" name="question" id="q_3" value="peut_etre"  <?php if( $_POST['question']  && $_POST['question'] == 'peut_etre' ){ echo 'checked="checked"';} ?> >           
             peut-etre
             </label>
             
		</fieldset>
	<fieldset class="form-group required">
			<input name="honey" class="honey" type="text">
		</fieldset>
<fieldset class="form-group">
<button  class="btn btn-primary">Come with us</button>

	</fieldset>			
		</form>
		 	<footer class="footer">
            <p class="text-muted"> © Timothée Serck -- B2G2.1</p>
        </footer>
		</div>
<div class="col-md-3"></div>

		</div>
		</div> <!-- container -->
		

	</body>
 		<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script>
	$( document ).ready(function() {
	if($('.alert').is(':visible')) {
    	

        setTimeout( function(){ $('.alert').fadeOut('slow'); }, 5000);

}
});
	</script>

</html>
