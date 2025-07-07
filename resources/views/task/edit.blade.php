<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Task</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen">

<div class="flex h-full">
  <!-- Sidebar -->
  <aside class="w-64 bg-white border-r border-gray-200">
    @include('sidebar')
  </aside>

  <!-- Main Content -->
  <main class="flex-1 overflow-y-auto p-10">
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-2xl font-bold mb-6">Edit Task</h2>

      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
          {{ session('success') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h3 class="text-lg font-semibold text-gray-900">Informasi Task</h3>
            <p class="mt-1 text-sm text-gray-600">Perbarui detail task.</p>

            <div class="mt-10 grid grid-cols-1 gap-y-8">

              <!-- Title -->
              <div class="col-span-full">
                <label for="title" class="block text-sm font-medium text-gray-900">Judul Task</label>
                <div class="mt-2">
                  <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required
                    class="w-full rounded-md bg-white px-3 py-2 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>
              </div>

              <!-- Description -->
              <div class="col-span-full">
                <label for="description" class="block text-sm font-medium text-gray-900">Deskripsi</label>
                <div class="mt-2">
                  <textarea name="description" id="description" rows="4" required
                    class="w-full rounded-md bg-white px-3 py-2 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description', $task->description) }}</textarea>
                </div>
              </div>

              <!-- Datetime -->
              <div class="col-span-full">
                <label for="datetime" class="block text-sm font-medium text-gray-900">Waktu</label>
                <div class="mt-2">
                  <input type="datetime-local" name="datetime" id="datetime" value="{{ old('datetime', \Carbon\Carbon::parse($task->datetime)->format('Y-m-d\TH:i')) }}" required
                    class="w-full rounded-md bg-white px-3 py-2 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>
              </div>

              <!-- Place -->
              <div class="col-span-full">
                <label for="place" class="block text-sm font-medium text-gray-900">Tempat</label>
                <div class="mt-2">
                  <input type="text" name="place" id="place" value="{{ old('place', $task->place) }}" required
                    class="w-full rounded-md bg-white px-3 py-2 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>
              </div>

              <!-- Implementor -->
              <div class="col-span-full">
                <label for="implementor" class="block text-sm font-medium text-gray-900">Implementor</label>
                <div class="mt-2">
                  <input type="text" name="implementor" id="implementor" value="{{ old('implementor', $task->implementor) }}" required
                    class="w-full rounded-md bg-white px-3 py-2 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
          <a href="{{ route('tasks.index') }}" class="text-sm font-semibold text-gray-700 hover:underline">Kembali</a>
          <button type="submit"
            class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-indigo-600">
            Update Task
          </button>
        </div>
      </form>
    </div>
  </main>
</div>

</body>
</html>
