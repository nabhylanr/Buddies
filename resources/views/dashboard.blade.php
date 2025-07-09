<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Task</title>
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
        <div class="flex space-x-3">
          <a href="{{ route('tasks.index') }}"
              class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-semibold shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
              </svg>
              Lihat Semua Task
          </a>
          <a href="{{ route('tasks.create') }}"
              class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-gray-900 text-white text-sm font-semibold shadow hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
              <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              Tambah Task
          </a>
        </div>
      </div>

      <!-- Statistics Bar -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-4 text-white">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-blue-100 text-sm">Total Task</p>
              <p class="text-2xl font-bold">{{ $totalTasks }}</p>
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
              <p class="text-2xl font-bold">{{ $todayTasks }}</p>
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
              <p class="text-2xl font-bold">{{ $weekTasks }}</p>
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
              <p class="text-2xl font-bold">{{ $upcomingTasks }}</p>
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
      <div class="mb-6" x-data="{ currentFilter: 'all' }">
        <div class="flex flex-wrap gap-2">
          <button @click="filterTasks('all')" 
                  :class="currentFilter === 'all' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'"
                  class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            Semua Task
          </button>
          <button @click="filterTasks('today')" 
                  :class="currentFilter === 'today' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'"
                  class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            Hari Ini
          </button>
          <button @click="filterTasks('week')" 
                  :class="currentFilter === 'week' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'"
                  class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            Minggu Ini
          </button>
          <button @click="filterTasks('upcoming')" 
                  :class="currentFilter === 'upcoming' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'"
                  class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            Mendatang
          </button>
        </div>
      </div>

      <!-- Task List -->
      <div id="taskContainer">
        @if($tasks->isEmpty())
          <div class="text-center py-12">
            <div class="bg-gray-50 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
              <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
              </svg>
            </div>
            <p class="text-gray-500 text-lg">Belum ada task yang tersedia</p>
            <p class="text-gray-400 text-sm mt-2">Mulai dengan menambahkan task baru</p>
          </div>
        @else
          <div id="taskList" class="space-y-4">
            @foreach($tasks as $task)
              <div class="task-item bg-white rounded-xl p-6 border border-gray-200 hover:shadow-xl transition-all duration-300 hover:border-indigo-200 transform hover:-translate-y-1"
                   data-date="{{ $task->datetime->format('Y-m-d') }}"
                   data-datetime="{{ $task->datetime->toISOString() }}">
                <div class="flex justify-between items-start">
                  <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $task->title }}</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">{{ $task->description }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                      <div class="flex items-center text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                        <span class="text-blue-500 mr-2">🕒</span>
                        {{ $task->datetime->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
                      </div>
                      <div class="flex items-center text-sm text-gray-600 bg-green-50 px-3 py-2 rounded-lg">
                        <span class="text-green-500 mr-2">📍</span>
                        {{ $task->place }}
                      </div>
                      <div class="flex items-center text-sm text-gray-600 bg-purple-50 px-3 py-2 rounded-lg">
                        <span class="text-purple-500 mr-2">👤</span>
                        @if($task->implementor === 'Pipin')
                          <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-1 rounded">Pipin</span>
                        @elseif($task->implementor === 'Adit')
                          <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded">Adit</span>
                        @else
                          <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-1 rounded">{{ $task->implementor }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="flex justify-between items-center">
                      <div class="flex space-x-2">
                        <a href="{{ route('tasks.edit', $task->id) }}"
                           class="text-yellow-600 hover:text-yellow-800 font-medium text-sm px-3 py-1 rounded-md hover:bg-yellow-50 transition-colors">
                          Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" 
                                  class="text-red-600 hover:text-red-800 font-medium text-sm px-3 py-1 rounded-md hover:bg-red-50 transition-colors"
                                  onclick="return confirm('Yakin ingin menghapus task ini?')">
                            Hapus
                          </button>
                        </form>
                      </div>
                      
                      <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-green-600 text-white text-sm font-semibold shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                                onclick="return confirm('Tandai task ini sebagai selesai?')">
                          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                          </svg>
                          Selesai
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
function filterTasks(filter) {
  const taskItems = document.querySelectorAll('.task-item');
  const today = new Date();
  
  taskItems.forEach(item => {
    const taskDate = new Date(item.dataset.datetime);
    let shouldShow = false;
    
    switch(filter) {
      case 'today':
        shouldShow = taskDate.toDateString() === today.toDateString();
        break;
      case 'week':
        const startOfWeek = new Date(today);
        startOfWeek.setDate(today.getDate() - today.getDay());
        const endOfWeek = new Date(startOfWeek);
        endOfWeek.setDate(startOfWeek.getDate() + 6);
        shouldShow = taskDate >= startOfWeek && taskDate <= endOfWeek;
        break;
      case 'upcoming':
        shouldShow = taskDate > today;
        break;
      default:
        shouldShow = true;
    }
    
    if (shouldShow) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
}

// Bind filter function to window for Alpine.js
window.filterTasks = filterTasks;
</script>
</body>
</html>