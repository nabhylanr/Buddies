<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Task</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
      <!-- Header -->
      <div class="flex items-center justify-between mb-8">
        <div>
          <h2 class="text-2xl font-bold text-gray-800">Daftar Task</h2>
          <p class="mt-1 text-sm text-gray-600">Kelola semua task dan jadwal Anda.</p>
        </div>
        <a href="{{ route('tasks.create') }}"
            class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-gray-900 text-white text-sm font-semibold shadow hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Tambah Task
        </a>
      </div>

      <!-- Success Message -->
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
          {{ session('success') }}
        </div>
      @endif

      <!-- Filter Dropdown Toast -->
        <div x-data="{ open: false }" class="relative mb-6">
        <div class="flex justify-end">
            <button @click="open = !open"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none">
            <svg class="w-4 h-4 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2H3V4zM3 8h18v12a1 1 0 01-1 1H4a1 1 0 01-1-1V8z" />
            </svg>
            Filter
            </button>
        </div>

        <!-- Floating Panel -->
        <div x-show="open" @click.outside="open = false" x-transition
            class="absolute right-0 mt-2 w-full max-w-md bg-white border border-gray-200 rounded-lg shadow-lg p-6 z-50">
            <form method="GET" action="{{ route('tasks.index') }}" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="date" value="{{ request('date') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-gray-900 focus:ring-2 focus:ring-gray-700 focus:outline-none" />
            </div>

            <!-- Time -->
            <div class="col-span-full">
                <label for="time" class="block text-sm font-medium text-gray-900 mb-1">Jam</label>
                <div class="relative">
                <select name="time" id="time" required
                        class="appearance-none w-full rounded-md bg-white px-3 py-2 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-gray-700 focus:outline-none pr-10">
                    <option value="">Jam</option>
                    @foreach(['10:00', '13:00', '15:00'] as $jam)
                    <option value="{{ $jam }}" {{ old('time', isset($task) ? \Carbon\Carbon::parse($task->datetime)->format('H:i') : '') === $jam ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::createFromFormat('H:i', $jam)->format('H.i') }}
                    </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7l3-3 3 3m0 6l-3 3-3-3"/>
                    </svg>
                </div>
                </div>
            </div>

            <!-- Tempat -->
            <div>
                <label for="place" class="block text-sm font-medium text-gray-700 mb-1">Tempat</label>
                <div class="relative">
                <select name="place" id="place"
                        class="appearance-none w-full rounded-md bg-white px-3 py-2 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-gray-700 focus:outline-none pr-10">
                    <option value="">Tempat</option>
                    @foreach(['Online', 'Offline'] as $tempat)
                    <option value="{{ $tempat }}" {{ request('place') == $tempat ? 'selected' : '' }}>
                        {{ $tempat }}
                    </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7l3-3 3 3m0 6l-3 3-3-3"/>
                    </svg>
                </div>
                </div>
            </div>

            <!-- Implementor -->
            <div>
                <label for="implementor" class="block text-sm font-medium text-gray-700 mb-1">Implementor</label>
                <div class="relative">
                <select name="implementor" id="implementor"
                        class="appearance-none w-full rounded-md bg-white px-3 py-2 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-gray-700 focus:outline-none pr-10">
                    <option value="">Implementor</option>
                    @foreach(['Pipin', 'Adit'] as $person)
                    <option value="{{ $person }}" {{ request('implementor') == $person ? 'selected' : '' }}>
                        {{ $person }}
                    </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7l3-3 3 3m0 6l-3 3-3-3"/>
                    </svg>
                </div>
                </div>
            </div>

            <div class="flex justify-between mt-4">
                <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 hover:underline">Reset</a>
                <button type="submit"
                        class="px-4 py-2 bg-gray-900 text-white text-sm rounded-md shadow hover:bg-gray-700">Terapkan</button>
            </div>
            </form>
        </div>
        </div>

      <!-- Table -->
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
                    <td class="px-6 py-4">
                    @if($task->implementor === 'Pipin')
                        <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-purple-900 dark:text-purple-300">Pipin</span>
                    @elseif($task->implementor === 'Adit')
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">Adit</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-sm">{{ $task->implementor }}</span>
                    @endif
                    </td>
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
