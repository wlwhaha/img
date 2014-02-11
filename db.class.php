<?php
class db{

	private $link_id;

	function __construct(){
		require_once("config.db.php");
		$this->connect($db_config["hostname"], $db_config["username"], $db_config["password"], $db_config["database"],$db_config["charset"]);
	
	}

	//数据库连接
    private function connect($dbhost, $dbuser, $dbpw, $dbname,$charset) {
        
        $this->link_id = @mysql_connect($dbhost, $dbuser, $dbpw, true);
        if(!$this->link_id){
            $this->halt("数据库连接失败");
        }
    
        if(!@mysql_select_db($dbname,$this->link_id)) {
            $this->halt('数据库选择失败');
        }
        @mysql_query("set names ".$charset);
    }

	//查询
    public function query($sql) {
        $query = mysql_query($sql,$this->link_id);
        if(!$query) $this->halt('Query Error: ' . $sql);
        return $query;
    }
     
    //获取一条记录（MYSQL_ASSOC，MYSQL_NUM，MYSQL_BOTH）             
    public function get_one($sql,$result_type = MYSQL_ASSOC) {
        $query = $this->query($sql);
        $rt = mysql_fetch_array($query,$result_type);
        return $rt;
    }
 
   //获取全部记录
    public function get_all($sql,$result_type = MYSQL_ASSOC) {
        $query = $this->query($sql);
        $i = 0;
        $rt = array();
        while($row =mysql_fetch_array($query,$result_type)) {
            $rt[$i]=$row;
            $i++;
        }
        return $rt;
    }
     
    //插入username = "zhangsan" $dataArray("username"=>"zhangsan")
    public function insert($table,$dataArray) {
        $field = "";
        $value = "";
        if( !is_array($dataArray) || count($dataArray)<=0) {
            $this->halt('没有要插入的数据');
            return false;
        }
        foreach($dataArray as $key=>$val) {
            $field .=$key.",";
            $value .="'".$val."',";
        }
        $field = substr( $field,0,-1);
        $value = substr( $value,0,-1);
        $sql = "insert into $table($field) values($value)";
        
        if(!$this->query($sql)){
			return $sql;
		}else{
			return true;
		}
	}

    //更新
    public function update( $table,$dataArray,$condition="") {
        if( !is_array($dataArray) || count($dataArray)<=0) {
            $this->halt('没有要更新的数据');
            return false;
        }
        $value = "";
		$field = "";
        foreach($dataArray as $key=>$val) {
            $value .="$key = '$val',";
        }
        $value = substr( $value,0,-1);
        $sql = "update $table set $value where 1=1 and $condition";
        if(!$this->query($sql)) return false;
        return true;
    }

    //删除
    public function delete($table,$condition="") {
        if( empty($condition) ) {
            $this->halt('没有设置删除的条件');
            return false;
        }
        $sql = "delete from $table where 1=1 and $condition";

        if(!$this->query($sql)) return false;
        return true;
    }

	//错误提示
    private function halt($msg='') {
        $msg .= "\r\n".mysql_error();
        die($msg);
    }
}












?>