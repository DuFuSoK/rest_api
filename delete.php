<?php

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://localhost/cbl/api/books/1");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

  curl_exec($ch);
  curl_close($ch);

?>
