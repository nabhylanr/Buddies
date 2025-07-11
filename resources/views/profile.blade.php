<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen">

<div class="flex h-full">
  <!-- Sidebar -->
  <aside class="w-64 bg-white border-r border-gray-200">
    @include('sidebar')
  </aside>

  <main class="flex-1 overflow-y-auto p-6">
    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-100">
      <!-- Header -->
      <div class="flex items-center justify-between mb-8">
        <div>
          <h2 class="text-2xl font-bold text-gray-800">Profile</h2>
          <p class="mt-1 text-sm text-gray-600">Kelola profile account Anda.</p>
        </div>
      </div>

      @auth
      <!-- Avatar + Info -->
      <div class="flex items-center space-x-4 mb-6">
        <div class="relative inline-flex items-center justify-center w-14 h-14 overflow-hidden bg-gray-100 rounded-full">
          <span class="font-medium text-gray-600 text-lg">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
          </span>
        </div>
        <div>
          <p class="text-lg font-semibold text-gray-800">{{ Auth::user()->name }}</p>
          <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
          <p class="text-sm text-gray-500 capitalize">{{ Auth::user()->role }}</p>
        </div>
      </div>

      <!-- Detail Fields -->
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Name</label>
          <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ Auth::user()->name }}" readonly>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ Auth::user()->email }}" readonly>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Role</label>
          <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm capitalize" value="{{ Auth::user()->role }}" readonly>
        </div>
      </div>
      @endauth

    </div>
  </main>
</div>

</body>
</html>
