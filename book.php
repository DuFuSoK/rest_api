<?php

  // connection to db
  $db = mysqli_connect("localhost","root", "", "library") or die("Error " . mysqli_error($db));
  mysqli_query($db,"SET NAMES 'utf8'");

  $request_method = $_SERVER["REQUEST_METHOD"];
  switch($request_method){
    // get all books or specific book
    case 'GET':
      if(!empty($_GET["book_id"])){
        $book_id = intval($_GET["book_id"]);
        get_books($book_id);
      }
      else {
        get_books();
      }
      break;
    // delete specific book
    case 'DELETE':
      $book_id = intval($_GET["book_id"]);
      delete_books($book_id);
      break;
    // add new book
    case 'POST':
      insert_books();
      break;
    // change name of specific book
    case 'PUT':
      $book_id = intval($_GET["book_id"]);
      update_books($book_id);
      break;

    default :
      break;
  }

function get_books($book_id=0) {
  global $db;
  $query = "SELECT * FROM bookcase";
  if($book_id != 0){
    $query .= " WHERE id=" . $book_id . " LIMIT 1";
  }
  $response = array();
  $result = mysqli_query($db,$query);
  while ($row = mysqli_fetch_assoc($result)) {
    $response[] = $row;
  }
  header("Content-Type: application/json");
  echo json_encode($response);
}

function delete_books($book_id){
  global $db;
  $query = "DELETE FROM bookcase WHERE id=". $book_id;
  if(mysqli_query($db,$query)){
    $response = array(
                'status' => 1,
                'status message' => 'Book with id='.$book_id . ' was deleted'
    );
  }
  else {
    $response = array(
                'status' => 0,
                'status message' => 'Error! - Deleting Failed'
    );
  }
  header("Content-Type: application/json");
  echo json_encode($response);
}

function insert_books(){
  global $db;
  $name = $_POST["name"];
  $query = "INSERT INTO bookcase SET name='{$name}'";
  if(mysqli_query($db,$query)){
    $response = array(
                'status' => 1,
                'status message' => 'New book was added'
    );
  }
  else {
    $response = array(
                'status' => 0,
                'status message' => 'Error! - Adding Failed'
    );
  }
  header("Content-Type: application/json");
  echo json_encode($response);
}

function update_books($book_id){
  global $db;
  parse_str(file_get_contents("php://input"), $put_vars);
  $name = $put_vars['name'];
  $query = "UPDATE bookcase SET name='{$name}' WHERE id=".$book_id;
  if(mysqli_query($db,$query)){
    $response = array(
                'status' => 1,
                'status message' => 'Book with id=' .$book_id. ' was updated'
    );
  }
  else {
    $response = array(
                'status' => 0,
                'status message' => 'Error! - Updating Failed'
    );
  }
  header("Content-Type: application/json");
  echo json_encode($response);
}

  // Close database connection
  mysqli_close($db);

?>
