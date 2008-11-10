<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Music Player Daemon API
 *
 * PHP Version 5
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
 * API for the admin peices of Music Player Daemon commands
 *
 * @category  Networking
 * @package   Net_MPD
 * @author    Graham Christensen <graham.christensen@itrebal.com>
 * @copyright 2006 Graham Christensen
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://pear.php.net/packages/Net_MPD
 */
class Net_MPD_Admin extends Net_MPD_Common
{

    /**
     * List available audio outputs
     *
     * @return array or int on failure
     */
    public function getOutputs()
    {
        return $this->runCommand('outputs');
    }

    /**
     * Disables an audio output
     *
     * @param int $id output Id to disable
     *
     * @return bool
     */
    public function disableOutput($id)
    {
        return ($this->runCommand('disableoutput', $id) == array());
    }

    /**
     * Enables an audio output
     *
     * @param int $id Id to enable
     *
     * @return bool
     */
    public function enableOutput($id)
    {
        return ($this->runCommand('enableoutput', $id) == array());
    }

    /**
     * Kills the MPD server in a safe way, saving state if possible
     *
     * @return bool
     */
    public function kill()
    {
        $r = $this->runCommand('kill');
        if ($r) {
            @$this->disconnect();
        }
        return true;
    }

    /**
     * Updates the music database
     *
     * @param string $path path which to search for music, optional
     *
     * @return bool
     */
    public function updateDatabase($path = '')
    {
        $this->runCommand('update', $path);
        return true;
    }
}
?>
