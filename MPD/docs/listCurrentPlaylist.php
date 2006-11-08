<?php
require_once 'MPD.php';
$MPD_PLS = Net_MPD::factory('Playlist');
if (!$MPD_PLS->connect()) {
    die('Connection failed: '.print_r($MPD_DB->getErrors(), true));
}

$data = $MPD_PLS->getPlaylistInfo();
var_dump($data);
