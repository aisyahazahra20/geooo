<?php  
  $fil = $_FILES["file"]["name"];
  $ext = pathinfo($fil, PATHINFO_EXTENSION);
  $fil = str_replace(".$ext", date("_His").".$ext", $fil);
  $fil = str_replace(" ", "-", $fil);
  $pth = _POST("path");
  $pth = $dcroot."/dist/img/$pth/";
  $tmp = $_FILES["file"]["tmp_name"];
  $obj = new stdClass();
  $uid = _SESSION("user")->user_id;
  
  if(!in_array($ext, ["jpg", "jpeg", "bmp", "gif", "png", "doc", "docx", "pdf"])) {
  	$obj->status  = "error";
  	$obj->message = "File extensi $ext tidak diijinkan.";
  	ejson($obj);
  	exit;
  }
  
  //sanitasi file;
  $chr = " abcdefghijklmnopqrstuvwxyz-_.0123456789";
  $sss = "";
  for($iii = 0; $iii < strlen($fil); $iii++) {
  	$ppp = strpos(strtoupper($chr), strtoupper($fil[$iii]));
  	
  	if($ppp == TRUE)
  	$sss .= $fil[$iii];
  }
  $fil = str_replace(" ", "-", $sss);
  
  rename($tmp, $pth.$fil);
  chmod($pth.$fil, 775);
  
  $obj->status  = "success";
  $obj->message = $fil;  
  ejson($obj);
?>