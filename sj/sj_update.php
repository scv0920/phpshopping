<?
	include "common.php";
	
	$no=$_REQUEST["no"];
	$name=$_REQUEST["name"];
	$kor=$_REQUEST["kor"];
	$eng=$_REQUEST["eng"];
	$mat=$_REQUEST["mat"];
	$hap=$_REQUEST["hap"];
	$avg=$_REQUEST["avg"];
	 
	$query="update sj set name52='$name', kor52='$kor', 
				eng52='$eng', mat52='$mat', hap52='$hap', 
				avg52='$avg' where no52=$no;";
	$result=mysqli_query($db,$query);
	if (!$result) exit("에러:$query");
	
	echo("<script>location.href='sj_list.php'</script>");
?>
