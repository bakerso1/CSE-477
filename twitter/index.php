<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tweet responder</title>
<link href="twitter.css" type="text/css" rel="stylesheet" />
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="font-awesome/css/social-buttons.css" type=text/css rel=stylesheet>
</head>
<body>

<!-- div around the entire column of content -->
<div class="column">

<!-- presentation of a tweet -->
<blockquote class="box twitter-tweet">
<figure><img src="stewart-48.png" width="48" height="48" alt="Picture of Stewart"/></figure>
<cite><a href="https://twitter.com/StewartCabbage">Stewart Cabbage LLC</a> <span class="id">@StewartCabbage</span></cite>
<p>We are your source for all things Cabbage! Give us a call today.</p></blockquote>

<!-- the form for the page -->
<form class="respond" method="post" action="./post/index.php">
<fieldset class="box">
<p><label for="tweeter">Respond to: </label>
<input type="text" id="tweeter" name="tweeter"></p>

<!-- Font Awesome button that looks cool -->
<p><button class="btn btn-twitter" id="twitter" name="respond" value="twitter"><i class="fa fa-twitter"></i> | Compose Response</button></p>
</fieldset>
</form>

</div>

</body>
</html>