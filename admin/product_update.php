<?
include "../common.php";
$no = $_REQUEST["no"];
$menu = $_REQUEST["menu"];
$code = $_REQUEST["code"];
$name = $_REQUEST["name"];
$coname = $_REQUEST["coname"];
$price = $_REQUEST["price"];
$opts1 = isset($_REQUEST["opts1"]) ? $_REQUEST["opts1"] : 0;
$opts2 = isset($_REQUEST["opts2"]) ? $_REQUEST["opts2"] : 0;
$content = $_REQUEST["contents"];
$status = $_REQUEST["status"];
$icon_new = isset($_REQUEST["icon_new"]) ? $_REQUEST["icon_new"] : 0;
$icon_hit = isset($_REQUEST["icon_hit"]) ? $_REQUEST["icon_hit"] : 0;
$icon_sale = isset($_REQUEST["icon_sale"]) ? $_REQUEST["icon_sale"] : 0;
$discount = $_REQUEST["discount"];
$regday1 = $_REQUEST["regday1"];
$regday2 = $_REQUEST["regday2"];
$regday3 = $_REQUEST["regday3"];
$imagename1 = $_REQUEST["imagename1"];
$imagename2 = $_REQUEST["imagename2"];
$imagename3 = $_REQUEST["imagename3"];
$checkno1 = $_REQUEST["checkno1"];
$checkno2 = $_REQUEST["checkno2"];
$checkno3 = $_REQUEST["checkno3"];
$regday = sprintf("%04d-%02d-%02d", $regday1, $regday2, $regday3);
$name = stripslashes($name);
$content = stripslashes($content);

$fname1 = $imagename1;
if ($checkno1 == "1") $fname1 = "";
if ($_FILES["image1"]["error"] == 0) {
    $fname1 = $_FILES["image1"]["name"];
    if (!move_uploaded_file($_FILES["image1"]["tmp_name"], "../product/" . $fname1)) exit("업로드 실패");
}

$fname2 = $imagename2;
if ($checkno2 == "1") $fname2 = "";
if ($_FILES["image2"]["error"] == 0) {
    $fname2 = $_FILES["image2"]["name"];
    if (!move_uploaded_file($_FILES["image2"]["tmp_name"], "../product/" . $fname2)) exit("업로드 실패");
}

$fname3 = $imagename3;
if ($checkno3 == "1") $fname3 = "";
if ($_FILES["image3"]["error"] == 0) {
    $fname3 = $_FILES["image3"]["name"];
    if (!move_uploaded_file($_FILES["image3"]["tmp_name"], "../product/" . $fname3)) exit("업로드 실패");
}

$query = "update product set menu52 = $menu, code52 = $code, name52='$name', coname52='$coname', price52 = $price, regday52='$regday', opts1=$opts1, opts2=$opts2, content52='$content', status52=$status, icon_new52=$icon_new, icon_hit52=$icon_hit, icon_sale52=$icon_sale, discount52 = $discount, image1 = '$fname1', image2 = '$fname2', image3 = '$fname3' where no52=$no;";

$result = mysqli_query($db, $query);
if (!$result) {
    $error = mysqli_error($db);
    exit("에러: $error");
}

echo("<script>location.href='product.php'</script>");
?>
