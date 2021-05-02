<?php
include("DBConnection.php");
class Student 
{
  private $db;
  public $_id;
  public $_name;
  public $_surname;
  public $_sidiCode;
  public $_taxCode;

  public function __construct() {
    $this->db = new DBConnection();
    $this->db = $this->db->returnConnection();
  }

  public function find($idd){
    $sql = "SELECT * FROM student WHERE id = ".$idd;
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $result;
  }
  
  public function all(){
    $sql = "SELECT * FROM student WHERE id < 80";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }
  
  public function find_max(){
	 $sql = "SELECT MAX(id) FROM student"; 
	 $stmt = $this->db->prepare($sql);
	 $stmt->execute();
	 while($row = $result->fetch(PDO::FETCH_OBJ))
	 {
		$num = $row->id;
	 }		 
	 return $num;
  }	  
  
  public function cancel($idc){
	$sql = "DELETE FROM student_class WHERE id_student = ".$idc;
    $stmt = $this->db->prepare($sql);
    $stmt->execute(); 
	$sql = "DELETE FROM student WHERE id = ".$idc;
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
  }
  
  public function create($_name, $_surname, $_sidiCode, $_taxCode){
	  $num = find_max();
	  $sql = "INSERT INTO student VALUES($num, '$_name', '$_surname', '$_sidiCode', '$_taxCode')";
	  $sql = "INSERT INTO student VALUES('diego', 'taioli', '12342345', 'BDLSMN05H07Z365P')"; 
	  $stmt = $this->db->prepare($sql);
	  $stmt->execute();
  }
}
?>
