<?php

require(__DIR__ . "/vendor/autoload.php");

use GitHubWebhook\Handler;
use GitHubToRally\GitHub;

// We set Handler gitDir param to NULL, because we are not using the git repo
// sync feature (but we use the library because the rest of it is useful).
$handler = new Handler(getenv('GITHUB_SECRET'), NULL);
$github = new GitHub($handler);
$github->syncToRally();
