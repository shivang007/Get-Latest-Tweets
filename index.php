<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
--> 

<?php
/*
 * TWITTER OAuth
 * USING "twitteroauth" LIBRARY BY ABRAHAM WILLIAMS: "https://github.com/abraham/twitteroauth"
 */
require_once '/twitteroauth/twitteroauth.php';
require_once 'conf.php';

if(!isset( $_SESSION['oauth_token'] )){
	$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
	$request_token = $connection->getRequestToken(TWITTER_OAUTH_CALLBACK);
	$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	switch ($connection->http_code) {
		case 200://IF U CANT CONNECT AFTER 200 BETTER RESET
			$url = $connection->getAuthorizeURL($token);
			break;
		default:
			$error = 'Err. Sorry could not connect to Twitter, please try again later!';
	}
}

?>

<!--
    ********GET-LATEST-TWEETS********
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Simple Login Page</title>
        
        <!--STYLESHEETS-->
        <link href="css/cstyle.css" rel="stylesheet" type="text/css" />
        <!--SCRIPTS-->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
    </head>
    <body>
        <!--MAIN WRAPPER-->
        <div id="wrapper">
            
        <!--REDIRECTION FORM-->
        <form name="main-form" class="main-form" action="" method="post">
            
            <!--HEADER-->
            <div class="header">
                <div class ="twitlogo">
                    
                </div>
             <!--TITLE--><h1>Get Latest Tweets</h1><!--END TITLE-->
             <!--DESCRIPTION--><span>Please press the "Sign-in through Twitter" icon to get started with the awesome Get Latest Tweets App!</span><!--END DESCRIPTION-->
             </div>
             <!--END HEADER-->
             
             <!--FOOTER-->
             <div class="footer">
             <!-- HYPERLINK THAT WILL BE USED TO REDIRECT USER TO TWITTER AUTHENTICATION PAGE -->
                 <a class="button" href="<?php echo $url;?>"> Sign-In using Twitter </a>
             
             </div>
             <!--END FOOTER-->
        
             </form>
             <!--END REDIRECTION FORM-->

        </div>
        <!--END MAIN WRAPPER-->
        
        <!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->
        
    </body>
</html>
