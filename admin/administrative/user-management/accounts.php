<?php
  include("../../../dotenv.php");
  include("$dir/layout/header.php");
  include("$dir/admin/not-authenticated_user.php");

?>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
<script src="https://cdn.tailwindcss.com/3.2.4"></script>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/js/utils.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/css/intlTelInput.css" rel="stylesheet"/>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.1.1/js/countrySelect.min.js"></script>
   <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.1.1/css/countrySelect.min.css"
   />
   <link
     rel="stylesheet"
     href="<?php echo "$url/css/password-validation.administrative.css"?>"
   />
   <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
<style>
  .iti-flag {
    background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/img/flags.png");
  }
  .iti__flag-container{
    width: 100% !important;
  }
  .intl-tel-input input{
    width: 100% !important;
    border:1px solid #cbd5e1;
    height: 45px;
  }
  body .intl-tel-input .flag-container {
    position: static;
  }

  body .intl-tel-input .selected-flag {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    height: 100%;
  }

  body .intl-tel-input .country-list {
    width: 100%;
    top: 100%;
  }
  body .intl-tel-input {
    width: 100%;
    z-index: 50;
  }
  .country-select{
    width: 100%  !important;
    z-index: 20;
  }
</style>

</head>
<body>
  <div class="min-h-screen flex">
      <?php include("$dir/layout/sidebar-nav.php") ?>
      <div class="bg-indigo-50 flex-grow  ">
          <?php include("$dir/layout/header-nav.php") ?>
            <div class="w-full min-h-[calc(100%-80px)] flex flex-col ">
                <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
                  <div class="container flex flex-wrap items-center justify-between mx-auto">
                  <div class="items-center justify-between flex w-auto order-1" id="navbar-cta">
                    <ul class="flex  py-4  border border-gray-100 rounded-lg bg-gray-50 flex-row space-x-8 mt-0 text-sm font-medium border-0 bg-white dark:bg-gray-800 dark:bg-gray-900 dark:border-gray-700">
                      <li>
                        <button  
                         data-te-ripple-init
                         data-te-ripple-color="info" 
                         data-te-toggle="modal"
                         data-te-target="#createAdminAccount"
                         class="  hover:bg-gray-100 hover:bg-transparent hover:text-blue-700 p-0 dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:hover:bg-transparent dark:border-gray-700">
                          Create Account</button>
                      </li>
                      <li>
                       <button  
                         data-te-ripple-init
                         data-te-ripple-color="info"  
                        class="  hover:bg-gray-100 hover:bg-transparent hover:text-blue-700 p-0 dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:hover:bg-transparent dark:border-gray-700">
                          Archive Account</button>
                      </li>
                      <li>
                        <button  
                         data-te-ripple-init
                         data-te-ripple-color="info" 
                          class="  hover:bg-gray-100 hover:bg-transparent hover:text-blue-700 p-0 dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:hover:bg-transparent dark:border-gray-700">
                          Export
                        </button>
                      </li>
                    </ul>
                  </div>
                  </div>
                </nav>
                  <div class="relative w-full px-4 bg-white h-full flex-1">
                 
                      <div class="relative w-full p-4">
                          <div class="relative overflow-x-scroll">
                              <table id="created-req-table" class=" text-sm text-left text-gray-500 dark:text-gray-400 " >
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Contact Number</th>
                                                <th>Country</th>
                                                <th>Birthdate</th>
                                                <th>Gender</th>
                                                <th>Department</th>
                                                <th>Position</th>
                                                <th>Created</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body" class="overflow-x-scroll ">
                                        </tbody>
                                      <tfoot>
                                          <tr>
                                                <th>User</th>
                                                <th>Contact Number</th>
                                                <th>Country</th>
                                                <th>Birthdate</th>
                                                <th>Gender</th>
                                                <th>Department</th>
                                                <th>Position</th>
                                                <th>Created</th>
                                          </tr>
                                      </tfoot>
                                </table>
                            </div>
                        </div>

                </div>
            </div>
      </div>


<!-- modal create account-->
<div
  data-te-modal-init
  class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
  id="createAdminAccount"
  tabindex="-1"
  aria-labelledby="createAdminAccount"
  aria-modal="true"
  role="dialog">
  <div
  data-te-modal-dialog-ref
  class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px] min-[1200px]:max-w-[1140px]">
  <div
    class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
      <div
        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
        <h5
          class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
          id="createAdminAccountLabel">
          Create Admin Account
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
          <div class="relative p-4 w-full">
            <div class="px-6 py-6 lg:px-8 relative w-full">
                    <form class="space-y-2 mb-10 relative w-full" id="form-create-admin-account">
                        <div class="relative flex justify-center">
                              <div>
                                  <div class="min-h-auto max-h-[200px] w-full flex items-center justify-center" id="profile-container">
                                    <img id="blah" src="<?php echo "$url/assets/img/default.png" ?>" alt="your image"  class="w-[150px] h-[150px] mb-2 rounded-full shadow-md"/>
                                </div>
                                  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white  text-center" for="profile">Upload Profile</label>
                                  <input type="file" id="profile" name="profile" required class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                              </div>
                          </div> 

                      <div class="flex md:gap-x-1 md:gap-y-0 md:flex-row flex-col gap-y-1">
                        <div class="relative flex-1">
                              <input type="text" id="firstname" name="firstname" required class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                              <label for="firstname"  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">First Name</label>
                        </div>     
                        <div class="relative flex-1">
                              <input type="text" id="lastname" name="lastname" required class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                              <label for="lastname"  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Last Name</label>
                        </div> 
                        <div class="relative flex-1">
                              <input type="text" id="middlename" name="middlename" required class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                              <label for="middlename"  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Middle Name</label>
                        </div> 
                      </div>

                      <div  class="flex md:gap-x-1 md:gap-y-0 md:flex-row flex-col gap-y-1">
                        <div class="relative flex-1">
                                <select id="gender" name="gender" class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" >
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                                </select>
                                <label for="address"  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Gender</label>
                          </div>
                          <div class="relative  flex-1">
                              <input type="date" id="birthdate" name="birthdate" required class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                              <label for="birthdate"  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Birth Date</label>
                          </div>
                      </div>

                      <div class="flex md:gap-x-1 md:gap-y-0 md:flex-row flex-col gap-y-1">
                          <div class="relative flex-1">
                                <input type="text" id="contact_number" name="contact_number" required />
                                <label for="contact_number"  class="z-[52] absolute text-sm   duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 ">Contact Number</label>
                          </div>  
                          <div class="relative flex-1">
                                <input type="text" id="country" name="country" required class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                <label for="country"  class="z-[22] absolute text-sm   duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 " >Country</label>
                          </div>  
                      </div>

                      <div class="flex md:gap-x-1 md:gap-y-0 md:flex-row flex-col gap-y-1 w-full">
                          <div class="relative  flex-1">
                              <select id="position" name="position_id" class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" >
                              </select>
                              <label for="address"  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Department</label>
                          </div>
                          <div class="relative  flex-1">
                              <select id="department" name="department_id" class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" >
                              </select>
                              <label for="address"  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Position</label>
                          </div>
                      </div>

                      <div class="flex md:gap-x-1 md:gap-y-0 md:flex-row flex-col gap-y-1">
                        <div class="relative flex-1">
                                <input type="email" id="email" name="email" required class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="email"  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Email</label>
                          </div>
                          <div class="relative flex-1">
                              <textarea type="text"  rows="1" id="address" name="address" required class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " ></textarea>
                              <label for="address"  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Address</label>
                        </div>
                      </div>

                     
                       

                         
                        
                      


                        
                      <div class="flex md:gap-x-1 md:gap-y-0 md:flex-row flex-col gap-y-1 w-full">
                        <div class="relative flex-1">
                                <input type="text" id="password" name="password" required class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="password"  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Password</label>
                          </div> 
                        <div class="relative flex-1">
                              <input type="text" id="confirm_password" name="confirm_password" required class="focus:shadow-md shadow-sm block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-sm border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                              <label for="confirm_password"  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Confirm Password</label>
                        </div>
                      </div>
                     
                        <div class="relative">
                            <div id="characterMinMax" class="validation-display">
                              <div id="characterMinMax-validation" class="validation-message"></div>
                              <p>Minimum of 8 & maximum of 30 characters</p>
                            </div>
                            <div id="lowercase" class="validation-display">
                              <div id="lowercase-validation" class="validation-message"></div>
                              <p>At least 1 lowercase letter</p>
                            </div>
                            <div id="uppercase" class="validation-display">
                              <div id="uppercase-validation" class="validation-message"></div>
                              <p>At least 1 uppercase letter</p>
                            </div>
                            <div id="numeric" class="validation-display">
                              <div id="numeric-validation" class="validation-message"></div>
                              <p>At least 1 numeric digit</p>
                            </div>
                            <div id="specialCharacter" class="validation-display">
                              <div id="specialCharacter-validation" class="validation-message"></div>
                              <p>At least 1 specialCharacter</p>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                                </div>
                                <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Agree to the terms and conditions policy?</label>
                            </div>
                        </div>
                    
                        <button   
                        data-te-ripple-init
                        data-te-ripple-color="info" 
                        type="submit" 
                        class=" w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                      </form>
              </div>
          </div>
      </div>
  </div>
</div>


      </div>


  <script src="<?php echo "$url/js/password-validation.administrative.js"?>"></script>

  <script>
    const confirmPassword = document.getElementById('confirm_password')
    initPasswordValidation(confirmPassword);

    const phoneInputField = document.querySelector("#contact_number");
    const datepickerEl = document.getElementById('birthdate');
    $("#contact_number").intlTelInput();
    $("#country").countrySelect({
      defaultCountry:"ph"
    });
  </script>

  <script>
    $.ajax({
      url:"<?php echo "$url/controller/administrative/user-management.php/getAllPosition" ?>",
      type:"GET",
      success:function(res){
        const data = JSON.parse(res)
        const position = document.getElementById('position')
        const department = document.getElementById('department')
        data.position.forEach((data) => {
          position.innerHTML += `<option value="${ data.position_id}">${data.position_name}</option>`
        });
        data.department.forEach((data) => {
          department.innerHTML += `<option value="${ data.department_id}">${data.department_name}</option>`
        });
      }
    })
  </script>

  <script>
    function readURL(input,id) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                $(id)[0].innerHTML =  `<img id="blah" src='${e.target.result}' alt="your image"  class="w-[150px] h-[150px] mb-2 rounded-full shadow-md"/>`
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
      $("#profile").change(function(){
          readURL(this,"#profile-container");
      });
  </script>

  <script>
        $("#form-create-admin-account").submit(function(e){
          e.preventDefault()
          const formData = new FormData(e.currentTarget)
            $.ajax({
              url:"<?php echo "$url/controller/administrative/user-management.php/createAccount" ?>",
              type:"POST",
              data:formData,
              processData: false,
              contentType: false,
              success:function(res){
                const data = JSON.parse(res)
                if(data.success){
                  $("#edit-request-modal").hide()
                   return   Swal.fire(
                        'Updated!',
                          data.message,
                        'success'
                      )
                 }
              }
            })
        })
  </script>
  
  <script>
      function displayTableData(res){
            const tableBody = document.getElementById("table-body")
           tableBody.innerHTML = "";
          console.log(res)
          res.forEach((data)=>{
                tableBody.innerHTML +=  `
                  <tr>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <div class='flex gap-x-2'>
                                <img
                                    class="p-1 md:w-8 md:h-8 w-6 h-6 rounded-full ring-2  ring-indigo-300 dark:ring-indigo-500"
                                    src="<?php echo "$url/assets/profile/" ?>${data.profile}"
                                    alt="logo"
                                />
                                <div>
                                    <p>${data.firstname} ${ data.middlename} ${data.lastname}</p>
                                    <p class='text-gray-400'>${data.email}</p>
                                </div>
                            </div>
                          </td>
                          <td>${data.contact_number}</td>
                          <td>${data.country}</td>
                          <td>${data.birthdate}</td>
                          <td>${data.gender}</td>
                          <td>${data.department_name}</td>
                          <td>${data.position_name}</td>
                          <td>${data.createdAt_account}</td>
                  </tr>
                  `
          })
        }
  </script>

  <script>
      $.ajax({
            type:"GET",
            url:"<?php  echo $url."/controller/administrative/user-management.php/get_all_accounts"?>",
            success:function(res){
              const data = JSON.parse(res);
              displayTableData(data.accounts)
              $('#created-req-table').DataTable();
            }
          })
  </script>

<?php
 include("$dir/layout/header.php")
?>