<?php
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);
require_once 'MPD.php';
$MPD_DB = Net_MPD::factory('Database');
var_dump($MPD_DB);
$dump = $MPD_DB->getMetaData('Artist');
echo '<ol>';
foreach ($dump as $artist) {
    echo '<li>'.$artist.'</li>';
}
echo '</ol>';
