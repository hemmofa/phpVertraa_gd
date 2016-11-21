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
 * This is a Cache implementation that actually does NOT do caching at all.
 * Please, consider a proper caching stragey instead of using this implementation.
 */
require_once(dirname(__FILE__).'/Cache.php');

class VtgdNoCache extends VtgdCache
{
	public function __construct($vtgdretriever)
	{
		parent::__construct($vtgdretriever);
	}

	public function getVertraagd()
	{
		return $this->getVtgdRetriever()->getVertraagd();
	}

}
?>