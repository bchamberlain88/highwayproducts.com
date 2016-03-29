<?php 

/**
 *
 * Create a secure connection to the 
 * Highway Products Inc. MySQL database
 * destroys the connection credentials after
 * a successful connection.
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

/**
 *
 * Decrypt provided encrypted string with a custom hash
 *
 * @param string $string : the hashed string to be decrypted
 * @return               : decrypted string
 *
 */

function decryptString( $string ) {
	$hash = 'iUb8qLpJm1DX8zQ52yhuKv';
	$decode = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $hash ), base64_decode( $string ), MCRYPT_MODE_CBC, md5( md5( $hash ) ) ), '\0' );
	return $decode;
}

// name of the database we want to connect to
$db_name = 'highwayp_new';
// connection credentials - username
$db_username = 'highwayp_webdev';
// connection credentials - encrypted password
$db_password = decryptString( 'kOCRg1C1bYfI5j4GfsyzXo7zzsVQW8GXbjHTmXHA55E=' );
// create the connection to the database using provided credentials
$connection = mysql_connect( 'localhost', $db_username, $db_password );
// select the database using our new connection
$database = mysql_select_db( $db_name, $connection );
// set the global character set to UTF8
mysql_set_charset( 'utf8', $connection );
// the connection has been established - destroy login credentials
unset( $db_password ); 
unset( $db_username );

?>
