<?php
session_start();
$_SESSION['count'] = $_SESSION['count'] + 1;
print "You've looked at this page " . $_SESSION['count'] . ' times.';
