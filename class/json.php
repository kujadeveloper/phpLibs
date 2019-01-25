<?php
class json
{
	public $start_time = 0;

	

	function json()
	{
		$this->start_time = $this->microtime_float();
	}

	function microtime_float()
	{
	    list($usec, $sec) = explode(" ", microtime());
	    return ((float)$usec + (float)$sec);
	}

	public function listele($success,$data,$toplamdata='',$page='',$ext=null)
	{
		$array = array('success'=>$success,
						'data'=>$data,
						'toplamdata'=>$toplamdata,
						'page'=>$page);
		return $this->arrayMerge($array,$ext);
	}



	public function edit($success,$msj,$ext=null)
	{

		if($success)
		{
			$array = array('success'=>$success,
									'message'=>$msj);
		}
		else
		{
			$array = array('success'=>$success,
									'error'=>$msj);
		}
		
		return $this->arrayMerge($array,$ext);
	}

	public function add($success,$msj,$ext=null)
	{

		if($success)
		{
			$array = array('success'=>$success,
									'message'=>$msj);
		}
		else
		{
			$array = array('success'=>$success,
									'error'=>$msj);
		}
		
		
		return $this->arrayMerge($array,$ext);
	}


	private function arrayMerge($array,$ext)
	{
		if($ext!=null)
			array_push($array,$ext);
		$array['runtime'] = @$this->microtime_float()-@$this->start_time;
		return json_encode($array,JSON_NUMERIC_CHECK);
	}
}
?>