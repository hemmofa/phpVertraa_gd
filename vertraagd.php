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
require_once(dirname(__FILE__).'/VtgdException.php');
require_once(dirname(__FILE__).'/dto/Vertraagd.php');
require_once(dirname(__FILE__).'/retriever/Retriever.php');
require_once(dirname(__FILE__).'/retriever/vtgdcURLRetriever.php');

class VERTRAAGD
{
	private $cache;

	public function __construct($cache)
	{
		$this->cache = $cache;
	}
	
	public function getCache()
	{
		return $this->cache;
	}

	/**
	 * This function returns the Vertraa.gd info.
	 */

	 public function getVertraagd()
	{
		$xml = $this->cache->getVertraagd();
		$xml = new SimpleXMLElement($xml);

		$result = array();
		foreach ($xml->vertragingen as $xmlVertraagd)
		{
			$percentage = (string)$xmlVertraagd->percentage;
			$totaal = (string)$xmlVertraagd->totaal;
			$vertraagd = (string)$xmlVertraagd->vertraagd;
			$opgeheven = (string)$xmlVertraagd->opgeheven;
			$tekst = (string)$xmlVertraagd->tekst;
			$vertraagd = new VertraagdXML($percentage, $totaal, $vertraagd, $opgeheven, $tekst);
			$result[] = $vertraagd;
		}
		return $result;
	}

	
}
?>