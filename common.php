<?
	error_reporting(E_ALL % ~E_NOTICE % ~E_WARNING);
	ini_set("display_error", 1);
	
	mysqli_report(MYSQLI_REPORT_OFF);
		
	$db=mysqli_connect("localhost", "shop52", "1234", "shop52");
	if(!$db)exit("DB연결에러");
	
	$page_line =5; // 페이지당 line수
	$page_block=5; //블록당 page수
	$admin_id = "admin";
	$admin_pw="1234";
	
	$a_idname=array("전체","이름", "ID");   
	$n_idname=count($a_idname);    
	

	$a_menu = array("분류선택", "OUTER", "KNIT", "SHIRTS", "SWEATSHIRTS", "T-SHIRTS", "BOTTOMS", "ACCESSORIES", "LIFESTYLE");
	$n_menu = count($a_menu);        

	$a_status=array("상품상태","판매중","판매중지","품절");
	$n_status=count($a_status);

	$a_icon=array("아이콘","New","Hit","Sale");
	$n_icon=count($a_icon);

	$a_text1=array("제품이름","제품번호");  
	$n_text1=count($a_text1);
	
	$baesongbi = 3000;
    $max_baesongbi = 100000;
	
	
	$a_state = array("전체", "주문신청", "주문확인", "입금확인", "배송중", "주문완료", "주문취소");
    $n_state = count($a_state);
	
	$a_jumun= array("","주문번호", "고객명", "상품명");
    $n_jumun = count($a_jumun);

		


?>