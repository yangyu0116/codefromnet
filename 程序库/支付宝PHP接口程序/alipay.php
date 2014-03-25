<?php

require_once("alipay_config.php");
class alipay
{
	function geturl($s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$s11,$s12,$s13,$s14,$s15,$s16,$s17,$s18,$s19,$s20,$s21,$s22,$s23)
	{
		$parameter = array(
				'cmd'			=> $s1,
				'subject'		=> $s2,
				'body'			=> $s3,
				'order_no'		=> $s4,
				'price'			=> $s5,
				'url'			=> $s6,
				'type'			=> $s7,
				'number'		=> $s8,
				'transport'		=> $s9,
				'ordinary_fee'		=> $s10,
				'express_fee'		=> $s11,
				'readonly'		=> $s12,
				'buyer_msg'		=> $s13,
				'seller'		=> $s14,
				'buyer'			=> $s15,
				'buyer_name'		=> $s16,
				'buyer_address'		=> $s17,
				'buyer_zipcode'		=> $s18,
				'buyer_tel'		=> $s19,
				'buyer_mobile'		=> $s20,
				'partner'		=> $s21,
		);

		$url = $s22.$s14."?";
		foreach($parameter as $key => $value){
				if($value){
						$url  .= $key."=".urlencode($value)."&";
						$acsouce .=$key.$value;
				}
		}
		$url  .= 'ac='.md5($acsouce.$s23);
		return $url;

	}
}
?>
