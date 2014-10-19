<?php
include 'hashtags.php';
foreach ($feedarray["data"] as $feed_data )
{
	if (!isset($feed_data["message"]) || $feed_data["from"]["id"] !== $infoarray["id"]) continue;
	$show_link = true;
	$category = false;
	foreach ($hashtags as $hashtag => $hashname) {
		if (strpos($feed_data["message"],$hashtag)) {
			$category = true;
			$hashtag = "/".$hashtag."/";
			$message = preg_replace($hashtag, '', $feed_data["message"]);
			$message = $parse->text($message);
			break;
		}
	}
	$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	preg_match('/(^\d{4})-(\d{2})-(\d{2})/',$feed_data["created_time"],$date);
	$monthName = $months[$date[2] - 1];
	echo '<div class="row"><div class="large-12 columns"><div class="callout panel"><h6 class="subheader"><small>Posted: '.$date[3].'. '.$monthName.' '.$date[1].'</small></h6>';
	if ($category) {
		echo '<p class="category"><small> in '.$hashname.'</small></p>';
	}
	else {
	$message = $parse->text($feed_data["message"]);
	}
	if (isset($feed_data["picture"]) && !strpos($feed_data["picture"],'external')) {
		$picture = preg_replace('/s\.(jpg|png)/', 'n.\1', $feed_data["picture"]);
		echo '<p><img src="'.$picture.'" /></p>';	
	}
	if (isset($feed_data["source"])) {
		if (strpos($feed_data["source"],'youtube')) {
			$show_link = false;
			$source = preg_replace('/\?.*$/', '', $feed_data["source"]);
			$source = preg_replace('/^http:\/\//', 'https://', $source);
			echo '<p><iframe width="595" height="335" src="'.$source.'" frameborder="0" allowfullscreen></iframe></p>';
		}
		else if (strpos($feed_data["source"],'bandcamp')) {
			preg_match('/album=(\d*)/', $feed_data["source"], $id);
			echo '<iframe style="border: 0; width: 595px; height: 42px;" src="https://bandcamp.com/EmbeddedPlayer/album='.$id[1].'/size=small/bgcol=ffffff/linkcol=333333transparent=true/" seamless><a href="'.$feed_data["link"].'">Listen to this album on Bandcamp</a></iframe>';
		}
		else if (strpos($feed_data["source"],'soundcloud')) {
			$show_link = false;
			preg_match('/tracks%2F(\d*)/', $feed_data["source"], $id);
			echo '<iframe width="595" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/'.$id[1].'&amp;auto_play=false&amp;hide_related=false&amp;visual=true"></iframe>';
		}
	}
	if (isset($feed_data["link"]) && (strpos($feed_data["link"], "photo.php") || preg_match('/facebook.com\/.*\/photos/',$feed_data["link"]))) {
			$link = $feed_data["link"];
			$show_link = false;
		}
	else{
			$post_id = preg_replace('/(\d*)_/','',$feed_data["id"]);
			$link = "https://www.facebook.com/".$profile_id."/posts/".$post_id;
	}
	if (isset($feed_data["link"])) {
		$message = str_replace($feed_data["link"],'',$message);
		if ($show_link === true) {
			echo '<p><a href="'.$feed_data["link"].'">'.$feed_data["link"].'</a></p>';
		}
	}
	echo '<p>',$message;
	
	echo '<h6><small>-- <a href="'.$link.'">Read this post and its comments on Facebook.</a></small></h6>';
	echo "</div></div></div>\n";
}
?>
