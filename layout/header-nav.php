
<style>
    @import url('https://fonts.googleapis.com/css2?family=Alata&family=Anek+Gurmukhi:wght@100;200;400&family=Barlow:ital,wght@1,200&family=Bebas+Neue&family=Pathway+Gothic+One&family=Plus+Jakarta+Sans:wght@200&family=Roboto&display=swap');

    .button {
    color: white;
    display: inline-block;
    position: relative; 
    padding: 2px 5px; 
    }
    .button__badge {
    background-color: #fa3e3e;
    border-radius: 2px;
    color: white;
    padding: 1px 6px;
    font-size: 10px;
    position: absolute;
    top: -5px;
    left: 50%;
    border-radius:100%;

    }
    .font-font{
      font-family: 'Roboto', sans-serif;
    }
</style>
<header  class="shadow-lg flex justify-between py-2 pl-2 pr-10 w-full h-auto  bg-white border-b ">
    <div id="toggle-sidebar" class="z-[50] flex items-center  cursor-pointer">
        <svg class="h-5 w-5 text-indigo-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
            </svg>
    </div>
    <div class="flex gap-x-5 items-center ">
        <div class="relative">
                <div class="button  cursor-pointer">
                    <svg id="notification" class=" cursor-pointer h-5 w-5 text-indigo-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />  <path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                    <span class="button__badge">42</span>
                </div>
                <div id="notification-dropdown" class="z-[200] hidden md:h-auto md:w-auto md:absolute md:-left-[380px] md:inset-auto z-[100] fixed inset-0  md:shadow-lg  w-full h-screen  md:bg-white bg-white">
                    <div class="relative w-full py-2 text-center bg-indigo-400 text-white font-font md:rounded-tl-lg  md:rounded-t-lg">
                        Notification
                        <svg id="close-notifcation-mobile" class="z-[100] h-6 w-6 text-white md:hidden absolute right-6 top-2   hover:text-indigo-300 cursor-pointer"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" /></svg>
                    </div>
                    <div class="md:w-[450px] md:h-[300px] h-full w-full overflow-y-scroll">
                    <!-- container noti  start-->
                        <div id="notif-message" class="relative px-2 py-1  w-full hover:bg-gray-100 cursor-pointer ">
                                <div class="absolute flex flex-col relative">
                                    <p class="text-sm capitalize  break-all font-font pointer-events-none" >
                                        Meron ka nalang 14 days hahahah
                                    </p>
                                    <div class="flex justify-between pointer-events-none	">
                                        <p class="text-[9px] font-semibold mt-2 pointer-events-none	">2022-01-23 9:30am</p>
                                    </div>
                                </div>
                                <div id="messages-option" class="z-[100] hidden shadow-lg absolute border border-top left-3/4 top-10 bg-white w-[100px] h-auto py-2  px-2">
                                    <button class="w-full hover:bg-gray-100 text-sm font-semibold py-1">Read</button>
                                    <button class="w-full hover:bg-gray-100 text-sm font-semibold py-1">Notify</button>
                                </div>
                            </div>
                            <div id="notif-message" class="relative px-2 py-1  w-full hover:bg-gray-100 cursor-pointer ">
                                <div class="absolute flex flex-col relative">
                                    <p class="text-sm capitalize  break-all font-font pointer-events-none	" >
                                        tapos may pasok kapa gg kana hahah
                                    </p>
                                    <div class="flex justify-between pointer-events-none	">
                                        <p class="text-[9px] font-semibold mt-2 pointer-events-none	">2022-01-23 9:31am</p>
                                    </div>
                                </div>
                                <div id="messages-option" class="z-[100] hidden shadow-lg absolute border border-top left-3/4 top-10 bg-white w-[100px] h-auto py-2  px-2">
                                    <button class="w-full hover:bg-gray-100 text-sm font-semibold py-1">Read</button>
                                    <button class="w-full hover:bg-gray-100 text-sm font-semibold py-1">Notify</button>
                                </div>
                            </div>
                            
                         <!-- container notif end-->
                    </div>
                </div>
        </div>
        <div id="personal-btn" class="z-[100] relative cursor-pointer" >
            <img src="<?php  echo "$url/assets/profile/".$_SESSION['user']['profile'] ?>" alt="logo" class="cursor-pointer w-10 h-10 rounded-full">
                <div id="profile-dropdown" class=" hidden absolute -left-[125px]  bg-white shadow-lg   ">
                    <ul class="w-[150px] h-auto  ">
                        <li>
                             <button class="py-2 hover:bg-gray-100 w-full pl-5  ">
                                    <a href="<?php echo "$url/admin/administrative/personal/profile.php" ?>" class="flex gap-x-2 text-sm font-semibold">
                                        <svg class="h-5 w-5 text-indigo-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Profile  
                                    </a>
                             </button>   
                        </li>
                        <li >
                             <button class="py-2 hover:bg-gray-100  w-full pl-5 ">
                                    <a href="<?php echo "$url/admin/administrative/personal/setting.php" ?>" class="flex gap-x-2 text-sm font-semibold">
                                    <svg class="h-5 w-5 text-indigo-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />  <circle cx="12" cy="12" r="3" /></svg>
                                        Settings
                                    </a>
                             </button>   
                        </li>
                        <li >
                             <button id='logout-button' class="py-2 hover:bg-gray-100 w-full pl-5 flex gap-x-2 text-sm font-semibold">
                                    <svg class="h-5 w-5 text-indigo-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M7 6a7.75 7.75 0 1 0 10 0" />  <line x1="12" y1="4" x2="12" y2="12" /></svg>
                                    Logout
                             </button>   
                        </li>
                    </ul>
                </div>
        </div>
    </div>
</header>
<script>
    $("#notification").click(function(){
        $("#notification-dropdown").toggle()
        $("#profile-dropdown").hide()
    })
    document.querySelectorAll("#notif-message").forEach((element,i) => {
       
        element.addEventListener("click" ,function(e){
                document.querySelectorAll("#notif-message")[i].children[1].classList.toggle('hidden')
        })
    });
    $("#personal-btn").click(function(){
        $("#profile-dropdown").toggle()
        $("#notification-dropdown").hide()
    })
    $("#close-notifcation-mobile").click(function(){
        $("#notification-dropdown").hide()
    })
</script>

<script>
     $("#logout-button").click(function(){
        $.ajax({
            url:"<?php echo "$url/controller/integ/admin-shared.php/logout_account" ?>",
            type:"GET",
            success:function(res){
                const data = JSON.parse(res)
                return Swal.fire({
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                  }).then(()=>{
                      window.location.reload() 
                })
            }
        })
    })
</script>