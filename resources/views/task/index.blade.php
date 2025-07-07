<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Task</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen">

  <div class="flex h-full">
    <aside class="w-64 bg-white border-r border-gray-200">
      @include('sidebar')
    </aside>

    <main class="flex-1 overflow-y-auto p-6">
      <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Daftar Task</h2>

        <a href="{{ route('tasks.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-indigo-600">Tambah Task</a>

        @if($tasks->isEmpty())
          <p class="text-gray-600">Belum ada task.</p>
        @else
          <ul class="divide-y divide-gray-200">
            @foreach($tasks as $task)
              <li class="py-4">
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h3>
                  <p class="text-sm text-gray-600">{{ $task->description }}</p>
                  <p class="text-sm text-gray-500">🕒 {{ \Carbon\Carbon::parse($task->datetime)->format('d M Y, H:i') }}</p>
                  <p class="text-sm text-gray-500">📍 {{ $task->place }}</p>
                  <p class="text-sm text-gray-500">👤 {{ $task->implementor }}</p>
                </div>
              </li>
            @endforeach
          </ul>
        @endif
      </div>
    </main>
  </div>

</body>
</html>
