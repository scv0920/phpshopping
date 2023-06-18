<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "../common.php";
	$no=$_REQUEST["no"];
	$sel1=$_REQUEST["sel1"];
	$sel2=$_REQUEST["sel2"];
	$sel3=$_REQUEST["sel3"];
	$sel4=$_REQUEST["sel4"];
	$text1=$_REQUEST["text1"];
	$page=$_REQUEST["page"];
	$menu = $row["menu"];
	
	$query="select * from product where no52=$no";
	$result=mysqli_query($db,$query);
	if (!$result) exit("에러:$query");
	
	$row=mysqli_fetch_array($result);
	$regday1=substr($row["regday52"],0,4);             
	$regday2=substr($row["regday52"],5,2);
	$regday3=substr($row["regday52"],8,2);

	
?>

<html>
<head>
<title>쇼핑몰 관리자 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>

<script language="JavaScript">
	function imageView(strImage)
	{
		this.document.images["big"].src = strImage;
	}
</script>

</head>

<body style="margin:0">

<form name="form1" method="post" action="product_update.php" enctype="multipart/form-data">

<input type="hidden" name="sel1" value=<?=$sel1;?>>
<input type="hidden" name="sel2" value=<?=$sel2;?>>
<input type="hidden" name="sel3" value=<?=$sel3;?>>
<input type="hidden" name="sel4" value=<?=$sel4;?>>
<input type="hidden" name="text1" value=<?=$text1?>>
<input type="hidden" name="page" value=<?=$page;?>>
<input type="hidden" name="no" value=<?=$no;?>>

<center>

<br>
<script> document.write(menu());</script>
<br>
<br>

<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr height="23"> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품분류</td>
		<td width="700" bgcolor="#F2F2F2">
		<?
			echo("<select name='menu'>");
			for($i=0;$i<$n_menu;$i++)
			{	
				$selectedText = $a_menu[$i]; 
				if ($i==$row['menu52'])
					echo("<option value='$i' selected>{$a_menu[$i]}</option>");
				else
					echo("<option value='$i'>{$a_menu[$i]}</option>");
			}
			echo("</select>");
		?>

</select>
		</select>
		</td>
	</tr>
	<tr height="23"> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품코드</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="code" value="<?=$row["code52"];?>" size="20" maxlength="20">
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품명</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="name" value="<?=$row["name52"];?>" size="60" maxlength="60">
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">제조사</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="coname" value="<?=$row["coname52"];?>" size="30" maxlength="30">
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">판매가</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="price" value="<?=$row["price52"];?>" size="12" maxlength="12"> 원
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">옵션</td>
		<td width="700"  bgcolor="#F2F2F2">
<?
$query = "select * from opt order by name52";
$result = mysqli_query($db, $query);
if (!$result) exit("에러:$query");
$count = mysqli_num_rows($result); // 전체 레코드 개수

echo("<select name='opts1'>");
for ($i = 0; $i < $count; $i++) {
    $row1 = mysqli_fetch_array($result);
    $optName = $row1['name52'];
    $optValue = $row1['no52'];

    if ($row['opts1'] == $optValue) {
        echo("<option value='$optValue' selected>$optName</option>");
    } else {
        echo("<option value='$optValue'>$optName</option>");
    }
}
echo("</select>");
echo("</select>");
?> &nbsp; &nbsp; 

<?
$query = "select * from opt order by name52";
$result = mysqli_query($db, $query);
if (!$result) exit("에러:$query");
$count = mysqli_num_rows($result); // 전체 레코드 개수

echo("<select name='opts2'>");
for ($i = 0; $i < $count; $i++) {
    $row1 = mysqli_fetch_array($result);
    $optName = $row1['name52'];
    $optValue = $row1['no52'];

    if ($row['opts2'] == $optValue) {
        echo("<option value='$optValue' selected>$optName</option>");
    } else {
        echo("<option value='$optValue'>$optName</option>");
    }
}
echo("</select>");
?> &nbsp; &nbsp; 

		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">제품설명</td>
		<td width="700"  bgcolor="#F2F2F2">
			<textarea name="contents" rows="10" cols="100"><?=$row["content52"];?></textarea>
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품상태</td>
    <td width="700"  bgcolor="#F2F2F2">
			<?
				if ($row["status52"]==1) 
                                 echo("<input type='radio' name='status' value='1' checked> 판매중
                                           <input type='radio' name='status' value='2'> 판매중지
										   <input type='radio' name='status' value='3'> 품절
										  ");
				else if ($row["status52"]==2)
                                  echo("<input type='radio' name='status' value='1'> 판매중
                                           <input type='radio' name='status' value='2' checked> 판매중지
										   <input type='radio' name='status' value='3'> 품절
										  ");
				else
								  echo("<input type='radio' name='status' value='1'> 판매중
                                           <input type='radio' name='status' value='2'> 판매중지
										   <input type='radio' name='status' value='3'  checked> 품절
										  ");
			?>
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">아이콘</td>
		<td width="700"  bgcolor="#F2F2F2">
		<?
			if ($row["icon_new52"]==1) 
						 echo("<input type='checkbox' name='icon_new' value='1' checked>New");
			else
						 echo("<input type='checkbox' name='icon_new' value='1'>New");
			if ($row["icon_hit52"]==1) 
						 echo("<input type='checkbox' name='icon_hit' value='1' checked>HIt");
			else
						 echo("<input type='checkbox' name='icon_hit' value='1'>Hit");
			if ($row["icon_sale52"]==1) 
						 echo("<input type='checkbox' name='icon_sale' value='1' checked>Sale");
			else
						 echo("<input type='checkbox' name='icon_sale' value='1'>Sale");
		?>				
			할인율 : <input type="text" name="discount" value="<?=$row["discount52"];?>" size="3" maxlength="3"> %
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">등록일</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="regday1" value="<?=$regday1;?>" size="4" maxlength="4"> 년 &nbsp
			<input type="text" name="regday2" value="<?=$regday2;?>" size="2" maxlength="2"> 월 &nbsp
			<input type="text" name="regday3" value="<?=$regday3;?>" size="2" maxlength="2"> 일 &nbsp
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">이미지</td>
		<td width="700"  bgcolor="#F2F2F2">

			<table border="0" cellspacing="0" cellpadding="0" align="left">
				<tr>
					<td>
						<table width="390" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td>
									<input type='hidden' name='imagename1' value='<?=$row["image1"];?>'>
									&nbsp;<input type="checkbox" name="checkno1" value="1"> <b>이미지1</b>:<?=$row["image1"];?>
									<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="file" name="image1" size="20" value="찾아보기">
								</td>
							</tr> 
							<tr>
								<td>
									<input type='hidden' name='imagename2' value='<?=$row["image2"];?>'>
									&nbsp;<input type="checkbox" name="checkno2" value="1"> <b>이미지2</b>: <?=$row["image2"];?>
									<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="file" name="image2" size="20" value="찾아보기">
								</td>
							</tr> 
							<tr>
								<td>
									<input type='hidden' name='imagename3' value='<?=$row["image3"];?>'>
									&nbsp;<input type="checkbox" name="checkno3" value="1"> <b>이미지3</b>: <?=$row["image3"];?>
									<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="file" name="image3" size="20" value="찾아보기">
								</td>
							</tr> 
							<tr>
								<td><br>&nbsp;&nbsp;&nbsp;※ 삭제할 그림은 체크를 하세요.</td>
							</tr> 
				  	</table>
						<br><br><br><br><br>
						<table width="390" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td  valign="middle">&nbsp;
									<img src="../product/<?=$row["image1"];?>" width="50" height="50" border="1" style='cursor:hand' onclick="imageView('../product/<?=$row["image1"];?>')">&nbsp;
									<img src="../product/<?=$row["image2"];?>" width="50" height="50" border="1" style='cursor:hand' onclick="imageView('../product/<?=$row["image2"];?>')">&nbsp;
									<img src="../product/<?=$row["image3"];?>"  width="50" height="50" border="1" style='cursor:hand' onclick="imageView('../product/<?=$row["image3"];?>')">&nbsp;
								</td>
							</tr>				 
						</table>
					</td>
					<td>
						<td align="right" width="310"><img name="big" src="<?=$row["image1"];?>" width="300" height="300" border="1"></td>
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>

<table width="800" border="0" cellspacing="0" cellpadding="5">
	<tr> 
		<td align="center">
			<input type="submit" value="수정하기"> &nbsp;&nbsp
			<input type="button" value="이전화면" onClick="javascript:history.back();">
		</td>
	</tr>
</table>

</form>

</center>

</body>
</html>
