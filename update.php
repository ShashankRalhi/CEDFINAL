<?php
session_start();
include("header.php");
include("action.php");

$obj = new connection();

$msg = "";
if (isset($_POST['submit'])) {
     $name = $_POST['username'];
     $oldpass = $_POST['oldpass'];
     $newpass = $_POST['newpass'];
     $repass = $_POST['repass'];

     if ($name == null && $oldpass == null && $newpass == null && $repass == null) {
          $msg = "Please Complete All Fields";
     }

     if ($newpass == $repass) {  

          $sql = $obj->display();

          $result = $sql;

          if ($result->num_rows > 0) {

               while ($row = $result->fetch_assoc()) {
                    $username = $row['user_name'];
                    $password = $row['password'];

                    $name = strtolower($name);
                    $username = strtolower($username);

                    if ($name == $username) {

                         if(md5($oldpass) == $password) {

                              if($newpass==$oldpass){
                                   echo "<script>alert('Password IS sAME');</script>";
                              }
                              else{                              {

                                   $sql = $obj->updatepass($username, md5($newpass));

                                   if ($sql) {

                                        echo "<script>alert('Password Updated');</script>";

                                   } else {

                                        echo "<script>alert('Password Updation Failed');</script>";
                                   }
                              }}
                         }
                    }
               }
          }
     }
}
?>

<!-- <div class="logincontainer">
     <h1 style="text-align: center;">Change Password</h1>
     <hr />
     <form method="POST" action="update.php">
          <div style="color: red;text-align: center;">
               <?php //echo $msg; ?>
          </div>

          <div>
               <label>User Name</label>
               <input type="text" name="username" placeholder="Enter User Name" onblur="this.value=removeSpaces(this.value);">
          </div>

          <div>
               <label>Old Password</label>
               <input type="password" name="oldpass" placeholder="Enter Old Password">
          </div>

          <div>
               <label>New Password</label>
               <input type="password" name="newpass" placeholder="Enter New Password">
          </div>

          <div>
               <label>Re-Password</label>
               <input type="password" name="repass" placeholder="Re-Password">
          </div>

          <div>
               <input type="submit" name="submit" value="Change password" class="btn" style="width: 100%;">
          </div>
     </form>
</div> -->

<div class="form">
            <form method="POST" id="upform" action="update.php">
               <h1 style="text-align: center;">PASSWORD</h1>
               <hr />

               <div style="color: red;text-align: center;">
                    <?php echo $msg; ?>
               </div>

               <label>User Name</label>
               <input type="text" name="username" placeholder="Enter User Name" 
                         onblur="this.value=removeSpaces(this.value);"><br>

               <label>Old Password</label>
               <input type="password" name="oldpass" placeholder="Enter Old Password"><br>

               <label>New Password</label>
               <input type="password" name="newpass" placeholder="Enter New Password"><br>

               <label>Re-Password</label>
               <input type="password" name="repass" placeholder="Re-Password"> <br>
               <button name="submit" class="btn">Change password</button>
               <?php 
                    if(isset($_SESSION['username'])){
               ?>
                    <!-- <button id="back">Back</button> -->
               <?php
                    }
                    else{

                    }
               ?>
            </form>
</div>

<script type="text/javascript">
      function removeSpaces(string) {
        return string.split(' ').join('');
    }

    // $("#back").click(function(){
    //       window.location.replace("localhost/cab/customer.php");
    // });
</script>



<?php include("footer.php"); ?>