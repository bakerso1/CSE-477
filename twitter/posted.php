<?php
require 'lib/site.inc.php';
$view = new Twitter\PostedView($_SESSION);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tweet posted</title>
<link href="twitter.css" type="text/css" rel="stylesheet" />
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="font-awesome/css/social-buttons.css" type=text/css rel=stylesheet>
</head>

<body>

<div class="column">

<h1>Response tweeted!</h1>
<blockquote class="box twitter-tweet">
<figure><img src="stewart-48.png" width="48" height="48" alt="Picture of Stewart"/></figure>
<cite><a href="https://twitter.com/StewartCabbage">Stewart Cabbage LLC</a> <span class="id">@StewartCabbage</span></cite>

    <?php
        echo $view->tweet();
    ?>

</blockquote>

<form class="posted" method="post" action="post/posted.php">
<p><button class="btn btn-twitter" id="twitter" name="respond" value="twitter"><i class="fa fa-check-square"></i> | Next Response</button></p>
</form>

</div>

</body>
</html>