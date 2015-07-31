<?php

class UserXMLGenerator{

	private $tags = [':-{password}-:', ':-{md5-hash}-:', ':-{nt-hash}-:', ':-{name}-:', ':-{descr}-:', ':-{uid}-:'];
	private $xml =    '		<user>' . PHP_EOL
					. '			<scope>user</scope>' . PHP_EOL
					. '			<password>:-{password}-:</password>' . PHP_EOL
					. '			<md5-hash>:-{md5-hash}-:</md5-hash>' . PHP_EOL
					. '			<nt-hash>:-{nt-hash}-:</nt-hash>' . PHP_EOL
					. '			<name>:-{name}-:</name>' . PHP_EOL
					. '			<descr><![CDATA[:-{descr}-:]]></descr>' . PHP_EOL
					. '			<expires/>' . PHP_EOL
					. '			<authorizedkeys/>' . PHP_EOL
					. '			<ipsecpsk/>' . PHP_EOL
					. '			<uid>:-{uid}-:</uid>' . PHP_EOL
					. '		</user>' . PHP_EOL;

	private $usernamePos = 0;
	private $passwordPos = 1;
	private $descriptionPos = 2;

	protected $pfSenseEncrypt;

	public function __construct( pfSenseEncrypt $pfSenseEncrypt ){
		$this->pfSenseEncrypt = $pfSenseEncrypt;
	}

	/*Creates an array of XML user definitions from a file*/
	public function createUsersXML( $uid, $filename ){
		//array to store xml
		$xml = [];

		//open file
		$file = fopen( $filename, 'r');

		if( $file ){
			//read line as csv
			while (($data = fgetcsv($file)) !== FALSE) {
				//create user's xml
				$xml[] = $this->userXML( $uid, $data );
				$uid++;
			}

			//close file
			fclose( $file );

		}
		else{
			$xml = false;
		}

		return $xml;
	}

	/* Creates the XML of a user with the given data and uid*/
	private function userXML( $uid, $data ){
		//Get pfSense style encrypted passwords

		$tmpPasswords = $this->pfSenseEncrypt->encryptPassword( $data[ $this->passwordPos ] );

		//Make an array of replacements that match tags positions
		$userData = [
			$tmpPasswords[ pfSenseEncrypt::PASSWORD ],
			$tmpPasswords[ pfSenseEncrypt::MD5 ],
			$tmpPasswords [ pfSenseEncrypt::NT_HASH ],
			$data[$this->usernamePos],
			$data[$this->descriptionPos],
			$uid
		];

		//Return the XML with everything replaced
		return str_ireplace($this->tags, $userData, $this->xml);

	}

}