<?php


function cgminer($command, $parameter) {

	$command = array (
		"command"  => $command,
		"parameter" => $parameter
	);
	
	$jsonCmd = json_encode($command);

	$host = "127.0.0.1";
	$port = 4028;

	$client = stream_socket_client("tcp://$host:$port", $errno, $errorMessage);

	if ($client === false) {
		throw new UnexpectedValueException("Failed to connect: $errorMessage");
	}
	fwrite($client, $jsonCmd);
	$responce = stream_get_contents($client);
	fclose($client);
	$responce = preg_replace("/[^[:alnum:][:punct:]]/","",$responce);
	$responce = json_decode($responce, true);
	return $responce;

}

