<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Recap</title>
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
    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-100 max-w-2xl mx-auto">
      <!-- Header -->
      <div class="flex items-center justify-between mb-8">
        <div>
          <h2 class="text-2xl font-bold text-gray-800">Edit Recap</h2>
          <p class="mt-1 text-sm text-gray-600">Edit informasi recap perusahaan.</p>
        </div>
        <a href="{{ route('recaps.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
          Kembali
        </a>
      </div>

      <!-- Error Messages -->
      @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
          <div class="flex">
            <div class="flex-shrink-0">
              <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.734-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
              </svg>
            </div>
            <div class="ml-3">
              <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
              <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      @endif

      <!-- Form -->
      <form action="{{ route('recaps.update', $recap->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Company ID -->
        <div>
          <label for="company_id" class="block text-sm font-medium text-gray-700 mb-2">
            Company ID <span class="text-red-500">*</span>
          </label>
          <input type="text" 
                 id="company_id" 
                 name="company_id" 
                 value="{{ old('company_id', $recap->company_id) }}"
                 class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent @error('company_id') border-red-500 @enderror"
                 placeholder="Masukkan Company ID"
                 required>
          @error('company_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Nama Perusahaan -->
        <div>
          <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700 mb-2">
            Nama Perusahaan <span class="text-red-500">*</span>
          </label>
          <input type="text" 
                 id="nama_perusahaan" 
                 name="nama_perusahaan" 
                 value="{{ old('nama_perusahaan', $recap->nama_perusahaan) }}"
                 class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent @error('nama_perusahaan') border-red-500 @enderror"
                 placeholder="Masukkan nama perusahaan"
                 required>
          @error('nama_perusahaan')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Cabang -->
        <div>
          <label for="cabang" class="block text-sm font-medium text-gray-700 mb-2">
            Cabang <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <select id="cabang" 
                    name="cabang" 
                    class="appearance-none w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent @error('cabang') border-red-500 @enderror pr-10"
                    required>
              <option value="">Pilih Cabang</option>
              @foreach(['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Yogyakarta', 'Malang', 'Palembang'] as $cabang)
                <option value="{{ $cabang }}" {{ old('cabang', $recap->cabang) == $cabang ? 'selected' : '' }}>
                  {{ $cabang }}
                </option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7l3-3 3 3m0 6l-3 3-3-3"/>
              </svg>
            </div>
          </div>
          @error('cabang')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Sales -->
        <div>
          <label for="sales" class="block text-sm font-medium text-gray-700 mb-2">
            Sales <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <select id="sales" 
                    name="sales" 
                    class="appearance-none w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent @error('sales') border-red-500 @enderror pr-10"
                    required>
              <option value="">Pilih Sales</option>
              @foreach(['Ahmad', 'Budi', 'Citra', 'Deni', 'Eka', 'Faisal', 'Gina', 'Hendra', 'Indra', 'Joko'] as $sales)
                <option value="{{ $sales }}" {{ old('sales', $recap->sales) == $sales ? 'selected' : '' }}>
                  {{ $sales }}
                </option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7l3-3 3 3m0 6l-3 3-3-3"/>
              </svg>
            </div>
          </div>
          @error('sales')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Keterangan -->
        <div>
          <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
            Keterangan
          </label>
          <textarea id="keterangan" 
                    name="keterangan" 
                    rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent @error('keterangan') border-red-500 @enderror"
                    placeholder="Masukkan keterangan (opsional)">{{ old('keterangan', $recap->keterangan) }}</textarea>
          @error('keterangan')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Info Update -->
        <div class="bg-gray-50 p-4 rounded-md">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="text-sm text-gray-600">
              <p class="font-medium">Informasi Recap</p>
              <p>Dibuat: {{ $recap->created_at->format('d M Y H:i') }}</p>
              @if($recap->updated_at != $recap->created_at)
                <p>Terakhir diupdate: {{ $recap->updated_at->format('d M Y H:i') }}</p>
              @endif
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end space-x-3 pt-6">
          <a href="{{ route('recaps.index') }}" 
             class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            Batal
          </a>
          <button type="submit" 
                  class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Update Recap
          </button>
        </div>
      </form>
    </div>
  </main>
</div>
</body>
</html>