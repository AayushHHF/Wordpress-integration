<?php
// SOAP_CLIENT_BASEDIR - folder that contains the PHP Toolkit and your WSDL
// $USERNAME - variable that contains your Salesforce.com username (must be in the form of an email)
// $PASSWORD - variable that contains your Salesforce.com password
 

define("SOAP_CLIENT_BASEDIR", "soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforcePartnerClient.php');
require_once (SOAP_CLIENT_BASEDIR.'/SforceHeaderOptions.php');
require_once ('samples/userAuth.php');
try {
  $mySforceConnection = new SforcePartnerClient();
  $mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/partner.wsdl.xml');
  $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);
  $query = 'Select Name, BillingStreet, BillingCity, BillingState From Account limit 20';
  $response = $mySforceConnection->query($query);
  $queryResult = new QueryResult($response);
  for ($queryResult->rewind(); $queryResult->pointer < $queryResult->size; $queryResult->next()) {
    print_r($queryResult->current());
  }
} catch (Exception $e) {
  print_r($mySforceConnection->getLastRequest());
  echo $e->faultstring;
}
?>
