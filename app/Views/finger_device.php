<?php

// TAD-PHP Library

use TADPHP\TAD;
use TADPHP\TADFactory;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;


$logger = new Logger('soap-service');
// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__.'/logs/'.date( "Y-m-d").'.log', Logger::DEBUG));
$logger->pushHandler(new FirePHPHandler());

$tad = (new TADFactory((['ip'=> $devices['ip_address'], 'com_key'=>0])))->get_instance();

echo 'starting read data in machine finger print ..'. $devices['ip_address'];
$info = $tad->get_serial_number();
//$data = $logs->to_json();

//$conv = json_decode($data,true);

echo '<br> '.$info;


// ZK Library

/**
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

$client = new GuzzleHttp\Client();

$zk     = new ZKLib($devices['ip_address'], 4370);
$conn   = $zk->connect();


$logger = new Logger('udp-service');
// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__.'/logs/'.date( "Y-m-d").'.log', Logger::DEBUG));
$logger->pushHandler(new FirePHPHandler());


if($conn){
    echo 'starting read data in machine finger print ..'.$devices['ip_address'];
    $platform = $zk->platform();
    echo '<br> '.$platform;

    $zk->disconnect();
} else {
    echo 'connection is failed to '.$devices['ip_address'];
}

*/

?>
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th>ID = <?= $id ?></th>
          <th>User</th>
          <th>Date</th>
          <th>Status</th>
          <th>Reason</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>183</td>
          <td>John Doe</td>
          <td>11-7-2014</td>
          <td><span class="tag tag-success">Approved</span></td>
          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
        </tr>
        <tr>
          <td>219</td>
          <td>Alexander Pierce</td>
          <td>11-7-2014</td>
          <td><span class="tag tag-warning">Pending</span></td>
          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
        </tr>
        <tr>
          <td>657</td>
          <td>Bob Doe</td>
          <td>11-7-2014</td>
          <td><span class="tag tag-primary">Approved</span></td>
          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
        </tr>
        <tr>
          <td>175</td>
          <td>Mike Doe</td>
          <td>11-7-2014</td>
          <td><span class="tag tag-danger">Denied</span></td>
          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
        </tr>
      </tbody>
    </table>