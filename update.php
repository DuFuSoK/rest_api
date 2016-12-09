<?php
  $changename = array('name' => 'Na zapade nic nove' );

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://localhost/cbl/api/books/4");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($changename));

  curl_exec($ch);
  curl_close($ch);

?>
