<?php

/**
 * Description of Helper
 *
 * @author blonder413
 */

namespace common\models;

class Helper {
	public static function calculaEdad($fecha)
	{
            //fecha actual

                $dia=date("j");
                $mes=date("n");
                $ano=date("Y");

                //fecha de nacimiento
                  $dianaz=substr($fecha,8,2);
                  $mesnaz=substr($fecha,5,2);
                  $anonaz=substr($fecha,0,4);


                //si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

                if (($mesnaz == $mes) && ($dianaz > $dia)) {
					$ano=($ano-1);
				}

                //si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

                if ($mesnaz > $mes) {
					$ano=($ano-1);
				}

                //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

                $edad=($ano-$anonaz);

                return $edad;
	}
	//---------------------------------------------------------------------------------------------
	/**
	 * @return boolean true para movil, false para computador
	 */
	public static function detectarMovil()
    {
		$es_movil=FALSE; //Aquí se declara la variable falso o verdadero XD
		$usuario = $_SERVER['HTTP_USER_AGENT']; //Con esta leemos la info de su navegador
		$usuarios_moviles = "Android, AvantGo, Blackberry, Blazer, Cellphone, Danger, DoCoMo, EPOC,EudoraWeb, Handspring, HTC, Kyocera, LG, MMEF20, MMP, MOT-V, Mot, Motorola, NetFront, Newt,Nokia, Opera Mini, Palm, Palm, PalmOS, PlayStation Portable, ProxiNet, Proxinet, SHARP-TQ-GX10,Samsung, Small, Smartphone, SonyEricsson, SonyEricsson, Symbian, SymbianOS, TS21i-10, UP.Browser,UP.Link, WAP, webOS, Windows CE, hiptop, iPhone, iPod, portalmmm, Elaine/3.0, OPWV";
		$navegador_usuario = explode(',',$usuarios_moviles);
		foreach($navegador_usuario AS $navegador) {
			if(@preg_match('/'.trim($navegador).'/',$usuario)){
				$es_movil=TRUE;
            }
        }

        if($es_movil==TRUE){
            return true;
        } else{
            return false;
        }
    }
	// -------------------------------------------------------------------------------------------------------------------
    public static function getRealIP()
	{
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            return $_SERVER['REMOTE_ADDR'];
    }

    // -------------------------------------------------------------------------------------------------------------------
    // Cortar textos sin cortar palabras
    // Original PHP code by Chirp Internet: www.chirp.com.au
    // Please acknowledge use of this code by including this header.
    public static function myTruncate($string, $limit, $break = " ", $pad = "...") {
        // return with no change if string is shorter than $limit
        if (strlen($string) <= $limit) {
            return $string;
        }
        // is $break present between $limit and the end of the string?
        if (false !== ($breakpoint = strpos($string, $break, $limit))) {
            if ($breakpoint < strlen($string) - 1) {
                $string = substr($string, 0, $breakpoint) . $pad;
            }
        }
        return $string;
    }
    // -------------------------------------------------------------------------------------------------------------------
    // Obtengo los textos limpios para usarlos como url
	public static function limpiaUrl($entra) {
		$traduce = array (
				'á' => 'a',
				'é' => 'e',
				'í' => 'i',
				'ó' => 'o',
				'ú' => 'u',
				'Á' => 'A',
				'É' => 'E',
				'Í' => 'I',
				'Ó' => 'O',
				'Ú' => 'U',
				'ñ' => 'n',
				'Ñ' => 'N',
				'ä' => 'a',
				'ë' => 'e',
				'ï' => 'i',
				'ö' => 'o',
				'ü' => 'u',
				'Ä' => 'A',
				'Ë' => 'E',
				'Ï' => 'I',
				'Ö' => 'O',
				'Ü' => 'U'
		);
		$sale = strtr ( $entra, $traduce );

		$texto = str_replace ( " ", "-", $sale );

                $texto = strtolower($texto);

		return $texto;
	}
}
