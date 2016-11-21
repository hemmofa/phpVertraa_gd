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
/**
 * A Retriever is the object that does the actual fetching of data.
 * In its basic form, it models a html GET.
 *
 * We have abstracted this, so people can implement their own ways to retrieve information. One example is support for proxies.
 * We only include the cURLRetriever in phpNS, so another example is sites that don't have cURL installed.
 */
abstract class vtgdRetriever
{
	private $apikey;
	
	// Use this URL to test with example data (no API key is required for that).
	const URL_VERTRAA_GD = "http://api.vertraa.gd/voorbeeld.xml";
	
	
	//const URL_VERTRAA_GD = "http://api.vertraa.gd/2/xml";

	
	public function __construct($apikey)
	{
		$this->apikey = $apikey;
	}

	protected function getAPIkey()
	{
		return $this->apikey;
	}


	public abstract function getVertraagd();

}
?>