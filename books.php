<?php
// connection to db
  $db = mysqli_connect("localhost","root", "", "library");
  // check connection
  if(mysqli_connect_errno()){
    echo "Fail to connect to database";
  }

/*
  $query = "SELECT * FROM bookcase";
  $result = mysqli_query($db, $query);
  while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
*/

$request_method=$_SERVER["REQUEST_METHOD"];

switch($request_method)
	{
    case 'GET':
			// Retrive Products
			if(!empty($_GET["book_id"]))
			{
				$book_id=intval($_GET["book_id"]);
				get_books($book_id);
			}
			else
			{
				get_books();
			}
			break;
		case 'POST':
			// Insert Book
      echo 'Vkladanie';
			break;
		case 'PUT':
			// Update Book
      echo 'Zmena';
			break;
		case 'DELETE':
			// Delete Book
      echo 'Mazanie';
			break;
		default:
      echo 'Ziadny request';
			break;
	}

  function get_books($book_id=0)
	{
		global $db;
		$query="SELECT * FROM bookcase";
		if($book_id != 0)
		{
			$query.=" WHERE id=".$book_id." LIMIT 1";
		}
		$response=array();
		$result=mysqli_query($db, $query);
		while($row=mysqli_fetch_array($result))
		{
			$response[]=$row;
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

  // Close database connection
  	mysqli_close($db);



?>
