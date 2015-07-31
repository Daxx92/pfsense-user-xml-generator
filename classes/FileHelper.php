<?php

/**
* Helps with file uploading and recovering
*/
class FileHelper{


	public function uploadCSV( $file, $storagePath = './' ){

		//Where to move the tmp file
		$destination = $storagePath . strtolower( $file['name'] );

		//try to move it
		$moved = move_uploaded_file( $file['tmp_name'], $destination);

		//Did we succed?
		return $moved;

	}

	public function listCsvFiles( $glob = '*.csv' ){
		return glob( $glob );
	}

}