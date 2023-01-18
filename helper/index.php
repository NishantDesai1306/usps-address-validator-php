<?php
function sanitize($value) {
  $stripped = stripcslashes($value);
  return $stripped;
}

?>