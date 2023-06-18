<?
    include "common.php";

    $today = date("Y-m-d");
    $query = "select no52 from jumun where jumunday52 = '$today' order by no52 desc;";
    $result = mysqli_query($db, $query);
    if (!$result) exit("ERROR: $query");
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);

    // 새 주문 번호 (형식 : YYMMDD0000)
    if ($count > 0) { // 주문 번호가 있는 경우
        $jumun_no = intval($row[0]) + 1;
    }
    else
        $jumun_no = date("ymd") . "0001";
    
    $cookie_no = $_COOKIE['cookie_no'];

    $cart = $_COOKIE['cart'];
    $n_cart = $_COOKIE['n_cart'];

    $product_total = 0;
    $product_nums = 0; // 주문한 제품 개수
    $product_names = "";

    for ($i=1;  $i<=$n_cart;  $i++) {
        if ($cart[$i]) { // 제품정보가 있는 경우만
            // 장바구니 cookie에서 제품번호, 수량, 소옵션번호1, 2 알아내기
            list($product_no, $num, $opts1, $opts2) = explode("^", $cart[$i]);

            // 제품정보(제품번호, 단가, 할인여부, 할인율) 알아내기
            $query = "select * from product where no52 = $product_no";
            $result = mysqli_query($db, $query);
            if (!$result) exit("ERROR: $query");
            $product_row = mysqli_fetch_array($result);

            // 소옵션이름 (opts1, opts2 이름) 알아내기
            $query = "select * from opts where no52 = $opts1";
            $result = mysqli_query($db, $query);
            if (!$result) exit("ERROR: $query");
            $row1 = mysqli_fetch_array($result);

            $query = "select * from opts where no52 = $opts2";
            $result = mysqli_query($db, $query);
            if (!$result) exit("ERROR: $query");
            $row2 = mysqli_fetch_array($result);

            if ($product_row['discount'] != 0) $real_price = round($product_row['price'] * (100 - $product_row['discount']) / 100, -3);
            else $real_price = $product_row['price52'];

            $cash = $num * $real_price;

            // insert SQL문을 이용하여 jumuns 테이블에 저장.
            // (주문번호, 제품번호, 수량, 단가, 금액, 할인율, 소옵션번호1, 2)
            $query = "insert into jumuns (jumun_no52, product_no52, num52, price52, cash52, discount52, opts_no1, opts_no2)
                        values ('$jumun_no', $product_no, $num, $product_row[price52], $cash, 
                                    $product_row[discount52], $opts1, $opts2);";
            $result = mysqli_query($db, $query);
            if (!$result) exit("ERROR: $query");

            // 장바구니 cookie에서 제품 정보 삭제.
            setcookie("cart[$i]");

            // 총금액 = 총금액 + 금액;
            $product_total += $cash;

            // 주문한 제품 개수
            $product_nums = $product_nums + 1;

            if ($product_nums == 1)
                $product_names = $product_row['name52'];
            }
    }

    if ($product_nums > 1) { // 제품수가 2개 이상인 경우만 "외 ?" 추가
        $tmp = $product_nums;
        $product_names = $product_names . " 외 " . $tmp-1;
    }

    if ($product_total < $max_baesongbi) {
        // (주문_번호, 0, 1, 배송비, 배송비, 0, 0, 0,)
        $query = "insert into jumuns (jumun_no52, product_no52, num52, price52, cash52, discount52, opts_no1, opts_no2)
                        values ('$jumun_no', 0, 1, $baesongbi, $baesongbi, 0, 0, 0);";
        $result = mysqli_query($db, $query);
        if (!$result) exit("ERROR: $query");
        
        // 총금액 = 총금액 + 배송비;
        $product_total += $baesongbi;
    }

    if ($cookie_no)
        $member_no = $cookie_no;
    else
        $member_no = 0;

    $o_name = $_REQUEST['o_name'];
    $o_tel = $_REQUEST['o_tel'];
    $o_phone = $_REQUEST['o_phone'];
    $o_email = $_REQUEST['o_email'];
    $o_zip = $_REQUEST['o_zip'];
    $o_juso = $_REQUEST['o_juso'];

    $r_name = $_REQUEST['r_name'];
    $r_tel = $_REQUEST['r_tel'];
    $r_phone = $_REQUEST['r_phone'];
    $r_email = $_REQUEST['r_email'];
    $r_zip = $_REQUEST['r_zip'];
    $r_juso = $_REQUEST['r_juso'];
    $memo = $_REQUEST['memo'];

    $memo = addslashes($memo);

    $pay_method = $_REQUEST['pay_method'];
    $card_kind = $_REQUEST['card_kind'];
    $card_halbu = $_REQUEST['card_halbu'];

    $bank_kind = $_REQUEST['bank_kind'];
    $bank_sender = $_REQUEST['bank_sender'];

    $jumunday = date("Y-m-d");
    
$query = "INSERT INTO jumun (no52, member_no52, jumunday52, product_names52, product_num52, o_name52, o_tel52, o_phone52, o_email52, o_zip52, o_juso52, r_name52, r_tel52, r_phone52, r_email52, r_zip52, r_juso52, memo52, pay_method52, card_okno52, card_halbu52, card_kind52, bank_kind52, bank_sender52, total_cash52, state52)
          VALUES ('$jumun_no', $member_no, '$jumunday', '$product_names', $product_nums, '$o_name', '$o_tel', '$o_phone', '$o_email', '$o_zip', '$o_juso', '$r_name', '$r_tel', '$r_phone', '$r_email', '$r_zip', '$r_juso', '$memo', $pay_method, $jumun_no, $card_halbu, $card_kind, $bank_kind, '$bank_sender', $product_total, 1)";

$result = mysqli_query($db, $query);
if (!$result) exit("에러: $query");

    echo("<script>location.href='order_ok.php'</script>");
?>