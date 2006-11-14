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
 *
 *
 * API for the administrative portion of Music Player Daemon commands
 *
 * Used for maintaining and controlling various administrative tasks
 * of the MPD software.
 * 
 * @category  Networking
 * @package   Net_MPD
 * @author    Graham Christensen <graham.christensen@itrebal.com>
 * @copyright 2006 Graham Christensen
 * @license   http://www.php.net/license/3_0.txt
 * @version   CVS: $ID:$
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
            try {
                return $this->runCommand('outputs');
            } catch (PEAR_Exception $e) {
                throw new PEAR_Exception($e->getMessage(), $e);
            }
        }
    
    /**
     * Disables an audio output
     * 
     * @param $id int output Id to disable
     * @return bool
     */
    public function disableOutput($id)
        {
            try {
                if ($this->runCommand('disableoutput', $id) == array()) {
                    return true;
                }
                return false;
            } catch (PEAR_Exception $e) {
                throw new PEAR_Exception($e->getMessage(), $e);
            }
        }
    
    /**
     * Enables an audio output
     * 
     * @param $id int Id to enable
     * @return bool
     */
    public function enableOutput($id)
        {
            try {
                if ($this->runCommand('enableoutput', $id) == array()) {
                    return true;
                }
                return false;
            } catch (PEAR_Exception $e) {
                throw new PEAR_Exception($e->getMessage(), $e);
            }
        }
    
    /**
     * Kills the MPD server in a safe way, saving state if possible
     * 
     * @return bool
     */
    public function kill()
        {
            try {
                $r = $this->runCommand('kill');
                if ($r) {
                    @$this->disconnect();
                }
                return true;
            } catch (PEAR_Exception $e) {
                throw new PEAR_Exception($e->getMessage(), $e);
            }
        }
    
    /**
     * Updates the music database
     * 
     * @param $path string path which to search for music, optional
     * @return bool
     */
    public function updateDatabase($path = '')
        {
            try {
                $this->runCommand('update', $path);
            } catch (PEAR_Exception $e) {
                throw new PEAR_Exception($e->getMessage(), $e);
            }
            return true;
        }
}