// DocuSign imports
import com.docusign.esign.api.*;
import com.docusign.esign.client.*;
import com.docusign.esign.model.*;

// Additional imports
import java.util.List;
import java.util.ArrayList;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.io.IOException;
import java.util.Base64;

public class SignatureRequest {

	public static void main(String args[]) {
		
		// Enter your DocuSign credentials:
		String UserName = "[EMAIL]";
		String Password = "[PASSWORD]";    
		String IntegratorKey = "[INTEGRATOR_KEY]";

		// for production environment update to "www.docusign.net/restapi"
		String BaseUrl = "https://demo.docusign.net/restapi";

		// initialize the api client for the desired environment
		ApiClient apiClient = new ApiClient();
		apiClient.setBasePath(BaseUrl);

		// create JSON formatted auth header
		String creds = "{\"Username\":\"" +  UserName + "\",\"Password\":\"" +  Password + "\",\"IntegratorKey\":\"" +  IntegratorKey + "\"}";
		apiClient.addDefaultHeader("X-DocuSign-Authentication", creds);

		// assign api client to the Configuration object
		Configuration.setDefaultApiClient(apiClient);

		// create an empty list that we will populate with account(s)
		List<LoginAccount> loginAccounts = null;
		
		try
		{
			// login call available off the AuthenticationApi
			AuthenticationApi authApi = new AuthenticationApi();

			// login has some optional parameters we can set
			AuthenticationApi.LoginOptions loginOps = authApi.new LoginOptions();
			loginOps.setApiPassword("true");
			loginOps.setIncludeAccountIdGuid("true");
			LoginInformation loginInfo = authApi.login(loginOps);

			// note that a given user may be a member of multiple accounts
			loginAccounts = loginInfo.getLoginAccounts();

			System.out.println("LoginInformation: " + loginAccounts);
		}
		catch (com.docusign.esign.client.ApiException ex)
		{
			System.out.println("Exception: " + ex);
		}
		
		// specify a document we want signed
		String SignTest1File = "[PATH/TO/DOCUMENT/TEST.PDF]";

		// create a byte array that will hold our document bytes
		byte[] fileBytes = null;

		try
		{
			String currentDir = System.getProperty("user.dir");
			// read file from a local directory
			Path path = Paths.get(currentDir + SignTest1File);
			fileBytes = Files.readAllBytes(path);
		}
		catch (IOException ioExcp)
		{
			// handle error
			System.out.println("Exception: " + ioExcp);
			return;
		}

		// create an envelope that will store the document(s), tab(s), and recipient(s)
		EnvelopeDefinition envDef = new EnvelopeDefinition();
		envDef.setEmailSubject("[Java SDK] - Please sign this doc");

		// add a document to the envelope
		Document doc = new Document();  
		String base64Doc = Base64.getEncoder().encodeToString(fileBytes);
		doc.setDocumentBase64(base64Doc);
		doc.setName("TestFile.pdf");    // can be different from actual file name
		doc.setDocumentId("1");
		
		// create a list of docs and add it to the envelope
		List<Document> docs = new ArrayList<Document>();
		docs.add(doc);
		envDef.setDocuments(docs);

		// add a recipient to sign the document, identified by name, email, and recipientId
		Signer signer = new Signer();
		signer.setEmail("[SIGNER_EMAIL]");
		signer.setName("[SIGNER_NAME]");
		signer.setRecipientId("1");

		// create a signHere tab somewhere on the document for the signer to sign
		// default unit of measurement is pixels, can be mms, cms, inches also
		SignHere signHere = new SignHere();
		signHere.setDocumentId("1");
		signHere.setPageNumber("1");
		signHere.setRecipientId("1");
		signHere.setXPosition("100");
		signHere.setYPosition("150");

		// can have multiple tabs, so need to add to envelope as a single element list
		List<SignHere> signHereTabs = new ArrayList<SignHere>();
		signHereTabs.add(signHere);
		Tabs tabs = new Tabs();
		tabs.setSignHereTabs(signHereTabs);
		signer.setTabs(tabs);

		// add recipients (in this case a single signer) to the envelope
		envDef.setRecipients(new Recipients());
		envDef.getRecipients().setSigners(new ArrayList<Signer>());
		envDef.getRecipients().getSigners().add(signer);

		// send the envelope by setting |status| to "sent". To save as a draft set to "created"
		envDef.setStatus("sent");

		try
		{
			// use the |accountId| we retrieved through the Login API to create the Envelope
			String accountId = loginAccounts.get(0).getAccountId();
			
			// instantiate a new EnvelopesApi object
			EnvelopesApi envelopesApi = new EnvelopesApi();
			
			// call the createEnvelope() API to send the signature request!
			EnvelopeSummary envelopeSummary = envelopesApi.createEnvelope(accountId, envDef);
			
			System.out.println("EnvelopeSummary: " + envelopeSummary);
		}
		catch (com.docusign.esign.client.ApiException ex)
		{
			System.out.println("Exception: " + ex);
		}
		
	} // end main()
} // end class


