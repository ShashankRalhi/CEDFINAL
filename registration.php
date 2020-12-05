<?php

include("header.php");
include("action.php");
$obj = new connection();

$msg = "";

    if (isset($_POST['register'])) 
    {
        $username = $_POST['username'];
        $mobile  = $_POST['mobile'];
        $passwordA = $_POST['pws1'];
        $passwordB = $_POST['pws2'];
        $name = "";



        if ($passwordA == $passwordB) 
        {
            $sql = $obj->display();

            $result = $sql;

            if ($result->num_rows > 0) 
            {

                while($row = $result->fetch_assoc()) 
                {
                    $name = $row['user_name'];
                    echo "<script>
                                console.log('".$row["user_name"]."');
                        </script>";


                    if($username != $name)
                    {
                          echo "<script>
                                        console.log('".$name."');
                                </script>";

                        $sql = $obj->insert($username, $mobile, md5($passwordA));
                        echo "<script>alert('User Registered Successfully.please wait for admin to accept')
                                window.location='login.php';
                                </script>";
                    }
                    elseif($username == $name)

                    {
                          echo "<script>alert('Username already present')
                                window.location='registration.php';
                                </script>";
                    }
                } 
           
            }  
        }
            
        else 
            {
                echo "<script>alert('Password is not same please enter same password')
                        window.location='registration.php';
                        </script>";
            }
    }
        
?>


<div class="form">
            <form method="POST" id="regform">
                <h1>REGISTRATION</h1>
                <hr>
                <div id="display" style="text-align: center;color: white;background-color: red;">
                    <?php echo $msg; ?>
                </div>

                <label><b>User Name</b></label>
                <input type="text" placeholder="Enter User Name" name="username" id="username" required onblur="this.value=removeSpaces(this.value);">

                <label><b>Mobile</b></label>
                <input type="text" placeholder="Enter Mobile No. (min-max length : 10 digit)" name="mobile" id="mobile" required onkeypress="return isNumberKey(event)" maxlength="10" minlength="10">

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="pws1" id="pws1" required>

                <label><b>Re Password</b></label>
                <input type="password" placeholder="Re Password" name="pws2" id="pws2" required>

                <button type="submit" class="btn" name="register">Register</button>
            </form>
</div>



<script type="text/javascript">

    $('#username').on("cut copy paste",function(e) {
                        e.preventDefault();
                });
    $('#mobile').on("cut copy paste",function(e) {
                        e.preventDefault();
                });
    $('#pws1').on("cut copy paste",function(e) {
                        e.preventDefault();
                });
    $('#pws2').on("cut copy paste",function(e) {
                        e.preventDefault();
                });

  
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