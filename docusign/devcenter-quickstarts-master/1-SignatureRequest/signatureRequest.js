// Install NPM package or download source
// https://www.npmjs.com/package/docusign-node
var docusign = require('docusign-node');

var async = require('async');
var assert = require('assert');
var fs = require('fs');

var integratorKey = "INTEGRATOR_KEY";
var email = "EMAIL";
var password = "PASSWORD";

async.waterfall([
    // Initialize DocuSign Object with Integratory Key and Desired Environment
    function init (next) {
    docusign.init(integratorKey, 'demo', 'false', function (error, response) {
      var message = response.message;
      assert.strictEqual(message, 'successfully initialized');
      console.log(message);
      next(null);
    });
    },
    // Authenticate Yourself With DocuSign to Recieve an OAuth Token and BaseUrl
    function createClient(next) {
      docusign.createClient(email, password, function (error, response) {
        assert.ok(!response.error);
        docusign.client = response;
        next(null, docusign.client);
      });
    },
    // create and send envelope (signature request) 
    function requestSignature(client, next) {
        // configure the envelope's email subject and recipient(s)
        var emailSubject = "EMAIL_SUBJECT";
        var recipients = {};

        // add one signer to the envelope as well as one signHere tab located at
        // 100 pixels right and 150 pixels down from top left corner of document
        recipients.signers = [{
          'email': "RECIPIENT_EMAIL",
          'name': "RECIPIENT_NAME",
          'recipientId': 1,
          'tabs': {
            'signHereTabs': [{
              'xPosition': '100',
              'yPosition': '150',
              'documentId': '1',
              'pageNumber': '1'
            }]
          }
        }];

        // grab the document bytes of the document we want signed
        var document = fs.readFileSync("TEST.PDF");

        // add document information 
        var files = [{
          name: "test.pdf",
          extension: 'pdf',
          base64: new Buffer(document).toString('base64')
        }];

        // Send the envelope!
        client.envelopes.sendEnvelope(recipients, emailSubject, files, null, function (error, response) {
          assert.ok(!error);
          console.log('Envelope Information is: \n' + JSON.stringify(response) + "\n");
        });
    }
]);