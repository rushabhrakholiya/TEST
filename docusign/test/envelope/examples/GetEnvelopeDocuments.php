<?php
	
	require_once '../../../src/DocuSign_Client.php';
	require_once '../../../src/service/DocuSign_EnvelopeService.php';

	$client = new DocuSign_Client();
	if( $client->hasError() )
	{
		echo "\nError encountered in client, error is: " . $client->getErrorMessage() . "\n";
		return;
	}
	$service = new DocuSign_EnvelopeService($client);

	//TODO:
	$envelopeId = '545d5ff9-4f23-42c5-8111-cd1c5ff651ac';
// 	$envelopeId = 'ac8937a1-68af-4586-94c7-3cf49325faa3';		

	$response = $service->envelope->getEnvelopeDocuments($envelopeId);
	
	echo "\n-- Results --\n\n";
	print_r($response);
	
?>