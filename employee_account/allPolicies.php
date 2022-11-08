<?php include("header.inc.php"); ?>
<h3>عرض السياسات الجديدة  </h3>
<?php
	
	 $query1 = "SELECT * FROM policy WHERE (group_id=$group_id or group_id=0) and published=1 Order BY policy_id DESC";
    ///echo $query1 = "SELECT * FROM policy t1 full JOIN policyReaded t2 ON(t1.policy_id = t2.policy_id) WHERE (t1.group_id=$group_id or t1.group_id=0) and t1.published=1 Order BY t1.policy_id DESC";

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
		<th>تاريخ النشر</th>
		<th>المراجعات</th>
	  </tr>
	  </thead>
	  <tbody>
	<?php
	$i =1;
	while($row1 = mysqli_fetch_array($result1)) {
        
        $policy_id = $row1['policy_id'];
        $q2 = "SELECT * FROM  policyReaded WHERE policy_id=$policy_id";
        $res2 = mysqli_query($link, $q2);
         $c2 = mysqli_num_rows($res2);
        $row2 = mysqli_fetch_array($res2);
        if($c2==0 or $c2==1) {
            
            if($row2['acknowledge']==0) {
             
                echo '<tr>' ;
                    echo '<td>' . '</td>';
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
                    echo '<td>' . $row1['title'] . '</td>';
                    $adminWritten = $row1['admin_id'];
                    $sql2 = "SELECT * FROM admin WHERE admin_id={$adminWritten}";
                    $run2 = mysqli_query($link, $sql2);
                    $row2 = mysqli_fetch_array($run2);

                    echo '<td>' . $row2['username'] . '</td>';
                    echo '<td>' . $row1['publish_date'] . '</td>';
                    $policy_id =  $row1['policy_id'] ;
                    $sql2 = "SELECT * FROM policyReviews WHERE policy_id={$policy_id}";
                    $run2 = mysqli_query($link, $sql2);
                    $row2No = mysqli_num_rows($run2);
                    echo '<td><a href="readPolicy.php?policy_id=' . $row1['policy_id'] . '" class="btn btn-xs btn-primary">قراءة السياسة</a></td>';

                echo '</tr>';
            }
        } else {
            echo "NOthing";
        }
	}
		}
	?>
	</tbody>
	</table>	  

</div><?php include("footer.inc.php"); ?>