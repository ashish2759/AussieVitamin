<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * Clean query strings and protocols from urls
 * Returns only hostname
 */

function cleanReferral($url)
{
    $urlClean = implode('.', array_slice(explode('.', parse_url($url, PHP_URL_HOST)), -2));
    if ($urlClean == null) {
        return $url;
    }
    return $urlClean;
}




if(!function_exists('pr'))
{
	function pr($data,$x = 1)
	{
		echo '<br>-----<pre>';
                if( is_string($data) ){
                    echo $data;
                }else if(is_object($data) || is_array($data)){
                    print_r($data);
                }else{
                    var_dump($data);
                }
		echo "</pre>---";
                
		if($x != 0){
			die('<div id="no_more_product" ></div>');
		}
	}
}



if (!function_exists('prf')) {

    function prf($data, $param = array('title' => NULL, 'file' => NULL, 'ext' => 'php'), $fileName = NULL) {
        $output = "";
        $title = NULL;
        $fileExt = 'txt';
        if (!empty($param) && is_array($param)) {
            $fileExt = 'php';
            if (!empty($param['title'])) {
                $title = $param['title'];
            } else if (!empty($param[0])) {
                $title = $param[0];
            }

            if (!empty($param['file'])) {
                $fileName = $param['file'];
            }
            if (!empty($param['ext'])) {
                $fileExt = $param['ext'];
            }
        } else if (!empty($param) && is_string($param)) {
            $title = $param;
        }


        /*
         * $data : it will be print_r / var_dump
         * $title (OPTIONAL) : if $title dose not supplyed then a default title will be added;
         *       if $x is a A STRING it will be treated as title;
         * $fileName (OPTIONAL) : the debut info would be written in the file under application/log. 
         * if not  file name is supplied then default file name should be treated as $title_Y_m_d.
         */
        $altChars = array('-' => '_', ' ' => '_',
            "'" => '`', '"' => '~', "\n" => '', "\r" => '.'
            , "\t" => '._', "\\" => '._._', "/" => '._._._', ":" => '__', "*" => '___'
            , "?" => '____', "<" => '__.__', ">" => '__.__.__', "|" => '___.___'
        );
        /*
          if (empty($fileName) && !empty($title)) {
          $fileName = ucwords(strtolower(str_replace(array_keys($altChars), $altChars, $title)));
          }
         */
        if (empty($title) && !empty($fileName)) {
            $title = ucwords(strtolower(str_replace($altChars, array_keys($altChars), $fileName)));
        }

        if (empty($fileName)) {
            $fileName = "log_" . date('Y_m_d');
        }

        if (empty($title)) {
            $title = "Log .............. ";
        }

        $output = PHP_EOL . date('Y-m-d H:i:s');
        if (!empty($title)) {
            $output .= ' ... ' . $title;
        }
        $output .= '................::' . PHP_EOL;

        if (is_string($data)) {
            $output .= $data;
        } else if (is_numeric($data)) {
            $output .= "(Numeric) " . $data;
        } else if (is_bool($data)) {
            $output .= "(Boolean) " . var_export($data, true);
        } else if (is_object($data) || is_array($data)) {
            $output .= print_r($data, true);
        } else {
            $output .= var_export($data, true);
        }
        $output .= PHP_EOL . "========================================" . PHP_EOL;

        @file_put_contents(APPPATH . "logs\\{$fileName}.{$fileExt}", $output, FILE_APPEND);
    }

}
