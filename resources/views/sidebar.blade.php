<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Sidebar Component</title>
</head>
<body class="bg-gray-50">

<!-- Mobile menu button -->
<div class="lg:hidden fixed top-4 left-4 z-50">
  <button id="mobile-menu-button" class="bg-white p-2 rounded-md shadow-md">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
  </button>
</div>

<!-- Sidebar -->
<div class="fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:inset-0" id="sidebar">
  <!-- Sidebar Header -->
  <div class="flex items-center justify-between h-16 bg-indigo-600 px-4">
    <h1 class="text-white text-xl font-bold">Dashboard</h1>
    <button id="sidebar-close" class="lg:hidden text-white hover:text-gray-200">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>
  
  <!-- Navigation Menu -->
  <nav class="mt-8">
    <div class="px-4 space-y-2">
      <!-- Calendar -->
      <a href="#" class="flex items-center px-4 py-2 text-gray-700 bg-indigo-100 rounded-lg sidebar-item active" data-page="calendar">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        Calendar
      </a>
      
      <!-- Dashboard -->
      <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg sidebar-item" data-page="dashboard">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2H3a2 2 0 00-2 2z"></path>
        </svg>
        Dashboard
      </a>
      
      <!-- Events -->
      <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg sidebar-item" data-page="events">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-5v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2z"></path>
        </svg>
        Events
      </a>
      
      <!-- Tasks -->
      <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg sidebar-item" data-page="tasks">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
        </svg>
        Tasks
      </a>
      
      <!-- Settings -->
      <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg sidebar-item" data-page="settings">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
        Settings
      </a>
    </div>
  </nav>
  
  <!-- User Profile Section -->
  <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200">
    <div class="flex items-center">
      <div class="flex-shrink-0">
        <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center text-white font-semibold">
          JD
        </div>
      </div>
      <div class="ml-3">
        <p class="text-sm font-medium text-gray-900">John Doe</p>
        <p class="text-xs text-gray-500">john@example.com</p>
      </div>
    </div>
  </div>
</div>

<!-- Overlay for mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>

<!-- Main Content Area (for demonstration) -->
<div class="lg:ml-64 p-8">
  <div class="max-w-7xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">Sidebar Component</h2>
    <p class="text-gray-600">This is a reusable sidebar component. Click the menu items to see the active state change.</p>
    
    <!-- Demo cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
      <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-semibold text-gray-900 mb-2">Feature 1</h3>
        <p class="text-gray-600">Responsive sidebar that collapses on mobile</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-semibold text-gray-900 mb-2">Feature 2</h3>
        <p class="text-gray-600">Clean navigation with hover effects</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-semibold text-gray-900 mb-2">Feature 3</h3>
        <p class="text-gray-600">User profile section at the bottom</p>
      </div>
    </div>
  </div>
</div>

<script>
// Sidebar functionality
class Sidebar {
  constructor() {
    this.sidebar = document.getElementById('sidebar');
    this.overlay = document.getElementById('sidebar-overlay');
    this.mobileMenuButton = document.getElementById('mobile-menu-button');
    this.sidebarClose = document.getElementById('sidebar-close');
    this.sidebarItems = document.querySelectorAll('.sidebar-item');
    
    this.init();
  }
  
  init() {
    this.setupEventListeners();
  }
  
  setupEventListeners() {
    // Mobile menu toggle
    this.mobileMenuButton.addEventListener('click', () => this.toggleSidebar());
    this.sidebarClose.addEventListener('click', () => this.closeSidebar());
    this.overlay.addEventListener('click', () => this.closeSidebar());
    
    // Sidebar navigation
    this.sidebarItems.forEach(item => {
      item.addEventListener('click', (e) => {
        e.preventDefault();
        this.setActiveItem(item);
        
        // Close sidebar on mobile after selection
        if (window.innerWidth < 1024) {
          this.closeSidebar();
        }
      });
    });
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
      if (window.innerWidth < 1024) {
        if (!this.sidebar.contains(e.target) && !this.mobileMenuButton.contains(e.target)) {
          this.closeSidebar();
        }
      }
    });
  }
  
  toggleSidebar() {
    this.sidebar.classList.toggle('-translate-x-full');
    this.overlay.classList.toggle('hidden');
  }
  
  closeSidebar() {
    this.sidebar.classList.add('-translate-x-full');
    this.overlay.classList.add('hidden');
  }
  
  setActiveItem(activeItem) {
    // Remove active class from all items
    this.sidebarItems.forEach(item => {
      item.classList.remove('active', 'bg-indigo-100');
      item.classList.add('hover:bg-gray-100');
    });
    
    // Add active class to clicked item
    activeItem.classList.add('active', 'bg-indigo-100');
    activeItem.classList.remove('hover:bg-gray-100');
  }
}

// Initialize sidebar when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  new Sidebar();
});
</script>

</body>
</html>