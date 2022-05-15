<?php
ini_set("display_errors", false);
include 'database.php';

if(count($_POST)>0){
	if($_POST['type']==1){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$gender=$_POST['gender'];
		$phone=$_POST['phone'];
		$course=$_POST['course'];
		$city=$_POST['city'];
		$hobbies=$_POST['hobbies'];
		if(!empty($hobbies)){
			$item=implode(",", $hobbies );
		}
		
		$image = $_FILES['image']['name'];
		$extension = substr($image,strlen($image)-4,strlen($image));
		// $allowed_extensions = array(".jpg","jpeg",".png",".gif");
		$imgnewfile=md5($imgfile).time().$extension;
		move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$imgnewfile);
		// $img_loc = $_FILES['image']['tmp_name'];
		// $img_desc= "images/".$img_name;
		// move_uploaded_file($img_loc, $img_desc);

    	// $tempname = $_FILES["image"]["tmp_name"];   
        // $folder = "images/".$image;

		// $query=  "Select * FROM crud where email='".$email."'";
		// print_r($query);
		$sql = "INSERT INTO `crud`( `name`, `email`,`gender`,`phone`,`course`,`city`,`hobbies`,`image`) 
		VALUES ('$name','$email','$gender','$phone','$course','$city','$item', '$imgnewfile')";
		// try {
		// 	//code...
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200));
				// $result = array("status"=> 1, "message"=> "New data added");
				// print_r();
				// http_response_code(200);
			}
			

		// } catch (\Throwable $th) {
			//throw $th;
			// print_r("Error: " . $sql . "<br>" . mysqli_error($conn));
			// print_r($th);
			// $result = array("status"=> 0, "message" => "Email id already exist", "error" => mysqli_error($conn));
			// http_response_code(500);
		// }
		// print_r(json_encode($result));
		// header("Content-Type:Application/json");
		
		mysqli_close($conn);
	}
}

//update
if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$name=$_POST['name'];
		$email=$_POST['email'];
		$gender=$_POST['gender'];
		$phone=$_POST['phone'];
		$course=$_POST['course'];
		$city=$_POST['city'];
		$hobbies=implode(",",$_POST['hobbies']);
		$date = date('Y-m-d H:i:s');
		$sql = "UPDATE `crud` SET `name`='$name',`email`='$email',
		`gender`='$gender',`phone`='$phone',`course`='$course',`city`='$city',`hobbies`= '$hobbies', `updated_date` = '$date'
		WHERE id=$id";
	//	print_r($sql);die;
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}


if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `crud` WHERE id=$id ";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM crud WHERE id in ($id)";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
?>
