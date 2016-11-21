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
 class VertraagdXML
{
	private $percentage;
	private $totaal;
	private $vertraagd;
	private $opgeheven;
	private $tekst;


	public function __construct($percentage, $totaal, $vertraagd, $opgeheven, $tekst)
	{
		$this->percentage = $percentage;
		$this->totaal = $totaal;
		$this->vertraagd = $vertraagd;
		$this->opgeheven = $opgeheven;
		$this->tekst = $tekst;
	}

	public function getPercentage()
	{
		return $this->percentage;
	}

	public function getTotaal()
	{
		return $this->totaal;
	}

	public function getVertraagd()
	{
		return $this->vertraagd;
	}

	public function getOpgeheven()
	{
		return $this->opgeheven;
	}

	public function getTekst()
	{
		return $this->tekst;
	}

}
?>