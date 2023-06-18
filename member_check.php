	<?
		include "common.php";
		$uid  =$_REQUEST["uid"];
		$pwd=$_REQUEST["pwd"];
		$query="select no52, name52 from member where uid52='$uid' and pwd52='$pwd'";
		$result=mysqli_query($db,$query);
		if (!$result) exit("에러:$query");

		$row=mysqli_fetch_array($result);
		$count=mysqli_num_rows($result); 
		
	if ($count>0) 
		{
		setcookie("cookie_no", $row["no52"]);
		setcookie("cookie_name", $row["name52"]);
		echo("<script>location.href='index.html'</script>"); 
		}
	else
		echo("<script>location.href='member_login.php'</script>");
	?>

