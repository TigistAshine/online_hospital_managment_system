<?php
session_start();
include("headers.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE laboratorist SET laboratoristname='$_POST[laboratoristname]',mobileno='$_POST[mobileno]',departmentid='$_POST[departmentid]',username='$_POST[username]',password='$_POST[password]',status='$_POST[status]',education='$_POST[education]',experience='$_POST[experience]' WHERE laboratoristid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('laboratorist record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$role = "Laboratorist";
	$status = "Active";
	$sql ="INSERT INTO account(username,password,role,status) values('$_POST[username]','$_POST[password]','$role','$status')";
if($qsql = mysqli_query($con,$sql))
{
$sql = "SELECT * FROM account WHERE username='$_POST[username]' AND password='$_POST[password]'";
		$qsql = mysqli_query($con,$sql);
		$rslogin = mysqli_fetch_array($qsql);
		$accId =  $rslogin['accountId'];
		$sql ="INSERT INTO laboratorist(laboratoristname,mobileno,departmentid,education,experience,accId) values('$_POST[laboratoristname]','$_POST[mobileno]','$_POST[departmentid]','$_POST[education]','$_POST[experience]','$accId')";
		if($qsql = mysqli_query($con,$sql))
{
	echo "<script>alert('Laboratorist record inserted successfully...');</script>";
}

else
{
	echo mysqli_error($con);
}
}
else
{
	echo mysqli_error($con);
}
}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM laboratorist WHERE laboratoristid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>

<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">Add New laboratorist</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <h1>Laboratorist profile Registration Panel</h1>
    <form method="post" action="" name="frmlaboratorist" onSubmit="return validateform()">
    <table width="200" border="3">
      <tbody>
        <tr>
          <td width="34%">Laboratorist Name</td>
          <td width="66%"><input type="text" name="laboratoristname" id="laboratoristname"  value="<?php echo $rsedit[laboratoristname]; ?>"/></td>
        </tr>

        <tr>
          <td>Mobile Number</td>
          <td><input type="text" name="mobileno" id="mobileno" value="<?php echo $rsedit[mobileno]; ?>"  /></td>
        </tr>
        <tr>
          <td>Department Id</td>
          <td><input type="number" name="departmentid" id="departmentid" value="<?php echo $rsedit[departmentid]; ?>"  /></td>
        </tr>

        <tr>
          <td>User Name</td>
          <td><input type="text" name="username" id="username" value="<?php echo $rsedit[username]; ?>"  /></td>
        </tr>
        <tr>
		<tr>
          <td>Password</td>
          <td><input type="password" name="password" id="password" value="<?php echo $rsedit[password]; ?>" /></td>
        </tr>
        <tr>
          <td>Confirm Password</td>
          <td><input type="password" name="confirmpassword" id="confirmpassword"  value="<?php echo $rsedit[confirmpassword]; ?>"/></td>
        </tr>
        <tr>
          <td>Education</td>
          <td><input type="text" name="education" id="education" value="<?php echo $rsedit[education]; ?>" /></td>
        </tr>
        <tr>
          <td>Experience</td>
          <td><input type="text" name="experience" id="experience" value="<?php echo $rsedit[experience]; ?>" /></td>
        </tr>   
        <tr>
          <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Submit" /></td>
        </tr>
      </tbody>
    </table>
    </form>
    <p>&nbsp;</p>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>
<?php
include("footers.php");
?>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmlaboratorist.laboratoristname.value == "")
	{
		alert("Laboratorist name should not be empty..");
		document.frmlaboratorist.laboratoristname.focus();
		return false;
	}
else if(!document.frmlaboratorist.laboratoristname.value.match(alphaspaceExp))
	{
		alert("Laboratorist name not valid..");
		document.frmlaboratorist.laboratoristname.focus();
		return false;
	}
	else if(document.frmlaboratorist.mobileno.value == "")
	{
		alert("Mobile number should not be empty..");
		document.frmlaboratorist.mobileno.focus();
		return false;
	}
	else if(!document.frmlaboratorist.mobileno.value.match(numericExpression))
	{
		alert("Mobile number not valid..");
		document.frmlaboratorist.mobileno.focus();
		return false;
	}
	else if(document.frmlaboratorist.departmentid.value == "")
	{
		alert("Department Id should not be empty..");
		document.frmlaboratorist.departmentid.focus();
		return false;
	}
	else if(document.frmlaboratorist.loginid.value == "")
	{
		alert("Login ID should not be empty..");
		document.frmlaboratorist.loginid.focus();
		return false;
	}
	else if(!document.frmlaboratorist.loginid.value.match(alphanumericExp))
	{
		alert("Login ID not valid..");
		document.frmlaboratorist.loginid.focus();
		return false;
	}
	else if(document.frmlaboratorist.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmlaboratorist.password.focus();
		return false;
	}
	else if(document.frmlaboratorist.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmlaboratorist.password.focus();
		return false;
	}
	else if(document.frmlaboratorist.password.value != document.frmlaboratorist.confirmpassword.value )
	{
		alert("Password and confirm password should be equal..");
		document.frmlaboratorist.confirmpassword.focus();
		return false;
	}
	else if(document.frmlaboratorist.select.value == "" )
	{
		alert("Select the status..");
		document.frmlaboratorist.select.focus();
		return false;
	}
	else if(document.frmlaboratorist.education.value == "")
	{
		alert("Education should not be empty..");
		document.frmlaboratorist.education.focus();
		return false;
	}
	
	else if(document.frmlaboratorist.experience.value == "")
	{
		alert("experience should not be empty..");
		document.frmlaboratorist.experience.focus();
		return false;
	}
	
	else
	{
		return true;
	}
}

</script>