
<div id="backgroud-modal-active" class="md:hidden hidden absolute inset-0 bg-gray-500 opacity-30 z-[100] "></div>
<div id="sidebar" class="z-[101] md:relative absolute py-12 bg-white min-h-screen transition-all ease-in-out md:w-[300px] w-[280px] shadow-lg">
            <div class="flex space-2 items-center border-b-2 pb-4 px-5 ">
                <div id="toggle-sidebar-mobile" class="md:hidden absolute top-5 right-2 flex items-center  cursor-pointer">
                    <svg class="h-5 w-5 text-indigo-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </div>
                <div>
                    <img src="<?php  echo "$url/assets/img/logo.png" ?>" alt="logo" class="rounded-full">
                </div>
                <div class="ml-3">
                    <h1 class="text-3xl font-bold text-indigo-600">FREIGHT</h1>
                    <p class="text-center text-sm text-indigo-600 mt-1 font-serif">Administrative </p>
                </div>
            </div>
          <div id="sidebar-container">
            <!-- sidebar -->
          </div>
</div>


<script src="<?php echo "$url/js/sidebar.js" ?>"></script>
<script>
        
        const sidebarConfig = [
            {
                link:"<?php echo "$url/admin/administrative/" ?>",
                title:"dashboard",
                icon:`<svg class="h-5 w-5 text-gray-500 group-hover:text-indigo-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>`
            },
            {
                title:"Visitor Management",
                icon:`<svg class="h-5 w-5 text-gray-500 group-hover:text-indigo-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>`,
                dropdown:[
                    {
                        link:"<?php echo "$url/admin/administrative/visitor-management/visitors.php" ?>",
                        title:"Visitors",
                        icon:`<svg class="h-5 w-5 "  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>`
                    },
                    {
                        link:"<?php echo "$url/admin/administrative/visitor-management/request.php" ?>",
                        title:"Request",
                        icon:`<svg class="h-5 w-5 "  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>`
                    },
                    {
                        link:"<?php echo "$url/admin/administrative/visitor-management/inquirers.php" ?>",
                        title:"Inquirers",
                        icon:`<svg class="h-5 w-5 "  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>`
                    }
                ]
                      
            },
            {
                title:"Facility Reservation",
                icon:`<svg class="h-5 w-5 text-gray-500 group-hover:text-indigo-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="3" y1="21" x2="21" y2="21" />  <path d="M5 21v-14l8 -4v18" />  <path d="M19 21v-10l-6 -4" />  <line x1="9" y1="9" x2="9" y2="9.01" />  <line x1="9" y1="12" x2="9" y2="12.01" />  <line x1="9" y1="15" x2="9" y2="15.01" />  <line x1="9" y1="18" x2="9" y2="18.01" /></svg>`,
                dropdown:[
                    {
                        link:"<?php echo "$url/admin/administrative/facility-reservation/facilities.php" ?>",
                        title:"Facilities",
                        icon:`<svg class="h-5 w-5 "  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>`
                    },
                    {
                        link:"<?php echo "$url/admin/administrative/facility-reservation/reserve-facility.php" ?>",
                        title:"Reserve Facility",
                        icon:`<svg class="h-5 w-5 "  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>`
                    }
                ]
                      
            },
            {
                title:"Legal Management",
                icon:`<svg class="h-5 w-5 text-gray-500 group-hover:text-indigo-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="12" y1="3" x2="12" y2="21" />  <line x1="9" y1="21" x2="15" y2="21" />  <polyline points="3 6 6 7 12 5 18 7 21 6" />  <path d="M6 7l-3 9a5 5 0 0 0 6 0l-3 -9" />  <path d="M18 7l-3 9a5 5 0 0 0 6 0l-3 -9" /></svg>`,
                dropdown:[
                    {
                        link:"<?php echo "$url/admin/administrative/legal-management/case-dockets.php" ?>",
                        title:"Case Dockets",
                        icon:`<svg class="h-5 w-5 "  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>`
                    },
                    {
                        link:"<?php echo "$url/admin/administrative/legal-management/legal-documents.php" ?>",
                        title:"Legal Document",
                        icon:`<svg class="h-5 w-5 "  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>`
                    }
                ]
                      
            },
            {
                title:"Document Management",
                icon:`<svg class="h-5 w-5 text-gray-500 group-hover:text-indigo-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                    </svg>`,
                dropdown:[
                    {
                        link:"<?php echo "$url/admin/administrative/document-management/documents.php" ?>",
                        title:"Documents",
                        icon:`<svg class="h-5 w-5 "  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>`
                    }
                ]
                      
            },
            {
                title:"User Management",
                icon:`<svg class="h-5 w-5  fill-gray-500 group-hover:fill-indigo-500"  id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 116.17"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>user-settings</title><path class="cls-1" d="M0,107.68c0-32.08,26.21-21,35-32.2,6.45,15.23,29.74,13.94,37.63,0A11.7,11.7,0,0,0,76,78a8.26,8.26,0,0,0,.4,5.29l.27.55a11.12,11.12,0,0,0-1.24.39,8.54,8.54,0,0,0-4.55,4.55l-.2.58a8.37,8.37,0,0,0-.41,2.57v5.27a8.25,8.25,0,0,0,.63,3.16l.25.51A8.42,8.42,0,0,0,72.6,103l.14.14a8.18,8.18,0,0,0,2.59,1.75l.66.24a8.47,8.47,0,0,0-1.06,2.56ZM115.64,79.32a2,2,0,0,0-2.9,0l-2.22,2.21a15.3,15.3,0,0,0-1.87-1,19,19,0,0,0-2-.78V76.34a2,2,0,0,0-.59-1.46,2,2,0,0,0-1.45-.59h-4.26a2,2,0,0,0-1.43.59,2,2,0,0,0-.61,1.46v3.1a15.41,15.41,0,0,0-2.06.64,15.89,15.89,0,0,0-1.91.88l-2.45-2.42a1.88,1.88,0,0,0-1.42-.61,2,2,0,0,0-1.45.61l-3,3a2,2,0,0,0,0,2.9l2.21,2.22a14.06,14.06,0,0,0-1,1.87,19,19,0,0,0-.78,2H83a2,2,0,0,0-2,2v4.26a2,2,0,0,0,.59,1.43,1.94,1.94,0,0,0,1.45.61h3.11a15.41,15.41,0,0,0,.64,2.06,19,19,0,0,0,.87,1.95l-2.41,2.41a1.85,1.85,0,0,0-.61,1.42,2,2,0,0,0,.61,1.45l3,3a2.13,2.13,0,0,0,2.9,0l2.21-2.25a14.18,14.18,0,0,0,1.88,1,19.67,19.67,0,0,0,2,.78v3.4a2,2,0,0,0,2,2h4.26a2,2,0,0,0,2-2V111a17,17,0,0,0,2.06-.63c.67-.26,1.32-.56,2-.88l2.41,2.41a1.86,1.86,0,0,0,1.43.62,1.9,1.9,0,0,0,1.44-.62l3-3a2.13,2.13,0,0,0,0-2.9l-2.25-2.21a14.18,14.18,0,0,0,1-1.88,19.67,19.67,0,0,0,.78-2h3.39a2,2,0,0,0,1.46-.6,2,2,0,0,0,.59-1.45V93.63a2,2,0,0,0-.59-1.43,2,2,0,0,0-1.46-.6h-3.1a17.31,17.31,0,0,0-.64-2,15.49,15.49,0,0,0-.88-1.93l2.42-2.45a1.88,1.88,0,0,0,.61-1.41,2.05,2.05,0,0,0-.61-1.46l-3-3Zm-13.7,7.57a8.27,8.27,0,0,1,3.25.65A8.23,8.23,0,0,1,109.63,92a8.45,8.45,0,0,1,0,6.5,8.23,8.23,0,0,1-4.44,4.44,8.45,8.45,0,0,1-6.5,0,8.23,8.23,0,0,1-4.44-4.44,8.45,8.45,0,0,1,0-6.5,8.23,8.23,0,0,1,4.44-4.44,8.27,8.27,0,0,1,3.25-.65ZM30.74,42a5,5,0,0,0-2.67.7,2,2,0,0,0-.77.88A3.11,3.11,0,0,0,27.05,45c.05,1.62.89,3.73,2.53,6.17l0,0h0l5.31,8.45C37,63.05,39.28,66.5,42.06,69a14.58,14.58,0,0,0,10.19,4.1A15,15,0,0,0,63,68.86c2.86-2.68,5.13-6.36,7.35-10l6-9.86c1.12-2.55,1.53-4.26,1.27-5.25-.15-.6-.81-.89-1.93-.95-.24,0-.48,0-.73,0l-.84.05a1.75,1.75,0,0,1-.46,0A9.15,9.15,0,0,1,72,42.7l2.06-9.08c-15.22,2.4-26.6-8.9-42.68-2.26l1.16,10.7A9.16,9.16,0,0,1,30.74,42Zm47-1.92A3.89,3.89,0,0,1,80.56,43c.43,1.67,0,4-1.46,7.26h0l-.09.17L73,60.4c-2.33,3.84-4.7,7.7-7.86,10.66a17.86,17.86,0,0,1-12.83,5.09A17.46,17.46,0,0,1,40,71.26c-3.07-2.82-5.42-6.45-7.66-10l-5.32-8.45c-1.94-2.9-3-5.55-3-7.72a6.2,6.2,0,0,1,.52-2.77,5.22,5.22,0,0,1,1.82-2.12,6,6,0,0,1,1.29-.65,136.66,136.66,0,0,1-.25-15.2,21.8,21.8,0,0,1,.65-3.43,20.41,20.41,0,0,1,9-11.45,28.41,28.41,0,0,1,7.53-3.35c1.68-.48-1.44-5.88.31-6C53.33-.8,67,6.9,72.88,13.28c2.94,3.2,4.8,7.42,5.2,13l-.33,13.78Z"/></svg>`,
                dropdown:[
                    {
                        link:"<?php echo "$url/admin/administrative/user-management/accounts.php" ?>",
                        title:"Accounts",
                        icon:`<svg class="h-5 w-5 "  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>`
                    },
                    {
                        link:"<?php echo "$url/admin/administrative/user-management/position.php" ?>",
                        title:"Position",
                        icon:`<svg class="h-5 w-5 "  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>`
                    },
                    {
                        link:"<?php echo "$url/admin/administrative/user-management/department.php" ?>",
                        title:"Department",
                        icon:`<svg class="h-5 w-5 "  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>`
                    }
                ]
                      
            }
            
            
        ]
            
        $(function(){
            init(sidebarConfig,'sidebar-container')

            if(window.innerWidth <= 750){
                $('#toggle-sidebar-mobile').click()
            }else{
                $('#toggle-sidebar').dblclick()
            }
            window.addEventListener('resize',function (){
            if(window.innerWidth <= 750){
                $("#sidebar")[0].classList.add ('md:w-0')
                $("#sidebar")[0].classList.add('w-0')
                $('#sidebar').children().hide()
                $("#backgroud-modal-active")[0].classList.add('hidden')
            }else{
                $("#sidebar")[0].classList.remove ('md:w-0')
                $("#sidebar")[0].classList.remove('w-0')
                $('#sidebar').children().show()

                }
            })
            
        })

</script>