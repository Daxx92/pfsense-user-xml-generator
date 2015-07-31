<?php

/**
* Takes xml and shows it depending of how the user wants it
*/

class OutputHelper{

	protected $xml;

	public function xml( $xml ){
		$this->xml = $xml;

		return $this;
	}

	public function escaped(){
		return nl2br( htmlentities( $this->xml, ENT_QUOTES ) );
	}

	public function notEscaped(){
		return $this->xml;
	}

}