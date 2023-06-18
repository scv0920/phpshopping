<?
include "common.php";
$no = $_REQUEST["no"];
$num = $_REQUEST["num"];
$opts1 = $_REQUEST["opts1"];
$opts2 = $_REQUEST["opts2"];
$n_cart = $_COOKIE["n_cart"];
$cart = $_COOKIE["cart"];
$kind = $_REQUEST["kind"];
$pos = $_REQUEST["pos"];

if (!$n_cart) $n_cart = 0;   // 제품 개수 0으로 초기화

switch ($kind) {
    case "insert":      // 장바구니 담기

    case "order":      // 바로 구매하기
        $n_cart++;
        $productInfo = implode("^", array($no, $num, $opts1, $opts2));
        setcookie("n_cart", $n_cart);
        setcookie("cart[$n_cart]", $productInfo);
        $cart[$n_cart] = $productInfo;
        break;
    case "delete":      // 제품 삭제
        setcookie("cart[$pos]", "");
        unset($cart[$pos]);
        break;
    case "update":     // 수량 수정
        $productInfo = $cart[$pos];
        $productInfoArray = explode("^", $productInfo);
        $productInfoArray[1] = $num;
        $productInfo = implode("^", $productInfoArray);
        setcookie("cart[$pos]", $productInfo);
        $cart[$pos] = $productInfo;
        break;
    case "deleteall":    // 장바구니 전체 비우기    
        for ($i = 1; $i <= $n_cart; $i++) {
            if (isset($cart[$i])) {
                setcookie("cart[$i]", ""); // 해당 제품의 쿠키 값을 삭제
                unset($cart[$i]);
            }
        }
		$n_cart = 0 ;
		setcookie("n_cart", $n_cart);
        break;
}

if ($kind == "order") {
    echo("<script>location.href='order.php'</script>");
} else {
    echo("<script>location.href='cart.php'</script>");
}
?>
