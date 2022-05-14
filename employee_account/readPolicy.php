<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
            <div class="col-md-3"></div>
			<div class="col-md-6">
<?php 
	$policy_id = $_GET['policy_id'];
	if(isset($_GET['policy_id']))
	{
        
        
        $sql2 = "SELECT *  FROM policyReaded WHERE policy_id=$policy_id and employee_id=$employee_id";
        $result2 = mysqli_query($link, $sql2);
        $count2 = mysqli_num_rows($result2);
        $row2 = mysqli_fetch_array($result2);
        if($count2 == 0) {
            $sql="INSERT INTO policyReaded VALUES(NULL, $employee_id, $policy_id, NOW(),0)";
            $run = mysqli_query($link,$sql);
            if($run){
                echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
                echo "<p>تم فتح السياسة للقراءة... الرجاء الانتظار.</p>";
                echo '</div>';
                echo '<META HTTP-EQUIV="Refresh" Content="1; URL=PolicyDetails.php?policy_id='  .$policy_id . '">';    
                exit;
            } 
        } else {
                echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
                echo "<p>تم فتح السياسة للقراءة... الرجاء الانتظار.</p>";
                echo '</div>';
                echo '<META HTTP-EQUIV="Refresh" Content="1; URL=PolicyDetails.php?policy_id='  .$policy_id . '">';    
                exit;
        }
	}
?>
			</div>
		</div>
	</div>
  </div>