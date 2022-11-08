<?php include("header.inc.php"); ?>
<!--  Create Search form to search for archived policy -->
<h3>عرض ارشيف السياسات 
    <form method="post" class="form-horizontal pull-right" style="position: relative">
        <input type="search" value="<?php  if(isset($_POST['txtSearch']))  echo $_POST['txtSearch']; ?>" name="txtSearch" style="min-width:300px; padding-left:60px" class="form-control pull-right" placeholder="أدخل عنوان السياسة" required autofocus  oninvalid="this.setCustomValidity('نسيت ادخال عنوان السياسة')" oninput="this.setCustomValidity('')">
        <button type="submit" id="search-btn" name="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
        <a href="PoliciesArchive.php" type="reset" id="clear-btn" name="reset" class="btn btn-danger"><i class="fa fa-trash"></i></a>
    </form>
</h3>
<?php
	$query1 = "";
	// write select statememt to check there is archived policies or not
    if(!isset($_POST['submit'])) {
        $query1 = "SELECT * FROM policy WHERE (group_id=$group_id or group_id=0) and admin_id=$admin_id and published = -1 Order BY policy_id DESC";
    } else {
        $txtSearch = $_POST['txtSearch'];
        $query1 = "SELECT * FROM policy WHERE (group_id=$group_id or group_id=0) and admin_id=$admin_id and published = -1 and title='$txtSearch' Order BY policy_id DESC";
    }
	// run the query
	$result1 = mysqli_query($link, $query1);
	$count = mysqli_num_rows($result1);
	if($count == 0) {
		// show no data matched msg
		echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>لم يتم العثور على سياسات.</p>";
		echo '</div>';
		
	} else {

		/// get data from table and printed into table
?>
<p></p>
<div class="table-responsive">
	<table id="example" class="display table table-striped table-bordered" style="background-color: #FFF; width:100%; margin: 5px auto">
	 <thead>
	  <tr class="active">
		<th>رقم.</th>
		  <th>مجموعة السياسة</th>
		<th>عنوان السياسة</th>
		<th>اسم المسؤول</th>
		<th>تاريخ النشر</th>
		<th>المراجعات</th>
		<th>استرجاع</th>
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
			$sql2 = "SELECT * FROM admin WHERE admin_id={$admin_id}";
			$run2 = mysqli_query($link, $sql2);
			$row2 = mysqli_fetch_array($run2);
			
			echo '<td>' . $row2['username'] . '</td>';
			echo '<td>' . $row1['publish_date'] . '</td>';
			$policy_id =  $row1['policy_id'] ;
			$sql2 = "SELECT * FROM policyReviews WHERE policy_id={$policy_id}";
			$run2 = mysqli_query($link, $sql2);
			$row2No = mysqli_num_rows($run2);
			echo '<td><a href="PolicyDetails.php?policy_id=' . $row1['policy_id'] . '&canArchive=true" class="btn btn-xs btn-primary">' . $row2No . ' مراجعات </a></td>';
			echo '<td>';
			if($adminWritten == $loggedIn_admin_id) {

					echo '<a href="UnarchivePolicy.php?policy_id=' . $row1['policy_id'] . '" class="btn btn-xs btn-success">استرجاع السياسة</a>';

				
			} else {
				echo '<span class="text-center text-danger">ليس لديك الصلاحية</span>';
			}
			
			echo '</td>';
		echo '</tr>';
	}
		}
	?>
	</tbody>
	</table>	  

</div>
<?php include("footer.inc.php") ?>