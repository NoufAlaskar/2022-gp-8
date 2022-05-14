<?php include("header.inc.php"); ?>

<h3>عرض الموظفين <a href="newEmployee.php" class="btn btn-sm btn-info">اضافة موظف جديد</a></h3>

<?php
	
	$query1 = "SELECT * FROM employee Order BY group_id DESC";

	$result1 = mysqli_query($link, $query1);
	$count = mysqli_num_rows($result1);
	if($count == 0) {
		echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>لم يتم العثور على الموظفين.</p>";
		echo '</div>';
		
	} else {
?>
<p></p>
<div class="table-responsive">
	<table id="example" class="display table table-striped table-bordered" style="background-color: #FFF; width:60%; ">
	 <thead>
	  <tr class="active">
		<th>رقم.</th>
		<th>قسم الموظف</th>
		<th>اسم الموظف</th>
		<th>البريد الالكتروني</th>
		<th>اسم المستخدم</th>
		<th>خيارات</th>
	  </tr>
	  </thead>
	  <tbody>
	<?php
	$i =1;
	while($row1 = mysqli_fetch_array($result1)) {
		echo '<tr>';
			echo '<td>' . $i++ . '</td>';
			$group_id = $row1['group_id'];
			$group_name = "";
			if($group_id == 0) {
				$group_name =  "عام - جميع الاقسام";
			} else {
				$sql0 = "SELECT * FROM policyGroup WHERE group_id={$group_id}";
				$run0 = mysqli_query($link, $sql0);
				$row0 = mysqli_fetch_array($run0);
				$group_name = $row0['group_name'];
			}
			
			echo '<td>' . $group_name . '</td>';
			echo '<td>' . $row1['fullname'] . '</a></td>';
			echo '<td>' . $row1['email'] . '</a></td>';
			echo '<td>' . $row1['username'] . '</td>';
			
			echo '<td><a href="deleteEmp.php?employee_id=' . $row1['employee_id'] . '" class="btn btn-xs btn-danger">حذف الموظف</a></td>';
			
		echo '</tr>';
	}
		}
	?>
	</tbody>
	</table>	  

</div>
<?php include("footer.inc.php") ?>