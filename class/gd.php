<?php
class gd 
{
	public $image = null;
	public $base64 = null;
	public $orjimage = null;
	public $imageinfo = null;
	public $imagetype = null;


	function __destruct()
    {
       
    }



    function createImg($url,$image_type)
    {
    	switch ($image_type)
	    {
	        case 1: 
	            $im = imagecreatefromgif($url); 
	        break;
	        case 2:
	            $im = imagecreatefromjpeg($url);  
	        break;
	        case 3: 
	            $im = imagecreatefrompng($url);
	        break;
	    }
	    $this->imagetype = $image_type;
	    $this->orjimage = $im;
	    return $this;
    }

	function cropImg($x1,
                    $y1,
                    $x2,
                    $y2,
                    $width,
                    $height,$outtype='base64') 
    {   
        $new = ImageCreateTrueColor($width, $height);
        imagecopyresampled($new, $this->orjimage, 0, 0, $x1,$y1,$width,$height,($x2-$x1),($y2-$y1));


    	$base64 = $this->imagetype($new, $this->imagetype);
    	$this->base64 = $base64;
        $this->image = $new;
        return $this;
    }

    function getImageInfo($dir)
    {
		$this->imageinfo = list($width, $height, $image_type) = getimagesize($dir);
		return $this;
    }

   	function imagetype($im,$image_type)
    {
        switch ($image_type)
        {
            case 1: 
                ob_start (); 
                //$im = imagegif($im);
                $im = imagegif($im);
                $image_data = ob_get_contents ();
                ob_end_clean();
                $base64 = 'data:image/jpeg;base64,'.base64_encode($image_data);
            break;
            case 2: 
                ob_start (); 
                $im = imagejpeg($im);  
                $image_data = ob_get_contents ();
                ob_end_clean();
                $base64 = 'data:image/jpeg;base64,'.base64_encode($image_data);
            break;
            case 3: 
                ob_start (); 
                //$im = imagepng($im);
                $im = imagepng($im);
                $image_data = ob_get_contents ();
                ob_end_clean();
                $base64 = 'data:image/jpeg;base64,'.base64_encode($image_data);
            break;
            default: 
                return '';  
            break;
        }
       return $base64;
    }

    function resize_image($file, $w, $h, $crop=FALSE) 
    {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        $this->image = $dst;
        return $this;
    }


    function save($out)
    {
       imagejpeg($this->image,$out);  
    }

}
?>