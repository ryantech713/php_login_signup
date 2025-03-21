<?php
session_start();
// Point this constant to your includes directory location
define("INCLUDES_DIR","assets/includes/");

// Set the SITE_NAME constant
define("SITE_NAME","");

function test_input($data)
{
    $input = trim($data);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

function generateCSRFToken()
{
    if(!isset($_SESSION["csrf_token"])) {
        $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    }
}

function getEmailTemplate($filePath, $replacements = []) {
	if(!file_exists($filePath)) {
		return false;
	}
	$template = file_get_contents($filePath);

	foreach ($replacements as $key => $value) {
		$template = str_replace("{".$key."}", $value, $template);
	}
	return $template;
}