@props(['active' => 'occupations'])

<nav class="flex gap-2 mb-6 border-b border-gray-200 pb-2">
    <a href="{{ route('dashboard.careermapping') }}"
       class="px-4 py-2 rounded-lg text-sm font-semibold min-h-[44px] inline-flex items-center {{ $active === 'occupations' ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
        Occupations
    </a>
    <a href="{{ route('dashboard.modules.index') }}"
       class="px-4 py-2 rounded-lg text-sm font-semibold min-h-[44px] inline-flex items-center {{ $active === 'modules' ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
        Training Modules
    </a>
</nav>
