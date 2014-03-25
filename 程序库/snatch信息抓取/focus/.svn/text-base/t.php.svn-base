<?php
//把temp.house表中的数据转到siisoo.house中
require_once $_SERVER['DOCUMENT_ROOT'].'/config.ini.php';


$db = $Mysql->connect('temp');
$sql = "SELECT  * FROM `house` WHERE 1 ";
$sql .= "ORDER BY `ID` DESC ";
$res = $db->GetAll($sql);
$db = $Mysql->connect($DATABASE);
foreach($res as $val)
{
	$sql = "INSERT INTO `house` (`Pid`,`Tag1`,`Tag2`,`Tag3`,`Title`,`Content`,`AreaID`,`CityID`,`DistID`,`LiveID`,`CommID`,`Contact`,`Email`,`ImWhich`,`IM`,`Mobile`,`Tel`,`Address`,`Pic`,`PicUrl`,`PostTime`,`IP`,`Valid`,`ValidPeriod`,`Top`,`IfMember`,`UserName`,`Hit`,`Reply`,`Comment`,`UseEmail`,`OriginalUrl`,`DealType`,`Room`,`Hall`,`Loo`,`Direction`,`PriceType`,`Price`,`RentPrice`,`BuyPrice`,`Area`,`RentArea`,`BuyArea`,`Fitment`,`Facility`,`RealtyFee`,`BuyRealtyFee`,`RealtyType`,`BuildAge`,`FloorTotal`,`Floor`,`RentFloor`,`BuyFloor`,`IfPersonal`,`HeatingType`,`HasHouse`,`Longitude`,`Latitude`) ";
	$sql .= "VALUES ('".$val['Pid']."','".$val['Tag1']."','".$val['Tag2']."','".$val['Tag3']."','".$val['Title']."','".$val['Content']."','".$val['AreaID']."','".$val['CityID']."','".$val['DistID']."','".$val['LiveID']."','".$val['CommID']."','".$val['Contact']."','".$val['Email']."','".$val['ImWhich']."','".$val['IM']."','".$val['Mobile']."','".$val['Tel']."','".$val['Address']."','".$val['Pic']."','".$val['PicUrl']."','".$val['PostTime']."','".$val['IP']."','".$val['Valid']."','".$val['ValidPeriod']."','".$val['Top']."','".$val['IfMember']."','".$val['UserName']."','".$val['Hit']."','".$val['Reply']."','".$val['Comment']."','".$val['UseEmail']."','".$val['OriginalUrl']."','".$val['DealType']."','".$val['Room']."','".$val['Hall']."','".$val['Loo']."','".$val['Direction']."','".$val['PriceType']."','".$val['Price']."','".$val['RentPrice']."','".$val['BuyPrice']."','".$val['Area']."','".$val['RentArea']."','".$val['BuyArea']."','".$val['Fitment']."','".$val['Facility']."','".$val['RealtyFee']."','".$val['BuyRealtyFee']."','".$val['RealtyType']."','".$val['BuildAge']."','".$val['FloorTotal']."','".$val['Floor']."','".$val['RentFloor']."','".$val['BuyFloor']."','".$val['IfPersonal']."','".$val['HeatingType']."','".$val['HasHouse']."','".$val['Longitude']."','".$val['Latitude']."') ";
	
	$res = $db->Query($sql);
}

$sql = "DELETE FROM `house` WHERE 1 ";
$sql .= "AND `DistID` = '0' ";	
$res = $db->Query($sql);

echo 'ok';
?>