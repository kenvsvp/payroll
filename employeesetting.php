<?php
include 'core/initForMainLogPage.php';
?>

<?php
 if(logged_in()){
$data=user_dataAdmin('username');
$usernameData=$data['username'];
 }else{
	 header('Location: index.php');
 }
?>
<?php include 'includes/adminHeadAll.php';?>

<header>
 <?php include 'includes/adminMenu.php';?> 
  </header>
  <div class="container">
  <br/>
	<?php


//admin login code
$error=array();
$errorAll='';
 
if(isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['designa']) && isset($_POST['level'])){
		 $name=htmlentities(mysql_real_escape_string($_POST['name']));
		 $phone=htmlentities(mysql_real_escape_string($_POST['phone']));
		$email=htmlentities(mysql_real_escape_string($_POST['email']));
	   	$designa=htmlentities(mysql_real_escape_string($_POST['designa']));
	   	$level=htmlentities(mysql_real_escape_string($_POST['level']));


 
	   //checking for the validity of data entered
	   if(empty($name) || empty($phone) || empty($email) || empty($designa) || empty($level)){
		   $error[]='All fields are required.';
	   }else{
	   
	   if(preg_match('/^[^\_\.\-\+\=]+[a-zA-Z]+$/',$name)==false){
   		$error[]='Name must only be in letters '; 
		}
		
		  if(preg_match('/^[^\_\.\-\+\=]+[0-9]+$/',$phone)==false){
   		$error[]='Phone numbers must be in numbers only'; 
		}
		
		 if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
 		 $error[]=' Email is not correct';
 		 }
		
		
	   }
	   
	    if(!empty($error)){
	  $errorAll= '<div class="error"><ul><li>'.implode('</li><li>',$error).'</li></ul></div>';

		}else{
			employeeInfo($name,$phone,$email,$designa,$level);
			echo '<p class="pa">Employee is  successfully added.&nbsp;&nbsp;<a href="manage-employee.php">See Changes</a></p>';
		}

 }//end isset
 

?>



<h2 class="formHead">Add New Employee</h2>
<div class="tableWrap">
<form action="" method="post">
  <table cellpadding="0" cellspacing="0">
   <tr><td> Name: </td><td><input type="text" name="name" class="input" value="<?php if(isset($name)){ echo $name;} ?>"></td></tr>
   <tr><td>Phone: </td><td><input type="text" name="phone" class="input" value="<?php if(isset($phone)){ echo $phone;} ?>"></td></tr>
   <tr><td>Email: </td><td><input type="email" name="email" class="input" value="<?php if(isset($email)){ echo $email;} ?>"></td></tr>
   <tr><td>Designation</td><td><input type="text" name="designa" class="input" value="<?php if(isset($designa)){ echo $designa;} ?>"></td></tr>
   <tr><td>Level: </td><td>
   
      <select name="level">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      </select>   
   </td></tr>
   <tr><td> </td><td><input type="submit" value="Saved" class="submit"></td></tr>
</table>
</form>
</div>
<br />
<?php echo $errorAll; ?>


 </div> 
	 <?php include 'includes/footerAll.php';?>  
</body>
</html>



