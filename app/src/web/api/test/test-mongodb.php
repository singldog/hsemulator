<?php

$mongo = mongo();

$query = new \MongoDB\Driver\Query(['x'=>1]);
$result = $mongo->executeQuery('db.points', $query); 

dd($result->toArray());

die();


