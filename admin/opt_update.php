
<?
	include "../common.php";
	$no1=$_REQUEST["no1"];
	

	$name=$_REQUEST["name"];
	$query="update opt set name52='$name' where no52=$no1;";
	
	$result=mysqli_query($db,$query);
	if (!$result) exit("에러:$query");
	
	echo("<script>location.href='opt.php'</script>");
?>
