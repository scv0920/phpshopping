<?
	include "common.php";
	
	$no=$_REQUEST["no"];
	$name=$_REQUEST["name"];
	$tel = sprintf("%-3s%-4s%-4s", $_REQUEST["tel1"], $_REQUEST["tel2"], $_REQUEST["tel3"]);  
	$sm=$_REQUEST["sm"];
	$birthday = sprintf("%04d-%02d-%02d", $_REQUEST["birthday1"], $_REQUEST["birthday2"], $_REQUEST["birthday3"]);
	$juso=$_REQUEST["juso"];
	 
	$query="update juso set name52='$name', tel52='$tel', sm52=$sm, birthday52='$birthday', juso52='$juso' where no52=$no;";
	$result=mysqli_query($db,$query);
	if (!$result) exit("에러:$query");
	
	echo("<script>location.href='juso_list.php'</script>");
?>
