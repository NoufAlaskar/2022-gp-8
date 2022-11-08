<?php
if(isset($_POST['txt'])){
  $txt=$_POST['txt'];
  $txt=htmlspecialchars($txt);
  $txt=rawurlencode($txt);
  $audio=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-IN');
  $speech="<audio controls='controls' autoplay></audio>";
  echo $speech;
}
?>
<form method="post">
<input id="txt" name="txt" type="textbox" />
<input name="submit" type="submit" value="Convert to Speech" />
</form>
