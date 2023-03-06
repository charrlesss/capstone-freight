function inquirersParticipants(url,cb) {
  $.ajax({
    type:"GET",
    url:url ,
    success:function(res){
      const data = JSON.parse(res)
      cb(data)
    }
  })
}

function displayInquirersParticipants(container, res ,url,id) {
  container.innerHTML = "";
  res.participants.forEach((data) => {
    const div = document.createElement("div");
    const img = document.createElement("img");
    const subCon = document.createElement("div");
    const fullname = document.createElement("p");
    const message = document.createElement("p");
    const messageSubCon = document.createElement("div");
    const date_message = document.createElement("p");

    div.className =
      "flex relative w-full h-auto lg:gap-x-2  items-center lg:justify-start justify-center  lg:pl-5 py-2 cursor-pointer hover:bg-gray-100";
    img.className = `p-1 w-10 h-10 rounded-full ring-2 
      text-xs ${
        Boolean(parseInt(data.seen))
          ? "ring-indigo-300 dark:ring-indigo-500"
          : "ring-indigo-700 dark:ring-indigo-700"
      }`;

    fullname.className = "lg:block hidden capitalize text-xl font-semibold";
    message.className = `lg:block hidden text-md ${
      Boolean(parseInt(data.seen)) ? "text-gray-400" : "font-bold"
    }`;

    messageSubCon.className =
      "lg:flex hidden  gap-x-1  h-auto w-auto items-end";
    date_message.className = "text-xs text-gray-400 pb-1 float-rigth";
    const messageDate = parseInt(data.createdAt);
    const dateofmessage = moment(messageDate * 1000).fromNow();
  img.src =    `${url}/assets/profile/${data.profile_link}`;
    fullname.textContent = data.fullname.trim();

    date_message.textContent =
      Date.now() <= messageDate * 1000 + 120 * 1000
        ? ". 1m"
        : ". " +
          dateofmessage.split(" ")[0] +
          dateofmessage.split(" ")[1].charAt(0);
    
    message.textContent =
      data.message.length >= 25
        ? data.message.slice(0, 25) + "..."
        : data.message;

    if(id !='' || id != null && id === data.from_id){
      HandleParticipantClick(id,url,false);
      // return;
    }

    div.addEventListener("click", () => {
      if (!Boolean(parseInt(data.seen))) {
        HandleParticipantClick(data.from_id,url,true);
        return;
      }
      const urlGetParticipants = url+'/controller/administrative/visitor-management.php/redirect_to_user_chat/'+data.from_id
        $.ajax({
          type: "GET",
          url:urlGetParticipants,
          success: function (res) {
            window.location.reload()
          }
      });

    });

    div.append(img);
    div.append(subCon);
    subCon.append(fullname);
    subCon.append(messageSubCon);
    messageSubCon.append(message);
    messageSubCon.append(date_message);
    container.append(div);
 
  });
}

function HandleParticipantClick(from_id,url ,reload) {
 
  const urlSeenParticipantsMessage = url+'/controller/administrative/visitor-management.php/redirect_to_user_chat_update_seen/'+from_id
  $.ajax({
    type: "GET",
    url:urlSeenParticipantsMessage,
    success: function (res) {
      console.log(res)
      if(reload){
        window.location.reload()
      }
    }
  });
}
