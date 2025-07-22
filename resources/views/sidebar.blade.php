<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Dark Blue Sidebar</title>
  <style>
    .sidebar-gradient {
      background: linear-gradient(135deg, #041e42 0%, #052854 50%, #073161 100%);
    }
    
    .sidebar-item {
      position: relative;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      color: rgba(255, 255, 255, 0.7);
      border-radius: 12px;
      margin-bottom: 4px;
      overflow: hidden;
    }
    
    .sidebar-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .sidebar-item:hover {
      color: #ffffff;
      transform: translateX(4px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }
    
    .sidebar-item:hover::before {
      opacity: 1;
    }
    
    .sidebar-item.current {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
      color: #041e42 !important;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.3);
      font-weight: 600;
    }
    
    .sidebar-item.current::before {
      display: none;
    }
    
    .sidebar-item svg {
      flex-shrink: 0;
    }
    
    .logo-container {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }
    
    .user-section {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.04) 100%);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .avatar-container {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.1) 100%);
      border: 2px solid rgba(255, 255, 255, 0.2);
    }
    
    .logout-btn {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      transition: all 0.3s ease;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }
    
    .logout-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
    }
  </style>
</head>
<body class="bg-gray-50">
<div class="h-full w-64 flex flex-col sidebar-gradient shadow-2xl">
  <!-- Header -->
  <div class="px-6 py-6 flex justify-center items-center">
    <img src="{{ asset('images/koprawhite.png') }}" alt="Kopra Buddies" class="h-20 object-contain scale-150">
  </div>

  <!-- Navigation -->
  <nav class="flex-1 px-4 py-6 space-y-1">
    @auth
    @if(Auth::user()->isAdmin())
    <a href="/dashboard" class="sidebar-item {{ request()->is('dashboard') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
      </svg>
      Dashboard
    </a>
    <a href="/calendar" class="sidebar-item {{ request()->is('calendar') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3M16 7V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
      </svg>
      Calendar
    </a>
    <a href="/recaps" class="sidebar-item {{ request()->is('recaps') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16" />
      </svg>
      Recap
    </a>
    <a href="/tasks" class="sidebar-item {{ request()->is('tasks') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
      </svg>
      Tasks
    </a>
    <a href="/profile" class="sidebar-item {{ request()->is('profile') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
      </svg>
      Profile
    </a>
    @elseif(Auth::user()->isUser())
    <a href="/calendar" class="sidebar-item {{ request()->is('calendar') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3M16 7V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
      </svg>
      Calendar
    </a>
    <a href="/recaps/user" class="sidebar-item {{ request()->is('recaps/user') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16" />
      </svg>
      Recap
    </a>
    <a href="/user/tasks" class="sidebar-item {{ request()->is('user/tasks') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
      </svg>
      Meetings
    </a>
    <a href="/profile" class="sidebar-item {{ request()->is('profile') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
      </svg>
      Profile
    </a>
    @elseif(Auth::user()->isImplementor())
    <a href="/dashboard" class="sidebar-item {{ request()->is('dashboard') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
      </svg>
      Dashboard
    </a>
    <a href="/calendar" class="sidebar-item {{ request()->is('calendar') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3M16 7V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
      </svg>
      Calendar
    </a>
    <a href="/recaps" class="sidebar-item {{ request()->is('recaps') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16" />
      </svg>
      Recap
    </a>
    <a href="/tasks" class="sidebar-item {{ request()->is('tasks') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
      </svg>
      Tasks
    </a>
    <a href="/profile" class="sidebar-item {{ request()->is('profile') ? 'current' : '' }} flex items-center gap-3 px-4 py-3 text-sm font-medium relative z-10">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
      </svg>
      Profile
    </a>
    @endif
    @endauth
  </nav>

  <!-- User Info (Bottom) -->
  @auth
  <div class="p-4 user-section mx-4 mb-6">
    <div class="flex items-center space-x-3 mb-4">
      <div class="w-12 h-12 avatar-container rounded-full flex items-center justify-center">
        <span class="text-white font-bold text-lg">{{ substr(Auth::user()->name, 0, 1) }}</span>
      </div>
      <div class="flex-1 min-w-0">
        <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
        <p class="text-xs text-blue-200">{{ ucfirst(Auth::user()->role) }}</p>
      </div>
    </div>

    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn w-full flex items-center justify-center px-4 py-3 text-sm font-semibold text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
        </svg>
        Logout
      </button>
    </form>
  </div>
  @endauth
</div>
</body>
</html>