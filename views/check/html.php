<?php
/*
# Use the Curl extension to query Google and get back a page of results
$url = "https://www.amazon.com/dp/B00ZV9RDKK";
$ch = curl_init($url);
curl_setopt_array($ch, array(
	CURLOPT_HTTPHEADER  => array('Authorization: ' . rand()),
	CURLOPT_RETURNTRANSFER  =>true,
	CURLOPT_VERBOSE     => 1,
	CURLOPT_SSL_VERIFYPEER => 0,
	CURLOPT_FAILONERROR => 1,
	CURLOPT_COOKIESESSION => 1,
	CURLOPT_FOLLOWLOCATION => 1,
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_USERAGENT =>  'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3',
	CURLOPT_CONNECTTIMEOUT => 120,
	CURLOPT_TIMEOUT => 120
));
$html = curl_exec($ch);
curl_close($ch);
*/
# Create a DOM parser object
$dom = new DOMDocument();

# Parse the HTML from Google.
# The @ before the method call suppresses any warnings that
# loadHTML might throw because of invalid HTML in the page.
libxml_use_internal_errors(true);
$dom->loadHTML($html);

/* Product Title */
$node = $dom->getElementById("productTitle");
$innerHTML= '';
$children = $node->childNodes;
foreach ($children as $child)
{
	$innerHTML .= $child->ownerDocument->saveXML( $child );
}
$title = $innerHTML;
/* Product Title */

/* Product Image */
$node = $dom->getElementById("imgTagWrapperId");
$innerHTML= '';
$children = $node->childNodes;
foreach ($children as $child)
{
	$innerHTML .= $child->ownerDocument->saveXML( $child );
}
$image = $innerHTML;
/* Product Image */

/* Customer Review */
$node = $dom->getElementById("acrCustomerReviewText");
$innerHTML= '';
$children = $node->childNodes;
foreach ($children as $child)
{
	$innerHTML .= $child->ownerDocument->saveXML( $child );
}
$reviews = str_replace(",","",str_replace("customer reviews","",$innerHTML));
/* Customer Review */

/* Bullet Point */
$node = $dom->getElementById("feature-bullets");
$innerHTML= '';
$children = $node->childNodes;
foreach ($children as $child)
{
	$innerHTML .= $child->ownerDocument->saveXML( $child );
}
$bulletpoint = str_replace(",","",str_replace("customer reviews","",$innerHTML));
/* Bullet Point */

/* Product description */
$description = "";
$node = $dom->getElementById("productDescription");
if(!is_null($node)){
	$innerHTML= '';
	$children = $node->childNodes;
	foreach ($children as $child)
	{
		$innerHTML .= $child->ownerDocument->saveXML( $child );
	}
	$description = $innerHTML;
}else{
	$description = "";
}
/* Product description */

/* Product description */
$bestseller = "";
$node = $dom->getElementById("zeitgeistBadge_feature_div");
if(!is_null($node)){
	$innerHTML= '';
	$children = $node->childNodes;
	foreach ($children as $child)
	{
		$innerHTML .= $child->ownerDocument->saveXML( $child );
	}
	$bestseller = $innerHTML;
}else{
	$bestseller = "";
}
/* Product description */


echo ">>" . $bestseller;
?>
