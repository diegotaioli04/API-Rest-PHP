

<?php
$method = $_SERVER["REQUEST_METHOD"];
include('./class/Student.php');
$student = new Student();

switch($method) 
{
  case 'GET':
  $id = getID();
    
	if (isset($id)){
      $student = $student->find($id);
      $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
    }
	else{
      $students = $student->all();
      $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
    }
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  case 'POST':
  //$entityBody = file_get_contents('php://input');
  //echo $entityBody;
  //$students = $students->create("", "", "", "");
	
    break;

  case 'DELETE':
    /*$id = getID();
	echo"funziona: ".$id;
	if (isset($id)){
		$students = $students->cancel($id);
	}*/
	break;

  case 'PUT':
  
    // TODO
    break;

  default:
    break;
}


function getID() {
    return explode('/', getenv('REQUEST_URI'))[4];
}

?>