<?php

if (file_exists('vendor/autoload.php')) {
  require_once 'vendor/autoload.php';
}
else {
  return FALSE;
}

use GitHubToRally\GitHub;

$github = new GitHub();

$rally = $github->hello('rally-slack@nbcuni.com', '2Es*69EpMGW4Cbwr#hsIa7^1NPN4*#');

//var_dump($rally);
