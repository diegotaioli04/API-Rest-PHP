

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
	  $corpo = json_decode(@file_get_contents('php://input'), true);
	  $a = $corpo['name'];
	  $b = $corpo['surname'];
	  $c = $corpo['tax_code'];
	  $d = $corpo['sidi_code'];
	  $student->create($a, $b, $c, $d);
	
    break;

  case 'DELETE':
    $id = getID();
	echo"funziona: ".$id;
	if (isset($id)){
		$student->cancel($id);
	}
	break;

  case 'PUT':
	$corpo = json_decode(@file_get_contents('php://input'), true);
	$PK = $corpo['id'];
	$a = $corpo['name'];
	$b = $corpo['surname'];
	$c = $corpo['tax_code'];
	$d = $corpo['sidi_code'];
	$student->update($PK, $a, $b, $c, $d);
    // TODO
    break;

  default:
    break;
}

function getID() {
    return explode('/', getenv('REQUEST_URI'))[4];
}

?>