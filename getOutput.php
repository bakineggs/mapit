<?php
public static function getOutput() {
  define('STREET_ZIP_SMID', 'TuZ');
  define('ZIP_SMID', 'xOZ');
  define('STREET_CITY_STATE_SMID', '4h1');
  define('CITY_STATE_SMID', 'W61');
  define('STATE_SMID', 'alx');

  $address_info = array(
    'zip' => Data::get('com.yahoo.uf.hcard/rel:Card/vcard:adr/vcard:postal-code'),
    'state' => Data::get('com.yahoo.uf.hcard/rel:Card/vcard:adr/vcard:region'),
    'city' => Data::get('com.yahoo.uf.hcard/rel:Card/vcard:adr/vcard:locality'),
    'street' => Data::get('com.yahoo.uf.hcard/rel:Card/vcard:adr/vcard:street-address')
  );

  if ($address_info['zip']) {
    if ($address_info['street']) {
      $smid = STREET_ZIP_SMID;
    }
    else {
      $smid = ZIP_SMID;
    }
  } else if ($address_info['state']) {
    if ($address['city']) {
      if ($address['street']) {
        $smid = STREET_CITY_STATE_SMID;
      } else {
        $smid = CITY_STATE_SMID;
      }
    } else {
      $smid = STATE_SMID;
    }
  }

  if (!$smid)
    return array();

  $img = Data::get('smid:' . $smid . '/media:Thumbnail/@resource');

  if ($img == 'http://not_real')
    return array();

  $address_parts = array_reverse(array_filter($address_info));

  return array(
    'infobar' => array(
      'summary' => 'Map of ' . implode(', ', $address_parts),
      'blob' => '<img src="' . htmlentities($img, ENT_QUOTES) . '" />'
    )
  );
}
?>
