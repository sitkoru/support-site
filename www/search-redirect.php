<?php

print_r( $_GET );
exit();

header('Location: /search.html?q='.$_GET['q']);

?>