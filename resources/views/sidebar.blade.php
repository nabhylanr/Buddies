<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Sidebar</title>
  <style>
    .sidebar-item {
      position: relative;
      transition: all 0.2s ease;
    }
    .sidebar-item:hover {
      background-color: #f8fafc;
    }
    .sidebar-item.active {
      background-color: #000000; /* Klik jadi hitam */
      color: white !important;
    }
    .sidebar-item.current {
      background-color: #000000;
      color: white !important;
    }
  </style>
</head>
<body class="bg-gray-50">
<div class="h-full bg-white shadow-lg w-64 flex flex-col">
  <!-- Header -->
    <div class="px-6 py-6 border-b border-gray-100">
    <div class="flex justify-center items-center">
        <img src="{{ asset('images/buddies.png') }}" alt="Kopra Buddies" class="h-16 object-contain">
    </div>
    </div>


  <!-- Navigation -->
  <nav class="flex-1 px-3 py-4 space-y-1">
    @auth
    @if(Auth::user()->isAdmin())
    <a href="/dashboard" class="sidebar-item {{ request()->is('dashboard') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Dashboard
    </a>
    <a href="/calendar" class="sidebar-item {{ request()->is('calendar') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Calendar
    </a>
    <a href="/recaps" class="sidebar-item {{ request()->is('recaps') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Recap
    </a>
    <a href="/tasks" class="sidebar-item {{ request()->is('tasks') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Tasks
    </a>
    <a href="/profile" class="sidebar-item {{ request()->is('profile') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Profile
    </a>
    @elseif(Auth::user()->isUser())
    <a href="/calendar" class="sidebar-item {{ request()->is('calendar') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Calendar
    </a>
    <a href="/recaps/user" class="sidebar-item {{ request()->is('recaps/user') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Recap
    </a>
    <a href="/user/tasks" class="sidebar-item {{ request()->is('user/tasks') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Meetings
    </a>
    <a href="/profile" class="sidebar-item {{ request()->is('profile') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Profile
    </a>
    @elseif(Auth::user()->isImplementor())
    <a href="/dashboard" class="sidebar-item {{ request()->is('dashboard') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Dashboard
    </a>
    <a href="/calendar" class="sidebar-item {{ request()->is('calendar') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Calendar
    </a>
    <a href="/recaps" class="sidebar-item {{ request()->is('recaps') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Recap
    </a>
    <a href="/tasks" class="sidebar-item {{ request()->is('tasks') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Tasks
    </a>
    <a href="/profile" class="sidebar-item {{ request()->is('profile') ? 'current' : '' }} flex items-center px-3 py-2.5 rounded-lg text-sm font-medium">
      Profile
    </a>
    @endif
    @endauth
  </nav>

  <!-- User Info (Bottom) -->
  @auth
  <div class="p-4 border-t border-gray-100">
    <div class="flex items-center space-x-3 mb-3">
      <div class="w-10 h-10 avatar-container relative rounded-full flex items-center justify-center bg-gray-200">
        <span class="text-gray-600 font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
      </div>
      <div class="flex-1 min-w-0">
        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
        <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</p>
      </div>
    </div>
    
    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="w-full flex items-center px-3 py-2 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-700 transition">
        Logout
      </button>
    </form>
  </div>
  @endauth
</div>

<script>
  // Removed click handler to prevent double active states during page loading
  // Active state is now handled only by server-side 'current' class
</script>
</body>
</html>