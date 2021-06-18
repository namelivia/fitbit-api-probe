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
try {
	$activities = $fitbit->activities()->favorites()->get();
} catch (MissingCodeException $e) {
	echo("Retrieve auth token from:");
	echo($fitbit->getAuthUri());
}
write_output("result", [
	$activities
]);
