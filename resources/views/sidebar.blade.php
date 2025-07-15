<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Sidebar</title>
</head>
<body class="bg-gray-100">
<div class="h-full bg-white shadow-md px-4 py-6 space-y-6">
  <div class="text-2xl font-bold text-gray-800 text-center">
    Kopra Buddies
  </div>

  <!-- User Info -->
  @auth
  <div class="text-center text-sm text-gray-600 border-b pb-4">
    <div class="w-12 h-12 bg-gray-200 rounded-full mx-auto mb-3 flex items-center justify-center">
      <span class="text-gray-700 font-semibold text-lg">{{ substr(Auth::user()->name, 0, 1) }}</span>
    </div>
    <p class="font-medium">{{ Auth::user()->name }}</p>
    <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</p>
  </div>
  @endauth

  <!-- Navigation -->
  <nav class="space-y-2">
    @auth
    @if(Auth::user()->isAdmin())
    <a href="/dashboard" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Dashboard
    </a>
    <a href="/calendar" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Calendar
    </a>
    <a href="/recaps" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Recap
    </a>
    <a href="/tasks" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Tasks
    </a>
    <a href="/user/create" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Meetings
    </a>
    <a href="/profile" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Profile
    </a>
    @elseif(Auth::user()->isUser())
    <a href="/user/create" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Meetings
    </a>
    <a href="/calendar" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Calendar
    </a>
    <a href="/user/recaps" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Recap
    </a>
    <a href="/profile" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Profile
    </a>
    @elseif(Auth::user()->isImplementor())
    <a href="/dashboard" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Dashboard
    </a>
    <a href="/calendar" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Calendar
    </a>
    <a href="/recaps" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Recap
    </a>
    <a href="/tasks" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Tasks
    </a>
    <a href="/profile" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 hover:text-black transition">
      Profile
    </a>
    @endif
    @endauth
  </nav>

  <!-- Logout Button -->
  @auth
  <div class="pt-4 border-t">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="w-full px-3 py-2 rounded-md text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-700 transition">
        Logout
      </button>
    </form>
  </div>
  @endauth
</div>
</body>
</html>
