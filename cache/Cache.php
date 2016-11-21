<?php
/*
 * phpVertraa_gd, by Hemmo de Vries
 * based on phpNS, by Jurrie Overgoor
 * Copyright 2016 Hemmo de Vries
 * Copyright 2011 Jurrie Overgoor <jurrie@narrowxpres.nl>
 * 
 * SmartFileCache added in 2016 by Hemmo de Vries
 *
 * This file is part of phpVertraa_gd.
 *
 * phpVertraa_gd falls under the GNU General Public License version 3. 
 * For more information on this license, see <http://www.gnu.org/licenses/>.
 */
 require_once(dirname(__FILE__).'/../retriever/Retriever.php');

/**
 * A cache is an object that keeps track of requests made, and responses retrieved.
 * When the same request is made again within the 'cache treshold', the stored response is returned, and no call to the server is done.
 * This keeps the number of requests to the server to a minimum.
 */
abstract class vtgdCache
{
	private $vtgdretriever;

	// Seconds to cache a previous result
	private $timeToCacheVertraagd = 150; // 60 * 2,5

	public function __construct($vtgdretriever)
	{
		$this->vtgdretriever = $vtgdretriever;
	}

	protected function getVtgdRetriever()
	{
		return $this->vtgdretriever;
	}

	public function getTimeToCacheVertraagd()
	{
		return $this->timeToCacheVertraagd;
	}

	public function setTimeToCacheVertraagd($timeToCacheVertraagd)
	{
		$this->timeToCacheVertraagd = $timeToCacheVertraagd;
	}

	public abstract function getVertraagd();
}
?>