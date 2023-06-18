<?
	include "../common.php";
	$no=$_REQUEST["no"];
	$menu=$_REQUEST["menu"];
	$code=$_REQUEST["code"];
	$name=$_REQUEST["name"];
	$coname=$_REQUEST["coname"];  
	$price=$_REQUEST["price"];	
	$opts1=$_REQUEST["opts1"];
	$opts2=$_REQUEST["opts2"];	
	$content=$_REQUEST["content"];
	$status=$_REQUEST["status"];
	$icon_new = isset($_REQUEST["icon_new"]) ? $_REQUEST["icon_new"] : 0;
	$icon_hit = isset($_REQUEST["icon_hit"]) ? $_REQUEST["icon_hit"] : 0;
	$icon_sale = isset($_REQUEST["icon_sale"]) ? $_REQUEST["icon_sale"] : 0;
	$discount=$_REQUEST["discount"];
	$regday1=$_REQUEST["regday1"];
	$regday2=$_REQUEST["regday2"];
	$regday3=$_REQUEST["regday3"];
	$regday = sprintf("%04d-%02d-%02d", $regday1, $regday2, $regday3);	
	$name = stripslashes($name);
	$content = stripslashes($content);

	$fname1="";
	if ($_FILES["image1"]["error"]==0) 
	{
		$fname1=$_FILES["image1"]["name"];    
		if (!move_uploaded_file($_FILES["image1"]["tmp_name"],
			  "../product/" . $fname1)) exit("업로드 실패");
	}

	$fname2="";
	if ($_FILES["image2"]["error"]==0) 
	{
		$fname2=$_FILES["image2"]["name"];    
		if (!move_uploaded_file($_FILES["image2"]["tmp_name"],
			  "../product/" . $fname2)) exit("업로드 실패");
	}

	$fname3="";
	if ($_FILES["image3"]["error"]==0) 
	{
		$fname3=$_FILES["image3"]["name"];    
		if (!move_uploaded_file($_FILES["image3"]["tmp_name"],
			  "../product/" . $fname3)) exit("업로드 실패");
	}

	$query="insert into product (menu52, code52, name52, coname52, price52, opts1, opts2, content52, status52, icon_new52, icon_hit52, icon_sale52, discount52, regday52, image1, image2, image3) 
								values($menu,$code,'$name','$coname',$price,$opts1,$opts2,'$content',$status,$icon_new,$icon_hit,$icon_sale,$discount,'$regday','$fname1','$fname2','$fname3');";


	$result=mysqli_query($db,$query);
	if (!$result) exit("에러:$query");

	echo("<script>location.href='product.php'</script>");

?>
