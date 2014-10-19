<?php

# App Info, needed for Auth
$fbpage = "YOUR_FACEBOOK_PAGE";
$app_id = "YOUR_FACEBOOK_APP_ID"; # go to https://developers.facebook.com/quickstarts/?platform=web and make yourself an app, this is the app id
$app_secret = "YOUR_FACEBOOK_APP_SECRET"; # and this is the app secret

$reqUri = $_SERVER['REQUEST_URI'];

if ($test_mode){
	if (preg_match('/^.*\?([\d\w_-]*)/',$reqUri, $uriarg)){
	        $profile_id = $uriarg[1];
			$externalpage = true;
	}
	else {
		$profile_id = Â$fbpage;
		$externalpage = false;
	}
}
else {
	$profile_id = â$fbpage;
	$externalpage = false;
}
function fetchUrl($url) {
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_TIMEOUT, 20);
 $feedData = curl_exec($ch);
 curl_close($ch);
 return $feedData;
}

$authToken = fetchUrl("https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id={$app_id}&client_secret={$app_secret}");
$json_object = fetchUrl("https://graph.facebook.com/{$profile_id}/feed?{$authToken}");
$feedarray = json_decode($json_object,true);
$next_object = fetchUrl($feedarray["paging"]["next"]); # this doesn't rly work yet i don't think
$nextarray = json_decode($next_object);



$profileinfo = fetchUrl("https://graph.facebook.com/{$profile_id}?{$authToken}");
$infoarray = json_decode($profileinfo, true);
?>
