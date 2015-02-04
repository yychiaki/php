<?php
$now = time();
$thu = strtotime('Thursday', $now);
$later = strtotime('next thursday', $now);
$befor = strtotime('last thursday', $now);
print strftime("now: %c <br />", $now);
print strftime("thu: %c <br />", $thu);
print strftime("later: %c <br />", $later);
print strftime("befor: %c <br />", $befor);
