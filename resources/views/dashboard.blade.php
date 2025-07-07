<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen">

  <div class="flex h-full">
    <!-- Sidebar -->
    <div class="w-64 bg-white border-r border-gray-200">
      @include('sidebar')
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto p-6 space-y-6">
      <!-- Ringkasan -->
      <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Ringkasan Hari Ini</h2>
        <p class="text-3xl font-bold text-indigo-600" id="todayTaskCount">0</p>
        <p class="text-gray-500">Task yang dijadwalkan hari ini</p>
      </div>

      <!-- Reminder -->
      <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Reminder Task Hari Ini</h2>
        <ul id="todayTaskList" class="space-y-3">
          <li class="text-gray-500">Memuat...</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const events = {
        '2025-07-06': [
          { title: 'Stand-up Meeting', time: '09:00', datetime: '2025-07-06T09:00' },
          { title: 'Submit Laporan', time: '14:00', datetime: '2025-07-06T14:00' }
        ],
        '2025-07-07': [
          { title: 'Review Progress', time: '10:00', datetime: '2025-07-07T10:00' }
        ]
      };

      const todayKey = new Date().toISOString().split('T')[0];
      const todayTasks = events[todayKey] || [];

      const countEl = document.getElementById('todayTaskCount');
      const listEl = document.getElementById('todayTaskList');

      countEl.textContent = todayTasks.length;

      if (todayTasks.length === 0) {
        listEl.innerHTML = '<li class="text-gray-500">Tidak ada task hari ini.</li>';
      } else {
        listEl.innerHTML = todayTasks.map(task => `
          <li class="flex items-start justify-between border-b pb-2">
            <div>
              <p class="font-medium text-gray-700">${task.title}</p>
              <time class="text-sm text-gray-500">${task.time}</time>
            </div>
            <span class="inline-block px-2 py-1 text-xs text-white bg-indigo-500 rounded">
              ${new Date(task.datetime).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}
            </span>
          </li>
        `).join('');
      }
    });
  </script>

</body>
</html>
