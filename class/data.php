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
		$this->sifirla();
		$this->where = $sql;
		return $this;
	}

	public function sqlJoin($sql)
	{
		$this->join = $sql;
		return $this;
	}

	public function listele($page)
	{
		$page = $page*page;
		if($this->join!='')
		{
			$sql = 'SELECT * FROM '.$this->vt.' '.$this->join.' WHERE sil=0 '.$this->orderby.' LIMIT '.$page.','.page;
		}
		else
		{
			$sql = 'SELECT * FROM '.$this->vt.' WHERE sil=0 '.$this->orderby.' LIMIT '.$page.','.page;
		}
		
		$array = array();
		$query = $this->db->prepare($sql);
		$query->execute($array);
		return $query->fetchAll(PDO::FETCH_ASSOC);
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

	public function tumuListele()
	{
		$sql = 'SELECT * FROM '.$this->vt.' WHERE sil=0 '.$this->orderby;
		$array = array();
		$query = $this->db->prepare($sql);
		$query->execute($array);
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function firma($ck='')
	{
		$ck = ($ck=='') ? '':$ck.'.';
		$this->arrays['firma_id'] = $_SESSION['firma'];
		$where = strpos(strtoupper($this->sql),'WHERE');
		if($where===false)
		{
			$fr = ' WHERE '.$ck.'firma_id=:firma_id';
			$this->sql .= $fr;
		}
		else
		{
			$fr = ' AND '.$ck.'firma_id=:firma_id';
			$this->sql .= $fr;
		}
		return $this;
	}

	public function sube($ck='')
	{
		$ck = ($ck=='') ? '':$ck.'.';
		$this->arrays['sube_id'] = $_SESSION['sube'];
		$where = strpos(strtoupper($this->sql),'WHERE');

		if($where===false)
		{
			$sb = ' WHERE '.$ck.'sube_id=:sube_id';
			$this->sql .= $sb;
		}
		else
		{
			$sb = ' AND '.$ck.'sube_id=:sube_id';
			$this->sql .= $sb;
		}
		return $this;
	}

	public function sql($sql)
	{
		$this->sifirla();
		$this->sql = $sql;
		return $this;
	}

	private function execute()
	{
		$page = $this->page;
		/*if($_SESSION['kul_id']==34)
			echo $this->sql;*/
		$query = $this->db->prepare($this->sql.' '.$this->orderby.' '.$this->page);

		//echo $this->sql.' '.$this->orderby.' '.$this->page;
		//utils::print_r($this->arrays);
		$query->execute($this->arrays);
		return $query;
	}

	public function sqlListele($fetch='')
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

	
	private function sifirla()
	{
		$this->orderby = '';
		$this->page = '';
		$this->arrays = array();
	}
}
?>