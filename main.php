<?php
include "common.php";
include 'main_top.php';

$no = $_REQUEST['no'];
$query = "select * from product where status52=1 order by rand() limit 15";
$result = mysqli_query($db, $query);
if (!$result) exit("에러: $query");
?>

	<style>
	* {margin:0;padding:0;}
	.section {}
	.section input[id*="slide"] {display:none;}

	.section .slide-wrap {max-width:2400px;margin:0 auto;}
	.section .slidelist {white-space:nowrap;font-size:0;overflow:hidden;}
	.section .slidelist > li {display:inline-block;vertical-align:middle;width:100%;transition:all .5s;}
	.section .slidelist > li > a {display:block;position:relative;}
	.section .slidelist > li > a img {width:100%;}
	.section .slidelist label {position:absolute;z-index:10;top:50%;transform:translateY(-50%);padding:50px;cursor:pointer;}
	.section .slidelist .left {left:30px;background:url('images/left.png') center center / 100% no-repeat;}
	.section .slidelist .right {right:30px;background:url('images/right.png') center center / 100% no-repeat;}
	.section .slidelist .textbox {position:absolute;z-index:1;top:50%;left:50%;transform:translate(-50%,-50%);line-height:1.6;text-align:center;}
	
	.section .slidelist .textbox h3 {font-size:50px;color:#fff;opacity:0;transform:translateY(30px);transition:all .5s;}
	.section .slidelist .textbox p {font-size:24px;color:#fff;opacity:0;transform:translateY(30px);transition:all .5s;}

	.section input[id="slide01"]:checked ~ .slide-wrap .slidelist > li {transform:translateX(0%);}
	.section input[id="slide02"]:checked ~ .slide-wrap .slidelist > li {transform:translateX(-100%);}
	.section input[id="slide03"]:checked ~ .slide-wrap .slidelist > li {transform:translateX(-200%);}

	.section input[id="slide01"]:checked ~ .slide-wrap li:nth-child(1) .textbox h3 {opacity:1;transform:translateY(0);transition-delay:.2s;}
	.section input[id="slide01"]:checked ~ .slide-wrap li:nth-child(1) .textbox p {opacity:1;transform:translateY(0);transition-delay:.4s;}
	.section input[id="slide02"]:checked ~ .slide-wrap li:nth-child(2) .textbox h3 {opacity:1;transform:translateY(0);transition-delay:.2s;}
	.section input[id="slide02"]:checked ~ .slide-wrap li:nth-child(2) .textbox p {opacity:1;transform:translateY(0);transition-delay:.4s;}
	.section input[id="slide03"]:checked ~ .slide-wrap li:nth-child(3) .textbox h3 {opacity:1;transform:translateY(0);transition-delay:.2s;}
	.section input[id="slide03"]:checked ~ .slide-wrap li:nth-child(3) .textbox p {opacity:1;transform:translateY(0);transition-delay:.4s;}
	</style>
<div class="section">
	<input type="radio" name="slide" id="slide01" checked>
	<input type="radio" name="slide" id="slide02">
	<input type="radio" name="slide" id="slide03">
	<div class="slide-wrap">
		<ul class="slidelist">
			<li>
				<a>
					<label for="slide03" class="left"></label>
					<div class="textbox">
						<h3>UNIFORM BRIDGE</h3>
						<p>SUMMER FESTIVAL</p>
					</div>
					<img src="images/main050.jpg">
					<label for="slide02" class="right"></label>
				</a>
			</li>
			<li>
				<a>
					<label for="slide01" class="left"></label>
					<div class="textbox">
						<h3>UNIFORM BRIDGE</h3>
						<p>SUMMER FESTIVAL</p>>
					</div>
					<img src="images/main052.jpg">
					<label for="slide03" class="right"></label>
				</a>
			</li>
			<li>
				<a>
					<label for="slide02" class="left"></label>
					<div class="textbox">
						<h3>UNIFORM BRIDGE</h3>
						<p>SUMMER FESTIVAL</p>
					</div>
					<img src="images/main044.jpg">
					<label for="slide01" class="right"></label>
				</a>
			</li>
		</ul>
	</div>
</div><br><br><br>

<br>
<table border='0' cellpadding='0' cellspacing='0'>
    <tr>
        <?
        $num_col = 5;
        $num_row = 3;
        $count = mysqli_num_rows($result);
        $icount = 0;

        for ($ir = 0; $ir < $num_row; $ir++) {
            for ($ic = 0; $ic < $num_col; $ic++) {
                if ($icount < $count) {
                    $row = mysqli_fetch_array($result);
echo "
    <td width='20%' height='495.25' align='center' valign='top'>
        <div class='gallery'>
            <table width='100%' border='0' cellpadding='0' cellspacing='0' width='100' class='cmfont'>
                <tr> 
                    <td align='center'> 
                        <a href='product_detail.php?no={$row['no52']}'><img src='./product/{$row['image1']}' width='100%' height='100%' border='0'></a>
                    </td>
                </tr>
                <tr>
                    <td height='5'></td>
                </tr>

                <tr> 
                    <td height='20' align='center'>
                        <a href='product_detail.php?no={$row['no52']}'><font color='444444'>{$row['name52']}<br><b>{$row['coname52']}</b></font></a>&nbsp;
";
									
                             
if ($row['icon_sale52'] == 1) {
    echo "</td>
        </tr>
        <tr>
            <td height='20' align='center'>
                 <strike>KRW ".number_format($row['price52'])."</strike><br>
                <b>KRW ".number_format(round($row['price52'] * (100 - $row['discount52']) / 100, -3))."</b>
            </td>
        </tr>
    </table>
</td>";
} else {
    echo "</td>
        </tr>
        <tr>
            <td height='20' align='center'>
                <b>KRW ".number_format($row['price52'])."</b>
            </td>
        </tr>
    </table>
</td>";
}

						
                } else {
                    echo "<td></td>"; // 제품 없는 경우
                }
                $icount++;
            }
            echo "</tr>";
        }

        ?>
    </tr>
</table>

<!-- 화면 우측(신상품) 끝 -->
<?
include 'main_bottom.php';
?>
