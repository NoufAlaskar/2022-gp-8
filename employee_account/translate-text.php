<?php
if(isset($_POST['translateBtn'])) {
   $data = $_POST['data'];
// When you have your own client ID and secret, put them down here:
$CLIENT_ID = "FREE_TRIAL_ACCOUNT";
$CLIENT_SECRET = "PUBLIC_SECRET";

// Specify your translation requirements here:
$postData = array(
  'fromLang' => "ar",
  'toLang' => "en",
  'text' => $data
);

$headers = array(
  'Content-Type: application/json',
  'X-WM-CLIENT-ID: '.$CLIENT_ID,
  'X-WM-CLIENT-SECRET: '.$CLIENT_SECRET
);
// call api
$url = 'http://api.whatsmate.net/v1/translation/translate';
$ch = curl_init($url);
// set options for api
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

$response = curl_exec($ch);
// print the api response
echo "Response: ".$response;
curl_close($ch);
     
}
?>