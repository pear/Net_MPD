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
 *
 * @category  Networking
 * @package   Net_MPD
 * @author    Graham Christensen <graham.christensen@itrebal.com>
 * @copyright 2006 Graham Christensen
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @version   CVS: $ID:$
 */


require_once 'PEAR/Exception.php';
require_once 'MPD/Common.php';


/**
 * Central class for the Music Player Daemon objects
 *
 * Used to utilize the functionality of the provided classes
 *
 * @category  Networking
 * @package   Net_MPD
 * @author    Graham Christensen <graham.christensen@itrebal.com>
 * @copyright 2006 Graham Christensen
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @version   CVS: $ID:$
 */
class Net_MPD
{
    /**
     * The Net_MPD_Admin object
     */
    public $Admin;

    /**
     * The Net_MPD_Common object
     */
    public $Common;

    /**
     * The Net_MPD_Database object
     */
    public $Database;

    /**
     * The Net_MPD_Playback object
     */
    public $Playback;

    /**
     * The Net_MPD_Playlist object
     */
    public $Playlist;

    /**
     * Creates new instances of objects
     * @param $host Host to connect to, optional (default: localhost)
     * @param $port Port to connect to, optional (default: 6600)
     * @param $pass Pass to connect to, optional (default: null)
     * @return object or false on failure
     */
    function __construct($host = 'localhost', $port = 6600, $pass = null)
    {
        $this->Admin    = self::factory('Admin'   , $host, $port, $pass);
        $this->Common   = self::factory('Common'  , $host, $port, $pass);
        $this->Database = self::factory('Database', $host, $port, $pass);
        $this->Playback = self::factory('Playback', $host, $port, $pass);
        $this->Playlist = self::factory('Playlist', $host, $port, $pass);
    }

    /**
     * Creates new instances of objects
     * @param $class Class to initiate, with out Net_MPD_$class
     * @param $host Host to connect to, optional (default: localhost)
     * @param $port Port to connect to, optional (default: 6600)
     * @param $pass Pass to connect to, optional (default: null)
     * @return object or false on failure
     */
    public static function factory($class, $host = 'localhost', $port = 6600, $pass = null)
    {
        $class = ucfirst(strtolower($class));

        if (!self::_loadClass($class)) {
            return false;
        }

        $class = 'Net_MPD_' . $class;
        $obj = new $class($host, $port, $pass);

        return $obj;
    }

    /**
    * Loads the class
    * @param $class Class to include, with out Net_MPD_
    * @return bool
    */
    protected static function _loadClass($class)
    {
        if (class_exists('Net_MPD_' . $class)) {
            return true;
        }
        require_once 'Net/MPD/' . $class . '.php';
        return true;
    }
}
?>
