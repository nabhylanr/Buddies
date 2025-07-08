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
          <h2 class="text-2xl font-bold text-gray-800">Daftar Task</h2>
          <p class="mt-1 text-sm text-gray-600">Kelola semua task dan jadwal Anda.</p>
        </div>
        <a href="{{ route('tasks.create') }}"
           class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-semibold shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
          </svg>
          Tambah Task
        </a>
      </div>

      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
          {{ session('success') }}
        </div>
      @endif

      <!-- Filter Form -->
      <form method="GET" action="{{ route('tasks.index') }}" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <input type="date" name="date" value="{{ request('date') }}"
               class="border border-gray-300 rounded-md px-3 py-2 text-sm" />

        <select name="time" class="border border-gray-300 rounded-md px-3 py-2 text-sm">
          <option value="">Pilih Jam</option>
          @foreach(['10:00', '13:00', '15:00'] as $jam)
            <option value="{{ $jam }}" {{ request('time') == $jam ? 'selected' : '' }}>
              {{ \Carbon\Carbon::createFromFormat('H:i', $jam)->format('H.i') }}
            </option>
          @endforeach
        </select>

        <select name="place" class="border border-gray-300 rounded-md px-3 py-2 text-sm">
          <option value="">Pilih Tempat</option>
          @foreach(['Online', 'Offline'] as $tempat)
            <option value="{{ $tempat }}" {{ request('place') == $tempat ? 'selected' : '' }}>{{ $tempat }}</option>
          @endforeach
        </select>

        <select name="implementor" class="border border-gray-300 rounded-md px-3 py-2 text-sm">
          <option value="">Pilih Implementor</option>
          @foreach(['Pipin', 'Adit'] as $person)
            <option value="{{ $person }}" {{ request('implementor') == $person ? 'selected' : '' }}>{{ $person }}</option>
          @endforeach
        </select>

        <div class="md:col-span-4 flex justify-end gap-2 mt-2">
          <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md shadow hover:bg-indigo-700">Filter</button>
          <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-200 text-sm rounded-md hover:bg-gray-300">Reset</a>
        </div>
      </form>

      @if($tasks->isEmpty())
        <div class="text-center py-12">
          <p class="text-gray-500 text-lg">Belum ada task yang tersedia</p>
          <p class="text-gray-400 text-sm mt-2">Mulai dengan menambahkan task baru</p>
        </div>
      @else
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th class="px-6 py-3">Judul</th>
                <th class="px-6 py-3">Tanggal</th>
                <th class="px-6 py-3">Jam</th>
                <th class="px-6 py-3">Tempat</th>
                <th class="px-6 py-3">Implementor</th>
                <th class="px-6 py-3">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tasks as $task)
                <tr class="bg-white border-b hover:bg-gray-50">
                  <td class="px-6 py-4 font-medium text-gray-900">{{ $task->title }}</td>
                  <td class="px-6 py-4">{{ \Carbon\Carbon::parse($task->datetime)->format('d M Y') }}</td>
                  <td class="px-6 py-4">{{ \Carbon\Carbon::parse($task->datetime)->format('H:i') }}</td>
                  <td class="px-6 py-4">{{ $task->place }}</td>
                  <td class="px-6 py-4">{{ $task->implementor }}</td>
                  <td class="px-6 py-4 flex space-x-2">
                    <a href="{{ route('tasks.edit', $task->id) }}"
                       class="text-yellow-600 hover:text-yellow-800 font-medium text-sm">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus task ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">Hapus</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </main>
</div>
</body>
</html>
