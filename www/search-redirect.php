<?php

$f = fopen('search.log', 'a+');
fwrite($f, date("Y-m-d H:i:s").': ' .serialize( $_GET ) . "\n");
fclose( $f );

exit();

header('Location: /search.html?q='.$_GET['q']);

?>