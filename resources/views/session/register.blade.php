<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Sign Up</title>
</head>
<body class="bg-cover bg-center h-screen w-screen flex items-center justify-center"
      style="background-image: url('/images/bg.jpg')">
  <div class="backdrop-blur-md bg-white/30 shadow-lg rounded-lg p-8 w-full max-w-md">
    <div class="text-center">
      <h2 class="text-2xl font-bold tracking-tight text-white">
        Create an Account
      </h2>
    </div>

    <div class="mt-6">
      <form class="space-y-6" action="#" method="POST">
        <div>
          <label for="name" class="block text-sm font-medium text-white">Name</label>
          <div class="mt-2">
            <input type="text" name="name" id="name" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-gray-900 sm:text-sm leading-6" />
          </div>
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-white">Email</label>
          <div class="mt-2">
            <input type="email" name="email" id="email" autocomplete="email" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-gray-900 sm:text-sm leading-6" />
          </div>
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-white">Password</label>
          <div class="mt-2">
            <input type="password" name="password" id="password" autocomplete="new-password" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-gray-900 sm:text-sm leading-6" />
          </div>
        </div>
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-white">Confirm Password</label>
          <div class="mt-2">
            <input type="password" name="password_confirmation" id="password_confirmation" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-gray-900 sm:text-sm leading-6" />
          </div>
        </div>

        <div>
          <button type="submit"
            class="flex w-full justify-center rounded-md border border-white bg-transparent px-3 py-1.5 text-sm font-medium text-white shadow-sm hover:bg-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
            Sign up
          </button>
        </div>
      </form>

      <p class="mt-6 text-center text-sm text-white">
        Already have an account?
        <a href="/login" class="font-semibold text-white hover:text-gray-100">Log in</a>
      </p>
    </div>
  </div>
</body>
</html>
