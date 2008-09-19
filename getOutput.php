<?php
public static function getOutput() {
  $img = Data::get('smid:1GQ/media:Thumbnail/@resource');

  if ($img == 'http://not_real')
    return array();

  return array(
    'infobar' => array(
      'blob' => '<img src="' . htmlentities($img, ENT_QUOTES) . '" />'
    )
  );
}
?>
