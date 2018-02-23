<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;
use Yii;
/**
 * Description of Security
 *
 * @author blonder413
 */
class Security extends \yii\base\Model {
    /**
     * This method encrypt a string using mcrypt
     * @param String $text string to encrypt
     * @return String text encrypted
     */
    public static function mcrypt($text)
    {
        if (!$text == null) {
            /*
             * ------------------------------------------------
             * ALGORITHMS
             * ------------------------------------------------
             * MCRYPT_3DES                  MCRYPT_PANAMA
             * MCRYPT_ARCFOUR               MCRYPT_RAND
             * MCRYPT_ARCFOUR_IV            MCRYPT_RC2
             * MCRYPT_BLOWFISH              MCRYPT_RC6
             * MCRYPT_BLOWFISH_COMPAT       MCRYPT_RIJNDAEL_128
             * MCRYPT_CAST_128              MCRYPT_RIJNDAEL_192
             * MCRYPT_CAST_256              MCRYPT_RIJNDAEL_256
             * MCRYPT_CRYPT                 MCRYPT_SAFER128
             * MCRYPT_DECRYPT               MCRYPT_SAFER64
             * MCRYPT_DES                   MCRYPT_SAFERPLUS
             * MCRYPT_DEV_RANDOM            MCRYPT_SERPENT
             * MCRYPT_DEV_URANDOM           MCRYPT_SKIPJACK
             * MCRYPT_ENCRYPT               MCRYPT_THREEWAY
             * MCRYPT_ENIGNA                MCRYPT_TRIPLEDES
             * MCRYPT_GOST                  MCRYPT_TWOFISH
             * MCRYPT_IDEA                  MCRYPT_WAKE
             * MCRYPT_LOKI97                MCRYPT_XTEA
             * MCRYPT_MARS
             * ------------------------------------------------
             * MODES
             * ------------------------------------------------
             * MCRYPT_MODE_CBC              MCRYPT_MODE_NOFB
             * MCRYPT_MODE_CFB              MCRYPT_MODE_OFB
             * MCRYPT_MODE_ECB              MCRYPT_MODE_STREAM
             */
            $algorithm  = MCRYPT_BLOWFISH;
            $mode       = MCRYPT_MODE_ECB;
            $iv_size    = mcrypt_get_iv_size ($algorithm, $mode );
            $iv         = mcrypt_create_iv ( $iv_size, MCRYPT_RAND );
            $key        = Yii::$app->params['securityKey'];

            return base64_encode( MCRYPT_ENCRYPT ( $algorithm, $key, $text, $mode, $iv ) );
        }
    }
    //-----------------------------------------------------------------------------------------------------------------
    /**
     * decrypt a string using a reversible mode with mcrypt
     * @param String $string    String to encript
     * @return String encripted
     */
    public static function decrypt($string)
    {
        /*
         * ------------------------------------------------
         * ALGORITHMS
         * ------------------------------------------------
         * MCRYPT_3DES                  MCRYPT_PANAMA
         * MCRYPT_ARCFOUR               MCRYPT_RAND
         * MCRYPT_ARCFOUR_IV            MCRYPT_RC2
         * MCRYPT_BLOWFISH              MCRYPT_RC6
         * MCRYPT_BLOWFISH_COMPAT       MCRYPT_RIJNDAEL_128
         * MCRYPT_CAST_128              MCRYPT_RIJNDAEL_192
         * MCRYPT_CAST_256              MCRYPT_RIJNDAEL_256
         * MCRYPT_CRYPT                 MCRYPT_SAFER128
         * MCRYPT_DECRYPT               MCRYPT_SAFER64
         * MCRYPT_DES                   MCRYPT_SAFERPLUS
         * MCRYPT_DEV_RANDOM            MCRYPT_SERPENT
         * MCRYPT_DEV_URANDOM           MCRYPT_SKIPJACK
         * MCRYPT_ENCRYPT               MCRYPT_THREEWAY
         * MCRYPT_ENIGNA                MCRYPT_TRIPLEDES
         * MCRYPT_GOST                  MCRYPT_TWOFISH
         * MCRYPT_IDEA                  MCRYPT_WAKE
         * MCRYPT_LOKI97                MCRYPT_XTEA
         * MCRYPT_MARS
         * ------------------------------------------------
         * MODES
         * ------------------------------------------------
         * MCRYPT_MODE_CBC              MCRYPT_MODE_NOFB
         * MCRYPT_MODE_CFB              MCRYPT_MODE_OFB
         * MCRYPT_MODE_ECB              MCRYPT_MODE_STREAM
         */

        $algorithm   = MCRYPT_BLOWFISH;
        $mode       = MCRYPT_MODE_ECB;
        $iv_size    = mcrypt_get_iv_size ($algorithm, $mode );
    	$iv         = mcrypt_create_iv ( $iv_size, MCRYPT_RAND );
    	$key        = Yii::$app->params['securityKey'];

    	$encrypt = base64_decode ( $string );

    	return MCRYPT_DECRYPT ( $algorithm, $key, $encrypt, $mode, $iv );
    }
    //-----------------------------------------------------------------------------------------------------------------
}
