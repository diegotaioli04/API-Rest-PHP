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

  public function find($id){
    $sql = "SELECT * FROM student WHERE id=$id";
    $stmt = $this->db->prepare($sql);
    $data = [
      'id' => $id
    ];
    $stmt->execute($data);
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
  
  public function cancel($id){
	$sql = "DELETE FROM student WHERE id = $id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
  }
  
  public function create($_name, $_surname, $_sidiCode, $_taxCode){
	  $num = find_max();
	  $sql = "INSERT INTO student VALUES($num, '$_name', '$_surname', '$_sidiCode', '$_taxCode')";
	  $stmt = $this->db->prepare($sql);
	  $stmt->execute();
  }
}
?>
