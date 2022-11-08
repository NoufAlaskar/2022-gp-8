<?php include("header.inc.php"); ?>

<h3>عرض السياسات الواردة للمراجعة</h3>
<?php
	
	$query1 = "SELECT * FROM policy WHERE admin_id <> $admin_id and approved=0 and group_id={$group_id} ORDER BY policy_id DESC";
	
	$result1 = mysqli_query($link, $query1);
	$count = mysqli_num_rows($result1);
	if($count == 0) {
		echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>لم يتم العثور على سياسات.</p>";
		echo '</div>';
		
	} else {
?>
<p></p>
<div class="table-responsive">
	<table id="example" class="display table table-striped table-bordered" style="background-color: #FFF; width:100%; margin: 5px auto">
	 <thead>
	  <tr class="active">
		<th>رقم.</th>
		  <th>مجموعة السياسة</th>
		<th>عنوان السياسة</th>
		<th>اسم كاتب السياسة</th>
		<th>تاريخ كتابة السياسة</th>
		<th>المراجعات</th>
		
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
			echo '<td><a href="PolicyDetails.php?policy_id=' . $row1['policy_id'] . '">' . $row1['title'] . '</a></td>';
			$adminWritten = $row1['admin_id'];
			$sql2 = "SELECT * FROM admin WHERE admin_id={$adminWritten}";
			$run2 = mysqli_query($link, $sql2);
			$row2 = mysqli_fetch_array($run2);
			$adminWrittenName = $row2['fullname'] . " - " . $group_name;
			echo '<td>' . $adminWrittenName . '</td>';
			echo '<td>' . $row1['publish_date'] . '</td>';
			$policy_id =  $row1['policy_id'] ;
			$sql2 = "SELECT * FROM policyReviews WHERE policy_id={$policy_id}";
			$run2 = mysqli_query($link, $sql2);
			$row2No = mysqli_num_rows($run2);
			echo '<td><a href="PolicyDetails.php?policy_id=' . $row1['policy_id'] . '" class="btn btn-xs btn-primary">' . $row2No . ' مراجعات </a></td>';
			
		echo '</tr>';
	}
		}
	?>
	</tbody>
	</table>	  

</div>
<?php include("footer.inc.php") ?>