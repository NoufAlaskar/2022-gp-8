<?php include("header.inc.php"); ?>
<h3>عرض سياساتي  
	<form method="post" class="form-horizontal pull-right" style="position: relative">
        <input type="search" value="<?php  if(isset($_POST['txtSearch']))  echo $_POST['txtSearch']; ?>" name="txtSearch" style="min-width:300px; padding-left:60px" class="form-control pull-right" placeholder="أدخل عنوان السياسة" required autofocus  oninvalid="this.setCustomValidity('نسيت ادخال عنوان السياسة')" oninput="this.setCustomValidity('')">
        <button type="submit" id="search-btn" name="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
        <a href="myPolices.php" type="reset" id="clear-btn" name="reset" class="btn btn-danger"><i class="fa fa-trash"></i></a>
    </form>

</h3>
<?php
	$query1 = "";
	if(!isset($_POST['submit'])) {
        $query1 = "SELECT * FROM policy t1 INNER JOIN policyReaded t2 ON(t1.policy_id = t2.policy_id) WHERE (t1.group_id=$group_id or t1.group_id=0) and t1.published=1 and t2.acknowledge =1 Order BY t1.policy_id DESC";
    } else {
        $txtSearch = $_POST['txtSearch'];
        $query1 = "SELECT * FROM policy t1 INNER JOIN policyReaded t2 ON(t1.policy_id = t2.policy_id) WHERE (t1.group_id=$group_id or t1.group_id=0) and t1.published=1 and t2.acknowledge =1 and t1.title='$txtSearch' Order BY t1.policy_id DESC";

    }
	//$query1 = "SELECT * FROM policy WHERE (group_id=$group_id or group_id=0) and published=1 Order BY policy_id DESC";
	 
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
		<th style="max-width:300px;width:300px">خيارات</th>
		<th>درجات الاختبار</th>
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
			echo '<td><a href="readPolicy.php?policy_id=' . $row1['policy_id'] . '" class="btn btn-xs btn-primary">قراءة السياسة</a> <a href="startPolicyExam.php?policy_id=' . $row1['policy_id'] . '&n=1" class="btn btn-xs btn-success">اخذ الاختبار</a> <a href="newViolation.php?policy_id=' . $row1['policy_id'] . '" class="btn btn-xs btn-info">التبيلغ عن انتهاك السياسة</a></td>';
			echo '<td>';
			$query2 = "SELECT count(*) as try FROM policyExamResult WHERE policy_id={$policy_id} and employee_id=$employee_id";
			$result2 = mysqli_query($link, $query2);
			$row2 = mysqli_fetch_array($result2);
			$try = $row2['try'];
			if($try ==0) {
				$try =1;
			}else {
				$try +=1;
			}
			echo '<div class="well3">';
    $sql3 = "SELECT *  FROM policyExamResult WHERE policy_id=$policy_id and employee_id=$employee_id";
    $result3 = mysqli_query($link, $sql3);
    $count3 = mysqli_num_rows($result3);
    if($count3 == 0) {
        echo '<span class="label label-warning"><i class="fa fa-hourglass-half "></i> لم يختبر بعد</span>';
    } else {
        ?>
            <table class="table table-bordered">
                <tr class="active">
                    <th>رقم المحاولة</th>
                    <th>نتيجة الاختبار</th>
                    <th>تاريخ الاختبار</th>
                </tr>
            
        <?php
        $j = 1;
        while($row3 = mysqli_fetch_array($result3)) {
            echo '<tr>';
            echo "<td> المحاولة رقم  $j</td>";
            echo "<td>100/" . $row3['result'] . "</td>";
            echo "<td>" . $row3['exam_date'] . "</td>";
            echo '</tr>';
            $j++;
        }
            echo '</table>';
    }

    echo '</div>';
    
			
			echo '</td>';
			
		echo '</tr>';
	}
		}
	?>
	</tbody>
	</table>	  

</div><?php include("footer.inc.php"); ?>