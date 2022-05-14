<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
            <div class="col-md-3">
                <img src="../assets/imgs/emp.png" class="img-thumbnail" style="margin-top:30px;">
            </div>
  		    <div class="col-md-6"  style="margin-top: 30px;">
                <div class="well">
                    <h3>بيانات حسابي</h3>

                    <?php
                        $query1 = "SELECT * FROM employee WHERE employee_id={$employee_id} ";

                        $result1 = mysqli_query($link, $query1);
                        $row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
                    ?>
                    <table class="table table-bordered" style="background-color:#FFF">
                        <tr>
                            <th class="active">اسم الموظف</th>
                            <td><?php echo $row1['fullname'] ?></td>
                        </tr>
                        <tr>
                            <th class="active">البريد الالكتروني</th>
                            <td><?php echo $row1['email'] ?></td>
                        </tr>
                        <tr>
                            <th class="active">اسم المستخدم</th>
                            <td><?php echo $row1['username'] ?></td>
                        </tr>
                        <tr>
                            <th class="active">القسم</th>
                            <td><?php echo $rec1['group_name']; ?></td>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
  </div>

<?php include("footer.inc.php") ?>
