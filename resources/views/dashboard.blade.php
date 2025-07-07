<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Task</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen">
<div class="flex h-screen">
  <!-- Sidebar -->
  <aside class="w-64 bg-white border-r border-gray-200 shadow-lg">
    @include('sidebar')
  </aside>

  <!-- Main Content -->
  <main class="flex-1 overflow-y-auto p-6">
    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-100">
      <div class="flex items-center justify-between mb-8">
        <div>
          <h2 class="text-2xl font-bold text-gray-800 flex items-center">
            Dashboard
          </h2>
        </div>
      </div>

      <!-- Statistics Bar -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-4 text-white">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-blue-100 text-sm">Total Task</p>
              <p class="text-2xl font-bold" id="totalTaskCount">0</p>
            </div>
            <div class="text-blue-200">
              <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
          </div>
        </div>
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-4 text-white">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-green-100 text-sm">Hari Ini</p>
              <p class="text-2xl font-bold" id="todayTaskCount">0</p>
            </div>
            <div class="text-green-200">
              <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/>
              </svg>
            </div>
          </div>
        </div>
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl p-4 text-white">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-yellow-100 text-sm">Minggu Ini</p>
              <p class="text-2xl font-bold" id="weekTaskCount">0</p>
            </div>
            <div class="text-yellow-200">
              <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5z"/>
              </svg>
            </div>
          </div>
        </div>
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-4 text-white">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-purple-100 text-sm">Mendatang</p>
              <p class="text-2xl font-bold" id="upcomingTaskCount">0</p>
            </div>
            <div class="text-purple-200">
              <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
              </svg>
            </div>
          </div>
        </div>
      </div>

      @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl flex items-center">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
          </svg>
          {{ session('success') }}
        </div>
      @endif

      <!-- Filter Options -->
      <div class="mb-6">
        <div class="flex flex-wrap gap-2">
          <button onclick="filterTasks('all')" class="filter-btn px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium">
            Semua Task
          </button>
          <button onclick="filterTasks('today')" class="filter-btn px-4 py-2 rounded-lg bg-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-300">
            Hari Ini
          </button>
          <button onclick="filterTasks('week')" class="filter-btn px-4 py-2 rounded-lg bg-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-300">
            Minggu Ini
          </button>
          <button onclick="filterTasks('upcoming')" class="filter-btn px-4 py-2 rounded-lg bg-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-300">
            Mendatang
          </button>
        </div>
      </div>

      <!-- Task List -->
      <div id="taskContainer">
        <div id="loadingState" class="text-center py-12">
          <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600 mx-auto mb-4"></div>
          <p class="text-gray-500">Memuat task...</p>
        </div>
        
        <div id="emptyState" class="text-center py-12 hidden">
          <div class="bg-gray-50 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
          </div>
          <p class="text-gray-500 text-lg">Belum ada task yang tersedia</p>
          <p class="text-gray-400 text-sm mt-2">Mulai dengan menambahkan task baru</p>
        </div>

        <div id="taskList" class="space-y-4 hidden">
          <!-- Task items will be populated here -->
        </div>
      </div>
    </div>
  </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Sample task data - replace with actual API call
  const tasks = [
    {
      id: 1,
      title: 'Meeting dengan Tim Development',
      description: 'Diskusi progress project dan planning sprint berikutnya',
      datetime: '2025-07-07T10:00:00',
      place: 'Ruang Meeting A',
      implementor: 'John Doe'
    },
    {
      id: 2,
      title: 'Review Code Frontend',
      description: 'Review dan testing fitur baru pada aplikasi web',
      datetime: '2025-07-07T14:30:00',
      place: 'Office Remote',
      implementor: 'Jane Smith'
    },
    {
      id: 3,
      title: 'Presentasi Proposal Project',
      description: 'Presentasi proposal project baru kepada client',
      datetime: '2025-07-08T09:00:00',
      place: 'Client Office',
      implementor: 'Bob Johnson'
    },
    {
      id: 4,
      title: 'Training Database Management',
      description: 'Pelatihan manajemen database untuk tim backend',
      datetime: '2025-07-10T13:00:00',
      place: 'Training Room B',
      implementor: 'Alice Brown'
    },
    {
      id: 5,
      title: 'Deploy Production Server',
      description: 'Deployment aplikasi ke production server',
      datetime: '2025-07-12T11:00:00',
      place: 'Server Room',
      implementor: 'Charlie Wilson'
    }
  ];

  let currentFilter = 'all';
  let filteredTasks = tasks;

  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
      day: '2-digit',
      month: 'short',
      year: 'numeric'
    }) + ', ' + date.toLocaleTimeString('id-ID', {
      hour: '2-digit',
      minute: '2-digit'
    });
  }

  function isToday(dateString) {
    const today = new Date();
    const taskDate = new Date(dateString);
    return today.toDateString() === taskDate.toDateString();
  }

  function isThisWeek(dateString) {
    const today = new Date();
    const taskDate = new Date(dateString);
    const startOfWeek = new Date(today.setDate(today.getDate() - today.getDay()));
    const endOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 6));
    return taskDate >= startOfWeek && taskDate <= endOfWeek;
  }

  function isUpcoming(dateString) {
    const today = new Date();
    const taskDate = new Date(dateString);
    return taskDate > today;
  }

  function updateStatistics() {
    const totalTasks = tasks.length;
    const todayTasks = tasks.filter(task => isToday(task.datetime)).length;
    const weekTasks = tasks.filter(task => isThisWeek(task.datetime)).length;
    const upcomingTasks = tasks.filter(task => isUpcoming(task.datetime)).length;

    document.getElementById('totalTaskCount').textContent = totalTasks;
    document.getElementById('todayTaskCount').textContent = todayTasks;
    document.getElementById('weekTaskCount').textContent = weekTasks;
    document.getElementById('upcomingTaskCount').textContent = upcomingTasks;
  }

  function filterTasks(filter) {
    currentFilter = filter;
    
    // Update filter buttons
    document.querySelectorAll('.filter-btn').forEach(btn => {
      btn.classList.remove('bg-indigo-600', 'text-white');
      btn.classList.add('bg-gray-200', 'text-gray-700');
    });
    event.target.classList.add('bg-indigo-600', 'text-white');
    event.target.classList.remove('bg-gray-200', 'text-gray-700');

    // Filter tasks
    switch(filter) {
      case 'today':
        filteredTasks = tasks.filter(task => isToday(task.datetime));
        break;
      case 'week':
        filteredTasks = tasks.filter(task => isThisWeek(task.datetime));
        break;
      case 'upcoming':
        filteredTasks = tasks.filter(task => isUpcoming(task.datetime));
        break;
      default:
        filteredTasks = tasks;
    }

    renderTasks();
  }

  function renderTasks() {
    const taskContainer = document.getElementById('taskContainer');
    const loadingState = document.getElementById('loadingState');
    const emptyState = document.getElementById('emptyState');
    const taskList = document.getElementById('taskList');

    // Hide loading
    loadingState.classList.add('hidden');

    if (filteredTasks.length === 0) {
      emptyState.classList.remove('hidden');
      taskList.classList.add('hidden');
      return;
    }

    emptyState.classList.add('hidden');
    taskList.classList.remove('hidden');

    const taskHTML = filteredTasks.map(task => `
      <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-xl transition-all duration-300 hover:border-indigo-200 transform hover:-translate-y-1">
        <div class="flex justify-between items-start">
          <div class="flex-1">
            <h3 class="text-xl font-bold text-gray-800 mb-2">${task.title}</h3>
            <p class="text-gray-600 mb-4 leading-relaxed">${task.description}</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
              <div class="flex items-center text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                <span class="text-blue-500 mr-2">🕒</span>
                ${formatDate(task.datetime)}
              </div>
              <div class="flex items-center text-sm text-gray-600 bg-green-50 px-3 py-2 rounded-lg">
                <span class="text-green-500 mr-2">📍</span>
                ${task.place}
              </div>
              <div class="flex items-center text-sm text-gray-600 bg-purple-50 px-3 py-2 rounded-lg">
                <span class="text-purple-500 mr-2">👤</span>
                ${task.implementor}
              </div>
            </div>
          </div>
        </div>
      </div>
    `).join('');

    taskList.innerHTML = taskHTML;
  }

  function deleteTask(taskId) {
    if (confirm('Yakin ingin menghapus task ini?')) {
      // In real application, make API call to delete task
      console.log('Deleting task with ID:', taskId);
      // For demo purposes, we'll just show an alert
      alert('Task berhasil dihapus! (Demo)');
    }
  }

  // Make deleteTask function global
  window.deleteTask = deleteTask;
  window.filterTasks = filterTasks;

  // Initialize
  updateStatistics();
  renderTasks();

  // Auto-refresh every 30 seconds
  setInterval(() => {
    updateStatistics();
    renderTasks();
  }, 30000);
});
</script>
</body>
</html>