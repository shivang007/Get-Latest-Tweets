# Get-Latest-Tweets
######Fetches Latest Tweets of user and his friends!######



###Instructions:

1. Install Xampp

2. Locate installed **xampp** folder (normally inside C:\Program Files\  or just C:\)

3. Inside xampp folder, open **htdocs** folder

4. create a new folder named **temp** inside htdocs

5. Paste all files/folders of Get-Latest-Tweets repository inside **temp** 

6. Start **xampp control panel**

7. Start **Apache** module

8. Open Browser and enter address: **http://localhost/temp/index.php**  (refresh the page if it shows connection-error)

That's it, authenticate youself and you are good to go!




####index.php
Contains the Login Page, User is Authenticated
using Twitter OAuth  and is redirected to callback.php.

####callback.php 
If the $_REQUEST['oauth_token'] and $_SESSION['oauth_token'] matches, user is redirected to HomePage.php.

####HomePage.php 
Shows User's Twitter Profile, his followers, Followers' 10 latest Tweets using jQuery slider, Searchbox etc.


