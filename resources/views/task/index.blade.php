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
            Daftar Task
          </h2>
          <p class="mt-1 text-sm text-gray-600">Kelola semua task dan jadwal Anda</p>
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

      @if($tasks->isEmpty())
        <div class="text-center py-12">
          <div class="bg-gray-50 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
            <!-- Optional icon -->
          </div>
          <p class="text-gray-500 text-lg">Belum ada task yang tersedia</p>
          <p class="text-gray-400 text-sm mt-2">Mulai dengan menambahkan task baru</p>
        </div>
      @else
        <div class="space-y-4">
          @foreach($tasks as $task)
            <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition duration-300 hover:border-indigo-200">
              <div class="flex justify-between items-start">
                <div class="flex-1">
                  <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $task->title }}</h3>
                  <p class="text-gray-600 mb-4 leading-relaxed">{{ $task->description }}</p>

                  <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Tanggal -->
                    <div class="flex items-center text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                      <span class="text-blue-500 mr-2">📅</span>
                      {{ \Carbon\Carbon::parse($task->datetime)->format('d M Y') }}
                    </div>

                    <!-- Waktu -->
                    <div class="flex items-center text-sm text-gray-600 bg-yellow-50 px-3 py-2 rounded-lg">
                      <span class="text-yellow-500 mr-2">🕒</span>
                      {{ \Carbon\Carbon::parse($task->datetime)->format('H:i') }}
                    </div>

                    <!-- Tempat -->
                    <div class="flex items-center text-sm text-gray-600 bg-green-50 px-3 py-2 rounded-lg">
                      <span class="text-green-500 mr-2">📍</span>
                      {{ $task->place }}
                    </div>

                    <!-- Implementor -->
                    <div class="flex items-center text-sm text-gray-600 bg-purple-50 px-3 py-2 rounded-lg md:col-span-3">
                      <span class="text-purple-500 mr-2">👤</span>
                      {{ $task->implementor }}
                    </div>
                  </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex flex-col gap-2 ml-6">
                  <!-- Edit -->
                  <a href="{{ route('tasks.edit', $task->id) }}"
                     class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-yellow-500 text-white text-sm font-semibold shadow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                  </a>

                  <!-- Hapus -->
                  <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus task ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-red-600 text-white text-sm font-semibold shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                      </svg>
                      Hapus
                    </button>
                  </form>
                </div>

              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </main>
</div>
</body>
</html>
