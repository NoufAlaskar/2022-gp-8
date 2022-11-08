<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
            <div class="col-md-2"></div>
  		    <div class="col-md-8"  style="margin-top: 30px;">
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
						<input type="button" onclick="SpeechNow()"  class="btn btn-sm btn-info pull-right" type="button" value="قراءة السياسة ">
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
				<?php
                        $sql6 = "SELECT * FROM policyReaded WHERE policy_id={$policy_id} and employee_id=$employee_id";
						$run6 = mysqli_query($link, $sql6);
                        $no6 = mysqli_num_rows($run6);
                        $row6 = mysqli_fetch_array($run6);
                        if($row6['acknowledge'] == 0) {
                            ?>
                            <a href="acknowledgePolicy.php?policy_id=<?php echo $policy_id ?>" class="btn btn-sm btn-primary pull-right" >موافقة</a> 
                            <?php
                        } else { ?>
                            <span class="label label-info pull-right"><i class="fa fa-check"></i> تم الموافقة  </span>
                        <?php } ?>

						<?php
							$sql10 = "SELECT * FROM questions WHERE policy_id={$policy_id}";
							$run10 = mysqli_query($link, $sql10);
							$count10 = mysqli_num_rows($run10);
							if($count10 == 0) {
								?>
								<a href="startPolicyExam.php?policy_id=<?php echo $policy_id ?>&n=1" class="disabled btn btn-sm btn-primary pull-left" >اخذ الاختبار  <i class="fa fa-question-circle" style="color:#FFF"></i> </a> 
								<?php
							} else if($count10 == 10) {
								?>
								<a href="startPolicyExam.php?policy_id=<?php echo $policy_id ?>&n=1" class=" btn btn-sm btn-primary pull-left" >اخذ الاختبار  <i class="fa fa-question-circle" style="color:#FFF"></i> </a> 
								<?php
							} else {
								?>
								<a href="startPolicyExam.php?policy_id=<?php echo $policy_id ?>&n=1" class="disabled btn btn-sm btn-primary pull-left" >اخذ الاختبار  <i class="fa fa-question-circle" style="color:#FFF"></i> </a> 
								<?php
							}
						?>
						
				<br>
			</div>

 <?php	
		}
	?>
  		</div>
             <div class="col-md-2"></div>
		</div>
  	</div>
  </div>
<script src="https://code.responsivevoice.org/responsivevoice.js?key=6fHWzLr6"></script>
<?php include("footer.inc.php") ?>