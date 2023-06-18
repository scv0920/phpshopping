<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	

<?
	include "../common.php";
	$no=$_REQUEST["no"];
	$sel1=$_REQUEST["sel1"];
	$text1=$_REQUEST["text1"];
	
	if (!$text1)
		$query="select * from member order by name52;";
	else if ($sel1==1)
		$query="select * from member where name52 like '%$text1%' order by name52;";
	else 
		$query="select * from member where uid52 like '%$text1%' order by name52;";
	
	$result=mysqli_query($db,$query);
	if (!$result) exit("에러:$query");
	$count=mysqli_num_rows($result); // 전체 레코드 개수
	
?>


<html>
<head>
<title>쇼핑몰 관리자 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>

<table width="800" border="0">
	<form name="form1" method="post" action="member.php">
  <tr height="40">
    <td width="200" valign="bottom">&nbsp 회원수 : <font color="#FF0000"><?=$count; ?></font></td>
    <td width="540" align="right" valign="bottom">
      <?
        echo("<select name='sel1'>");
        for ($i=1; $i<$n_idname; $i++)
        {
          if ($sel1==$i)
            echo("<option value='$i' selected>$a_idname[$i]</option>");
          else
            echo("<option value='$i'>$a_idname[$i]</option>");
        }
        echo("</select>");
      ?>
	  
      <input type="text" name="text1" value="<?=$text1?>" placeholder="검색어 입력">
      <input type="submit" value="검색">
    </td>
  </tr>
</form>
</table>

<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC" height="23"> 
		<td width="100" align="center">ID</td>
		<td width="100" align="center">이름</td>
		<td width="100" align="center">전화</td>
		<td width="100" align="center">핸드폰</td>
		<td width="200" align="center">E-Mail</td>
		<td width="100" align="center">회원구분</td>
		<td width="100" align="center">수정/삭제</td>
	</tr>
	<?	


	$result=mysqli_query($db,$query);
	if (!$result) exit("에러:$query");
	
	$count=mysqli_num_rows($result); // 전체 레코드 개수


	$page=$_REQUEST["page"];
	if (!$page) $page=1;
	$pages=ceil( $count / $page_line );
	
	
	// 현재 페이지가 몇 번째 자료부터 시작하는지 계산 :20(2-1) = 20
	
	$first=1;
	if ($count>0) $first=$page_line*($page-1);
	// 현재 페에지에 표시할 수 있는 줄 수 : 모든 페이지는 20줄씩 표시되지만, 맨 끝 페이지인 경우는 65-60=5줄만 표시 됨.
	$row=mysqli_fetch_array($result);
	$page_last=$count - $first;
	if($page_last>$page_line) $page_last=$page_line;
	if ($row["gubun52"]==0)  $gubun="회원";  else   $gubun="탈퇴";
	
	//현재 페이지 1번째 자료로 이동
	if ($count>0) mysqli_data_seek($result,$first);
	for ($i=0; $i<$page_last; $i++) //남은 줄만큼만 표시
	{
		$row=mysqli_fetch_array($result);
		if ($row["gubun52"]==1)  $gubun="탈퇴";  else   $gubun="회원";
		$tel1=trim(substr($row["tel52"],0,3));        // 0번 위치에서 3자리 문자열 추출
		$tel2=trim(substr($row["tel52"],3,4));        // 3번 위치에서 4자리
		$tel3=trim(substr($row["tel52"],7,4));   		// 7번 위치에서 4자리
		$tel = $tel1 . "-" . $tel2 . "-" . $tel3; 
		$phone1=trim(substr($row["phone52"],0,3));        // 0번 위치에서 3자리 문자열 추출
		$phone2=trim(substr($row["phone52"],3,4));        // 3번 위치에서 4자리
		$phone3=trim(substr($row["phone52"],7,4));        // 7번 위치에서 4자리
		$phone = $phone1 . "-" . $phone2 . "-" . $phone3; 
		   
		 echo("<tr bgcolor='#F2F2F2'>
						<td align='center'>$row[uid52]</a>
						<td align='center'>$row[name52]</td>	
						<td align='center'>$tel</td>
						<td align='center'>$phone</td>
						<td align='center'>$row[email52]</td>
						<td align='center'>$gubun</td>
						<td align='center'>
							<a href='member_edit.php?no=$row[no52]&page=&sel1=&text1='>수정 </a> / 
							<a href='member_delete.php?no=$row[no52]'
								onClick='javascript:return confirm(\"삭제할까요?\");'>
								삭제
							</a>
						</td>
					</tr>");
	}
?>
</table>


<?
	$blocks = ceil($pages/$page_block);		// 전체 블록수
	$block= ceil($page/$page_block);			// 현재 블록
	$page_s = $page_block * ($block-1);	// 현재 페이지
	$page_e = $page_block * $block;			// 마지막 페이지
	if($blocks <= $block) $page_e = $pages;
	
	echo("<table width='400' border='0'>
		<tr>
			<td height='20' align='center'>");

	if ($block > 1) {		// 이전 블록으로
		$tmp = $page_s;
		echo("<a href='member.php?no=$no&page=$tmp&sel1=$sel1&text1=$text1'>
			<img src='images/i_prev.gif' align='absmiddle' border='0'>
			</a>&nbsp");
}

for ($i=$page_s+1; $i<=$page_e; $i++) { 	// 현재 블록의 페이지
    if ($page == $i)
        echo("<font color='red'><b>$i</b></font>&nbsp");
    else
        echo("<a href='member.php?no=$no&page=$i&sel1=$sel1&text1=$text1'> [$i]</a>&nbsp;");
}

if ($block < $blocks) {		// 다음 블록으로
    $tmp = $page_e+1;
    echo("&nbsp<a href='member.php?no=$no&page=$tmp&sel1=$sel1&text1=$text1'>
        <img src='images/i_next.gif' align='absmiddle' border='0'>
        </a>");
}

	echo("</td>
		</tr>
	</table>");
?>


</center>

</body>
</html>

