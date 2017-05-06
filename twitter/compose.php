<?php
require 'lib/site.inc.php';
$view = new Twitter\ComposeView($_SESSION);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tweet composer</title>
<link href="twitter.css" type="text/css" rel="stylesheet" />
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="font-awesome/css/social-buttons.css" type=text/css rel=stylesheet>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="jslib/twitter.js"></script>

    <style>
        .box button{
            margin: 0;
            border: 0;
            padding: 0;
        }
    </style>
</head>

<body>

<div class="column">

<!-- One big form for the whole page -->
<form class="compose" method="post" action="post/compose.php">

    <?php
        echo $view->viewTweet();
    ?>

<p class="post">
<button class="btn btn-twitter" id="twitter" name="post" value="twitter"><i class="fa fa-twitter"></i> | Post to Twitter</button>
<button class="btn btn-twitter" name="cancel"><i class="fa fa-ban"></i> | Cancel</button>
</p>

    <?php
        echo $view->viewSecondTweet();
    ?>

<fieldset class="box">
<p><label for="manual">Manual response: </label>
<input type="input" name="manual" id="manual">
</p>
<p class="addmanual"><input type="submit" name="addmanual" value="Add"></p>
<h2>Stock responses</h2>

    <?php
        echo $view->viewResp();
    ?>


</fieldset>
</form>
</div>



</body>
</html>