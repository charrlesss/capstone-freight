<?php
  include("../../../dotenv.php");
  include("$dir/layout/header.php");
  include("$dir/admin/not-authenticated_user.php");
  $visitor_id = !empty($_SESSION['visitor_chat_id']) ? $_SESSION['visitor_chat_id'] :"";
?>
</head>
<body>
  <div class="min-h-screen flex">
      <?php include("$dir/layout/sidebar-nav.php") ?>
      <div class="bg-indigo-50 flex-grow flex flex-col ">
          <?php include("$dir/layout/header-nav.php");?>
            <div class="w-full  flex-1 flex ">
                <div id="inquirers-container" class="lg:w-[320px] w-[80px] bg-white"> 

                </div>
                <div class="relative chat lg:flex items-center justify-center bg-indigo-100 flex-1  mr-2  h-auto ">
                        <?php  if(empty($visitor_id)){ ?>
                               <div class="flex h-full w-full items-center justify-center">
                                    <p class="uppercase" >NO SELECTED conversation</p>
                               </div>    
                        <?php  }else{ ?>
                            <div class=" h-full w-full flex flex-col ">
                                     <div id="scrollable-element"  class="  flex-1 overflow-y-auto p-2 md:pt-16">
                                                <div id="messages-container" class="border w-full min-h-auto max-h-[600px] ">


                                                </div>
                                            </div>
                                        <form id="message-form" class="flex gap-x-1 p-5 bg-white">
                                            <input type="text" id="staff-message" name="staff-message" class='w-full rounded-lg'  placeholder="Type your message" required>
                                            <button type="submit" id="btn-input" ><svg class="md:h-12 md:w-12 w-8 h-8 text-indigo-500 hover:text-indigo-300"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="22" y1="2" x2="11" y2="13" />  <polygon points="22 2 15 22 11 13 2 9 22 2" /></svg></button>
                                        </form>
                                    </div>
                                </div> 
                    <?php } ?>
                </div>
            </div>
      </div>
  </div>

  <script src="<?php echo "$url/js/inquirers-participants.js"?>"></script>
  <script src='https://momentjs.com/downloads/moment.js'></script>

  <script>
    const hasSelectAccount = "<?php echo $visitor_id ?>"
    const main_URL = "<?php  echo $url."/controller/administrative/visitor-management.php/get_all_inquirers"?>"
    const container = document.getElementById('inquirers-container')
    const url = "<?php  echo $url?>"

    inquirersParticipants(main_URL ,function(res){
        displayInquirersParticipants(container,res,url,hasSelectAccount)
    })
    setInterval(() => {
        const container = document.getElementById('inquirers-container')
        inquirersParticipants(main_URL ,function(res){
            displayInquirersParticipants(container,res,url ,hasSelectAccount)
        })
    }, 2000);
  </script>

  <script>
    function scrollToBottom(id){
        $(`#${id}`).animate({scrollTop:9999999},"slow");
    }
  </script>

  
<script>



  
function initChat(){

    function displayMyMessages(input,userProfile){
        const messagesContainer = document.getElementById('messages-container')
        const div = document.createElement("div");
        const img = document.createElement("img");
        const message = document.createElement("p");
        img.alt ="my profile"
        img.src = "<?php   echo $url."/assets/profile/".$_SESSION['user']['profile'] ?>"
        img.className = "cursor-pointer w-10 h-10 rounded-full"
        div.className ="flex  w-full flex-row-reverse items-end gap-x-2 mb-2"
        message.className ="bg-indigo-400  text-white max-w-[250px] min-w-auto sm:text-md text-[13px] break-all flex items-end rounded-bl-md  rounded-tl-md rounded-tr-md py-1 px-3"
        message.textContent = input;
        div.append(img);
        div.append(message);
        messagesContainer.append(div)
    }

  

    $("#message-form").submit(function(e){
        e.preventDefault()
        const formData = new FormData(e.currentTarget)
        if(formData.get("staff-message").trim() === ''){
            return
        }
        displayMyMessages(formData.get("staff-message").trim())
        scrollToBottom('scrollable-element')
        $.ajax({
            type:"POST",
            processData: false,
            contentType: false,
            url:"<?php  echo $url."/controller/administrative/visitor-management.php/staff_send_message/".$_SESSION['user']['account_id']."/".$visitor_id?>",
            data:formData,
            success:function(res){
              const data = JSON.parse(res)
              console.log(data)
            }
          })
      
        document.getElementById('staff-message').value = ''
    })

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
   
    const allmessage = res.my_message.concat(res.visitor_message);

    function sort(data){
      return data?.sort((a,b)=>{

          return new Date(a.createdAt * 1000) - new Date(b.createdAt * 1000)
      })
    }


    sort(allmessage)?.forEach((data)=>{
      const url = "<?php  echo $url?>";
        if(data.hasOwnProperty("profile")){
          conM.append(createElementMessage(
            " flex  w-full flex-row-reverse items-end gap-x-2 mb-2 p-2",
            "cursor-pointer w-10 h-10 rounded-full",
            "bg-indigo-400  text-white max-w-[250px] min-w-auto sm:text-md text-[13px] break-all flex items-end rounded-bl-md  rounded-tl-md rounded-tr-md py-1 px-3",
            `${url}/assets/profile/${data.profile}`,
            data.message
          ))
          return
        }

        conM.append(createElementMessage(
            "flex gap-x-2 mb-1 items-end p-2",
            "cursor-pointer w-10 h-10 rounded-full",
            "bg-indigo-400  text-white  max-w-[250px] min-w-auto sm:text-md text-[13px] break-all flex items-end rounded-bl-md  rounded-br-md rounded-tr-md py-1 px-3",
            `${url}/assets/profile/${data.profile_link}`,
            data.message
          ))
          
       
    })

  }



  function getMessage(cb){
    $.ajax({
      type:"GET",
      url:"<?php  echo $url."/controller/administrative/visitor-management.php/fetchStaffConvo/".$visitor_id."/".$_SESSION['user']['account_id']?>",
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


  }
</script>
<script>

if(hasSelectAccount !== null || hasSelectAccount !== ''){
  initChat()
}
</script>


<?php
 include("$dir/layout/header.php")
?>