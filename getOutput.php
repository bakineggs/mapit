<?php
public static function getOutput() {
  $img = Data::get('smid:1GQ/media:Thumbnail/@resource');

  if ($img == 'http://not_real')
    return array();

  $address_parts = array_filter(array(
    'street' => Data::get('com.yahoo.uf.hcard/rel:Card/vcard:adr/vcard:street-address'),
    'city' => Data::get('com.yahoo.uf.hcard/rel:Card/vcard:adr/vcard:locality'),
    'state' => Data::get('com.yahoo.uf.hcard/rel:Card/vcard:adr/vcard:region'),
    'zip' => Data::get('com.yahoo.uf.hcard/rel:Card/vcard:adr/vcard:postal-code')
  ));

  return array(
    'infobar' => array(
      'summary' => 'Map of ' . implode(', ', $address_parts),
      'blob' => '<img src="' . htmlentities($img, ENT_QUOTES) . '" />'
    )
  );
}
?>
