<?php
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);
require_once 'Net/MPD.php';
$MPD_DB = Net_MPD::factory('Database');


//Search for songs by the Artist "Modest Mouse"
$dump = $MPD_DB->find(array('Artist' => 'Goldfinger'));
echo '<ol>';
foreach ($dump as $song) {
    echo '<li>'.$song['Title'].'</li>';
}
echo '</ol>';
?>