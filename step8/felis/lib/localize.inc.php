<?php
/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Felis\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');
    $site->setEmail('bhushanj@cse.msu.edu');
    $site->setRoot('/~bhushanj/step8');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=bhushanj',
        'bhushanj',       // Database user
        'helloworld',     // Database password
        's8_');            // Table prefix

};