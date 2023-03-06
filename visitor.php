<?php
 include('dotenv.php');
 include("$dir/admin/authenticated_user.php");

 use Ramsey\Uuid\Uuid;
    function insertNewUser($db,$email,$fullname,$profile){
      include('dotenv.php');
      $uuid = Uuid::uuid4();
      $profile_filename = "$uuid.jpg";
      $img = "$dir/assets/profile/$profile_filename";
      $content = file_get_contents($profile);
      file_put_contents($img, $content);   
      
      
      $_SESSION['user_account'] = array('name'=>$fullname,"email"=>$email,"profile"=>$profile_filename);
      $_SESSION['login_by'] ="google";

      $sql = "SELECT * FROM `visitor-account` WHERE `email` = '$email'";
      $isFind = $db->query($sql);
      $resultData = $isFind->fetch_assoc();
      if($resultData){
        print_r($resultData);
       $id = $resultData['visitor_account_id'];
       $_SESSION['visitor_acc_id'] =$id;
       $sql = "UPDATE `visitor-account` SET `profile_link` ='$profile_filename' WHERE `visitor_account_id` ='$id'";
       $db->query($sql);
        return;
      }
     
      $date =date("m/d/Y");
      $_SESSION['visitor_acc_id'] =$uuid;
        $sql = "INSERT INTO `visitor-account`(`visitor_account_id`, `email`, `fullname`,`profile_link` ,`visitor_account_createdAt`) 
        VALUES('$uuid','$email','$fullname','$profile_filename','$date')";
        $db->query($sql);
    }
   
    include("google-auth.conifg.php");
    include("$dir/model/connect.db.php");
    if(empty($_SESSION['user_account'])){
      if (isset($_GET['code'])) {
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);
        if(empty($_SESSION['access_token']) && !empty( $token['access_token'])){
          $_SESSION['access_token'] = $token['access_token'];
        }else{
          include("fbconfig.php");
        }
        $google_client->setAccessToken(!empty($token['access_token']) ? $token['access_token'] : $_SESSION['access_token']);
        $google_oauth = new Google_Service_Oauth2($google_client);
        $google_account_info = $google_oauth->userinfo->get();
        $email =  $google_account_info->email;
        $name =  $google_account_info->name;
        $profile = $google_account_info->picture;
        insertNewUser($db,$email,$name,$profile);
    
        header("Location: visitor.php");
      }else{
        include("fbconfig.php");
      }
  }
?>

<?php
  $visitor_profile = isset($_SESSION['user_account']) ? $_SESSION['user_account']['profile'] :"";
  $image_url =  "$url/assets/profile/". $visitor_profile;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frieght</title>
    <link rel="stylesheet" href="">
    <link rel="icon" href="<?php echo "$url/assets/img/logo.png" ?>" sizes="16x16">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap"
  rel="stylesheet" />
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
<script src="https://cdn.tailwindcss.com/3.2.4"></script>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script>
    tailwind.config = {
      darkMode: "class",
      theme: {
        fontFamily: {
          sans: ["Roboto", "sans-serif"],
          body: ["Roboto", "sans-serif"],
          mono: ["ui-monospace", "monospace"]
        },
        extend: {
          colors: {
            clifford: '#da373d'
          }
        }
      },
      corePlugins: {
        preflight: false
      }
    }
  </script>
    
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alata&family=Anek+Gurmukhi:wght@100;200;400&family=Bebas+Neue&family=Pathway+Gothic+One&family=Plus+Jakarta+Sans:wght@200&family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">

<style>
@import url('https://fonts.googleapis.com/css2?family=Alata&family=Anek+Gurmukhi:wght@100;200;400&family=Barlow:ital,wght@1,200&family=Bebas+Neue&family=Pathway+Gothic+One&family=Plus+Jakarta+Sans:wght@200&family=Roboto&display=swap');
    .google-login-font{
      font-family: 'Roboto', sans-serif;
    }

    .google-login-title{
      font-family: 'Roboto', sans-serif;
    }
    .ripple {
    background-position: center;
    transition: background 0.5s;
  }
  .ripple:hover {
    background: #47a7f5 radial-gradient(circle, transparent 1%, #f1f5f9 1%) center/15000%;
  }
  .ripple:active {
    background-color:#f1f5f9;
    background-size: 100%;
    transition: background 0s;
  }
  .modal{
    background: rgba(51, 170, 500, .1) 
  }

</style>
</head>
    <body class="m-0 min-w-screen min-h-screen max-h-auto relative">
    <?php
      if(empty($_SESSION['user_account'])){
      ?>
        <div class="modal absolute   inset-0  flex justify-center items-center px-4 "></div>
        <div class="z-[100] absolute   inset-0  flex justify-center items-center px-4  	">
              <div class="  bg-white shadow-xl w-auto border h-auto p-5 rounded-sm relative">
                <div class="w-full google-login-title">
                  <h1 class="sm:w-[400px] w-full mb-8 text-lg text-indigo-500">To create visiting request and messages your question you need to</h1>
                  <hr class="mb-10">
                    <div class="sm:w-[300px] w-auto  mx-auto">
                      <button
                      data-te-ripple-init data-te-ripple-color="secondary"
                       class="w-full mb-2">
                      <a href="<?php echo $google_client->createAuthUrl() ?>"  class=" w-[290px] mx-auto flex gap-x-3 p-4 border border-gray-300 rounded-sm hover:bg-gray-200">
                      <div class="relative w-9  flex justify-center">
                        <img src="<?php echo "$url/assets/img/google-icon.png" ?>" class="w-5 h-5" alt="google-icon">
                        </div>
                        <p class="google-login-font font-thin	">Continue with Google</p>
                      </a>
                    </button>
                      <button
                      data-te-ripple-init data-te-ripple-color="secondary"
                       class="w-full">
                        <a href="<?php echo $loginUrl?>" class=" w-[290px] mx-auto flex gap-x-3 p-4 border border-gray-300 rounded-sm hover:bg-gray-200">
                          <div class="relative w-9 ">
                          <img src="<?php echo "$url/assets/img/facebook-logo.png" ?>" class="w-9 h-7 absolute" alt="google-icon">
                          </div>
                          <p class="google-login-font font-thin	">Continue with Facebook</p>
                        </a>
                      </button>
                    </div>

                  
                </div>
              </div>
        </div>
    <?php 
          }
    ?>
      <?php
      if(empty($_SESSION['user_account'])){
      ?>
   <nav id="header" class="z-[100] bg-gradient-to-r from-[#8E629D] to-[#d489f0] fixed w-full z-30 top-0 text-white">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
        <div class="pl-4 flex items-center">
          <p class='text-white no-underline hover:no-underline font-bold text-xl lg:text-2xl'>Freight</p>
        </div>
        <div class="block lg:hidden pr-4">
          <button id="nav-toggle" class="flex items-center p-1 text-pink-800 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <title>Menu</title>
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
          </button>
        </div>
        
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
          <ul class="list-reset lg:flex justify-end flex-1 items-center">
            <li class="mr-3">
              <a class="inline-block py-2 px-4 lg:text-white font-bold no-underline md:hover:text-gray-100 hover:text-underline py-2 px-4" href="<?php echo $url?>">Home</a>
            </li>
            <li class="mr-3">
              <a class="inline-block lg:text-white no-underline md:hover:text-gray-100 hover:text-gray-400 hover:text-underline py-2 px-4" href="<?php echo $url."/visitor.php"?>">Visitor</a>
            </li>
            <li class="mr-3">
              <a class="inline-block lg:text-white no-underline md:hover:text-gray-100 hover:text-gray-400 hover:text-underline py-2 px-4" href="<?php echo $url."/admin"?>">Employeer</a>
            </li>
            <li class="mr-3">
              <a  class="inline-block lg:text-white no-underline md:hover:text-gray-100 hover:text-gray-400 hover:text-underline py-2 px-4"  href="<?php echo $url."/contact-us.php"?>">Contact us</a>
            </li>
          </ul>
        </div>
      </div>
      <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
    </nav>
    <?php 
          }else{

    ?>
    <nav id="header" class="z-[100] bg-gradient-to-r from-[#8E629D] to-[#d489f0] fixed w-full z-30 top-0 text-white">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
        <div class="pl-4 flex items-center">
          <p class='text-white no-underline hover:no-underline font-bold text-xl lg:text-2xl'>Freight</p>
        </div>
        <div class="flex items-center w-auto   mt-0   text-black  p-0 z-20" id="nav-content">
          <ul class="list-reset flex justify-end flex-1 items-center">
            <div id="personal-btn" class="relative cursor-pointer" >
              <img src="<?php  echo $image_url ?>" alt="logo" class="cursor-pointer w-10 h-10 rounded-full">
                  <div id="profile-dropdown" class=" hidden absolute -left-[125px]  bg-white shadow-lg  rounded-md ">
                      <ul class="w-[150px] h-auto  ">
                          <li>
                              <button 
                              type="button"
                              data-te-toggle="modal"
                              data-te-target="#profileModal"
                              data-te-ripple-init
                              data-te-ripple-color="light"
                               class="py-2 hover:bg-gray-100 w-full pl-5  rounded-md  flex gap-x-2 text-sm font-semibold">
                                  <svg class="h-5 w-5 text-indigo-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                  </svg>
                                  Profile  
                              </button>   
                          </li>
                          <li>
                              <button 
                              type="button"
                              data-te-toggle="modal"
                              data-te-target="#tableRequest"
                              data-te-ripple-init
                              data-te-ripple-color="light"
                              class="py-2 hover:bg-gray-100 w-full pl-5  rounded-md  flex gap-x-2 text-sm font-semibold">
                              <svg class="h-5 w-5 text-indigo-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <polyline points="12 4 4 8 12 12 20 8 12 4" />  <polyline points="4 12 12 16 20 12" />  <polyline points="4 16 12 20 20 16" /></svg>
                                     Appointments
                              </button>   
                          </li>
                          <li >
                              <button id='logout-btn' class="py-2 hover:bg-gray-100 w-full pl-5 flex gap-x-2 text-sm font-semibold  rounded-md">
                                      <svg class="h-5 w-5 text-indigo-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M7 6a7.75 7.75 0 1 0 10 0" />  <line x1="12" y1="4" x2="12" y2="12" /></svg>
                                      Logout
                              </button>   
                          </li>
                      </ul>
                  </div>
          </div>
          </ul>
        </div>
      </div>
      <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
    </nav>

  <?php 
          }
    ?>
        <div class="lg:flex  ">
            <div class="lg:w-1/2 xl:max-w-screen-sm">
                <div class="py-12 bg-indigo-100 lg:bg-white flex justify-center lg:justify-start lg:px-12">
                    <div class="cursor-pointer flex items-center mt-10">
                        <div>
                            <img src="<?php  echo "$url/assets/img/logo.png" ?>" alt="logo" class="cursor-pointer w-14 h-14 rounded-full">
                        </div>
                        <div class="text-2xl text-indigo-800 tracking-wide ml-2 font-semibold">FREIGHT</div>
                    </div>
                </div>
                <div class="md:mt-10 mt-5 px-12 sm:px-24 md:px-48 lg:px-12 lg:mt-16 xl:px-24 xl:max-w-2xl">
                    <div>
                        <p class="text-xl mb-3 text-indigo-500 uppercase font-semibold">It's nice to meet you</p>
                    </div>
                    <div class="md:mt-10 mt-5">
                        <h1 class="text-sm mb-5">
                            Freight administrative is willing to help you for questions or those who want to visit the company!
                          </h1>
                        <div class="md:mt-10 mt-5">
                              <button
                              type="button"
                              data-te-toggle="modal"
                              data-te-target="#createRequestModal"
                              data-te-ripple-init
                              data-te-ripple-color="light"
                                  class="bg-indigo-500 text-gray-100 p-4 md:w-auto w-full rounded-full md:tracking-wide
                                font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-indigo-600
                                shadow-lg">
                                Click To Create Request Appointment For Visiting!
                              </button>
                        </div>
                        <hr class="md:mt-10 mt-5 font-bold">
                        <div class="md:mt-10 mt-5 flex gap-x-4">
                                <div >
                                    <p class="text-xl mb-3 text-indigo-500 uppercase font-semibold">Do you have any questions?</p>
                                   <!-- Button trigger modal -->
                                  
                                    <p class="text-sm mb-5">
                                        If there is, you can ask now  through chat and it's free, you can ask freely
                                    </p>
                                </div>
                                <svg class="h-12 w-12 text-indigo-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="5" y1="12" x2="19" y2="12" />  <polyline points="12 5 19 12 12 19" /></svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat lg:flex items-center justify-center bg-indigo-100 flex-1  md:h-screen h-auto ">
                    <div class="md:h-full h-[500px] w-full flex flex-col">
                            <div id="scrollable-element"  class="  flex-1 overflow-y-auto p-2 md:pt-16">
                              <div id="messages-container" class="border w-full min-h-auto max-h-[600px] ">


                              </div>
                          </div>
                        <form id="message-form" class=" flex gap-x-1 p-5 bg-white">
                            <input type="text" name="visitor-message" id="visitor-message" class='w-full rounded-lg'  placeholder="Type your message" required>
                             <button type="submit" ><svg class="md:h-12 md:w-12 w-8 h-8 text-indigo-500 hover:text-indigo-300"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="22" y1="2" x2="11" y2="13" />  <polygon points="22 2 15 22 11 13 2 9 22 2" /></svg></button>
                        </form>
                   </div> 
            </div>

            <!-- Modals -->
    <!-- Profile Modal -->
    <div
      data-te-modal-init
      class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
      id="profileModal"
      tabindex="-1"
      aria-labelledby="profileModalTitle"
      aria-modal="true"
      role="dialog">
      <div
        data-te-modal-dialog-ref
        class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
        <div
          class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
          <div
            class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
            <h5
              class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
              id="exampleModalScrollableLabel">
              User Information
            </h5>
            <button
              type="button"
              class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
              data-te-modal-dismiss
              aria-label="Close">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="relative p-4">
            <div class="px-6 py-6 lg:px-8">
                      <div class="w-full flex justify-center mt-10 ">
                          <img src="<?php echo !empty($_SESSION['user_account']) ? $image_url :""?>" class="rounded-full w-[150px] h-[150px]" alt="profile">
                      </div>
                      <div class="mt-5">
                        <div class="flex">
                          <p class="w-[68px] font-semibold">Fullname</p>
                          <p class="text-sm">: <?php echo !empty($_SESSION['user_account']) ? $_SESSION['user_account']['name'] :""?></p>
                        </div>
                        <div  class="flex">
                          <p class="w-[68px] font-semibold">Email</p>
                          <p class="text-sm">: <?php echo !empty($_SESSION['user_account']) ? $_SESSION['user_account']['email'] :""?></p>
                        </div>
                        <div  class="flex gap-x-1 items-center mt-5">
                          <svg class="h-5 w-5 text-green-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="9" cy="7" r="4" />  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />  <path d="M16 11l2 2l4 -4" /></svg>
                          <p class="text-sm uppercase  text-green-700 ">LOGIN BY 
                            <?php echo !empty($_SESSION['login_by']) ? $_SESSION['login_by'] :""?>
                          </p>
                        </div>
                      </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Create Req Modal -->
    <div
      data-te-modal-init
      class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
      id="createRequestModal"
      tabindex="-1"
      aria-labelledby="createRequestModal"
      aria-modal="true"
      role="dialog">
      <div
        data-te-modal-dialog-ref
        class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
        <div
          class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
          <div
            class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
            <h5
              class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
              id="createRequestModalLabel">
              Create Appointment Request
            </h5>
            <button
              type="button"
              class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
              data-te-modal-dismiss
              aria-label="Close">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="relative p-4">
          <div class="px-6 py-6 lg:px-8">
                  <form class="space-y-2 mb-10" id="request-form">
                    <?php if(!empty($_SESSION['user_account'])){ ?>
                      <div>
                          <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your fullname</label>
                          <input type="text" name="fullname" id="fullname" value="<?php echo $_SESSION['user_account']['name'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                      </div>
                      <div>
                          <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your date visit</label>
                          <input type="text" id="datepicker" name="date"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <small class="text-[11px]">The disabled date is already occupied so pick the best date for you to visit</small>
                        </div>
                      <div>
                          <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your time visit</label>
                          <input type="time" name="time" id="time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                      </div>
                      <div>
                          <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your id picture</label>
                          <div id="img-con"  class="w-auto h-auto relative"></div>
                          <input type="file" id="imgInp" name="file" id="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                      </div>
                      <div>
                        <label for="purpose" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your purpose</label>
                        <textarea id="purpose" name="purpose" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your purpose here..."></textarea>
                      </div>
                      <div class="flex justify-between">
                          <div class="flex items-start">
                              <div class="flex items-center h-5">
                                  <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                              </div>
                              <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Agree to the terms and conditions policy?</label>
                          </div>
                      </div>
                      <button type="submit" class=" w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Request Appointment</button>
                      <?php } ?>
                    </form>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- table Req Modal -->
    <div
      class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
      data-te-modal-init
      id="tableRequest"
      tabindex="-1"
      aria-labelledby="tableRequestLabel"
      aria-modal="true"
      role="dialog">
        <div
        data-te-modal-dialog-ref
        class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out  w-auto  min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px] min-[1200px]:max-w-[1140px]">
        <div
          class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
          <div
            class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
            <h5
              class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
              id="tableRequestLabel">
              Create Appointment Request
            </h5>
            <button
              type="button"
              class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
              data-te-modal-dismiss
              aria-label="Close">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="relative p-4">
              <div class="relative w-full">
                  <div class="relative overflow-x-scroll">
                      <table id="created-req-table" class=" text-sm text-left text-gray-500 dark:text-gray-400 " >
                                <thead>
                                    <tr>
                                        <th>Visitor</th>
                                        <th>Date Visit</th>
                                        <th>Time Visit</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body" class="overflow-x-scroll ">
                                </tbody>
                              <tfoot>
                                  <tr>
                                      <th>Visitor</th>
                                      <th>Date Visit</th>
                                      <th>Time Visit</th>
                                      <th>Purpose</th>
                                      <th>Status</th>
                                      <th>Created At</th>
                                      <th>Action</th>
                                  </tr>
                              </tfoot>
                        </table>
                    </div>
                  </div>
          </div>
        </div>
      </div>
    </div>
    <!--  Req View Modal -->
    <div
      class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
      data-te-modal-init
      id="viewRequest"
      tabindex="-1"
      aria-labelledby="viewRequestLabel"
      aria-modal="true"
      role="dialog"
      >
        <div
        data-te-modal-dialog-ref
        class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out  w-auto  min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px] min-[1200px]:max-w-[1140px]">
        <div
          class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
          <div
            class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
            <h5
              class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
              id="viewRequestLabel">
              Visitor Request Form
            </h5>
            <button
              type="button"
              class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
              data-te-modal-dismiss
              aria-label="Close"
              id="close-view-modal"
              >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="relative p-4">
            <div class=" relative  w-full  p-3 ">
                <p id="status" class='absolute border top-2 right-2 p-1 rounded-lg'></p>
                <div id="view-option" class="z-[100] absolute top-11 flex flex-col gap-y-2 right-0 bg-white p-2">
                  
                </div>
                <p class="font-bold">
                    Visitors to freight management must be pre-approved.
                </p>
                <small>
                    Please wait to approved your visit.
                </small>
                <div class="w-full relative h-auto  pt-16 ">

                <div class="flex  w-auto items-center gap-x-1 mb-14">
                    <p class="text-xs font-bold">Date: </p>
                    <div class="w-auto border-b-2 border-black">
                    <p id="ceatedAt" class="text-xs  w-auto font-semibold  text-left "> </p>
                    </div>
                </div>

                <div class=" relative flex justify-start flex-col  w-full mb-3">
                    <div class="flex  w-auto items-center gap-x-1 pb-2  mb-3">
                        <p class="text-xs font-bold ">Name : </p>
                        <div class="flex-1 border-b-2 border-black">
                        <p id="rep-name" class="text-xs  w-auto font-semibold  text-left ">
                        </p>
                        </div>
                    </div>
                    <div class="flex gap-x-4 w-full ">
                        <div class="flex  w-full items-center gap-x-1 pb-2">
                        <p class="text-xs font-bold ">Email : </p>
                        <div class="flex-1 border-b-2 border-black">
                            <p  id="email-view" class="text-xs  w-auto font-semibold  text-left ">
                            </p>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="relative flex justify-start flex-col  w-full">
                    <div class="flex gap-x-4 w-full ">
                        <div class="flex  w-full items-center gap-x-1 pb-2">
                        <p class="text-xs font-bold ">Date of Visit & Time: </p>
                        <div class="w-auto border-b-2 border-black">
                            <p  id="date-visit"  class="text-xs  w-auto font-semibold  text-left ">
                            </p>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="relative w-full h-auto mb-14">
                <div class="block gap-x-4 w-full   mt-14">
                    <div class="flex flex-col flex-wrap w-full  gap-x-1 pb-2">
                    <p class="text-xs font-bold pb-2">Purpose of Visit: </p>
                    <div class="ml-14 flex-1 border-b-2 border-black">
                        <p id="purpose-view" class="text-xs   w-auto font-semibold  text-left ">
                        </p>
                    </div>
                    </div>
                    <div class="block  w-full items-center gap-x-1 ">
                    <div class="flex-1 border-b-2 border-black pb-2">
                        <p class="text-xs h-[1px]  w-auto font-semibold  text-left "></p>
                    </div>
                    <div class="flex-1 border-b-2 border-black pb-2">
                        <p class="text-xs h-[7px]  w-auto font-semibold  text-left "></p>
                    </div>
                    </div>
                </div>
                </div>


                </div>


                </div>        
          </div>
        </div>
      </div>
    </div>
    <!-- Edit Req Modal -->
    <div
      data-te-modal-init
      class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
      id="editRequestModal"
      tabindex="-1"
      aria-labelledby="editRequestModal"
      aria-modal="true"
      role="dialog">
      <div
        data-te-modal-dialog-ref
        class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
        <div
          class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
          <div
            class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
            <h5
              class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
              id="editRequestModalLabel">
              Create Appointment Request
            </h5>
            <button
              type="button"
              class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
              data-te-modal-dismiss
              aria-label="Close">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="relative p-4">
              <div class="px-6 py-6 lg:px-8">
              <form class="space-y-2 mb-10" id="edit-request-form">
                    <?php if(!empty($_SESSION['user_account'])){ ?>
                      <div>
                          <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your fullname</label>
                          <input type="text" name="fullname" id="fullname-edit" value="<?php echo $_SESSION['user_account']['name'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                      </div>
                      <div>
                          <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your date visit</label>
                          <input type="text" name="date" id="date-edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <small class="text-[11px]">The disabled date is already occupied so pick the best date for you to visit</small>
                        </div>
                      <div>
                          <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your time visit</label>
                          <input type="time" name="time" id="time-edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                      </div>
                      <div>
                          <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your id picture</label>
                          <div id="img-con-2"  class="w-auto h-auto relative"></div>
                          <input type="file" id="imgInp-2" name="file"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                      </div>
                      <div>
                        <label for="purpose" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your purpose</label>
                        <textarea id="purpose-edit" name="purpose" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your purpose here..."></textarea>
                      </div>
                      <div class="flex justify-between">
                          <div class="flex items-start">
                              <div class="flex items-center h-5">
                                  <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                              </div>
                              <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Agree to the terms and conditions policy?</label>
                          </div>
                      </div>
                      <button type="submit" class=" w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Request Appointment</button>
                      <?php } ?>
                    </form>
                </div>
          </div>
        </div>
      </div>
    </div>


  </div>

</body>


<script>

      function defaultValue (input,profile){
          const myFile = new File(['Hello World!'],`${profile}`, {
                  type: 'text/plain',
                  lastModified: new Date(),
              });
              const dataTransfer = new DataTransfer();
              dataTransfer.items.add(myFile);
              input.files = dataTransfer.files
        }
     
      function viewRequest(id , data,res){
        display(data,res)
      }
      function editRequest(id,data){
        
        const current_req = data.filter((d)=>d.visitor_req_id === id)
        $('#fullname-edit').val(`${current_req[0].fullname}`)
        $('#date-edit').val(`${current_req[0].date}`)
        $('#time-edit').val(`${current_req[0].time}`)
        $('#purpose-edit').val(`${current_req[0].purpose}`)
        defaultValue($("#imgInp-2")[0],current_req[0].id_picture)
        const url_prof = "<?php echo $url."/assets/request-appointment-id-picture/" ?>" +current_req[0].id_picture
        $("#img-con-2")[0].innerHTML =  `<img id="blah" src='${url_prof}' alt="your image"  class="w-full h-[150px] mb-2"/>`
      

        $("#edit-request-form").submit(function(e){
        e.preventDefault()
        const formData = new FormData(e.currentTarget)
        formData.append("visitor_id","<?php echo $_SESSION['visitor_acc_id'] ?>")
        formData.append('email',"<?php echo $_SESSION['user_account']['email'] ?>")
        formData.append('req_id',id)


        
          $.ajax({
            type:"POST",
            processData: false,
            contentType: false,
            url:"<?php  echo $url."/controller/administrative/visitor-management.php/visitor_edit_appointment_request"?>",
            data:formData,
            success:function(res){
              const data = JSON.parse(res)
                   if(data.success){
                

                     return   Swal.fire(
                          'Updated!',
                            data.message,
                          'success'
                        ).then(()=>{
                          window.location.reload()
                        })
                   }
                Swal.fire({
                  icon: 'error',
                  title: data.message,
                  showConfirmButton: false,
                  timer: 1500
                })
            }
          })
        })
      }

      function deleteRequest(id,datas){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {

          $.ajax({
            type:"GET",
            processData: false,
            contentType: false,
            url:"<?php  echo $url."/controller/administrative/visitor-management.php/visitor_remove_appointment_request/"?>" + id,
            success:function(res){
              const data = JSON.parse(res)
                   if(data.success){
                  
                     return   Swal.fire(
                          'Updated!',
                            data.message,
                          'success'
                        ).then(()=>{
                            window.location.reload()
                        })
                   }
                Swal.fire({
                  icon: 'error',
                  title: data.message,
                  showConfirmButton: false,
                  timer: 1500
                })
            }
          })


          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })

      } 
    </script>

    <script>
      $("#request-form").submit(function(e){
        e.preventDefault()
        const formData = new FormData(e.currentTarget)
        formData.append("visitor_id","<?php echo $_SESSION['visitor_acc_id'] ?>")
        formData.append('email',"<?php echo $_SESSION['user_account']['email'] ?>")
        $.ajax({
          type:"POST",
          processData: false,
          contentType: false,
          url:"<?php  echo $url."/controller/administrative/visitor-management.php/visitor_create_appointment_request"?>",
          data:formData,
          success:function(res){
            const data = JSON.parse(res)
                 if(data.success){
                   return Swal.fire({
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                  }).then(()=>{
                    window.location.href = "<?php echo $url."/visitor.php" ?>"
                  })
                 }
              Swal.fire({
                icon: 'error',
                title: data.message,
                showConfirmButton: false,
                timer: 1500
              })
          }
        })
      })

    </script>


<script>
    function getElementById(id){
        return document.querySelector(`#${id}`)
    }
    function variables(){
        return {
            createdAt:getElementById('ceatedAt'),
            repName:getElementById('rep-name'),
            email:getElementById('email-view'),
            dateVisit:getElementById('date-visit'),
            purpose:getElementById('purpose-view'),
            status:getElementById('status'),
            viewOption:getElementById('view-option'),
        }
    }

</script>

<script>
  
    function display(data,res){
        const {
            purpose,
            createdAt,
            repName,
            email,
            dateVisit,
            editTag,
            deleteTag,
            status,
            viewOption
         } =  variables()

         const createdAtText = data.req_createdAt
         const dateVisitText = data.date
         createdAt.textContent = createdAtText
         repName.textContent = data.fullname
         email.textContent = data.email
         dateVisit.textContent = `${data['date']}, ${data['time']}`
         purpose.textContent = data.purpose
         status.textContent = data.pending === "1" ? "Pending" : data.declined ? "Declined" :"Approved";
         status.className=`absolute border top-2 right-2 p-1 rounded-sm uppercase text-xs ${data.pending === "1" ? "border-amber-500 text-amber-700" : data.declined === "1" ? "border-red-500 text-red-700" : "border-green-500 text-green-700"}`
      

         viewOption.innerHTML = `
           ${
            data.approved === '1' ?
            `
            <button
            type="button"
            data-te-toggle="modal"
            data-te-target="#createRequestModal"
            data-te-ripple-init
            data-te-ripple-color="light"
            id="add-new-req" 
            class='border cursor-pointer'>
                <svg class="h-6 w-6 hover:text-green-500  text-indigo-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="12" y1="5" x2="12" y2="19" />  <line x1="5" y1="12" x2="19" y2="12" /></svg>
            </button>
            <button id='get-qrcode' class='border'>
                <svg class="h-6 w-6 text-indigo-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                </svg>
            </button>
            `:
            `
            <button
            type="button"
            data-te-toggle="modal"
            data-te-target="#createRequestModal"
            data-te-ripple-init
            data-te-ripple-color="light"
            id="add-new-req" 
            class='border cursor-pointer'>
                <svg class="h-6 w-6 hover:text-green-500  text-indigo-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="12" y1="5" x2="12" y2="19" />  <line x1="5" y1="12" x2="19" y2="12" /></svg>
            </button>
            <button
            type="button"
            data-te-toggle="modal"
            data-te-target="#editRequestModal"
            data-te-ripple-init
            data-te-ripple-color="light"
            onclick='editRequest("${data.visitor_req_id}",${JSON.stringify(res)})'
            id="edit-new-req" 
            class='border'>
                <svg class="h-6 w-6 hover:text-green-500 text-indigo-500"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />  <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />  <line x1="16" y1="5" x2="19" y2="8" /></svg>
            </button>
            <button
            onclick='deleteRequest("${data.visitor_req_id}",${JSON.stringify(res)})' 
            id="delete" 
            class='border'>
                <svg class="h-5 w-5 hover:text-green-500 text-indigo-500 cursor-pointer"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z" />  <line x1="18" y1="9" x2="12" y2="15" />  <line x1="12" y1="9" x2="18" y2="15" /></svg>         
            </button>
            `

           }
         `
    }
    </script>


    <script>
  

      function readURL(input,id) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                $(id)[0].innerHTML =  `<img id="blah" src='${e.target.result}' alt="your image"  class="w-full h-[150px] mb-2"/>`
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#imgInp").change(function(){
          readURL(this,"#img-con");
      });

      $("#imgInp-2").change(function(){
          readURL(this ,"#img-con-2");
      });

      var dateToday = new Date(); 
      $(function() {
        $.ajax({
            type:"GET",
            url:"<?php  echo $url."/controller/administrative/visitor-management.php/get_all_appointment_request/".$_SESSION['visitor_acc_id']?>",
            success:function(res){
              const data = JSON.parse(res)
              displayTableDataRequest(data.appoint_req)
            }
          })
    
      } );
    </script>

    <script>
      function displayTableDataRequest(res){
        if(res == null) return;
        const array = []
        const tableBody = document.getElementById("table-body")
        tableBody.innerHTML = "";
          res.forEach((data)=>{
                tableBody.innerHTML +=  `
                <tr>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                          <div class='flex gap-x-2'>
                              <img
                                  class="p-1 md:w-8 md:h-8 w-6 h-6 rounded-full ring-2  ring-indigo-300 dark:ring-indigo-500"
                                  src="${"<?php echo !empty($image_url) ? $image_url : "" ?>"}"
                                  alt="logo"
                              />
                              <div>
                                  <p>${data.fullname}</p>
                                  <p class='text-gray-400'>${data.email}</p>
                              </div>
                          </div>
                      </td>
                      <td>${data.date}</td>
                      <td>${data.time}</td>
                      <td>${data.purpose}</td>
                      <td>${data.pending ? "Pending" : data.declined ? "Declined" : "Approved"}</td>
                      <td>${data.req_createdAt}</td>
                      <td class=" flex gap-x-1 items-center justify-center  h-full  mt-3">
                      ${
                        data.pending === '1' ?
                        `
                        
                        <button 
                            type="button"
                            data-te-toggle="modal"
                            data-te-target="#viewRequest"
                            data-te-ripple-init
                            data-te-ripple-color="light"
                            onclick='viewRequest("${data.visitor_req_id}",${JSON.stringify(data)},${JSON.stringify(res)})' class='text-blue-500'>
                                <svg class="h-4 w-4 text-indigo-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>                         
                        </button>


                          <button 
                            type="button"
                            data-te-toggle="modal"
                            data-te-target="#editRequestModal"
                            data-te-ripple-init
                            data-te-ripple-color="light"
                            onclick='editRequest("${data.visitor_req_id}",${JSON.stringify(res)})'>
                            <svg class="h-4 w-4 text-purple-500"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />  <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />  <line x1="16" y1="5" x2="19" y2="8" /></svg>
                          </button>

                        <button onclick='deleteRequest("${data.visitor_req_id}",${JSON.stringify(res)})'>
                            <svg class="h-4 w-4 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z" />  <line x1="18" y1="9" x2="12" y2="15" />  <line x1="12" y1="9" x2="18" y2="15" /></svg>
                          </button>
                          ` :
                          `
                          <button  class='text-blue-500'>
                            <svg class="h-4 w-4 text-blue-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M10 12h-7l3 -3m0 6l-3 -3" />  <path d="M14 12h7l-3 -3m0 6l3 -3" />  <path d="M3 6v-3h18v3" />  <path d="M3 18v3h18v-3" /></svg>
                          </button>
                          <button>
                          <svg class="h-4 w-4 text-indigo-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                            </svg>
                          </button>
                        `
                      }
                    </td>
                  </tr>`
                array.push(data.date)
              })

              $('#created-req-table').DataTable();


              $("#datepicker").datepicker({
              changeDate: true,
              changeMonth: true,
              changeYear: true,
              minDate:dateToday,
              beforeShowDay: function(date){
                  var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
                  return [ array.indexOf(string) == -1 ]
              }
          });
          $("#date-edit").datepicker({
              changeDate: true,
              changeMonth: true,
              changeYear: true,
              minDate:dateToday,
              beforeShowDay: function(date){
                  var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
                  return [ array.indexOf(string) == -1 ]
              }
          });
      }
    </script>



    <script>
        $("#personal-btn").click(function(){
          $("#profile-dropdown").toggle()
        })
      </script>

      <script>
        $("#logout-btn").click(function(){
          $("#profile-modal").hide()
          $("#request-modal").hide()
          $.ajax({
            type:"GET",
            url:"<?php  echo $url."/controller/administrative/visitor-management.php/logout_visitor_account"?>",
            success:function(res){
              window.location.href = "<?php echo $url."/visitor.php" ?>"
            }
          })
        })
    </script>
    
    <script>
      /*Toggle dropdown list*/
      /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/
      const data = "<?php  echo $image_url  ?>";
      var navMenuDiv = document.getElementById("nav-content");
      var navMenu = document.getElementById("nav-toggle");
      document.onclick = check;
      
      function check(e) {
        if(data) return;

        var target = (e && e.target) || (event && event.srcElement);

        //Nav Menu
        if (!checkParent(target, navMenuDiv)) {
          // click NOT on the menu
          if (checkParent(target, navMenu)) {
            // click on the link
            if (navMenuDiv.classList.contains("hidden")) {
              navMenuDiv.classList.remove("hidden");
            } else {
              navMenuDiv.classList.add("hidden");
            }
          } else {
            // click both outside link and outside menu, hide menu
            navMenuDiv.classList.add("hidden");
          }
        }
      }
      
      function checkParent(t, elm) {
        while (t.parentNode) {
          if (t == elm) {
            return true;
          }
          t = t.parentNode;
        }
        return false;
      }
    </script> 

<script>
    function scrollToBottom(id){
        $(`#${id}`).animate({
          scrollTop:1000050
      });
    }
</script>

<script>
    function displayMyMessages(input){
        const messagesContainer = document.getElementById('messages-container')
        const div = document.createElement("div");
        const img = document.createElement("img");
        const message = document.createElement("p");
        img.src = "<?php  echo $image_url ?>"
        img.alt ="my profile"
        img.className = "cursor-pointer w-10 h-10 rounded-full"
        div.className ="flex  w-full flex-row-reverse items-end gap-x-2 mb-2"
        message.className ="bg-indigo-400  text-white max-w-[250px] min-w-auto sm:text-md text-[13px] break-all flex items-end rounded-bl-md  rounded-tl-md rounded-tr-md py-1 px-3"
        message.textContent = input;
        div.append(img);
        div.append(message);
        messagesContainer.append(div)
    }
</script>

<script>

  $("#message-form").submit(function(e){
        e.preventDefault()
        const formData = new FormData(e.currentTarget)
        if(formData.get("visitor-message").trim() === ''){
            return
        }
        displayMyMessages(formData.get("visitor-message").trim())
        scrollToBottom('scrollable-element')
        $.ajax({
            type:"POST",
            processData: false,
            contentType: false,
            url:"<?php  echo $url."/controller/administrative/visitor-management.php/visitor_send_message/".$_SESSION['visitor_acc_id']."/"?>",
            data:formData,
            success:function(res){
              const data = JSON.parse(res)
            }
          })
          document.getElementById('visitor-message').value = ""
          
    })

</script>

<script>
  function createElementMessage(con_classname,img_classname,message_classname ,img_url ,message){
      const createDiv = document.createElement('div')
      const createImg = document.createElement('img')
      const createMessage = document.createElement('p')
      createDiv.className = con_classname
      createImg.alt = "profile"
      createImg.src =img_url
      createImg.className = img_classname
      createMessage.className =message_classname
      createMessage.textContent = message
      createDiv.append(createImg)
      createDiv.append(createMessage)
      return createDiv
  }
  function displayConvo(res){

    const conM = document.getElementById("messages-container");
   
    const allmessage = res.my_message.concat( res.staff_message);

    function sort(data){
      return data?.sort((a,b)=>{

          return new Date(a.createdAt * 1000) - new Date(b.createdAt * 1000)
      })
    }



    sort(allmessage)?.forEach((data)=>{
      const url = "<?php  echo $url?>";
        if(data.hasOwnProperty("profile")){
            conM.append(createElementMessage(
            "flex gap-x-2 mb-1 items-end p-2",
            "cursor-pointer w-10 h-10 rounded-full",
            "bg-indigo-400  text-white  max-w-[250px] min-w-auto sm:text-md text-[13px] break-all flex items-end rounded-bl-md  rounded-br-md rounded-tr-md py-1 px-3",
            `${url}/assets/profile/${data.profile}`,
            data.message
          ))
          return
        }
           conM.append(createElementMessage(
            " flex  w-full flex-row-reverse items-end gap-x-2 mb-2 p-2",
            "cursor-pointer w-10 h-10 rounded-full",
            "bg-indigo-400  text-white max-w-[250px] min-w-auto sm:text-md text-[13px] break-all flex items-end rounded-bl-md  rounded-tl-md rounded-tr-md py-1 px-3",
            "<?php  echo $image_url ?>",
            data.message
          ))
       
    })

  }

  function getMessage(cb){
    
    $.ajax({
      type:"GET",
      url:"<?php  echo $url."/controller/administrative/visitor-management.php/fetchVisitorConvo/".$_SESSION['visitor_acc_id']?>",
      success:function(res){
        const data = JSON.parse(res)
        cb(data)
      }
    })

   
  }
  setInterval(() => {
    getMessage(function(res){
      if(res.affect > 0){
        scrollToBottom('scrollable-element')
        const conM = document.getElementById("messages-container");
        conM.innerHTML = ''
        displayConvo(res)
      }

    })
  }, 100);

  scrollToBottom('scrollable-element')
    getMessage(function(res){
        displayConvo(res)
    })


 
</script>







<?php
    include('./layout/footer.php');
?>


