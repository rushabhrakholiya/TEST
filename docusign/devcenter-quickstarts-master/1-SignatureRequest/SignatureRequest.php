<?php

// 
// DocuSign API Quickstart - Signature Request
// 

// Download PHP client:  https://github.com/docusign/DocuSign-PHP-Client
require_once './DocuSign-PHP-Client/src/DocuSign_Client.php';
require_once './DocuSign-PHP-Client/src/service/DocuSign_RequestSignatureService.php';

//=======================================================================================================================
// STEP 1: Login API 
//=======================================================================================================================

// client configuration
$testConfig = array(
	// Enter your Integrator Key, Email, and Password
	'integrator_key' => "INTEGRATOR_KEY", 'email' => "EMAIL", 'password' => "PASSWORD",
	// API version and environment (demo, www, etc)
	'version' => 'v2', 'environment' => 'demo'
);

// instantiate client object and call Login API
$client = new DocuSign_Client($testConfig);

if( $client->hasError() )
{
	echo "\nError encountered in client, error is: " . $client->getErrorMessage() . "\n";
	return;
}

//=======================================================================================================================
// STEP 2: Create and Send Envelope API 
//=======================================================================================================================

$service = new DocuSign_RequestSignatureService($client);

// Configure envelope settings, document(s), and recipient(s)
$emailSubject = "Please sign my document";
$emailBlurb = "This goes in the email body";	
// create one signHere tab for the recipient
$tabs = array( "signHereTabs" => array( 
	array( "documentId"=>"1","pageNumber" => "1","xPosition" => "100","yPosition" => "150" )));
$recipients = array( new DocuSign_Recipient( "1", "1", "RECIPIENT_NAME", "RECIPIENT_EMAIL", NULL, 'signers', $tabs));
$documents = array( new DocuSign_Document("TEST.PDF", "1", file_get_contents("/PATH/TO/DOCUMENT/TEST.PDF") ));

// "sent" to send immediately, "created" to save as draft in your account	
$status = 'sent'; 

//*** Send the signature request!
$response = $service->signature->createEnvelopeFromDocument( 
	$emailSubject, $emailBlurb, $status, $documents, $recipients, array() );

echo "\n-- Results --\n\n";
print_r($response);

?>