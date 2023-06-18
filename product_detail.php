<?
include "common.php";
include 'main_top.php';

	$no=$_REQUEST["no"];
	$query="select * from product where no52=$no";
	$result=mysqli_query($db,$query);
	if (!$result) exit("에러:$query");
	
	$row = mysqli_fetch_array($result);

?>
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

			<!--  현재 페이지 자바스크립  -------------------------------------------->
			<script language = "javascript">

			function Zoomimage(no) {
			  window.open("zoomimage.php?no=" + <? echo $no; ?>, "", "menubar=no, scrollbars=yes, width=560, height=640, top=30, left=50");
			}

			function check_form2(str) 
			{
				if (!form2.opts1.value) {
						alert("옵션1을 선택하십시요.");
						form2.opts1.focus();
						return;
				}
				if (!form2.opts2.value) {
						alert("옵션2를 선택하십시요.");
						form2.opts2.focus();
						return;
				}
				if (!form2.num.value) {
						alert("수량을 입력하십시요.");
						form2.num.focus();
						return;
				}

				if (str == "D") {
					form2.action = "cart_edit.php";
					form2.kind .value = "order";
					form2.submit();
				}
				else {
					form2.action = "cart_edit.php";
					form2.kind .value = "insert";
					form2.submit();
				}
			}
			</script>
<div style="position: sticky; top: 0; width: 100%;">
<div style="float: right; width: 50%;">
			<table border="0" cellpadding="0" cellspacing="0" width="747">
				<tr><td height="13"></td></tr>

				<tr><td height="10"></td></tr>
			</table>

			<!-- form2 시작  -->
			<form name="form2" method="post" action="cart_edit.php">
				<input type="hidden" name="no" value="<? echo $no;?>">
				<input type="hidden" name="kind" value="insert">

			<table border="0" cellpadding="0" cellspacing="0" width="745">
				<tr>
					<td width="335" align="center" valign="top">
						<!-- 상품이미지 -->
						<table border="0" cellpadding="0" cellspacing="1" width="315" height="315" bgcolor="D4D0C8">
							<tr>
								<td bgcolor="white" align="center">
									<img src="./product/<?=$row['image2'];?>" height="315" border="0" align="absmiddle" ONCLICK="Zoomimage('0000')" STYLE="cursor:hand">
								</td>
							</tr>
						</table>
					</td>
					<td width="410 " align="center" valign="top">
						<!-- 상품명 -->
						<table border="0" cellpadding="0" cellspacing="0" width="370" class="cmfont">
							<tr><td colspan="3" bgcolor="E8E7EA"></td></tr>
							<tr>
								<td width="80" height="45" style="padding-left:10px">
									<img src="images/i_dot1.gif" width="3" height="3" border="0" align="absmiddle">
									<font color="666666"><b>제품명</b></font>
								</td>
								<td width="1" bgcolor="E8E7EA"></td>
								<td style="padding-left:10px">
									<font color="282828"><?=$row["name52"];?></font><br>
								</td>
							</tr>
							<tr><td colspan="3" bgcolor="E8E7EA"></td></tr>
							<!-- 시중가 -->
							<tr>
								<td width="80" height="35" style="padding-left:10px">
									<img src="images/i_dot1.gif" width="3" height="3" border="0" align="absmiddle">
									<font color="666666"><b>소비자가</b></font>
								</td>
								<td width="1" bgcolor="E8E7EA"></td>
								<td width="289" style="padding-left:10px"><font color="666666">
									KRW <? if ($row['icon_sale52'] == 1) { ?>
										<strike><? echo number_format($row['price52']); ?></strike>
									<? } else {
										echo  number_format($row['price52']);
									} ?>
								</font></td>

							</tr>
							<tr><td colspan="3" bgcolor="E8E7EA"></td></tr>
							<!-- 판매가 -->
							<tr>
								<td width="80" height="35" style="padding-left:10px">
									<img src="images/i_dot1.gif" width="3" height="3" border="0" align="absmiddle">
									<font color="666666"><b>판매가</b></font>
								</td>
								<td width="1" bgcolor="E8E7EA"></td>
								<td style="padding-left:10px"><font color="0288DD"><b>
								<?
									if ($row['icon_sale52'] == 1) {
											echo "<b>KRW ".number_format(round($row['price52']*(100-$row['discount52'])/100, -3))."</b>";
									} else {
											echo "<b>KRW " . number_format($row['price52']) . "</b>";

									}
								?>
								</b></font></td>
							</tr>
							<tr><td colspan="3" bgcolor="E8E7EA"></td></tr>
							<!-- 옵션 -->
							<tr>
								<td width="80" height="35" style="padding-left:10px">
									<img src="images/i_dot1.gif" width="3" height="3" border="0" align="absmiddle">
									<font color="666666"><b>옵션선택</b></font>
								</td>
								<td width="1" bgcolor="E8E7EA"></td>
								<td style="padding-left:10px">
							<?
							$query = "select * from opts where opt_no52 = $row[opts1]";
							$result = mysqli_query($db, $query);
							if (!$result) exit("에러:$query");
							$count = mysqli_num_rows($result); // 전체 레코드 개수

							echo("<select name='opts1'>");
							// 기본 선택 값으로 "선택하세요"를 표시
							echo("<option value='' selected>SIze</option>");

							for ($i = 0; $i < $count; $i++) {
								$row1 = mysqli_fetch_array($result);
								$optName = $row1['name52'];
								$optValue = $row1['no52'];

								if ($row['opts1'] == $optValue) {
									echo("<option value='$optValue'>$optName</option>");
								} else {
									echo("<option value='$optValue'>$optName</option>");
								}
							}
							echo("</select>");
							?> &nbsp; &nbsp; 

							<?
							$query = "select * from opts where opt_no52 = $row[opts2]";
							$result = mysqli_query($db, $query);
							if (!$result) exit("에러:$query");
							$count = mysqli_num_rows($result); // 전체 레코드 개수

							echo("<select name='opts2'>");
							// 기본 선택 값으로 "선택하세요"를 표시
							echo("<option value='' selected>Color</option>");

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
							<tr><td colspan="3" bgcolor="E8E7EA"></td></tr>
							<!-- 수량 -->
							<tr>
								<td width="80" height="35" style="padding-left:10px">
									<img src="images/i_dot1.gif" width="3" height="3" border="0" align="absmiddle">
									<font color="666666"><b>수량</b></font>
								</td>
								<td width="1" bgcolor="E8E7EA"></td>
								<td style="padding-left:10px">
									<input type="text" name="num" value="1" size="3" maxlength="5" class="cmfont1"> <font color="666666">개</font>
								</td>
							</tr>
							<tr><td colspan="3" bgcolor="E8E7EA"></td></tr>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="370" class="cmfont">
							<tr>
								<td height="70" align="center">
									<a href="javascript:check_form2('D')"><img src="images/buy.png" border="0" align="absmiddle"></a>&nbsp;&nbsp;&nbsp;
									<a href="javascript:check_form2('C')"><img src="images/cart.png"  border="0" align="absmiddle"></a>
								</td>
							</tr>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="370" class="cmfont">
							<tr>
								<td height="30" align="center">
									<img src="images/product_text1.gif" border="0" align="absmiddle">
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form>
			<!-- form2 끝  -->

			<table border="0" cellpadding="0" cellspacing="0" width="747">
				<tr><td height="22"></td></tr>
			</table>

			<!-- 상세설명 -->
			<table border="0" cellpadding="0" cellspacing="0" width="747">
				<tr><td height="13"></td></tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" width="746">
				<tr>

				</tr>
			</table>
			
<table border="0" cellpadding="0" cellspacing="0" width="746" style="font-size:9pt">
	<tr><td height="13"></td></tr>
	<tr>
		<td height="200" valign="top" style="line-height:14pt">
			<?=$row['content52'];?>
		</td>
	</tr>
</table>
</div>
</div>
<br>
<br>
<div style="overflow: hidden;">
    <div style="float: left; width: 50%;">
        <img src="./product/<?=$row['image3'];?>" alt="Image" style="margin-left: 25%;">
    </div>
</div>
<br>
<br>



<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	
<?
include 'main_bottom.php';
?>
