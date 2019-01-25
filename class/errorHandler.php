<?php
function errorHandler ($code, $description, $file = null, $line = null, $context = null)
{
	switch($code)
	{
        case E_ERROR:               $error = "Error";              	   break;
        case E_WARNING:             $error = "Warning";                break;
        case E_PARSE:               $error = "Parse Error";            break;
        case E_NOTICE:              $error = "Notice";                 break;
        case E_CORE_ERROR:          $error = "Core Error";             break;
        case E_CORE_WARNING:        $error = "Core Warning";           break;
        case E_COMPILE_ERROR:       $error = "Compile Error";          break;
        case E_COMPILE_WARNING:     $error = "Compile Warning";        break;
        case E_USER_ERROR:          $error = "User Error";             break;
        case E_USER_WARNING:        $error = "User Warning";           break;
        case E_USER_NOTICE:         $error = "User Notice";            break;
        case E_STRICT:              $error = "Strict Notice";          break;
        case E_RECOVERABLE_ERROR:   $error = "Recoverable Error";      break;
        default:                    $error = "Unknown error ($errno)"; break;
    }
    	if(count($context)<1)
    		$context = array();
    	
		$array = array('code'=>$code,
						'error'=>$error,
						'description'=>$description,
						'file'=>$file,
						'line'=>$line,
						'context'=>'',
						'ip'=>$_SERVER['REMOTE_ADDR']);
}
set_error_handler("errorHandler");
?>