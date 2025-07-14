<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    body { font-family: 'Inter', sans-serif; }
    
    .profile-card {
      background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
      transition: all 0.3s ease;
    }
    
    .info-box {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      border: 1px solid #e2e8f0;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    
    .info-box::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 2px;
      background: linear-gradient(90deg, #64748b, #94a3b8, #64748b);
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .info-box:hover::before {
      opacity: 1;
    }
    
    .info-box:hover {
      transform: translateX(2px);
      border-color: #cbd5e1;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
    }
    
    .avatar-container {
      background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), inset 0 2px 4px rgba(255, 255, 255, 0.8);
      position: relative;
      overflow: hidden;
    }
    
    .avatar-container::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      transform: rotate(-45deg);
      transition: transform 0.6s ease;
    }
    
    .avatar-container:hover::before {
      transform: rotate(-45deg) translate(50%, 50%);
    }
    
    .floating-header {
      animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-3px); }
    }
    
    .label-enhanced {
      position: relative;
      display: inline-block;
    }
    
    .label-enhanced::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 1px;
      background: linear-gradient(90deg, #64748b, #94a3b8);
      transition: width 0.3s ease;
    }
    
    .info-box:hover .label-enhanced::after {
      width: 100%;
    }
    
    .text-shimmer {
      background: linear-gradient(45deg, #374151, #6b7280, #374151);
      background-size: 200% 200%;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: shimmer 3s ease-in-out infinite;
    }
    
    @keyframes shimmer {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }
  </style>
</head>
<body class="bg-gray-50 h-screen">

<div class="flex h-full">
  <!-- Sidebar -->
  <aside class="w-64 bg-white border-r border-gray-200">
    @include('sidebar')
  </aside>

  <main class="flex-1 overflow-y-auto p-6">
    <div class="profile-card bg-white p-8 rounded-xl shadow-xl border border-gray-100">
      <!-- Header -->
      <div class="flex items-center justify-between mb-8">
        <div class="floating-header">
          <h2 class="text-2xl font-bold text-shimmer">Profile</h2>
          <p class="mt-1 text-sm text-gray-600">Kelola profile account Anda.</p>
        </div>
        <div class="relative">
          <div class="w-8 h-8 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center shadow-sm">
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
        </div>
      </div>

      @auth
      <!-- Avatar + Info -->
      <div class="flex items-center space-x-4 mb-6">
        <div class="relative">
          <div class="avatar-container relative inline-flex items-center justify-center w-14 h-14 overflow-hidden rounded-full">
            <span class="font-medium text-gray-600 text-lg relative z-10">
              {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </span>
          </div>
          <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white shadow-sm animate-pulse"></div>
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
          <label class="label-enhanced block text-sm font-medium text-gray-700 mb-1">Name</label>
          <div class="info-box rounded-md p-3 shadow-sm">
            <div class="flex items-center">
              <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              <p class="text-gray-800 font-medium">{{ Auth::user()->name }}</p>
            </div>
          </div>
        </div>

        <div>
          <label class="label-enhanced block text-sm font-medium text-gray-700 mb-1">Email</label>
          <div class="info-box rounded-md p-3 shadow-sm">
            <div class="flex items-center">
              <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              <p class="text-gray-800 font-medium">{{ Auth::user()->email }}</p>
            </div>
          </div>
        </div>

        <div>
          <label class="label-enhanced block text-sm font-medium text-gray-700 mb-1">Role</label>
          <div class="info-box rounded-md p-3 shadow-sm">
            <div class="flex items-center">
              <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
              <p class="text-gray-800 font-medium capitalize">{{ Auth::user()->role }}</p>
            </div>
          </div>
        </div>
      </div>
      @endauth

    </div>
  </main>
</div>

</body>
</html>