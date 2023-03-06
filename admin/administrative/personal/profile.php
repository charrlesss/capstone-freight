<?php
  include("../../../dotenv.php");
  include("$dir/layout/header.php");
  include("$dir/admin/not-authenticated_user.php");

?>
</head>
<body>
  <div class="min-h-screen flex">
      <?php include("$dir/layout/sidebar-nav.php") ?>
      <div class="bg-indigo-50 flex-grow  ">
          <?php include("$dir/layout/header-nav.php") ?>
          <div class="w-full min-h-[calc(100%-80px)] border border-red-500">

            </div>
      </div>
  </div>
<?php
 include("$dir/layout/header.php")
?>