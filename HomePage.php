<?php
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * USING "twitteroauth" LIBRARY BY ABRAHAM WILLIAMS: "https://github.com/abraham/twitteroauth"
 */ 

require 'res/conf.php';
require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

session_start();


if (!isset($_SESSION['access_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	
} else {
        //If the session exists
	$access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	//creating new connection
        //getting basic user info
	$user = $connection->get("account/verify_credentials");
	
	// getting recent tweeets by user 'Shahrukh Khan' on twitter
        $tweetsof = 'iamsrk';           
	$tweets = $connection->get('statuses/user_timeline', ['count' => 10, 'screen_name' => $tweetsof]);
	$totalTweets[] = $tweets;
	$page = 0;
        $count = 1;
               
       /* foreach ($totalTweets as $value) {
            echo $count . ':' . $value . '<br/>';
            $count++;
        }
           */ 
            
	// printing recent tweets on screen
	  
        /*
        echo "<pre>";
        print_r($user);
        echo "<pre>";
        */
}

?>

<!DOCTYPE html>
<!--
The Home Page
-->
<html>
    <head>
        <title>Get Latest Tweets!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="res/css/main.css">
        <script src="res/script/jquery-2.2.4.js"></script>
        <script type="text/javascript" src="res/script/main.js"></script>
    </head>
    <body>
        <div class="top_label"><br> Search Followers and Logout</div>
        <div id="main_wrapper">
            
            <div class="profile_box"><br> User Profile</div>
            <div class="followers"><br> Followers </div>
            
            

            <div class="container">
                <a id="arrow-up" onclick="prev()"></a>
                <a id="arrow-down"></a>

            <div class="header">
                <h1><?php echo $tweetsof ;?>'s Tweets:</h1>
            </div>

            <div id="slider">
                <ul class="slides">
                    <?php
                        //list 10 (max = 10) latest tweets 
                        $start = 1;
                        foreach ($totalTweets as $page) {
                            foreach ($page as $key) {
                                echo  '<li class="slide">' . '<br>' . $start . ':' . $key->text . '</li>' ;
                                    $start++;
                            }
                        }

                        //If total number of tweets > 3 
                        //Then list latest 3 tweets once again, as we are using the slider 
                        //with window of three tweets
                        if($start > 3){
                            $start = 1;
                            foreach ($totalTweets as $page) {
                                foreach ($page as $key) {
                                    echo '<li class="slide">' . '<br>' . $start . ':' . $key->text . '</li>';
                                    $start++;
                                    if($start == 4){
                                        break;
                                    }
                                }
                            }
                        }
                    ?>
                </ul>

            </div>
                
            </div>
            
        </div>
        <div class="bottom-box"> Footer </div>
               
    </body>
</html>
