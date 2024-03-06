<?php
require_once('connect.php');

$voucherValue = $_POST['value'];

$single_Voucher_Query = "SELECT * FROM vouchers WHERE voucher_code = '$voucherValue'";
$single_Voucher_Result = mysqli_query($conn, $single_Voucher_Query);
$single_Voucher = $single_Voucher_Result->fetch_All(MYSQLI_ASSOC);
echo json_encode($single_Voucher);
?>