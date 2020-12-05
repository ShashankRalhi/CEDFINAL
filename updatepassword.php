<?php
session_start();
include("action.php");
include("customer-dashboard.php");



$obj = new connection();

if(isset($_POST['submit'])){
     $name = $_SESSION['username'];
     $oldpass = $_POST['oldupass'];
     $newpass = $_POST['newupass'];
     $repass = $_POST['reupass'];

     if($repass==$newpass)
     {
          if($newpass!=$oldpass)
          {
              $sql = $obj->pass($name,md5($newpass));

              if($sql){
                    echo "<script>alert('Password Updated');</script>";
              }
               else
               {
                    echo "<script>alert('SQL Fail');</script>";
               }     
          }
          else
          {
                    echo "<script>alert('Both Old & New Password are same');</script>";
          }
     }
     else
     {
          echo "<script>alert('New & Re-Passsword both are not same');</script>";
     }
}

?>

<div class="bookcontainer">
            <form method="POST" id="form">
               <h1 style="text-align: center;">UPDATE PASSWORD</h1>
               <hr />

               <label>Old Password</label>
               <input type="Password" name="oldupass" placeholder="Enter Old Password" id="oldpass"><br>

               <label>New Password</label>
               <input type="Password" name="newupass" placeholder="Enter New Password"  id="newpass"><br>

               <label>Re Password</label>
               <input type="Password" name="reupass" placeholder="Enter Re-Password"  id="newpass">

               <button name="submit" class="btn">Update</button>
            </form>
</div>




<?php include("footer.php"); ?>