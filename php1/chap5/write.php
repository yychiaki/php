<?php

require_once('common.php');


$result = bbs_write($_POST);

header('Location:index.php');