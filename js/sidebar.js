function noDropDown(data,pathname){
  const li = document.createElement('li')
  li.className ='group'
  li.id ="no-drop-down"
  li.innerHTML = `
      <a href="${data.link}" class=" ${pathname === data.link ? "bg-gray-100 text-indigo-500" :"text-gray-500"} capitalize flex gap-x-5 px-3 group-hover:text-indigo-500 p-2 hover:bg-gray-100 flex items-center text-sm font-semibold  hover:text-indigo-600 transition duration-200" hover:text-indigo-600>
          ${data.icon}
          ${data.title}
      </a>
  `
  return li
}

function withDropDownParent(data){
  const button = document.createElement('button')
  button.className = "group py-3 pr-2 hover:bg-gray-100  group-hover:text-indigo-500 flex items-center w-full justify-between text-sm font-semibold text-gray-500  transition duration-200"
  button.id="drop-down-button"
  let buttonElements = ''
  buttonElements = `
  <div class="flex gap-x-5 px-3 group-hover:text-indigo-500 pointer-events-none	">
                  ${data.icon}
              <p class="pointer-events-none	 group-hover:text-indigo-500 capitalize">${data.title}</p>
          </div>
          <svg id="drop-down-icon" class=" pointer-events-none	 transition-all h-5 w-5 text-gray-500  group-hover:text-indigo-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="6 9 12 15 18 9" /></svg>
  `
  button.innerHTML = buttonElements
  return button

}

function withDropDown(dData ,pathname){
 return `
      <li class="hover:bg-gray-100 group  ${pathname === dData.link ? "bg-gray-100 text-indigo-500" :"text-gray-500"}">
          <a href="${dData.link}"
          class="  capitalize flex gap-x-2 group-hover:text-indigo-500 flex items-center w-full p-2 text-sm  font-normal transition duration-75 rounded-lg group  pl-11">
          ${dData.icon}
          ${dData.title}</a>
      </li>
  `

}
function activeNavChild(container){
    const pathname  = window.location.pathname
    container.querySelectorAll('a').forEach((link)=>{
        if(link.pathname === pathname){
            link.parentNode.parentNode.parentNode.firstChild.click()
        }
    })
}

function activeNav(container){
  const pathname  = window.location.pathname
  console.log(container.querySelectorAll('#no-drop-down'))
  container.querySelectorAll('#no-drop-down').forEach((link)=>{
      if(link.pathname === pathname){
        link.parentNode.click()
      }
  })
}

function initDisplaySidebar(arr,container){
  const pathname  = window.location.pathname
  const ul = document.createElement('ul')
  ul.className ="transition-all ease-in-out"
  arr.forEach((data) => {
     
      if(data['dropdown']){
          const li = document.createElement('li')
          const dul = document.createElement('ul')
          dul.id = "dropdown-list"
          dul.className = "hidden py-2 space-y-2 transition-all "
          const button  =  withDropDownParent(data)
          li.append(button) 
          data['dropdown'].forEach((dData)=>{
              dul.innerHTML += withDropDown(dData ,pathname ,button,dul)
              li.append(dul)
              ul.append(li)

          })
      }else{
          const li = noDropDown(data,pathname)
          ul.append(li)
      }
  });
  container.append(ul)
}
function sidebarToggle(){
  $("#toggle-sidebar").click(function(){
     
      $("#sidebar")[0].classList.toggle ('md:w-0')
      $("#sidebar")[0].classList.toggle('w-0')
      $('#sidebar').children().toggle()
      $("#backgroud-modal-active")[0].classList.toggle('hidden')
  })
  $("#toggle-sidebar-mobile").click(function(){
      $("#sidebar")[0].classList.toggle ('md:w-0')
      $("#sidebar")[0].classList.toggle('w-0')
      $('#sidebar').children().toggle()
      $("#backgroud-modal-active")[0].classList.add('hidden')

  })

  $("#backgroud-modal-active").click(function(){
    $("#sidebar")[0].classList.toggle ('md:w-0')
    $("#sidebar")[0].classList.toggle('w-0')
    $('#sidebar').children().toggle()
    $("#backgroud-modal-active")[0].classList.add('hidden')

})

  document.querySelectorAll("#drop-down-button").forEach(el=>{
    el.addEventListener("click",function(){
        el.parentNode.children[0].children[1].classList.toggle('rotate-180')
        el.parentNode.children[1].classList.toggle('hidden')
    })
  })
}
function init(arr ,containerId){
  const container = document.getElementById(containerId)
  initDisplaySidebar(arr,container)
  sidebarToggle()
  activeNavChild(container)
 
  activeNav(container)
}