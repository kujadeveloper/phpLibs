<?php
class file
{
	function createdir($dir)
	{
		if(!is_dir($dir))
			mkdir($dir);
	}

	function deletedir($dir) 
	{
	    if (!file_exists($dir)) {
	        return true;
	    }

	    if (!is_dir($dir)) {
	        return unlink($dir);
	    }

	    foreach (scandir($dir) as $item) {
	        if ($item == '.' || $item == '..') {
	            continue;
	        }

	        if (!$this->deletedir($dir . DIRECTORY_SEPARATOR . $item)) {
	            return false;
	        }

	    }

    	return rmdir($dir);
	}
}
?>