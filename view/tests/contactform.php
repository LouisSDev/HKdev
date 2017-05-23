<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Contact Form</title>
	<!--[if IE]><script>
	$(document).ready(function() {

$("#form_wrap").addClass('hide');

})

</script><![endif]-->

</head>
<body>
<?php
/** @var User $user */
$user = $GLOBALS['view']['user'];
?>
	<div id="wrap">
		<h1>Send a message</h1>
		<div id='form_wrap'>
			<form>
				<p><?php echo $user->getFirstName()?></p>
				<label for="email">Votre message : </label>
				<textarea  name="message" value="Your Message" id="message" ></textarea>
				<p>Best,</p>
				<input type="text" name="lastName" value="" id="lastName" placeholder="Nom" />
                <input type="text" name="firstName" value="" id="firstName" placeholder="Prénom" />
				<input type="text" name="email" value="" id="email" placeholder="Adresse mail"/>
				<input type="submit" name ="submit" value="Envoyer" />
			</form>
		</div>
	</div>
<?php include_once ($GLOBALS['root_dir'] . "/view/general/footer.php");?>
</body>
</html>
