<?php

class logs
{
	public function __construct ($page,$request)
	{
		for($i=0; $i<count($request); $i++) 
		{
			if(isset($request['password']))
			{
				$request['password'] = '******';
			}
		}

		$array = array('page'=>$page, 'request'=>json_encode($request));
		$this->save($array);
	}

	private function save($datas)
	{
		$datas = array_merge($datas, array('ip'=>utils::GetIP()));
	}
}
//aa
?>