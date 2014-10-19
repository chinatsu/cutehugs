<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
	<link rel="icon" type="image/png" href="favico.png">
<?php
include 'res/config.php';
include 'res/Parsedown.php';
$parse = new Parsedown();
include 'res/error.php';

?>
	<title><?=$infoarray["name"]?> - powered by cute hugs</title>
  </head>
  <body>
	<div class="row">
		<div class="large-12 columns">
			<div class="cover">
				<img src="<?=$infoarray["cover"]["source"]?>" />
			</div>
		</div>
	</div>

	<div class="row">
		<div class="large-12 columns">
			<div class="panel">
				<h3><a href="https://www.facebook.com/<?=$profile_id?>"><?=$infoarray["name"]?></a></h3>
				<h3><small><?=$parse->text($infoarray["about"])?></small></h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 medium-12 columns">
<?php include 'cute/feedmodule.php';?>
		</div>
	</div>
	<!-- <div class="row">
		<div class="large-12 medium 12 columns">
			 <?php 
				// $nextlink = preg_match('/(limit=25&until=\d*)$/',$feedarray->paging->next,$linkmatch);
				// if ($externalpage){
					// echo '<p class="text-right"><a href="'.$profile_id.'&'.$linkmatch[1].'">Older posts</a></p>';
				// }
				// else {
					// echo '<p class="text-right"><a href="?'.$linkmatch[1].'">Older posts</a></p>';
				// }
			?>
		</div>
	</div> -->
</body>
