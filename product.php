<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
include "common.php";
include 'main_top.php';
$no = $_REQUEST['no'];
$menu = $_REQUEST['menu'];
$sort = $_REQUEST['sort'];
if ($menu == 9){
    $query = "select * from product where icon_sale52=1 and status52=1 order by rand()";
}
else{
    if ($sort == "up") {
        $query = "SELECT * FROM product WHERE menu52 = $menu ORDER BY price52 DESC";
    } elseif ($sort == "down") {
        $query = "SELECT * FROM product WHERE menu52 = $menu ORDER BY price52 ASC";
    } elseif ($sort == "name") {
        $query = "SELECT * FROM product WHERE menu52 = $menu ORDER BY name52 ASC";
    } else {
        $query = "SELECT * FROM product WHERE menu52 = $menu ORDER BY no52 DESC";
    }
}
$result = mysqli_query($db, $query);
if (!$result) exit("에러: $query");
$count = mysqli_num_rows($result);

?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

<!-- 하위 상품목록 -->
<form name="form2" method="post" action="product.php">
    <input type="hidden" name="menu" value=<?=$menu;?>>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="cmfont">
        <tr>
            <td align="center" valign="middle">
                <table border="0" cellpadding="0" cellspacing="0" width="730" height="40" class="cmfont">
                    <tr>
                        <td width="500" align="center" class="cmfont">
                            <font color="#000000" size="4"><b><?=$a_menu[$menu];?> &nbsp</b></font>&nbsp;
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <?php if ($menu != 9) { ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="cmfont">
        <tr>
            <td align="right">
                <font color="EF3F25"><b><?=$count;?></b></font> 개의 상품.&nbsp;&nbsp;&nbsp;
            </td>
            <td width="100">
                <form method="GET" action="">
                    <select name="sort" size="1" class="cmfont" onChange="this.form.submit()">
                        <option value="new" <?php if ($sort == 'new') echo 'selected'; ?>>신상품순 정렬</option>
                        <option value="up" <?php if ($sort == 'up') echo 'selected'; ?>>고가격순 정렬</option>
                        <option value="down" <?php if ($sort == 'down') echo 'selected'; ?>>저가격순 정렬</option>
                        <option value="name" <?php if ($sort == 'name') echo 'selected'; ?>>상품명 정렬</option>
                    </select>
                </form>
            </td>
        </tr>
    </table>
    <?php } ?>

</form>

<table border="0" cellpadding="0" cellspacing="0">

<?php
    $num_col = 5;
    $num_row = 3;
    $page_line = $num_col * $num_row; // 한 페이지에 출력할 제품 수
    $icount = 0;

    $page = $_REQUEST['page'];
    if (!$page) $page = 1;
    $pages = ceil($count/$page_line);

    $first = 1;
    if ($count > 0) $first = $page_line * ($page - 1);

    $page_last = $count - $first;
    if ($page_last > $page_line) $page_last = $page_line;

    if ($count > 0) mysqli_data_seek($result, $first);

    echo("<table>");

    for ($ir=0; $ir<$num_row; $ir++) {
        echo("<tr>");
        for ($ic=0; $ic<$num_col; $ic++) {
            if ($icount < $page_last) {
                $row = mysqli_fetch_array($result);
                $price = number_format($row['price52'], 0);

                echo "<td width='20%' height='495.25' align='center' valign='top'>
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
        echo("</tr>");
    }
    echo("</table>");
?>

<!-- 페이지 기능 -->
<?php
    $page_block = 5; // 페이지 블록에 나타날 페이지 수
    $blocks = ceil($pages/$page_block);
    $block = ceil($page/$page_block);
    $page_s = $page_block * ($block - 1);
    $page_e = $page_block * $block;
    if ($page_e > $pages) $page_e = $pages;

    echo "<table width='100%' border='0' cellpadding='0' cellspacing='0' class='cmfont'>
            <tr>
                <td height='30' class='cmfont' align='center'>";

    if ($block > 1) {
        $prev = ($block - 2) * $page_block + 1;
        echo "<font color='#D0D0D0'>
                <a href='product.php?menu=$menu&page=1&sort=$sort'>
                   
                </a>
                &nbsp;|
                <a href='product.php?menu=$menu&page=$prev&sort=$sort'>
                    <img src='images/i_prev.gif' align='absmiddle' border='0'>
                </a>
                &nbsp;</font>";
    }

    for ($i=$page_s+1; $i<=$page_e; $i++) {
        if ($page == $i)
            echo "<font color='EF3F25'><b>$i</b></font>&nbsp;";
        else
            echo "<a href='product.php?menu=$menu&page=$i&sort=$sort'>[$i]</a>&nbsp;";
    }

    if ($block < $blocks) {
        $next = $block * $page_block + 1;
        echo "<font color='#D0D0D0'>
                <a href='product.php?menu=$menu&page=$next&sort=$sort'>
                    
                </a>
                &nbsp;|
                <a href='product.php?menu=$menu&page=$pages&sort=$sort'>
                    <img src='images/i_next.gif' align='absmiddle' border='0'>
                </a>
                </font>";
    }

    echo "</td>
        </tr>
    </table>";
?>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	

<?php
    include 'main_bottom.php';
?>
