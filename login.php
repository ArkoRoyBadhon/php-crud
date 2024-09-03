<?php
include 'shared/header.php';

?>

<body class="bg-gray-100 ">
  <?php include 'shared/nav.php' ?>
  <div class="flex justify-center items-center">

    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8 ">
      <h1 class="text-2xl font-bold text-gray-800 text-center mb-8">Login</h1>

      <?php
      require_once 'func/login-views.php';
      render_message();
      ?>

      <form method="POST" action="func/login-user.php" class="space-y-6">

        <div class="relative">
          <input type="text" required name="username"
            class="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-blue-500"
            placeholder="Username">
          <label for="username"
            class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2.5 peer-focus:-top-3.5 peer-focus:text-blue-500">Username</label>
        </div>

        <div class="relative">
          <input type="password" required name="password"
            class="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-blue-500"
            placeholder="Password">
          <label for="password"
            class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2.5 peer-focus:-top-3.5 peer-focus:text-blue-500">Password</label>
        </div>

        <div>
          <input type="submit" value="Login"
            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200">
        </div>

        <div class="text-center text-sm text-gray-600">
          Not a member? <a href="register.php" class="text-blue-500 hover:underline">Signup</a>
        </div>

      </form>
    </div>
  </div>

</body>

</html>