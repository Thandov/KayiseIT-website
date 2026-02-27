@extends('admin.dashboard.layout')

@section('page-title', $service->name)

@section('content')
    <div class="p-6">
        {{-- Page bar: back + title + action --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard.services') }}" class="flex items-center gap-2 text-gray-500 hover:text-gray-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    <span class="text-sm font-medium">Services</span>
                </a>
                <span class="text-gray-400">/</span>
                <h1 class="text-lg font-semibold text-gray-900 truncate">{{ $service->name }}</h1>
            </div>
            <button type="button" id="add-subservice-btn" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg bg-kb-600 text-white hover:bg-kb-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add subservice
            </button>
        </div>

        <div class="lg:grid lg:grid-cols-12 lg:gap-8">
            {{-- Left: Edit service form --}}
            <div class="lg:col-span-5 xl:col-span-4">
                <div class="sticky top-6">
                    <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Edit service</h2>
                    @include('admin.services._addService')
                </div>
            </div>

            {{-- Right: Subservices --}}
            <div class="mt-10 lg:mt-0 lg:col-span-7 xl:col-span-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Subservices</h2>
                    @if($subservices->isNotEmpty())
                        <span class="text-sm text-gray-400">{{ $subservices->count() }}</span>
                    @endif
                </div>

                @if($subservices->isNotEmpty())
                    <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach($subservices as $subservice)
                        <div class="group flex items-center justify-between gap-3 rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:border-gray-300 hover:shadow transition">
                            <div class="min-w-0 flex-1">
                                <p class="font-medium text-gray-900 truncate">{{ $subservice->name }}</p>
                                <p class="text-sm text-gray-500 mt-0.5">{{ $subservice->price ?? '—' }}</p>
                            </div>
                            <div class="flex items-center gap-1 shrink-0 opacity-0 group-hover:opacity-100 transition">
                                <a href="{{ route('dashboard.subservices.viewsubservice', $subservice->id) }}" class="p-2 text-gray-400 hover:text-kb-600 rounded-md hover:bg-gray-100" title="View">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('dashboard.subservices.deletesubservice') }}" class="inline" onsubmit="return confirm('Delete this subservice?');">
                                    @csrf
                                    <input type="hidden" name="subservice_id" value="{{ $subservice->subserv_id }}">
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 rounded-md hover:bg-gray-100" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-xl border-2 border-dashed border-gray-200 bg-gray-50/50 py-16 text-center">
                        <p class="text-gray-500 mb-2">No subservices yet</p>
                        <button type="button" onclick="document.getElementById('add-subservice-btn').click()" class="text-sm font-medium text-kb-600 hover:text-kb-500">
                            Add your first subservice →
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div id="add-subservice-modal" class="fixed inset-0 z-50 hidden" aria-hidden="true">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" id="add-subservice-modal-backdrop"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto" role="dialog" aria-labelledby="modal-title">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h3 id="modal-title" class="text-base font-semibold text-gray-900">Add subservice</h3>
                    <button type="button" id="add-subservice-modal-close" class="p-2 -m-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100" aria-label="Close">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="p-6">
                    @include('admin.subservices.add-new-subservice')
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            var btn = document.getElementById('add-subservice-btn');
            var modal = document.getElementById('add-subservice-modal');
            var backdrop = document.getElementById('add-subservice-modal-backdrop');
            var closeBtn = document.getElementById('add-subservice-modal-close');

            function openModal() { modal.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
            function closeModal() { modal.classList.add('hidden'); document.body.style.overflow = ''; }

            if (btn) btn.addEventListener('click', openModal);
            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (backdrop) backdrop.addEventListener('click', closeModal);
            modal.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeModal(); });
        })();
    </script>
@endsection
