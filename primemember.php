<?php
include("admin.php");

include("action.php");

?>

<div id="adminhome">

  <div>
    <p style="text-align: center;font-size: 50px;margin-bottom: 20px;">All USERS DATA </p>
    <input class="w3-input w3-border w3-padding" type="text" placeholder="Filter by Name" id="myInput" onkeyup="myFunction()">
  </div>
  <hr />
<div id="adminhome">
  <table id="admintable" cellspacing="10">
    <tr>
      <th onclick="sortTable(0)">
        User Name &#x21c5;
      </th>

      <th>
        User Id
      </th>

      <th>
        Mobile
      </th>

      <th onclick="sortTable(3)">
        Date of Signup &#x21c5;
      </th>

      <th>
        Action
      </th>
    </tr>

    <?php


    $obj = new connection();

    $sql = $obj->display();

    $result = $sql;

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
    ?>

        <tr>

          <td>
            <?php echo $row['user_name']; ?>
          </td>

          <td>
            <?php echo $row['user_id']; ?>
          </td>

          <td>
            <?php echo $row['mobile']; ?>
          </td>

          <td>
            <?php echo $row['dateofsignup']; ?>
          </td>

          <td>
            <!-- <a href="approved.php?id=<?php echo $row['user_id']; ?>" name="update" class="update" style="float: left;color:green">ACCEPT</a>  -->
            <a href="delete.php?id=<?php echo $row['user_id']; ?>" name="delete" class="delete" style="color: red">DELETE</a>
          </td>

          <!-- <td>
				<input type="hidden" name="userid" value="<?php //echo $row['user_id']; 
                                                  ?>">
			</td> -->
        <?php
      }
    } else {
        ?>
        <td colspan="5">
          <?php echo "No User is available"; ?>
        </td>
        </tr>
  </table>
</div>
</div>
<?php
    }
?>


<script>
  function myFunction() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("admintable");
    tr = table.getElementsByTagName("tr");
    for (i = 1; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }




  function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("admintable");
    switching = true;

    dir = "asc";

    while (switching) {

      switching = false;
      rows = table.rows;

      for (i = 1; i < (rows.length - 1); i++) {

        shouldSwitch = false;

        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];

        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {

            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {

            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {

        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;

        switchcount++;
      } else {

        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }
</script>