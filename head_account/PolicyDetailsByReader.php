<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
  
  		<div class="col-md-7"  style="margin-top: 30px;">
			<div class="well" style="background: #FFF">
			<?php
				$policy_id = $_GET['policy_id'];
				$no_reviews = 0;
				$policy_group_id = 0;
				$query1 = "SELECT * FROM policy WHERE policy_id={$policy_id} ";
				
				$result1 = mysqli_query($link, $query1);
				$count = mysqli_num_rows($result1);
				if($count == 0) {
					echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
						echo "<p>لم يتم العثور على سياسات.</p>";
					echo '</div>';
				} else {
					$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
					$admin_owner_policy =$row1['admin_id'];
					$group_id = $policy_group_id =$row1['group_id'];
					
					if($group_id == 0) {
						$group_name = "عام - جميع الاقسام";
					} else {
						 $sql0 = "SELECT * FROM policyGroup WHERE group_id={$group_id}";
						$run0 = mysqli_query($link, $sql0);
						$row0 = mysqli_fetch_array($run0);
						$group_name = $row0['group_name'];
					}
					
					
					$sql7 = "SELECT * FROM policyReviews WHERE policy_id={$policy_id}";
					$run7 = mysqli_query($link, $sql7);
					$row7 = mysqli_fetch_array($run7);
					$no_reviews = mysqli_num_rows($run7);
					
					$adminWritten = $row1['admin_id'];
			?>	
				
				
				    <h3>تفاصيل السياسة <span class="pull-right" style="font-size: 16px;"><i class="fa fa-calendar"></i>  <?php echo $row1['publish_date'] ?></span></h3>
                
				<hr>
				<h4>عنوان السياسة</h4>
				<p class="text-muted"><?php echo $row1['title'] ?></p>
				<hr>
				
				<?php
					$sql5 = "SELECT * FROM admin WHERE admin_id={$adminWritten}";
					$run5 = mysqli_query($link, $sql5);
					$row5 = mysqli_fetch_array($run5);
				?>
				<div class="row">
					<div class="col-md-6">
						<h4>مجموعة السياسة</h4>
						<p class="text-muted"><?php echo $group_name ?></p>
					</div>
					<div class="col-md-6">
						<h4>كتب بواسطة:</h4>
						<p class="text-muted"><?php echo $row5['fullname'] ?></p>
						
					</div>
				</div>
				
				<hr>
                <form method="post">
                    <input type="hidden" value="<?php echo strip_tags($row1['description']); ?>" class="form-control" name="data">
				<h4>وصف السياسة</h4>
				
				<p class="text-muted" id="ar"><?php echo nl2br($row1['description']); ?></p>
				<div class="row">
					<div class="col-md-8 text-left">
					<input type="submit" value="Translate" class="btn btn-sm btn-info" name="translateBtn">
					</div>
					<div class="col-md-4 text-right">
						<select class="form-control input-sm" id="voiceSelection">
							<option value="Arabic Male">عربي</option>
							<option value="UK English Male">English</option>
						</select>
						<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
						<script>
							function SpeechNow() {
								//alert('Speech Now');
								var v = $('#voiceSelection').val();
								var text = document.getElementById('ar').textContent;
								///alert('Voice : ' + v);
								if (v == 'Arabic Male' || v == 'Arabic Female') {
									$("#TranslationDiv").removeClass("enTranslationDir");
									$("#TranslationDiv").addClass("arTranslationDir");
								} else {
									var text =document.getElementById('TranslationDiv').textContent;
									$("#TranslationDiv").removeClass("arTranslationDir");
									$("#TranslationDiv").addClass("enTranslationDir");
								}
								responsiveVoice.speak(text,v);
							}

						</script>
						<input type="button" onclick="SpeechNow()"  class="btn btn-sm btn-info pull-right" type="button" value="قراءة ">
						<!--<input onclick="responsiveVoice.speak('<?php echo strip_tags($row1[2]); ?>','Arabic Male');" class="btn btn-sm btn-info pull-right" type="button" value="Play "> -->
						
					</div>
				</div>
                   
				</form>
				<?php
if(isset($_POST['translateBtn'])) {
   $data = $_POST['data'];
    // When you have your own client ID and secret, put them down here:
    $CLIENT_ID = "FREE_TRIAL_ACCOUNT";
    $CLIENT_SECRET = "PUBLIC_SECRET";

    // Specify your translation requirements here:
    $postData = array(
      'fromLang' => "ar",
      'toLang' => "en",
      'text' => $data
    );

    $headers = array(
      'Content-Type: application/json',
      'X-WM-CLIENT-ID: '.$CLIENT_ID,
      'X-WM-CLIENT-SECRET: '.$CLIENT_SECRET
    );

    $url = 'http://api.whatsmate.net/v1/translation/translate';
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    $response = curl_exec($ch);
    echo "<h4  style='text-align: left;direction: ltr;'>Policy Translated</h4>";
    echo "<p style='text-align: left;direction: ltr;' class='text-muted' id='TranslationDiv'>".$response ."</p>";
    curl_close($ch);
}
?>
				<hr>
				<a href="index.php" class="btn btn-sm btn-warning pull-left" >رجوع</a> 
				
				<?php if($admin_id == $adminWritten) { ?>
				<a href="editPolicy.php?policy_id=<?php echo $row1['policy_id'] ?>" class="btn btn-sm btn-success pull-right">تحديث السياسة</a>  
				<?php } ?>
				<br>
			</div>

 <?php	
		}
	?>
  		</div>
		<div class="col-md-5"  style="margin-top: 30px;">
			<div class="well" style="background: #FFF;">
				<h3 style="border-bottom: 2px solid #DDD">مراجعات السياسة -  <span class="label label-primary pull-right" ><?php echo $no_reviews; ?> مراجعات</span></h3></div>
			<div class="well" style="background: #FFF; max-height: 300px; overflow-y: scroll">
			<?php
				
			$sql3 = "SELECT * FROM policyReviews WHERE policy_id={$policy_id} and admin_id={$admin_id} and group_id={$group_id}";
			$run3 = mysqli_query($link, $sql3);
			$count3 = mysqli_num_rows($run3);
			?>

				<?php
					$query4 = "SELECT * FROM policyReviews WHERE policy_id={$policy_id}";
					$result4 = mysqli_query($link, $query4);
					$count4 = mysqli_num_rows($result4);
					if($count4 == 0) {
						echo '<div class="alert alert-danger" style="margin:10px auto;text-align:center">';
							echo "<p>لم يتم العثور على أي مراجعات للسياسة.</p>";
						echo '</div>';

					} else {
						while($row4 = mysqli_fetch_array($result4, MYSQLI_BOTH)) {
							$adminWritten = $row4['admin_id'];
								$sql6="SELECT * FROM admin WHERE admin_id=$adminWritten";
								$run6 = mysqli_query($link,$sql6);
								$row6 = mysqli_fetch_array($run6);
							?>
								<div class="media">
								  <div class="media-left">
									<i class="fa fa-user-circle fa-2x"></i>
								  </div>
								  <div class="media-body">
									<h4 class="media-heading"><?php echo $row6['fullname'] ?></h4>
									<p class="text-muted small text-justify"><?php echo $row4['comment'] ?></p>
								  </div>
								</div>
							<?php
						}
					}
				?>
			</div>
			
			<?php
				 $query4 = "SELECT * FROM policyReviews WHERE policy_id={$policy_id} AND group_id=$group_id";
				$result4 = mysqli_query($link, $query4);
				 $count4 = mysqli_num_rows($result4);	
				if ($count4 < 3) {
		?>
			
			<a href="ApprovePolicy.php?policy_id=<?php echo $row1['policy_id'] ?>" class="btn btn-sm btn-info  pull-right disabled"  style="margin-right: 10px;">إرسال السياسة</a>
		
			<?php }else if ($row1['approved'] == 0 AND $count4 >=3 AND $loggedIn_admin_id==$admin_owner_policy) {?>
				<a href="ApprovePolicy.php?policy_id=<?php echo $row1['policy_id'] ?>" class="btn btn-sm btn-info  pull-right "  style="margin-right: 10px;">إرسال السياسة</a>
			<?php } elseif ($row1['approved'] == 1 and $count4 >=3) { ?>
				<div class="alert alert-info clearfix"><span>معتمد / مرسل</span></div>
			<?php } ?>
		</div>
  	</div>
        <hr />

        <div class="row">
            <h3 align="center">اطلاع الموظفين</h3>
            <?php
  $query1 = "SELECT * FROM employee WHERE (group_id=$group_id or group_id=0) Order BY employee_id DESC";

	$result1 = mysqli_query($link, $query1);
	$count = mysqli_num_rows($result1);
	if($count == 0) {
		echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>لم يتم العثور على موظفين.</p>";
		echo '</div>';
		
	} else {
?>
<table class="table table-bordered" style="background-color:#FFF">
<tr  class="active">
    <th>تسلسل</th>
    <th>اسم الموظف</th>
    <th>اسم السياسة</th>
    <th>هل تم القراءة ام لا؟</th>
    <th>تاريخ الموافقة</th>
    <th>هل تم الموافقة ام لا؟</th>
	<th>علامة الاختبار</th>
</tr>
<?php
        $i =1;
        while($row1 = mysqli_fetch_array($result1)) {
            echo '<tr>';
            echo '<td>' . $i++ . '</td>';
            echo '<td>' . $row1['fullname'] . '</td>';
            $sql3 = "SELECT *  FROM policy WHERE policy_id=$policy_id ";
            $result3= mysqli_query($link, $sql3);
            $count3 = mysqli_num_rows($result3);
            $row3 = mysqli_fetch_array($result3);
             echo '<td>' . $row3['title'] . '</td>';
            $emp_id = $row1['employee_id'];
           
            $sql2 = "SELECT *  FROM policyReaded WHERE policy_id=$policy_id and employee_id=$emp_id";
            $result2 = mysqli_query($link, $sql2);
            $count2 = mysqli_num_rows($result2);
            $row2 = mysqli_fetch_array($result2);
            if($count2 == 1) {
                echo '<td><span class="text-primary"><i class="fa fa-check "></i> تم القراءة </span></td>';
            } else {
                echo '<td></td>';
            }
             echo '<td>' . $row2['read_date'] . '</td>';
           echo '<td>';
            if($row2['acknowledge'] == 1) {
                echo '<span class="label label-primary"><i class="fa fa-check "></i> تم الموافقة </span>';
            }
            echo '</td>';
			echo '<td>';
				$sql3 = "SELECT *  FROM policyExamResult WHERE policy_id=$policy_id and employee_id=$emp_id";
				$result3 = mysqli_query($link, $sql3);
				$count3 = mysqli_num_rows($result3);
				if($count3 == 0) {
					echo '<span class="label label-warning"><i class="fa fa-hourglass-half "></i> لم يختبر بعد</span>';
				} else {
					?>
						<table class="table table-bordered examresult">
							<tr class="active">
								<th>العدد</th>
								<th>نتيجة الاختبار</th>
							</tr>
						
					<?php
					$j = 1;
					while($row3 = mysqli_fetch_array($result3)) {
						echo '<tr>';
						echo "<td> المحاولة رقم  $j</td>";
						echo "<td>100/" . $row3['result'] . "</td>";
						echo '</tr>';
						$j++;
					}
						echo '</table>';
				}
				
			echo '</td>';
        }
    }
?>
</table>
        </div>
  	</div>
  </div>
<script src="https://code.responsivevoice.org/responsivevoice.js?key=6fHWzLr6"></script>
<?php include("footer.inc.php") ?>