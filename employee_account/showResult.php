<?php include("header.inc.php"); ?>
<?php
	$policy_id = $_GET['policy_id'];
	$total = $_SESSION['total'];
	$employee_id = $_SESSION['employee_id'];
    
    if(isset($_POST['submitTry']) or isset($_POST['submitTryViews'])) {
        $update = "INSERT INTO policyExamResult VALUES (NULL, $policy_id, $employee_id,$total, NOW())";
        $update_res = mysqli_query($link, $update);
        if(isset($_POST['submitTry'])) {
            $msg = "تم حفظ العلامة الخاصة بك.";
            echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
            echo "<p>$msg</p>";
            echo '</div>';
            $_SESSION['total'] = 0;
            unset($_SESSION['total']);
            echo '<META HTTP-EQUIV="Refresh" Content="1;startPolicyExam.php?n=1&policy_id=' . $policy_id . '">';
        }
        if(isset($_POST['submitTryViews'])) {
            $msg = "تم حفظ العلامة الخاصة بك.";
            echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
            echo "<p>$msg</p>";
            echo '</div>';
            $_SESSION['total'] = 0;
            unset($_SESSION['total']);
            echo '<META HTTP-EQUIV="Refresh" Content="1;myPolices.php?policy_id=' . $policy_id . '">';
        }
    }

   
    
    $query1 = "SELECT * FROM policy WHERE policy_id={$policy_id} ";
    $result1 = mysqli_query($link, $query1);
    $row1 = mysqli_fetch_array($result1);

    $query2 = "SELECT count(*) as try FROM policyExamResult WHERE policy_id={$policy_id} and employee_id=$employee_id";
    $result2 = mysqli_query($link, $query2);
    $row2 = mysqli_fetch_array($result2);
    $try = $row2['try'];
    if($try ==0) {
        $try =1;
    }else {
        $try +=1;
    }
?>
<div class="well text-center">
	<h2>لقد أنهيت هذا الاختبار للسياسة [<?php echo $row1['title'] ?>] .</h2>

	<p class="lead">يحتوي هذا الاختبار على <strong> 10 </strong> أسئلة.</p>
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-success"><h4><?php echo $total/10; ?> الإجابات الصحيحة</h4></div>
        </div>
        <div class="col-md-6">
        <div class="alert alert-danger"><h4><?php echo (100-$total)/10; ?> إجابات خاطئة</h4></div>
        </div>
    </div>
	<h1 style="font-size: 50px; text-align: center">درجة الاختبار : 100/<?php echo $total; ?></h1>
    <h3> المحاولة رقم <?php echo $try; ?></h3>
    <?php
    echo '<div class="well">';
    $sql3 = "SELECT *  FROM policyExamResult WHERE policy_id=$policy_id and employee_id=$employee_id";
    $result3 = mysqli_query($link, $sql3);
    $count3 = mysqli_num_rows($result3);
    if($count3 == 0) {
        echo '<span class="label label-warning"><i class="fa fa-hourglass-half "></i> لم يختبر بعد</span>';
    } else {
        ?>
            <table class="table table-bordered examresult2">
                <tr class="active">
                    <th>العدد</th>
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
    ?>
	<form method="post">
		<input type="submit" name="submitTry" class="btn btn-danger pull-left" value="اعادة الاختبار">
        <input type="submit" name="submitTryViews" class="btn btn-success pull-right" value="رجوع">
	</form>
</div>
<?php include("footer.inc.php"); ?>
