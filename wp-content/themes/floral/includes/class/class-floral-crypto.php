<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-crypto.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

require_once( floral_theme_dir() . 'includes/library/defuse-crypto/defuse-crypto.phar' );
use \Defuse\Crypto\Key;
use \Defuse\Crypto\Crypto;

class Floral_Crypto {
    public $secure_key_file;
    public $secure_key;

    function __construct( $key_file ) {
        $this->secure_key_file = $key_file;

        $this->secure_key = $this->get_secure_key();
    }

    private function get_secure_key() {
        if ( file_exists( $this->secure_key_file ) ) {
            try {
                $key = Key::loadFromAsciiSafeString( floral_get_file_contents( $this->secure_key_file ) );

                return $key;
            } catch ( Exception $e ) {
                // do nothing
            }
        }
        $new_key = Key::createNewRandomKey();
        floral_put_file_content( $this->secure_key_file, $new_key->saveToAsciiSafeString() );

        return $new_key;
    }

    public function encrypt( $plaintext ) {
        return Crypto::encrypt( $plaintext, $this->secure_key );
    }

    public function decrypt( $ciphertext ) {
        return Crypto::decrypt( $ciphertext, $this->secure_key );
    }
}

// path to file contain secure key
//$secure_key_file = floral_theme_dir() . 'includes/library/defuse-crypto/floral-secure-key.txt';
//
//$crypto = ne w Floral_Crypto( $secure_key_file );
//
//$cipher = $crypto->encrypt( 'decosfriend@gmail.com' );
//
//var_dump( $cipher );
//
//$plaint = $crypto->decrypt( $cipher );
//
//var_dump( $plaint );
