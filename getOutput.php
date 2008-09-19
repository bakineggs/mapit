<?php
public static function getOutput() {
  $ret = array();
  define("SMDEFAULT", "");
  define('STREET_ZIP_SMID', 'TuZ');
  define('ZIP_SMID', 'xOZ');
  define('STREET_CITY_STATE_SMID', '4h1');
  define('CITY_STATE_SMID', 'W61');
  define('STATE_SMID', 'alx');

  /* If you leave these blank, the default title and summary will be shown */
  $ret['title'] = SMDEFAULT;
  $ret['summary'] = SMDEFAULT;

  /* Now you fill in the rest. Use Data::get and Data::xpath to get data  */

  // Image
  $ret['image']['src'] = SMDEFAULT;
  $ret['image']['alt'] = SMDEFAULT;
  $ret['image']['title'] = SMDEFAULT;
  $ret['image']['allowResize'] = true;

  // Deep links - up to 4
  $ret['links'][0]['text'] = SMDEFAULT;
  $ret['links'][0]['href'] = SMDEFAULT;
  $ret['links'][1]['text'] = SMDEFAULT;
  $ret['links'][1]['href'] = SMDEFAULT;
  $ret['links'][2]['text'] = SMDEFAULT;
  $ret['links'][2]['href'] = SMDEFAULT;

  // Key Value pairs - up to 4
  $ret['dict'][0]['key'] = SMDEFAULT;
  $ret['dict'][0]['value'] = SMDEFAULT;
  $ret['dict'][1]['key'] = SMDEFAULT;
  $ret['dict'][1]['value'] = SMDEFAULT;
  $ret['dict'][2]['key'] = SMDEFAULT;
  $ret['dict'][2]['value'] = SMDEFAULT;
  $ret['dict'][3]['key'] = SMDEFAULT;
  $ret['dict'][3]['value'] = SMDEFAULT;

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

  /* This is for infobar apps
     You can put a subset of HTML in here
     See the docs for more details */
  $ret['infobar']['summary'] = SMDEFAULT;
  $ret['infobar']['blob'] = '<img src="' . htmlentities($img, ENT_QUOTES) . '" />';

  return $ret;
}
?>
