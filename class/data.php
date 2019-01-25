<?php
class data
{
	private $db;
	public  $vt;
	private $join;
	private $orderby;
	public  $page;
	private $sql;
	private $arrays = array();
	private $where;

	public function __construct ($db)
	{
		$this->db =  $db;
	}
	
	public function count()
	{
		$sql = 'SELECT count(*) as sayi FROM '.$this->vt.' WHERE sil=0 '.$this->where;
		$query = $this->db->prepare($sql);
		$query->execute($this->arrays);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result[0];
	}

	public function where($sql)
	{
		$this->remove();
		$this->where = $sql;
		return $this;
	}

	public function sqlJoin($sql)
	{
		$this->join = $sql;
		return $this;
	}

	public function orderby($sql,$clm=null,$yon=null)
	{
		if($clm!=null)
		{
			if($yon=='DESC')
				$sortyon = ' DESC';
			else
				$sortyon = ' ASC';

			$this->orderby = 'ORDER BY '.$clm.$sortyon;
		}
		else
		{
			$this->orderby = $sql;	
		}
		
		return $this;
	}


	public function sql($sql)
	{
		$this->remove();
		$this->sql = $sql;
		return $this;
	}

	private function execute()
	{
		$page = $this->page;
		$query = $this->db->prepare($this->sql.' '.$this->orderby.' '.$this->page);
		$query->execute($this->arrays);
		return $query;
	}

	public function result($fetch='')
	{
		$query = $this->execute();
		if($fetch=='fetchObject')
			return $query->fetchObject();
		else
			return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function arrays($array)
	{
		if(count($array)>0)
		{
			$this->arrays = array_merge($this->arrays,(array)$array);
		}
		return $this;
	}

	public function page($page)
	{
		$this->page = 'LIMIT '.($page*page).','.page;
		return $this;
	}

	
	private function remove()
	{
		$this->orderby = '';
		$this->page = '';
		$this->arrays = array();
	}
}
?>