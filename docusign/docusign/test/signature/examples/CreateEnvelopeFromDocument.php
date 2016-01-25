<?php
	
	require_once '../../../src/DocuSign_Client.php';
	require_once '../../../src/service/DocuSign_RequestSignatureService.php';
	require_once '../../../src/service/DocuSign_ViewsService.php';

	$client = new DocuSign_Client();
	if( $client->hasError() )
	{
		echo "\nError encountered in client, error is: " . $client->getErrorMessage() . "\n";
		return;
	}
	$service = new DocuSign_RequestSignatureService($client);

	//TODO:
	/*$emailSubject = 'Docusign';
	$emailBlurb = 'test@yopmail.com';	
	$documents = array( new DocuSign_Document("sample.pdf", "1", file_get_contents("../sample.pdf") ));
	$recipients = array( new DocuSign_Recipient( "1", "1", 'test', 'testing@yopmail.com'));
	$status = 'created'; // can be "created" or "sent"
	// optional
	$eventNotifications = array();

	$response = $service->signature->createEnvelopeFromDocument( $emailSubject,
																 $emailBlurb,
																 $status,
																 $documents,																 
																 $recipients,
																 $eventNotifications );
	
	echo "\n-- Results --\n\n";
	print_r($response);	*/

	//=======================================================================================================================
	// STEP 2: Create and Send Envelope API 
	//=======================================================================================================================

	/*$service = new DocuSign_RequestSignatureService($client);

	// Configure envelope settings, document(s), and recipient(s)
	$emailSubject = "Please sign my document";
	$emailBlurb = "This goes in the email body";	
	// create one signHere tab for the recipient
	$tabs = array( "signHereTabs" => array( 
		array( "documentId"=>"1","pageNumber" => "1","xPosition" => "100","yPosition" => "150" )));
	$recipients = array( new DocuSign_Recipient( "1", "1", "test", "test@yopmail.com", NULL, 'signers', $tabs));
	$documents = array( new DocuSign_Document("TEST.PDF", "1", file_get_contents("../sample.pdf") ));

	// "sent" to send immediately, "created" to save as draft in your account	
	$status = 'sent'; 

	//*** Send the signature request!
	$response = $service->signature->createEnvelopeFromDocument( 
		$emailSubject, $emailBlurb, $status, $documents, $recipients, array() );

	echo "\n-- Results --\n\n";
	print_r($response);*/


	// create service object and configure envelope settings, document(s), and recipient(s)
	$service = new DocuSign_RequestSignatureService($client);
	$emailSubject = "EMAIL_SUBJECT";
	$emailBlurb = "EMAIL_BLURB";	
		
	// add one signHere tab for the recipient located 100 pixels right and
	// 150 pixels down from the top left corner of document's first page
	$tabs = array( "signHereTabs" => array( 
		array( 	"documentId"=>"1",
			"pageNumber" => "1",
			"xPosition" => "100",
			"yPosition" => "150" )));
		
	// add a recipient and document to the envelope
	$recipients = array( new DocuSign_Recipient( "1", "1", "test", "testing@yopmail.com", NULL, 'signers', $tabs));
	$documents = array( new DocuSign_Document("TEST.PDF", "1", file_get_contents("../sample.pdf") ));
		
	// "sent" to send immediately, "created" to save as draft in your account	
	$status = 'sent'; 
		
	//*** Create and send the envelope with embedded recipient
	$response = $service->signature->createEnvelopeFromDocument( 
	$emailSubject, $emailBlurb, $status, $documents, $recipients, array() );

	$service = new DocuSign_ViewsService($client);
		
	// set the redirect URL for post signing and also the main auth method
	$returnUrl = "http://localhost/docusign/test/signature/examples/CreateEnvelopeFromDocument.php";
	$authMethod = "email";
			
	// use envelopeId from response to create envelope call
	$envelopeId = $response->envelopeId;	// response from step 2
			
	// request the Recipient View (aka signing URL)
	$response = $service->views->getRecipientView( 	$returnUrl, 
							$envelopeId, 
							"test", 
							"testing@yopmail.com",
							"101",
							$authMethod );
			
	echo "\nOpen the following URL in an iFrame to sign the document:\n\n";
	print_r($response);
	
?>
