<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * MPD Interaction API
 *
 * Net_MPD deals with socket interaction with MPD to ease the
 * use of MPD in web applications.
 * 
 * PHP Version 5
 *
 * @package   Net_MPD
 * @category  Networking
 * @author    Graham Christensen <graham.christensen@itrebal.com>
 * @copyright 2006 Graham Christensen
 * @license   PHP License 3.0
 * @version   CVS: $ID:$
 */


/**
 * API for the playlist portion of Music Player Daemon commands
 *
 * Used for maintaining, creating, and utilizing playlists in MPD
 * 
 * @category  Networking
 * @package   Net_MPD
 * @author    Graham Christensen <graham.christensen@itrebal.com>
 * @copyright 2006 Graham Christensen
 * @license   http://www.php.net/license/3_0.txt
 * @vers
 */
class Net_MPD_Playlist extends Net_MPD_Common {

  /**
   * List playlists in specified directory
   *
   * @param $dir string directory path, optional
   * @return bool true on success int on failure
   */
  public function getPlaylists($dir = '')
    {
      try {
	$out = $this->runCommand('lsinfo', $dir);
	return $out['playlist'];
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
    
  /**
   * Add file to playlist
   * 
   * @param $file string filename
   * @return bool
   */
  public function addSong($file)
    {
      try {
	$this->runCommand('add', $file);
	return true;
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  /**
   * Clear the playlist
   * 
   * @return bool
   */  
  public function clear()
    {
      try {
	$this->runCommand('clear');
	return true;
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Gets the current song and related information
   * 
   * @return array of data
   */
  public function getCurrentSong()
    {
      try {
	$out = $this->runCommand('currentsong');
	if(!isset($out['file'][0])){
	  return false;
	}
	return $out['file'][0];
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Delete song from playlist
   * 
   * @param $song int song position in playlist
   * @return bool
   */
  public function deleteSong($song)
    {
      try {
	$this->runCommand('delete', $song);
	return true;
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Delete song from playlist by song Id
   * 
   * @param $id int song Id
   * @return bool
   */
  public function deleteSongId($id)
    {
      try {
	$this->runCommand('deleteid', $id);
	return true;
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Loads a playlist into the current playlist
   * 
   * @param $playlist string playlist name
   * @return bool
   */
  public function loadPlaylist($playlist)
    {
      try {
	$this->runCommand('load', $playlist);
	return true;
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Move song in the playlist
   * 
   * @param $from int song position in the playlist
   * @param $to int song position to move it to
   * @return bool
   */
  public function moveSong($from, $to)
    {
      try {
	$this->runCommand('move', array($from, $to));
	return true;
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }

  
  /**
   * Move song in the playlist by Id
   * 
   * @param $from int song Id
   * @param $to int song Id to move it to
   * @return bool
   */
  public function moveSongId($fromId, $toId)
    {
      try {
	$this->runCommand('moveid', array($fromId, $toId));
	return true;
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Displays metadata for songs in the playlist by position Id
   * 
   * @param $song int song position, optional
   * @return array of song metadata
   */
  public function getPlaylistInfo($song = null)
    {
      try {
	$out = $this->runCommand('playlistinfo', $song, 0);
	return isset($out['file'])?$out['file']:array();
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Displays metadata for songs in the playlist
   * 
   * @param $song int song Id, optional
   * @return array of song metadata
   */
  public function getPlaylistInfoId($song = null)
    {
      try {
	return $this->runCommand('playlistid', $song);
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Get playlist changes
   * 
   * @param $version int playlist version
   * @param $limit boolean true to limit return
   *               to only position and id
   *
   * @return array of changes
   */
  public function getChanges($version, $limit = false)
    {
      $cmd = $limit?'plchangesposid':'plchanges';
      try {
	return $this->runCommand($cmd, $version);
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Delete a playlist
   * 
   * @param $playlist string playlist name
   * @return true
   */
  public function deletePlaylist($playlist)
    {
      try {
	$this->runCommand('rm', $playlist);
	return true;
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Save the playlist
   * 
   * @param $playlist string playlist name
   * @return bool
   */
  public function savePlaylist($playlist)
    {
      try {
	$this->runCommand('save', $playlist);
	return true;
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Shuffle the playlist
   * 
   * @return true
   */
  public function shuffle()
    {
      try {
	$this->runCommand('shuffle');
	return true;
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Swap song by position in the playlist
   * 
   * @param $song1 int song position from
   * @param $song2 int song position to
   * @return bool
   */
  public function swapSong($song1, $song2)
    {
      try {
	$this->runCommand('swap', array($song1, $song2));
	return true;
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
  
  
  /**
   * Swaps a song with another song, by Id
   * 
   * @param $song1 int Id of the first song
   * @param $song2 int Id of the second song
   * @return true
   */
  public function swapSongId($songId1, $songId2)
    {
      try {
	$this->runCommand('swapid', array($songId1, $songId2));
	return true;
      } catch (PEAR_Exception $e) {
	throw new PEAR_Exception($e->getMessage(), $e->getCode());
      }
    }
}