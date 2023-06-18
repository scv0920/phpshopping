<?
	error_reporting(E_ALL % ~E_NOTICE % ~E_WARNING);
	ini_set("display_error", 1);
	
	mysqli_report(MYSQLI_REPORT_OFF);
		
	$db=mysqli_connect("localhost", "shop52", "1234", "shop52");
	if(!$db)exit("DB연결에러");
	
	$page_line =5; // 페이지당 line수
	$page_block=5; //블록당 page수
?>