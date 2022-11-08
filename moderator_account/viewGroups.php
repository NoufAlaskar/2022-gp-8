<?php include("header.inc.php"); ?>

<h3>عرض الاقسام <a href="newGroup.php" class="btn btn-sm btn-info">اضافة قسم جديد</a></h3>

<?php
	
	$query1 = "SELECT * FROM policyGroup Order BY group_id DESC";

	$result1 = mysqli_query($link, $query1);
	$count = mysqli_num_rows($result1);
	if($count == 0) {
		echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>لم يتم العثور على اقسام.</p>";
		echo '</div>';
		
	} else {
       
?>
<p></p>
	<table id="example" class="display table table-striped table-bordered" style="background-color: #FFF; width:30%; ">
	 <thead>
	  <tr class="active">
          <th>الرقم</th>
		<th>اسم القسم</th>
		<th>تعديل القسم</th>
	  </tr>
	  </thead>
	  <tbody>
            <?php
            $i = 1;
             while($row1 = mysqli_fetch_array($result1)) {
                echo '<tr>';
                    echo '<td>' . $i++ . '</td>';
                    echo '<td>' . $row1['group_name'] . '</td>';
                    echo '<td><a href="editGroup.php?group_id=' . $row1['group_id'] . '" class="btn btn-xs btn-success">تعديل</a></td>';
                echo '</tr>'; 
             }
        }
	?>
	</tbody>
</table>	  

<?php include("footer.inc.php") ?>