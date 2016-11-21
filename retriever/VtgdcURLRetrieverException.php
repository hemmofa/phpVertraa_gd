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
 require_once(dirname(__FILE__).'/../VtgdException.php');

class VtgdcURLRetrieverException extends NSException
{
	/**
	 * When an VtgdcURLRetrieverException is of this type, something went wrong with cURL.
	 * getCode() will return cURL's error code.
	 * getMessage() will return cURL's error message.
	 */
	const TYPE_CURL = "curl";
	
	/**
	 * When an VtgdcURLRetrieverException is of this type, the returned XML was a soap fault.
	 * Usually, the soap fault messages from NS follow pattern <ERRNR>:<ERRMSG>.
	 * getCode() will return the <ERRNR> part (always a in digits), or NULL if the soap fault was not in the above pattern.
	 * getMessage() will return the <ERRMSG> part, or the complete soap fault if the soap fault was not in the above pattern.
	 */
	const TYPE_XML = "xml";

	/**
	 * Should either be TYPE_CURL or TYPE_XML.
	 */
	private $type;
	
	private $url;
	private $faultstring;

	public function __construct($type, $url, $faultstring = null, $faultcode = null)
	{
		$this->type = $type;
		$this->url = $url;
		$this->message = $faultstring;
		$this->code = $faultcode;
	}
	
	/**
	 * Returns the type of error. It's either TYPE_CURL or TYPE_XML. See there an explanation. 
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * Returns the URL that was requested.
	 */
	public function getUrl()
	{
		return $this->url;
	}
}
?>