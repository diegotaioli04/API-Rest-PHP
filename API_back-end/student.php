

<?php
$method = $_SERVER["REQUEST_METHOD"];
include('./class/Student.php');
$student = new Student();

switch($method) 
{
  case 'GET':
    /*$id = $_GET['id'];
	$js_encode = null;
    if (isset($id)){
      $student = $student->find($id);
      $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
    }else{*/
      $students = $student->all();
      $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
	  header("Content-Type: application/json");

	foreach($arr['students'] as $stud){
		$name = $stud["name"];
		$surname = $stud["surname"];
		$Code = $stud["sidi_code"];
		$tax = $stud["tax_code"];
		echo "<div class='row align-items-start'>
            <div class='col-md-2'> </div>
            <div class='col-md-1'> <input type='checkbox' /> </div>
            <div class='col-md-2'> $name $surname </div>
            <div class='col-md-2'> $Code </div>
            <div class='col-md-3'> $tax </div>
            <div class='col-md-1'>
                <input class='b1' type='button'/> 
                <input class='b2' type='button' /> 
            </div>
            <div class='col-md-1'> </div>";
	}
    break;

  case 'POST':
 
    // TODO
    break;

  case 'DELETE':
    // TODO
    break;

  case 'PUT':
  
    // TODO
    break;

  default:
    break;
}

?>