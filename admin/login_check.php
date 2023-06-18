
<?
	include "../common.php";

	if ($_REQUEST['adminid'] == $admin_id && $_REQUEST['adminpw'] == $admin_pw)
	{
		setcookie("cookie_admin", "yes");
		echo("<script>location.href='member.php'</script>"); 
	}
	else 
	{
		setcookie("cookie_admin", "");
		echo("<script>location.href='index.html'</script>");
	}
 ?>
