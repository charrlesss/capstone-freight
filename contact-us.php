<?php
    include('dotenv.php');
    include("$dir/layout/header.php");
    include("$dir/admin/authenticated_user.php");

?>
<style>
 
 .gradient {
   background: linear-gradient(90deg, #8E629D 0%, #d489f0 100%);
 }
</style>

</head>
<body class='w-screen h-screen relative overflow-x-hidden'>
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


     <div class='z-[1]  px-10 w-full h-auto  bg-transparent absolute top-[45%] left-[50%] -translate-x-[50%] -translate-y-[50%]'>
            <div class='mb-10 text-center'>
                <h1 class='font-semibold md:text-4xl text-3xl text-white mb-10'>Contact Us</h1>
                <p class='font-thin	 leading-6 overflow-hidden h-[3em] md:text-2xl text-lg text-slate-50 opacity-70'>We're here to help and answer your question you migth have, we look forward to hearing from you</p>
            </div>
            <div class='md:w-[700px] h-auto bg-white rounded-2xl shadow-lg mx-auto'>
                <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                    <form action="#" class="space-y-8">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
                            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="name@flowbite.com" required>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your message</label>
                            <textarea id="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Leave a comment..."></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Send message</button>
                    </form>
                </div>
            </div>
            
    </div> 
    <div class="w-full h-[400px] relative  bg-gray-700 overflow-x-hidden">
        <img class='absolute max-h-[400px] w-full opacity-25 overflow-x-hidden' src="<?php echo $url.'/assets/img/contact.webp'; ?>"  alt="contact-us-logo">
    </div>
    <div class='w-full h-auto md:mt-[450px] mt-[410px] mx-auto px-10'>
        <div class='flex flex-wrap  w-full h-auto justify-center'>
                    <div class='w-[500px] h-[300px] m-2'>
                        <div class='w-full h-auto flex justify-center mb-5' >
                            <div class='w-auto h-auto border p-4 text-center rounded-lg'>
                                <svg class="md:h-10 md:w-10 h-6 w-6 text-indigo-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="3" y="5" width="18" height="14" rx="2" />  <polyline points="3 7 12 13 21 7" /></svg>  
                            </div>
                        </div>
                        <div class='w-full h-auto relative text-center'>
                            <h1 class='mb-3 font-semibold md:text-2xl text-lg'>Email </h1>
                            <p class='mb-2 md:text-lg text-gray-400'>Email us for general queries, including marketing and partnership opportunities.</p>
                            <p class='text-blue-500 font-semibold md:text-lg'>freight-administrative@gmail.com</p>
                        </div>
                    </div>
                    <div class='w-[500px] h-[300px] m-2'>
                        <div class='w-full h-auto flex justify-center mb-5' >
                            <div class='w-auto h-auto border p-4 text-center rounded-lg'>
                                <svg class="md:h-10 md:w-10 h-6 w-6 text-indigo-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                        </div>
                        <div class='w-full h-auto relative text-center'>
                            <h1 class='mb-3 font-semibold md:text-2xl text-lg'>Contact Number</h1>
                            <p class='mb-2 md:text-lg text-gray-400'>Contact us for general queries, including marketing and partnership opportunities.</p>
                            <p class='text-blue-500 font-semibold md:text-lg'>+63 907 214 7761</p>
                        </div>
                    </div>
                    <div class='w-[500px] h-[300px] m-2'>
                        <div class='w-full h-auto flex justify-center mb-5' >
                            <div class='w-auto h-auto border p-4 text-center rounded-lg'>
                                <svg class="md:h-10 md:w-10 h-6 w-6 text-indigo-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class='w-full h-auto relative text-center'>
                            <h1 class='mb-3 font-semibold md:text-2xl text-lg'>Head Office</h1>
                            <p class='mb-2 md:text-lg text-gray-400'>Go to offices for general queries, including marketing and partnership opportunities.</p>
                            <p class='text-blue-500 font-semibold md:text-lg'>P2HR+CMV, Quirino Hwy, Novaliches, Quezon City, Metro Manila</p>
                        </div>
                    </div>
        </div>
    </div>

    <script>
      /*Toggle dropdown list*/
      /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

      var navMenuDiv = document.getElementById("nav-content");
      var navMenu = document.getElementById("nav-toggle");

      document.onclick = check;

      function check(e) {
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

       
<?php
    include('./layout/footer.php');
?>
