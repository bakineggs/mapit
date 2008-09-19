<?php
header('Content-Type: text/xml');

$doc = DOMDocument::loadHTMLFile($_GET['identifier']);

$parameters = address_parameters($doc) + array(
  'appid' => 'tCa4.fDV34GcXMnIbz5dWxSZWjSWsMXIQSqiVVBFb55nTKX1RFLqYyuM677Jz2vK',
  'image_width' => '564',
  'image_height' => '455',
  'zoom' => '4'
);

$joined_parameters = array();
foreach ($parameters as $key => $value)
  $joined_parameters[] = urlencode($key) . '=' . urlencode($value);

$url_parameters = '?' . implode('&', $joined_parameters);

readfile('http://local.yahooapis.com/MapsService/V1/mapImage' . $url_parameters);

function address_parameters($doc) {
  $xpath = new DOMXPath($doc);
  $addresses = $xpath->evaluate("//*[@class='adr']", $doc);
  foreach ($addresses as $address) {
    if ($zip = nodeValue($xpath, $address, 'postal-code')) {
      $params = array('zip' => $zip);
      if ($state = nodeValue($xpath, $address, 'region'))
        $params['state'] = $state;
      if ($city = nodeValue($xpath, $address, 'locality'))
        $params['city'] = $city;
      if ($street = nodeValue($xpath, $address, 'street-address'))
        $params['street'] = $street;
      return $params;
    } else if ($state = nodeValue($xpath, $address, 'region')) {
      $params = array('state' => $state);
      if ($city = nodeValue($xpath, $address, 'locality'))
        $params['city'] = $city;
      if ($street = nodeValue($xpath, $address, 'street-address'))
        $params['street'] = $street;
      return $params;
    }
  }
  return array();
}

function nodeValue($xpath, $address, $class) {
  return $xpath->evaluate("//*[@class='" . $class . "']", $address)->item(0)->nodeValue;
}
?>
