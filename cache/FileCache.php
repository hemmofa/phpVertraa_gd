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
require_once(dirname(__FILE__).'/Cache.php');

/**
 * This is a Cache implementation that stores the responses on disk in a directory structure.
 */
class VtgdFileCache extends VtgdCache
{
	private $tmpDir;

	public function __construct($vtgdretriever, $tmpDir)
	{
		parent::__construct($vtgdretriever);
		$this->tmpDir = $tmpDir;
	}

	public function getVertraagd()
	{
		$tmpFile = $this->initTmpDir("vertraagd")."result.xml";
		if (file_exists($tmpFile) && filemtime($tmpFile) + $this->getTimeToCacheVertraagd() > time())
		{
			return file_get_contents($tmpFile);
		}
		else
		{
			$xml = $this->getVtgdRetriever()->getVertraagd();
			file_put_contents($tmpFile, $xml);
			return $xml;
		}
	}

	private function initTmpDir($functionName)
	{
		$arguments = func_get_args();
		$strTmpDir = $this->tmpDir . "/";
		foreach ($arguments as $arg)
		{
			if ($arg === null)
			{
				$strTmpDir .= "NULL/";
			}
			elseif ($arg instanceof Station)
			{
				$strTmpDir .= $arg->getCode() . "/";
			}
			elseif (is_bool($arg))
			{
				$strTmpDir .= ($arg ? "TRUE" : "FALSE") . "/";
			}
			elseif (is_int($arg))
			{
				$strTmpDir .= $arg . "/";
			}
			elseif (is_string($arg))
			{
				$strTmpDir .= $arg . "/";
			}
			else
			{
				trigger_error("FileCache::initTmpDir got an object of unknown type", E_USER_WARNING);
				$strTmpDir .= $arg . "/";
			}
		}
		if (!file_exists($strTmpDir))
		{
			mkdir($strTmpDir, 0700, TRUE);
		}
		return $strTmpDir;
	}
}
?>