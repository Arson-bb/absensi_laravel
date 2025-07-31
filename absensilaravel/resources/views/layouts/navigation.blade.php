<nav class="bg-gray-800">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6">
            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>

      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            @if(auth()->user()->role->name === 'admin')
              <a href="{{ route('admin.absensi.rekap') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Rekap Absensi</a>
              <a href="{{ route('admin.users.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Manajemen User</a>
            @else
              <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
              <a href="{{ route('user.absen.riwayat') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Riwayat</a>
              <a href="{{ route('profile.edit') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Profil</a>
            @endif
          </div>
        </div>
      </div>

      <div class="absolute inset-y-0 right-0 flex items-center pr-2">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</button>
        </form>
      </div>
    </div>
  </div>

  <div id="mobile-menu" class="sm:hidden hidden">
    <div class="space-y-1 px-2 pt-2 pb-3">
      @if(auth()->user()->role->name === 'admin')
        <a href="{{ route('admin.absensi.rekap') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Rekap Absensi</a>
        <a href="{{ route('admin.users.index') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Manajemen User</a>
      @else
        <a href="{{ route('dashboard') }}" class="block rounded-md px-3 py-2 text-base font-medium text-white bg-gray-900">Dashboard</a>
        <a href="{{ route('user.absen.riwayat') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Riwayat</a>
        <a href="{{ route('profile.edit') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Profil</a>
      @endif
    </div>
  </div>
</nav>
