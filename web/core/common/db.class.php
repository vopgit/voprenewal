<?php
//if(!defined('_HOME_TITLE')) exit;

/*******************************
 * 사용법 *  
 require_once('class.db.php');
 $database = new DB();  OR  $database = DB::getInstance();
********************************/

$database = array(
				'master' => array('서버IP', '사용자명', '비밀번호', 'DB명', 'utf8'),
				'counter' => array('서버IP', '사용자명', '비밀번호', 'DB명', 'utf8'),
			);

//디버깅 정의
if(empty($_base['debug'])) $_base['debug'] = false;
define( 'DISPLAY_DEBUG', $_base['debug']);

class DB
{
    private $link = null;
    public $filter;
    static $inst = null;
    public static $counter = 0;

	public function log_db_errors($error, $query)
    {
        $message  = '<p>Error: '.$error.'</p>';
        $message .= '<p>Query: '. htmlentities($query).'</p>';

		if(!defined('DISPLAY_DEBUG') || (defined('DISPLAY_DEBUG') && DISPLAY_DEBUG))
        {
            echo $message;   
			//trigger_error($message);
        }
    }
    
    public function __construct($dbname = 'master')
    {
		global $database;
		
		mb_internal_encoding('UTF-8');
        mb_regex_encoding('UTF-8');
        //mysqli_report(MYSQLI_REPORT_STRICT);

		$this->link = new mysqli($database[$dbname][0], $database[$dbname][1], $database[$dbname][2], $database[$dbname][3]);
		if ($this->link->connect_errno) 
		{
			die($this->link->connect_error);				
			die("<p>사이트 점검중입니다. 잠시 후 이용하여 주세요.</p>"); //$this->link->connect_error;
		}
		$this->link->set_charset($database[$dbname][4]);
	}
    public function __destruct()
    {
        if($this->link)
        {
            $this->disconnect();
        }
    }

	public function filter($data)
	{
		if(!is_array($data))
		{
			$data = $this->link->real_escape_string(trim($data));
			//$data = trim(htmlentities($data, ENT_QUOTES, 'UTF-8', false));
		}
		else
		{
			//배열일 경우 재귀호출합니다.
			$data = array_map(array($this, 'filter'), $data);
		}
		return $data;
	}
    
	public function clean($data)
    {
		$data = stripslashes($data);
        $data = html_entity_decode($data, ENT_QUOTES, 'UTF-8');
        $data = nl2br($data);
        $data = urldecode($data);
        return $data;
    }
    
	public function query($query)
    {
        $full_query = $this->link->query($query);
        if($this->link->error)
        {
            $this->log_db_errors($this->link->error, $query);
            return false; 
        }
        else
        {
            return true;
        }
    }
    
    public function num_rows($query)
    {
        self::$counter++;
        $num_rows = $this->link->query($query);
        if($this->link->error)
        {
            $this->log_db_errors($this->link->error, $query);
            return $this->link->error;
        }
        else
        {
            return $num_rows->num_rows;
        }
    }
    
    public function exists($table = '', $check_val = '', $params = array())
    {
        self::$counter++;
        if(empty($table) || empty($check_val) || empty($params))
        {
            return false;
        }
        $check = array();
        $check[] = "$field = '$value'";   
		$check = implode(' AND ', $check);
        $rs_check = "SELECT $check_val FROM ".$table." WHERE $check";
        $number = $this->num_rows($rs_check);
        if($number === 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
	public function row($query, $object = false)
    {
        self::$counter++;
        $row = null;
		$results = $this->link->query($query);
        if($this->link->error)
        {
            $this->log_db_errors($this->link->error, $query);
            return false;
        }
        else
        {
            $r = (!$object) ? $results->fetch_assoc() : $row->fetch_object();
            return $r;   
        }
    }

	public function rowone($query)
    {
        self::$counter++;
        $row = null;
		$results = $this->link->query($query);
        if($this->link->error)
        {
            $this->log_db_errors($this->link->error, $query);
            return false;
        }
        else
        {            
            $r = $results->fetch_array();
			return $r[0];  
        }
    }
	
	//리스트 가져오기
	public function get_list($q = array())
    {
        $data = null;

		if(empty($q['table'])) return false;
		if(empty($q['orderby'])) return false;

		//조건절
		$where = $this->make_where($q['where']);

		//전체개수
		$tquery = "select count(*) from ".$q['table']." ".$where." ".$q['add_qry'];	
		$tot = $this->total($tquery);
		if($tot < 1) return false;

		//페이지분할
		$nPageSize = (empty($q['nPageSize'])) ? 10 :  $q['nPageSize'];
		$nPage = ($q['nPage'] * 1 < 1) ? 1 :  $q['nPage'];		
		$tpage = ceil($tot / $nPageSize);
		$offset = $nPageSize * ($nPage - 1);

		//데이터가져오기
		$query = "select ".$q['field']." from ".$q['table']." ".$where." ".$q['add_qry']." order by ".$q['orderby']." limit ".$offset.", ".$nPageSize;
		
		$data = array(
				'total' => $tot,
				'tot_page' => $tpage,
				'data' => $this->select($query)
				);

		return $data;
    }

	//리스트 가져오기
	public function get_list_all($q = array())
    {
        $data = null;

		//print_r($q);

		if(empty($q['table'])) return false;
		if(empty($q['orderby'])) return false;

		//조건절
		$where = $this->make_where($q['where']);

		//데이터가져오기
		$query = "select ".$q['field']." from ".$q['table']." ".$where." ".$q['add_qry']." order by ".$q['orderby'];
		//echo $query;
		$data = $this->select($query);
		return $data;
    }

	//조건절만들기
	public function make_where($where)
    {
		if(empty($where)){

			$str_where = "";

		}else{

			$str_where="";

			if(is_array($where)){
				
				foreach($where  as $field => $value){
					$field = $this->filter($field);
					$value = $this->filter($value);
					$str_where .= ($str_where == "") ? $field."='".$value."'" : " and ".$field."='".$value."'";
				}

			}else{

				$str_where  = $where;

			}
			
			if($str_where  == "") $str_where = "1";
			$str_where = " where ".$str_where;
		};
		return $str_where;
    }

	public function select($query, $object = false)
    {
        self::$counter++;

        $row = null;

        $results = $this->link->query($query);
        if($this->link->error)
        {
            $this->log_db_errors($this->link->error, $query);
            return false;
        }
        else
        {
            $row = array();
            while($r = (!$object) ? $results->fetch_assoc() : $results->fetch_object())
            {
                $row[] = $r;
            }
            return $row;   
        }
    }

	public function total($query)
    {
        self::$counter++;

		$row = null;
        
        $results = $this->link->query($query);
        if($this->link->error)
        {
            $this->log_db_errors($this->link->error, $query);
            return false;
        }
        else
        {
            $row = $results->fetch_array();
            return $row[0];   
        }
    }
    
    public function insert($table, $variables = array())
    {
        self::$counter++;

        if(empty($variables))
        {
            return false;
        }
        
        $sql = "INSERT INTO ". $table;
        $fields = array();
        $values = array();
		
        foreach($variables as $field => $value)
        {
			$fields[] = $field;
            $values[] = "'".$value."'";
        }
        $fields = ' (' . implode(', ', $fields) . ')';
        $values = '('. implode(', ', $values) .')';
        
        $sql .= $fields .' VALUES '. $values;

        $query = $this->link->query($sql);
        
        if($this->link->error)
        {
            $this->log_db_errors($this->link->error, $sql);
            return false;
        }
        else
        {
            return true;
        }
    }
 
    public function update($table, $variables = array(), $where = array(), $limit = '')
    {
        self::$counter++;

        if(empty($variables))
        {
            return false;
        }
        $sql = "UPDATE ". $table ." SET ";        
		
		foreach($variables as $field => $value)
        {
			if($value == 'null') $updates[] = "`$field` = null";  //널처리
			else if($value == '++') $updates[] = "`".$field."` = ".$field."+1";  //카운터증가
			else $updates[] = "`$field` = '$value'";
        }
        $sql .= implode(', ', $updates);
        
        if(!empty($where))
        {
            foreach($where as $field => $value)
            {  
				$clause[] = $field." = '".$value."'";
            }
            $sql .= ' WHERE '. implode(' AND ', $clause);   
        }

        if(!empty($limit))
        {
            $sql .= ' LIMIT '. $limit;
        }

		$query = $this->link->query($sql);
        if($this->link->error)
        {
            $this->log_db_errors($this->link->error, $sql);
            return false;
        }
        else
        {
            return true;
        }
    }
    
    public function delete($table, $where = array(), $limit = '')
    {
        self::$counter++;
        if(empty($where))
        {
            return false;
        }
        
        $sql = "DELETE FROM ". $table;
        foreach($where as $field => $value)
        {
            $value = $value;
            $clause[] = "$field = '$value'";
        }
        $sql .= " WHERE ". implode(' AND ', $clause);
        
        if(!empty($limit))
        {
            $sql .= " LIMIT ". $limit;
        }
            
        $query = $this->link->query($sql);
        if($this->link->error)
        {
            $this->log_db_errors($this->link->error, $sql);
            return false;
        }
        else
        {
            return true;
        }
    }
    
    
    /*
    $database->insert('users_table', $user);
    $lastid = $database->lastid();
    */
    public function lastid()
    {
        return $this->link->insert_id;
    }
    
    public function affected()
    {
        return $this->link->affected_rows;
    }    

    public function num_fields($query)
    {
        self::$counter++;
        $query = $this->link->query($query);
        $fields = $query->field_count;
        return $fields;
    }
    
    public function list_fields($query)
    {
        self::$counter++;
        $query = $this->link->query($query);
        $listed_fields = $query->fetch_fields();
        return $listed_fields;
    }

    /*
    public function truncate($tables = array())
    {
        if(!empty($tables))
        {
            $truncated = 0;
            foreach($tables as $table)
            {
                $truncate = "TRUNCATE TABLE `".trim($table)."`";
                $this->link->query($truncate);
                if(!$this->link->error)
                {
                    $truncated++;
                    self::$counter++;
                }
            }
            return $truncated;
        }
    }
    */
    
    public function display($variable, $echo = true)
    {
        $out = '';
        if(!is_array($variable))
        {
            $out .= $variable;
        }
        else
        {
            $out .= '<pre>';
            $out .= print_r($variable, TRUE);
            $out .= '</pre>';
        }
        if($echo === true)
        {
            echo $out;
        }
        else
        {
            return $out;
        }
    }
    
    public function total_queries()
    {
        return self::$counter;
    }
    
    static function getInstance()
    {
        if(self::$inst == null)
        {
            self::$inst = new DB();
        }
        return self::$inst;
    }

    public function disconnect()
    {
        $this->link->close();
    }

} //end class DB
