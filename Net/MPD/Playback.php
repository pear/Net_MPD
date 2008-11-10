<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Music Player Daemon API
 *
 * PHP Version 5
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * @category  Networking
 * @package   Net_MPD
 * @author    Graham Christensen <graham.christensen@itrebal.com>
 * @copyright 2006 Graham Christensen
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @version   CVS: $Id$
 * @link      http://pear.php.net/packages/Net_MPD
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
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://pear.php.net/packages/Net_MPD
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
        $out = $this->runCommand('currentsong');
        if (!isset($out['file'][0])) {
            return false;
        }
        return $out['file'][0];
    }



    /**
     * Set crossfade between songs
     *
     * @param int $sec seconds to crossfade
     *
     * @return bool
     */
    public function setCrossfade($sec)
    {
        $this->runCommand('crossfade', $sec);
        return true;
    }



    /**
     * Continue to the next song
     *
     * @return bool
     */
    public function nextSong()
    {
        $this->runCommand('next');
        return true;
    }

    /**
     * Go back to the previous song
     *
     * @return bool
     */
    public function previousSong()
    {
        $this->runCommand('previous');
        return true;
    }



    /**
     * Pauses or plays the audio
     *
     * @return bool
     */
    public function pause()
    {
        $this->runCommand('pause');
        return true;
    }



    /**
     * Starts playback
     *
     * @param int $song song position in playlist to start playing at
     *
     * @return bool
     */
    public function play($song = 0)
    {
        $this->runCommand('play', $song);
        return true;
    }

    /**
     * Starts playback by Id
     *
     * @param int $song song Id
     *
     * @return bool
     */
    public function playId($song = 0)
    {
        $this->runCommand('playid', $song);
        return true;
    }



    /**
     * Sets 'random' mode on/off
     *
     * @param bool $on true or false, for random or not (respectively), optional
     *
     * @return bool
     */
    public function random($on = false)
    {
        $this->runCommand('random', (int)$on);
        return true;
    }



    /**
     * Sets 'random' mode on/off
     *
     * @param bool $on true or false, for repeat or not (respectively), optional
     *
     * @access public
     * @return true
     */
    public function repeat($on = false)
    {
        $this->runCommand('repeat', (int)$on);
        return true;
    }



    /**
     * Seek a position in a song
     *
     * @param int $song song position in playlist
     * @param int $time time in seconds to seek to
     *
     * @return bool
     */
    public function seek($song, $time)
    {
        $this->runCommand('seek', array($song, $time));
        return true;
    }



    /**
     * Seek a position in a song
     *
     * @param int $song song Id
     * @param int $time time in seconds to seek to
     *
     * @return bool
     */
    public function seekId($song, $time)
    {
        $this->runCommand('seekid', array($song, $time));
        return true;
    }



    /**
     * Set volume
     *
     * @param int $vol volume
     *
     * @return true
     */
    public function setVolume($vol)
    {
        $this->runCommand('setvol', $vol);
        return true;
    }



    /**
     * Stop playback
     *
     * @return bool
     */
    public function stop()
    {
        $this->runCommand('stop');
        return true;
    }
}
?>
