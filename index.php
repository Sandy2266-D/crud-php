<?php
ini_set('display_errors', 0);
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Data</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src= "https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
	
	
	<script src="ajax.js"></script>
	
</head>
<body>
    <div class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Users</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>SL NO</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
						<th>GENDER</th>
						<th>PHONE</th>
						<th>COURSE</th>
                        <th>CITY</th>
						<th>HOBBIES</th>
						<th>IMAGE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
				<tbody>
				
				<?php
				$result = mysqli_query($conn,"SELECT * FROM crud ORDER BY updated_date DESC");
					$i=1;
					while($row = mysqli_fetch_array($result)) {
				?>
				<tr id="<?php echo $row["id"]; ?>">
				<td>
							<span class="custom-checkbox">
								<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id"]; ?>">
								<label for="checkbox2"></label>
							</span>
				</td>
					<td><?php echo $i; ?></td>
					<td><?php echo $row["name"]; ?></td>
					<td><?php echo $row["email"]; ?></td>
					<td><?php echo $row["gender"];		
				?></td>
					<td><?php echo $row["phone"]; ?></td>
					<td><?php echo $row["course"]; ?></td>
					<td><?php echo $row["city"]; ?></td>
					<td><?php echo $row["hobbies"]; ?></td>
					<td><img src= "<?php echo $row['image'];?>"></td>
					<td>

						<a href="#editEmployeeModal" class="edit" data-toggle="modal">
							<i class="material-icons update" data-toggle="tooltip" 
							data-id="<?php echo $row["id"]; ?>"
							data-name="<?php echo $row["name"]; ?>"
							data-email="<?php echo $row["email"]; ?>"
							data-gender="<?php echo $row["gender"]; ?>"
							data-phone="<?php echo $row["phone"]; ?>"
							data-course="<?php echo $row["course"]; ?>"
							data-city="<?php echo $row["city"]; ?>"
							data-hobbies="<?php echo $row["hobbies"]; ?>"
							title="Edit">&#xE254;</i>
						</a>
						<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						 title="Delete">&#xE872;</i></a>
                    </td>
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
			
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="user_form" method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Add User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<!-- NAME					 -->
						<div class="form-group">
							<label>NAME</label>
							<input type="text" id="name" name="name" class="form-control" required>
						</div>

						<!-- EMAIL -->
						<div class="form-group">
							<label>EMAIL</label>
							<input type="email" id="email" name="email" class="form-control" required>
						</div>
						<!-- Gender -->
						<div class="form-group">
							<label>GENDER</label><br/>
							<label>
							<input type="radio" name="gender" value="Male" required>
							MALE</label>&nbsp;

							<label>
							<input type="radio"  name="gender" value="Female" required>
							FEMALE</label>&nbsp;
							<label>
							<input type="radio"  name="gender" value="Others" required>
							Others</label>&nbsp;
						</div>

						<!-- PHONE -->
						<div class="form-group">
							<label>PHONE</label>
							<input type="phone" id="phone" name="phone" class="form-control">
						</div>

						<!-- COURSE -->
						<div class="form-group">
							<label>COURSE</label><br/>
							<select name="course">
							<option value="">Choose a Course</option>&nbsp;&nbsp;
    							<option value="Web Developer">Web Developer</option>
    							<option value="Python">Python</option>
								<option value="Java">Java</option>
  							</select>
						</div>
						
						<!-- CITY -->
						<div class="form-group">
							<label>CITY</label>
							<input type="city" id="city" name="city" class="form-control">
						</div>

						<!-- HOBBIES -->
						<div class="form-group">
							<label>HOBBIES</label><br/>

							<input type="checkbox"  name="hobbies[]" value="Cricket"> Cricket &nbsp;
							<input type="checkbox"  name="hobbies[]" value="Badminton"> Badminton &nbsp;
							<input type="checkbox"  name="hobbies[]" value="Volleyball"> Volleyball &nbsp;
				
						</div><br/>

						<!-- Image -->
						<div class="form-group">
							<input type ="file" name="image">Upload<br/>
							<!-- <button name="Upload">Upload</button> -->
						</div>
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-success" id="btn-add">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>


	<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Edit User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="name_u" name="name" class="form-control"	required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" id="email_u" name="email" class="form-control" required>
						</div>

					<!-- Gender -->
						<div class="form-group">
							<label>GENDER</label><br/>
							<label><input type="radio" name="gender" id="Male" value="Male"	class="Male"
							>MALE
						</label>&nbsp;

							<label>
							<input type="radio"  name="gender" id="Female" value="Female" class="Female"
							>
							FEMALE</label>&nbsp;

							<label>
							<input type="radio"  name="gender" id="Others" value="Others" class="Others"
							> OTHERS
							</label>&nbsp;
						</div>


						<div class="form-group">
							<label>PHONE</label>
							<input type="phone" id="phone_u" name="phone" class="form-control" required>
						</div>

		
						<!-- COURSE -->
						<div class="form-group">
							<label>COURSE</label><br/>
							<select name="course" id="course_u">
							<option value="">Choose a Course</option>&nbsp;&nbsp;
    							<option value="Web Developer">Web Developer</option>
    							<option value="Python">Python</option>
								<option value="Java">Java</option>
  							</select>
						</div>

						<div class="form-group">
							<label>City</label>
							<input type="city" id="city_u" name="city" class="form-control" required>
						</div>
						
						<div class="form-group">
							<label>HOBBIES</label><br/>

							<input type="checkbox" id="cricket" name="hobbies[]" value="Cricket"> Cricket &nbsp;
							<input type="checkbox" id="badminton" name="hobbies[]" value="Badminton"> Badminton &nbsp;
							<input type="checkbox" id="volleyball" name="hobbies[]" value="Volleyball"> Volleyball &nbsp;
				
						</div>
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>


	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>                                		                            