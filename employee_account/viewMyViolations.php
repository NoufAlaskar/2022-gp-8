
<h3>بلاغاتي</h3>
<?php
	// create query to get all violation for each employee depending dept ID
     $query1 = "SELECT * FROM violation WHERE employee_id=$employee_id Order BY v_status ";

	$result1 = mysqli_query($link, $query1);
	$count = mysqli_num_rows($result1);
	if($count == 0) {
		// show no data found msg
		echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>لم يتم العثور على بلاغات.</p>";
		echo '</div>';
		
	} else {
		// show table that contains violations data
?>
<p></p>
<div class="table-responsive">
	<table id="example" class="display table table-striped table-bordered" style="background-color: #FFF; width:100%; margin: 5px auto">
	 <thead>
	  <tr class="active">
		<th>رقم.</th>
		<th>عنوان السياسة</th>
		<th>اسم كاتب البلاغ</th>
		<th>تاريخ البلاغ</th>
        <th> تفاصيل</th>
        <th>الحالة</th>
	  </tr>
	  </thead>
	  <tbody>
	<?php
	$i =1;
	while($row1 = mysqli_fetch_array($result1)) {
		echo '<tr>';
			echo '<td>' . $i++ . '</td>';
			$policy_id = $row1['policy_id'];
            $sql0 = "SELECT * FROM policy WHERE policy_id={$policy_id}";
            $run0 = mysqli_query($link, $sql0);
            $row0 = mysqli_fetch_array($run0);
			echo '<td>' . $row0['title'] . '</td>';
            $employee_id = $row1['employee_id'];
            $sql0 = "SELECT * FROM employee WHERE employee_id={$employee_id}";
            $run0 = mysqli_query($link, $sql0);
            $row0 = mysqli_fetch_array($run0);
			echo '<td>' . $row0['fullname'] . '</td>';
			echo '<td>' . $row1['violation_date'] . '</td>';
            
            echo '<td><a href="violationDetails.php?policy_id=' . $row1['policy_id'] . '&violation_id=' . $row1['violation_id'] . '">تفاصيل</a></td>';
			
			echo '<td>';
            if($row1['v_status'] == 1) {
                echo "<span class='label label-default'>قيد المراجعة</span>";
            } else  if($row1['v_status'] == 2) {
                echo "<span class='label label-success'>تم الحل</span>";
            } 
            echo '</td>';
		
		echo '</tr>';
	}
		}
	?>
	</tbody>
	</table>	  

</div>