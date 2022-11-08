<?php include("header.inc.php"); ?>

<h3>عرض الرؤساء <a href="newAdmin.php" class="btn btn-sm btn-info">اضافة رئيس جديد</a></h3>

<?php
	
	$query1 = "SELECT * FROM policyGroup Order BY group_id DESC";

	$result1 = mysqli_query($link, $query1);
	$count = mysqli_num_rows($result1);
	if($count == 0) {
		echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>لم يتم العثور على اقسام.</p>";
		echo '</div>';
		
	} else {
        while($row1 = mysqli_fetch_array($result1)) {
?>
<p></p>
	<table id="example" class="display table table-striped table-bordered" style="background-color: #FFF; width:70%; ">
	 <thead>
	  <tr class="active">
		<th colspan='6'>قسم : <?php echo $name = $row1['group_name'] ?></th>
	  </tr>
	  </thead>
	  <tbody>
	<?php
        $group_id = $row1['group_id'];
	    $query2 = "SELECT * FROM admin WHERE group_id=$group_id and group_id<>0 Order BY group_id DESC";

        $result2 = mysqli_query($link, $query2);
        $count2 = mysqli_num_rows($result2);
        if($count2 == 0) {
                echo "<tr><th colspan='4'><span class='text-danger'>لايوجد رؤساء</span></th><tr>";
            echo '</div>';
        } else {
            ?>
          <thead>
              <tr class="active">
                <th>رقم.</th>
                <th>الفئة</th>
                <th>الاسم</th>
                <th>البريد الالكتروني</th>
                <th>اسم المستخدم</th>
                  <th>حذف</th>
              </tr>
          </thead>
            <?php
            $i = 1;
             while($row2 = mysqli_fetch_array($result2)) {
                echo '<tr>';
                    echo '<td>' . $i++ . '</td>';
                    echo '<td>';
                  
                    if($row2['group_id']==0) {
                        echo  "Executive";
                    } else {
                        echo $row2['grade']; 
                    }
                    echo '</td>';
                    echo '<td>' . $row2['fullname'] . '</a></td>';
                    echo '<td>' . $row2['email'] . '</a></td>';
                    echo '<td>' . $row2['username'] . '</td>';
                    echo '<td><a href="deleteAdmin.php?admin_id=' . $row2['admin_id'] . '" class="btn btn-xs btn-danger">حذف</a></td>';
                echo '</tr>'; 
             }
        }
	
		
	}
}
	?>
	</tbody>
</table>	  

<?php include("footer.inc.php") ?>