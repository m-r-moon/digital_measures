<?php

$user = 'YOUR USERNAME';
$password ='YOUR PASSWORD';
 
 
$curl = curl_init();
curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://webservices.digitalmeasures.com/login/service/v4/User',
        CURLOPT_USERPWD => $user . ':' . $password,
        CURLOPT_ENCODING => 'gzip',
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_RETURNTRANSFER => true));
$responseData = curl_exec($curl);
if(curl_errno($curl))
{
  $errorMessage = curl_error($curl);
  echo "Error: ".$errorMessage;  // TODO: Handle cURL error
}
else
{
  $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
// echo "Status Code: ".$statusCode;// TODO: Handle HTTP status code and response data
}
// curl_close($curl);

//print_r($responseData);

$xml = simplexml_load_string($responseData) or die("Error: cannot create object");
//print_r($xml);

foreach($xml as $item)
{
  echo $item->Email;
  echo explode('@', $item->Email)[0];

  $curl2 = curl_init();
  curl_setopt_array($curl2, array( CURLOPT_URL => 'https://webservices.digitalmeasures.com/login/service/v4/SchemaData/INDIVIDUAL-ACTIVITIES-University/USERNAME:' . explode('@', $item->Email)[0],
          CURLOPT_USERPWD => $user . ':' . $password,
          CURLOPT_ENCODING => 'gzip',
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_RETURNTRANSFER => true));
  $responseData2 = curl_exec($curl2);
  print_r($responseData2);
}

