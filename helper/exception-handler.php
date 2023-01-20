<?php

function exception_handler(Throwable $exception) {
  header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
  print_r("Uncaught exception: " . $exception->getMessage());
}

set_exception_handler('exception_handler');

?>