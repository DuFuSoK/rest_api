<?php
  $newbook = array('name' => 'Smely zajko v Afrike' );

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://localhost/cbl/api/books/");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS, $newbook);

  curl_exec($ch);
  curl_close($ch);

?>
