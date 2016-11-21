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
require_once(dirname(__FILE__).'/Retriever.php');
require_once(dirname(__FILE__).'/VtgdcURLRetrieverException.php');

/**
 * A simple Retriever implementation that uses cURL to retrieve data from the NS.
 */
class VtgdcURLRetriever extends VtgdRetriever
{
	const SOAP_FAULT = "<soap:Fault>";
	const SOAP_FAULTSTRING_START = "<faultstring>";
	const SOAP_FAULTSTRING_END = "</faultstring>";

	const XML_ERROR_INVALID_WEBSERVICE = 002; // 002:The requested webservice is not found
	const XML_ERROR_INVALID_KEY = 006; // 006:No customer found for the specified username and password
	const XML_ERROR_UNEXPECTED = 009; // 099:An unexpected exception occured
	const XML_ERROR_LIMIT_REACHED = 013; // 013:The limit for calling this webservice has been reached

	public function __construct($apikey)
	{
		parent::__construct($apikey);
	}

	public function getVertraagd()
	{
		return $this->getXML(parent::URL_VERTRAA_GD);
	}

	
	private function getXML($url)
	{
	error_log($url);
		$ch = curl_init($url . "?auth=" . parent::getAPIkey());
		//		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_TIMEOUT, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$xml = curl_exec($ch);
		
		if (curl_errno($ch) != 0)
		{
			die("<br/><br/>Er is een onverwachte fout opgetreden - onze excuses hiervoor. Klik op Home om verder te gaan...");
	//		throw new NScURLRetrieverException(NScURLRetrieverException::TYPE_CURL, $url, curl_error($ch), curl_errno($ch));
		}
		
		curl_close($ch);

		if (strpos($xml, self::SOAP_FAULT) > -1)
		{
			// This is an error response
			$faultstringStartPosition = strpos($xml, self::SOAP_FAULTSTRING_START);
			$faultstringEndPosition = strpos($xml, self::SOAP_FAULTSTRING_END);
			if ($faultstringStartPosition > -1 && $faultstringEndPosition > $faultstringStartPosition)
			{
				$faultstring = substr($xml, $faultstringStartPosition + strlen(self::SOAP_FAULTSTRING_START), $faultstringEndPosition- $faultstringStartPosition - strlen(self::SOAP_FAULTSTRING_START));
				if (preg_match("/^([0-9]+):(.+)$/", $faultstring, $matches) > 0)
				{
				//	throw new NScURLRetrieverException(NScURLRetrieverException::TYPE_XML, $url, $matches[2], $matches[1]);
				}
				else
				{
				//	throw new NScURLRetrieverException(NScURLRetrieverException::TYPE_XML, $url, $faultstring);
				}
			}
			else
			{
			//	throw new NScURLRetrieverException(NScURLRetrieverException::TYPE_XML, $url);
			}
		}

		return $xml;
	}
}
?>