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
 * API for the database portion of Music Player Daemon commands
 *
 * Used for maintaining and working with the MPD database
 *
 * @category  Networking
 * @package   Net_MPD
 * @author    Graham Christensen <graham.christensen@itrebal.com>
 * @copyright 2006 Graham Christensen
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://pear.php.net/packages/Net_MPD
 */
class Net_MPD_Database extends Net_MPD_Common
{
    /**
     * Case sensitive search for data in the database
     *
     * @param array $params        array('search_field' => 'search for')
     * @param bool  $caseSensitive True for case sensitivity,
     *                             false for not [default false]
     *
     * @return array
     */
    public function find($params, $caseSensitive = false)
    {
        $prms = array();

        foreach ($params as $key => $value) {
            $prms[] = $key;
            $prms[] = $value;
        }
        $cmd = $caseSensitive ? 'find' : 'search';
        
        $out = $this->runCommand($cmd, $prms);
        if (!isset($out['file'])) {
            return array();
        }
        return $out['file'];
    }



    /**
     * List all metadata of matches to the search
     *
     * @param string $metadata1 metadata to list
     * @param string $metadata2 metadata field to search in, optional
     * @param string $search    data to search for in search field,
     *                          required if search field provided
     *
     * @return array
     */
    public function getMetadata($metadata1, $metadata2 = null, $search = null)
    {
        //Make sure that if metadata2 is set, search is as well
        if (!is_null($metadata2)) {
            if (is_null($search)) {
                return false;
            }
        }
        if (!is_null($metadata2)) {
            $data = array($metadata1, $metadata2, $search);
            $out  = $this->runCommand('list', $data, 1);
        } else {
            $out = $this->runCommand('list', $metadata1, 1);
        }
        if ($metadata1 == 'filename') {
            $metadata1 = 'file';
        }
        return $out[$metadata1];
    }



    /**
     * Lists all files and folders in the directory recursively
     *
     * @param string $dir directory to start in, optional
     *
     * @return array
     */
    public function getAll($dir = '')
    {
        return $this->runCommand('listall', $dir, 1);
    }



    /**
     * Lists all files/folders recursivly, listing any related informaiton
     *
     * @param string $dir directory to start in, optional
     *
     * @return array
     */
    public function getAllInfo($dir = '')
    {
        return $this->runCommand('listallinfo', $dir);
    }

    /**
     * Lists content of the directory
     *
     * @param string $dir directory to work in, optional
     *
     * @return array
     */
    public function getInfo($dir = '')
    {
        return $this->runCommand('lsinfo', $dir);
    }
}
?>
