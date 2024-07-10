<?php
  $deb = isset($_GET["debug"]) ? "1" : "";
  $hst = "localhost";
  $usr = "root";
  $pas = "";
  $dbn = "groupwaree";
  $prt = 3306;
  
  if($deb) {
  	$_SESSION["debug"] = "1";
  }

  $con = new mysqli($hst, $usr, $pas, $dbn, $prt);
  
  function isDebug() {
  	return _SESSION("debug");
  }
  
  if($con->connect_errno) {
    $die = $con->connect_error;
    $die = "{\"status\":\"error\",\"message\":\"$die\",\"data\":\"\"}";  
    echo $die;
    exit;
  }
  
  function isSelect($sql) {
    $sql = strtolower(trim($sql));
    
    return substr($sql, 0, 6) == "select";	
  }
  
  function ExecQuery($sql, $save = TRUE) {
    global $con;

    $_SESSION["SQL"]["ERROR"] = "";
    $sql = str_replace("''", "'0'", $sql); 
    $obj = $con->query($sql);
    
    if($con->error) {
    	$err = $con->error;
    	
    	/*
    	$deb = debug_backtrace();
    	$deb = $deb[0];
    	echo "<div style='padding: 10px; border: 1px solid #888888;'>"
    	     ."Query Error in ".$deb["file"]." line ".$deb["line"]
    	     ."<br /><br />$err"
    	     ."</div>";
    	*/
    	
    	$_SESSION["SQL"]["ERROR"] = $err;    	
    	return "";
    }
    
    
    $dat = array();
  	if($obj->num_rows)
  	while($row = $obj->fetch_object()) {
  	  $dat[] = $row;
  	}	
    //$obj->close;
    
    return $dat;
  }
  
  function ExecQuery1R($sql, $save = TRUE) {
    global $con;
 
    $_SESSION["SQL"]["ERROR"] = "";
    $sql = str_replace(["'[blank]'"], ["''"], $sql); 
    $obj = $con->query($sql);
    
    if($con->error) {
    	$err = $con->error;
    	
    	/*
    	$deb = debug_backtrace();
    	$deb = $deb[0];
    	echo "<div style='padding: 10px; border: 1px solid #888888;'>"
    	     ."Query Error in ".$deb["file"]." line ".$deb["line"]
    	     ."<br /><br />$err"
    	     ."</div>";
    	*/
    	
    	$_SESSION["SQL"]["ERROR"] = $err;
    	return "";
    }
    
    if(isSelect($sql)) {
  	  if($obj->num_rows)
  	  while($row = $obj->fetch_object()) {
  	    $dat = $row;
  	  }	
    } else $dat = "";
    //$obj->close;
    
    return isset($dat) ? $dat : "";
  }
  
  function SQLError() {
  	return $_SESSION["SQL"]["ERROR"];
  }
?>