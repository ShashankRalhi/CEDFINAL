<?php
session_start();
include("action.php");
include("customer-dashboard.php");


$obj = new connection();


if(isset($_POST['submit'])){
     $name = $_SESSION['username'];
     $newm = $_POST['newm'];
     $pass = $_POST['pass'];

     $sql = $obj->display();

    $passdb = "";

    $result = $sql;

    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $passdb = $row["password"];

            if(md5($pass) == $passdb)
            {
                $sql = $obj->mobile($name,$newm);
                echo "<script>alert('Mobile No. Updated');</script>";
            }
            else{
              echo "<script>alert('PASSWORD IS NOT SAME');</script>";
            }
        }
      }

    if($sql)
    {
         echo "<script>alert('Mobile No. Updated');</script>";
    }
    else
    {
         echo "<script>alert('PASSWORD IS NOT SAME');</script>";
    }
}

?>

<div class="container">
            <form method="POST" id="form">
               <h1 style="text-align: center;">UPDATE CONTACT</h1>
               <hr />

              <label>New Contact Number</label>
              <input type="text" name="newm" placeholder="Enter New Contact (10 digit)" id="newm" maxlength="10" minlength="10" required onblur="this.value=removeSpaces(this.value);" onkeypress="return isNumberKey(event)"><br>

              <label>Password</label><br>
              <input type="text" name="pass" placeholder="Enter Password" id="oldm" required onblur="this.value=removeSpaces(this.value);" onkeypress="return isNumberKey(event)"><br>


               <button name="submit" class="btn">Change Mobile Number</button>
            </form>
</div>


<script type="text/javascript">
     function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if ((charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function removeSpaces(string) {
        return string.split(' ').join('');
    }

</script>

<?php include("footer.php"); ?>