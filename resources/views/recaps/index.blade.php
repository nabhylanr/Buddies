<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Recap</title>
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
          <h2 class="text-2xl font-bold text-gray-800">Daftar Recap</h2>
          <p class="mt-1 text-sm text-gray-600">Kelola semua recap perusahaan Anda.</p>
        </div>
        <div class="flex space-x-3">
          <a href="{{ route('recaps.create') }}"
              class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-gray-900 text-white text-sm font-semibold shadow hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
              <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              Tambah Recap
          </a>
        </div>
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
          <form method="GET" action="{{ route('recaps.index') }}" class="space-y-4">
            
            <!-- Company ID -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Company ID</label>
              <input type="text" name="company_id" value="{{ request('company_id') }}" placeholder="Cari berdasarkan Company ID"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-gray-900 focus:ring-2 focus:ring-gray-600 focus:outline-none" />
            </div>

            <!-- Nama Perusahaan -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
              <input type="text" name="nama_perusahaan" value="{{ request('nama_perusahaan') }}" placeholder="Cari berdasarkan Nama Perusahaan"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-gray-900 focus:ring-2 focus:ring-gray-600 focus:outline-none" />
            </div>

            <!-- Cabang -->
            <div>
              <label for="cabang" class="block text-sm font-medium text-gray-700 mb-1">Cabang</label>
              <div class="relative">
                <select name="cabang" id="cabang"
                        class="appearance-none w-full rounded-md bg-white px-3 py-2 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-gray-600 focus:outline-none pr-10">
                  <option value="">Semua Cabang</option>
                  @foreach($cabangList as $cabang)
                    <option value="{{ $cabang }}" {{ request('cabang') == $cabang ? 'selected' : '' }}>
                      {{ $cabang }}
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

            <!-- Status -->
            <div>
              <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
              <div class="relative">
                <select name="status" id="status"
                        class="appearance-none w-full rounded-md bg-white px-3 py-2 text-sm text-gray-900 border border-gray-300 focus:ring-2 focus:ring-gray-600 focus:outline-none pr-10">
                  <option value="">Semua Status</option>
                  @foreach($statusList as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                      {{ $status }}
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
              <a href="{{ route('recaps.index') }}" class="text-sm text-gray-600 hover:underline">Reset</a>
              <button type="submit"
                      class="px-4 py-2 bg-gray-900 text-white text-sm rounded-md shadow hover:bg-gray-700">Terapkan</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Table -->
      @if($recaps->isEmpty())
        <div class="text-center py-12">
          <p class="text-gray-500 text-lg">Belum ada recap yang tersedia</p>
          <p class="text-gray-400 text-sm mt-2">Mulai dengan menambahkan recap baru</p>
        </div>
      @else
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th class="px-6 py-3">Company ID</th>
                <th class="px-6 py-3">Nama Perusahaan</th>
                <th class="px-6 py-3">Cabang</th>
                <th class="px-6 py-3">Sales</th>
                <th class="px-6 py-3">Keterangan</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recaps as $recap)
                <tr class="bg-white border-b hover:bg-gray-50">
                  <td class="px-6 py-4 font-medium text-gray-900">{{ $recap->company_id }}</td>
                  <td class="px-6 py-4">{{ $recap->nama_perusahaan }}</td>
                  <td class="px-6 py-4">{{ $recap->cabang }}
                  </td>
                  <td class="px-6 py-4">{{ $recap->sales }}</td>
                  <td class="px-6 py-4">
                    <div class="max-w-xs truncate" title="{{ $recap->keterangan }}">
                      {{ $recap->keterangan ?? '-' }}
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                      {{ $recap->status === 'pending' ? 'bg-red-100 text-red-800' : 
                        ($recap->status === 'scheduled' ? 'bg-blue-100 text-blue-800' : 
                        'bg-green-100 text-green-800') }}">
                      {{ ucfirst($recap->status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 flex space-x-2">
                    <a href="{{ route('recaps.edit', $recap->id) }}"
                       class="text-yellow-600 hover:text-yellow-800 font-medium text-sm">Edit</a>
                    <form action="{{ route('recaps.destroy', $recap->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus recap ini?')">
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

        <!-- Pagination -->
        <div class="mt-4">
          {{ $recaps->appends(request()->input())->links() }}
        </div>
      @endif
    </div>
  </main>
</div>
</body>
</html>