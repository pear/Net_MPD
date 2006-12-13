<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Music Player Daemon API
 *
 * PHP Version 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available thorugh the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt. If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  Networking
 * @package   Net_MPD
 * @author    Graham Christensen <graham.christensen@itrebal.com>
 * @copyright 2006 Graham Christensen
 * @license   http://www.php.net/license/3_0.txt
 * @version   CVS: $ID:$
 */
/**
 * API for the playback portion of Music Player Daemon commands
 *
 * For controlling playback aspects of MPD
 *
 * @category  Networking
 * @package   Net_MPD
 * @author    Graham Christensen <graham.christensen@itrebal.com>
 * @copyright 2006 Graham Christensen
 * @license   http://www.php.net/license/3_0.txt
 * @version   CVS: $ID:$
 */
class Net_MPD_Playback extends Net_MPD_Common
{
    /**
     * Gets the current song and related information
     *
     * @return array of data
     */
    public function getCurrentSong()
    {
        try {
            $out = $this->runCommand('currentsong');
            if (!isset($out['file'][0])) {
                return false;
            }
            return $out['file'][0];
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }



    /**
     * Set crossfade between songs
     *
     * @param $sec int, seconds to crossfade
     * @return bool
     */
    public function setCrossfade($sec)
    {
        try {
            $this->runCommand('crossfade', $sec);
            return true;
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }



    /**
     * Continue to the next song
     *
     * @return bool
     */
    public function nextSong()
    {
        try {
            $this->runCommand('next');
            return true;
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Go back to the previous song
     *
     * @return bool
     */
    public function previousSong()
    {
        try {
            $this->runCommand('previous');
            return true;
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }



    /**
     * Pauses or plays the audio
     *
     * @return bool
     */
    public function pause()
    {
        try {
            $this->runCommand('pause');
            return true;
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }



    /**
     * Starts playback
     *
     * @param $song int, song position in playlist to start playing at
     * @return bool
     */
    public function play($song = 0)
    {
        try {
            $this->runCommand('play', $song);
            return true;
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Starts playback by Id
     *
     * @param $song int, song Id
     * @return bool
     */
    public function playId($song = 0)
    {
        try {
            $this->runCommand('playid', $song);
            return true;
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }



    /**
     * Sets 'random' mode on/off
     *
     * @param $on bool true or false, for random or not (respectively),
     optional
     * @return bool
     */
    public function random($on = false)
    {
        try {
            $this->runCommand('random', (int)$on);
            return true;
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }



    /**
     * Sets 'random' mode on/off
     * @access public
     * @param $on bool true or false, for repeat or not (respectively),
     optional
     * @return true
     */
    public function repeat($on = false)
    {
        try {
            $this->runCommand('repeat', (int)$on);
            return true;
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }



    /**
     * Seek a position in a song
     *
     * @param $song int song position in playlist
     * @param $time int time in seconds to seek to
     * @return bool
     */
    public function seek($song, $time)
    {
        try {
            $this->runCommand('seek', array($song, $time));
            return true;
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }



    /**
     * Seek a position in a song
     *
     * @param $song int song Id
     * @param $time int time in seconds to seek to
     * @return bool
     */
    public function seekId($song, $time)
    {
        try {
            $this->runCommand('seekid', array($song, $time));
            return true;
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }



    /**
     * Set volume
     *
     * @param $vol int volume
     * @return true
     */
    public function setVolume($vol)
    {
        try {
            $this->runCommand('setvol', $vol);
            return true;
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }



    /**
     * Stop playback
     *
     * @return bool
     */
    public function stop()
    {
        try {
            $this->runCommand('stop');
            return true;
        }
        catch(PEAR_Exception $e) {
            throw new PEAR_Exception($e->getMessage(), $e->getCode());
        }
    }
}
?>