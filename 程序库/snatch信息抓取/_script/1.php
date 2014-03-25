<?

$contents2 = file_get_contents('http://travel.kooxoo.com/800820/guide');
		preg_match_all("/<strong>简介(.*?)kxalog=\"id=gi_jiucuo\/0/is", $contents2, $introduce);
		echo '<pre>';
		print_r ($introduce);
		echo '</pre>';

		$introduce = trim ($introduce[0][0]);
echo $introduce
?>