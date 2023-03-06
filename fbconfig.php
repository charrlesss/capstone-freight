<?php

$fb = new Facebook\Facebook([
    "app_id" => "3433213313622938",
    "app_secret" => "dec3c4fda186c8133c71ea7f21eab672",
    "default_graph_version" => "v2.10"
    ]);

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email']; // optional
    try {
    if (isset($_SESSION['facebook_access_token'])) {
    $accessToken = $_SESSION['facebook_access_token'];
    } else {
      $accessToken = $helper->getAccessToken();
    }
    } catch(Facebook\Exceptions\facebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    if (isset($accessToken)) {
    if (isset($_SESSION['facebook_access_token'])) {
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    } else {
    // getting short-lived access token
    $_SESSION['facebook_access_token'] = (string) $accessToken;
      // OAuth 2.0 client handler
    $oAuth2Client = $fb->getOAuth2Client();
    // Exchanges a short-lived access token for a long-lived one
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
    $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
    // setting default access token to be used in script
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    // redirect the user to the profile page if it has "code" GET variable
    if (isset($_GET['code'])) {

      try {
        $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
        $requestPicture = $fb->get('/me/picture?redirect=false&height=200'); //getting user picture
        $picture = $requestPicture->getGraphUser();
        $profile = $profile_request->getGraphUser();
        $fbid = $profile->getProperty('id');           // To Get Facebook ID
        $fbfullname = $profile->getProperty('name');   // To Get Facebook full name
        $fbemail = $profile->getProperty('email');    //  To Get Facebook email
        $fbpic = $picture['url'];
        # save the user nformation in session variable
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        // redirecting user back to app login page
        header("Location: visitor.php");
        exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
        }

        insertNewUser($db,$fbemail,$fbfullname,$fbpic);
      $_SESSION['user_account'] = array('name'=>$fbfullname,"email"=>$fbemail,"profile"=>$fbpic);
      $_SESSION['login_by'] ="facebook";
    header('Location: visitor.php');
    }
    // getting basic info about user
   
    } else {
    // replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used            
    $loginUrl = $helper->getLoginUrl('http://localhost/freight/visitor.php', $permissions);
    }
?> 