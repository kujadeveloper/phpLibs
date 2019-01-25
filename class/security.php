<?php
class security
{
	public function post($post)
	{
		return $this->recursive($post);
	}

	public function postV2($post)
	{
		return $this->recursive($post);
	}
	
	public function get($get)
	{
	    return $this->recursive($get);
	}

	private function recursive($deger,$post_array=array())
	{	
		if(is_array($deger))
		{
			foreach($deger as $key => $item)
			{
				if(is_array($item))
				{
					$post_array = array_merge($post_array,array($key=>$this->recursive($item)));
				}
				else
				{
					$post_array[$key] =  $this->cleanInput($item);
				}
			}
		}
		return $post_array;
	}

	private function cleanInput($input) 
	{
	    $search = array( 
	      '@<script[^>]*?>.*?</script>@si', // Strip out javascript 
	      '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags 
	      '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly 
	      '@<![\s\S]*?--[ \t\n\r]*>@' // Strip multi-line comments 
	    ); 
	    $output = preg_replace($search, '', $input); 
	    return $output; 
	}
}
?>