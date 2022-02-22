<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP form</title>
    <style media="screen">
      .error{
        color:red;
      }
    </style>
  </head>
  <body>
    <!--Objective = Display user form input on the same page as the form-->
<!--Validation = pass all variables through PHP's htmlspecialchars() functions to make sure data is transmitted securely
Use the trim funtion to strip any unnecessary characters such as extra space, tabs, or breaks inserted into the input fields.
Use the striplashes() function to remove any backslashes from use input data.
This helps add an additional layer of security and projects data integrity. -->
<?php
$name = $website = $position = $Experience = $estatus = $comments = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty($_POST["name"])){
    echo "<span class=\"error\">Error: First Name Required</span><br>";
    //validation: name can only contain letters and white spaces
  }else if(!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])){
    echo "<span class=\"error\">Error: name can only contain letters or space</span><br>";
  }
  if(empty($_POST["website"])){
    echo "<span class=\"error\">Error: Website is required</span><br>";
  }
  //validation: website must be in correct format (www.mywebsite.com)
  else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$_POST["website"])){
      echo "<span class=\"error\">Error:Website is in wrong format</span><br>";
    }
  if($_POST["website"] && $_POST["name"]){
    $name = val($_POST["name"]);
    $website = val($_POST["website"]);
    $position = val($_POST["position"]);
    $Experience = val($_POST["Experience"]);
    $estatus = val($_POST["estatus"]);
    $comments = val($_POST["comments"]);
  }
}
function val($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
    <form name="emplyment" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <table width="600" border="0" cellspacing="1" callpadding="1">
        <tr>
          <td>
            <h2>Employment Application</h2>
          </td>
          <td></td>
        </tr>
        <tr>
          <td>Name</td>
          <td>
            <input type="text" name="name" maxlength="50"/>
          </td>
        </tr>
        <tr>
          <td>Website</td>
          <td>
            <input type="text" name="website" maxlength="50"/>
          </td>
        </tr>
        <tr>
          <td>Position</td>
          <td>
            <select class="" name="position">
              <option value="Accounting">Accounting</option>
              <option value="Receptionist">Receptionist</option>
              <option value="Administrator">Administrator</option>
              <option value="Supervisor">Supervisor</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Experience Level</td>
          <td>
            <select name="Experience">
              <option value="Entry Level">Entry Level</option>
              <option value="Some Experience">Some Experience</option>
              <option value="Very Experienced">Very Experienced</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Employement Status</td>
          <td>
            <input type="radio" name="estatus" value="Employed" checked/>Employed
            <input type="radio" name="estatus" value="Unemployed"/>Unemployed
            <input type="radio" name="estatus" value="Student"/>Student
          </td>
        </tr>
        <tr>
          <td>Additional Comments</td>
          <td>
            <textarea name="comments" rows="5" cols="45"></textarea>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" name="submit" value="Submit">
            <input type="reset" name="reset" value="Reset">
          </td>
        </tr>
      </table>
    </form>
    <?php
    echo "<h2>User Input</h2>";
    echo "Name: " . $name;
    echo "<br>";
    echo "Website: " . $website;
    echo "<br>";
    echo "Position: " . $position;
    echo "<br>";
    echo "Experience: " . $Experience;
    echo "<br>";
    echo "Employment Status: " . $estatus;
    echo "<br>";
    echo "Comments: " . $comments;
     ?>
  </body>
</html>
