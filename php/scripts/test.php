<?php
require_once(__DIR__."/../vendor/autoload.php");
require_once("utils.php");
use kamermans\OAuth2\Persistence\NullTokenPersistence;
use Namelivia\Fitbit\ServiceProvider;
use Namelivia\Fitbit\OAuth\MissingCodeException;
$fitbit = (new ServiceProvider())->build(
	new NullTokenPersistence(),
	getenv("FITBIT_CLIENT_ID"),
	getenv("FITBIT_CLIENT_SECRET"),
	getenv("FITBIT_REDIRECT_URL"),
);
$authCode = getenv("FITBIT_AUTH_CODE");
if (!empty($authCode)) {
	$fitbit->setAuthorizationCode($authCode);
}
try {
	$food = $fitbit->food()->foods()->search('mango');
	write_output("result", [
		$food
	]);
	echo("Success! Check the contents on php/output/result\n");
} catch (MissingCodeException $e) {
	echo("Retrieve auth token from:\n");
	echo($fitbit->getAuthUri() . "\n");
	echo("Place it to FITBIT_AUTH_CODE on .env and run again\n");
}
