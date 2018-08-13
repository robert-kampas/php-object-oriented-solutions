<?php
require_once 'Pos/Validator.php';

if (filter_has_var(INPUT_POST, 'send')) {
	$missing = null;
	$errors = null;

	try {
		$required = array('name', 'email', 'comments');
		$val = new Pos_Validator($required);
		$val->checkTextLength('name', 3);
		$val->removeTags('name');
		$val->isEmail('email');
		$val->checkTextLength('comments', 10, 500);
		$val->useEntities('comments');

		$filtered = $val->validateInput();
		$missing = $val->getMissing();
		$errors = $val->getErrors();

		if (!$missing && !$errors) {
			// Everything passed validation.
			// The validated input is stored in $filtered.
		}
	} catch (Exception $e) {
		echo $e;
	}
}

if ($missing) {
	echo '<div class="warning">The following required fields have not been filled in:';
	echo '<ul>';
	foreach ($missing as $field) {
		echo "<li>$field</li>";
	}
	echo '</ul></div>';
}

/*if ($errors) {
	echo '<div class="warning">The following errors occured:';
	echo '<ul>';
	foreach ($errors as $error) {
		echo "<li>$error</li>";
	}
	echo '</ul></div>';
}*/

?>

<form id="form1" name="form1" method="post" action="">
	<strong>Name:</strong><br>
	<input type="text" name="name"><br>
	<strong>Email:</strong><br>
	<input type="email" name="email"><br>
	<strong>Comments:</strong><br>
	<textarea name="comments"></textarea><br>
	<input type="submit" name="send" value="Send comments">
</form>