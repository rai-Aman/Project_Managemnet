<?php $conn = oci_connect('Aman_Rai', '123_Aman', '//localhost/xe'); if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit; } else {
   // print "Connected to Oracle!"; 
} 
?>