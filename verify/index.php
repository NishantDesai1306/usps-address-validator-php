<?php
require $_SERVER['DOCUMENT_ROOT'] . '/helper/index.php';

$addressLine1 = sanitize($_POST['addressLine1']);
$addressLine2 = sanitize($_POST['addressLine2']);
$city = sanitize($_POST['city']);
$state = sanitize($_POST['state']);
$zip = sanitize($_POST['zip']);

$xmlBody = "<AddressValidateRequest USERID='128JDPOW5437'>
    <Revision>1</Revision>
    <Address>
        <Address1>$addressLine1</Address1>
        <Address2>$addressLine2</Address2>
        <City>$city</City>
        <State>$state</State>
        <Zip5>$zip</Zip5>
        <Zip4></Zip4>
    </Address>
</AddressValidateRequest>";

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://production.shippingapis.com/ShippingAPI.dll?API=Verify&XML=' . urlencode($xmlBody),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
)
);

$response = curl_exec($curl);

curl_close($curl);

$xml = simplexml_load_string($response);
if ($xml === false) {
  echo "Failed loading XML: ";
  foreach (libxml_get_errors() as $error) {
    echo "<br>", $error->message;
  }
} else {
  $err = (string) $xml->Address->Error->Description;
  $standardizedAddressLine1 = (string) $xml->Address->Address2;
  $standardizedAddressLine2 = (string) $xml->Address->Address1;
  $standardizedCity = (string) $xml->Address->City;
  $standardizedState = (string) $xml->Address->State;
  $standardizedZip5 = (string) $xml->Address->Zip5;
}
?>

<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>

  <link rel="stylesheet" href="index.css">
  <script src="/verify/index.js"></script>
</head>

<body>
  <div class="h-100 w-100 row">
    <div class="col-8 offset-2 col-sm-4 offset-sm-4 d-flex align-items-center">
      <div class="w-100 card">
        <div class="card-body">
          <div class="card-title text-center h5 mb-4">Save Address</div>

          <div class="row mb-3">
            <div class="col-12 d-flex justify-content-center">
              <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="address-selection" id="original" value="ORIGINAL" autocomplete="off">
                <label class="btn btn-light" for="original">Original</label>
                
                <input type="radio" class="btn-check" name="address-selection" id="standardized" value="STANDARDIZED" autocomplete="off" checked>
                <label class="btn btn-primary" for="standardized">Standardized</label>
              </div>
            </div>
          </div> 
          <div class="row">
            <div class="col-12 col-sm-6 mb-3 mb-sm-0 p-2">
              <div class="border p-2 rounded" id="address-section-ORIGINAL">
                <div class="fw-bold mb-3">Original Address</div>

                <div>Address Line 1: <label name="addressLine1"><?= $addressLine1 ?></label></div>
                <div>Address Line 2: <label name="addressLine2"><?= $addressLine2 ?></label></div>
                <div>City: <label name="city"><?= $city ?></label></div>
                <div>State: <label name="state"><?= $state ?></label></div>
                <div>Zip: <label name="zip"><?= $zip ?></label></div>
              </div>
            </div>

            <div class="col-12 col-sm-6 mb-3 mb-sm-0 p-2">
              <div class="border p-2 rounded" id="address-section-STANDARDIZED">
                <div class="fw-bold mb-3">Standardized Address</div>
  
                <div>Address Line 1: <label name="addressLine1"><?= $standardizedAddressLine1 ?></label></div>
                <div>Address Line 2: <label name="addressLine2"><?= $standardizedAddressLine2 ?></label></div>
                <div>City: <label name="city"><?= $standardizedCity ?></label></div>
                <div>State: <label name="state"><?= $standardizedState ?></label></div>
                <div>Zip: <label name="zip"><?= $standardizedZip5 ?></label></div>
              </div>
            </div>
          </div>

          <div class="row mt-3 d-none" id="error">
            <div class="col-12">
              <div class="alert text-center alert-danger">
                Something went wrong.
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-12 text-center">
              <button class="btn btn-lg btn-primary" onclick="saveSelectedAddress()">
                Save
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>