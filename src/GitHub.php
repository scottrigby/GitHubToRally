<?php

namespace GitHubToRally;

use Yahoo\Connectors\Rally;



class GitHub {

  public function hello($username, $password) {
    $rally = new Rally($username, $password);
    $rally->setWorkspace('https://rally1.rallydev.com/slm/webservice/v2.0/workspace/29652320927');
    $defect = $rally->get('defect', '33525234744');

    var_dump($defect);

    return $rally;
  }

}
