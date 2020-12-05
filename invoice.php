<?php
    session_start();

    include("header.php"); 

    include("action.php");

    $obj = new connection();

    $id = $_GET['id'];

    // echo $id;

?>

    <div>
       <!--  <h1 id="invoicetitle">
           <a href="completeride.php">Invoice</a>
        </h1> -->
        <div>
             <table id="invoice" cellspacing="20">
    <!-- 
                <tr>
                        <th > Pick </th>
                        <th> Drop </th>
                        <th> Luggage </th>
                        <th> User Name </th>
                        <th> Status </th>
                        <th> Total </th>
                </tr>
  -->

                <th colspan="2">
                    <h3>Invoice<h3>
                </th>

                <?php 


                    $sql = $obj-> invoice($id);

                    $result = $sql;

                    if ($result->num_rows > 0) {
                       
                        while ($row = $result->fetch_assoc()) {
                ?>
                    
                    <tr>
                        <td>User Name</td><td > <?php echo $row['customer_user_name'];?> </td>
                    </tr>

                    <tr >
                        <td>Pick</td><td > <?php echo $row['pickup_point']; ?> </td>
                    </tr>

                    <tr>
                        <td>Drop</td><td > <?php echo $row['drop_point'];?> </td>
                    </tr>

                    <tr>
                        <td>Luggage</td><td > <?php if($row['luggage']!=null){echo $row['luggage'];}else{echo "-" ;};?> </td>
                    </tr> 

                    
                        
                    <tr>
                        <td>Status</td><td> Complete </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>

                    <tr>
                        <td>Total</td><td >&#x20B9;<?php echo $row['total_cost'];?></td>
                    </tr>

                     <tr>
                        <td colspan="2" id="paymode"> <h3>Pay By: Cash</h3></td>                  
                    </tr>
                <?php
                        }   

                    }
                ?>
            </table>
               <center>
                   <input type="button" name="" value="Print" onclick="window.print()">
               </center> 
        </div>
    </div>

           

           

