@php $userProjects = $userProjects ?? collect(); @endphp

{{-- ── My Projects ─────────────────────────────────────────────────────── --}}
<div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-lg font-semibold text-gray-900">My Projects</h4>
        <button onclick="openProjectModal()"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            + Add Project
        </button>
    </div>

    @if($userProjects->isEmpty())
        <div class="text-center py-10 text-gray-400">
            <svg class="mx-auto mb-3 w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h18M3 12h18M3 17h18"/>
            </svg>
            <p class="text-sm">No projects yet. Add your first one!</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($userProjects as $project)
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-2">
                    <h5 class="font-semibold text-gray-900">{{ $project->title }}</h5>
                    <span class="text-xs font-medium px-2.5 py-0.5 rounded-full
                        {{ $project->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $project->status === 'published' ? 'Published' : 'In Progress' }}
                    </span>
                </div>
                @if($project->description)
                    <p class="text-sm text-gray-600 mb-3">{{ $project->description }}</p>
                @endif

                <div class="flex flex-wrap gap-2">
                    @if($project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm font-medium transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            View Live
                        </a>
                    @endif
                    @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-1 bg-gray-800 hover:bg-gray-900 text-white px-3 py-1 rounded text-sm font-medium transition-colors">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                            GitHub
                        </a>
                    @endif
                    @if($project->gitlab_url)
                        <a href="{{ $project->gitlab_url }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-1 bg-orange-600 hover:bg-orange-700 text-white px-3 py-1 rounded text-sm font-medium transition-colors">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.65 14.39L12 22.13 1.35 14.39a.84.84 0 01-.3-.94l1.22-3.78 2.44-7.51A.42.42 0 014.82 2a.43.43 0 01.58 0 .42.42 0 01.11.18l2.44 7.49h8.1l2.44-7.51A.42.42 0 0118.6 2a.43.43 0 01.58 0 .42.42 0 01.11.18l2.44 7.51L23 13.45a.84.84 0 01-.35.94z"/></svg>
                            GitLab
                        </a>
                    @endif
                    @if($project->bitbucket_url)
                        <a href="{{ $project->bitbucket_url }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-1 bg-blue-700 hover:bg-blue-800 text-white px-3 py-1 rounded text-sm font-medium transition-colors">
                            Bitbucket
                        </a>
                    @endif
                    @if($project->other_platform_url)
                        <a href="{{ $project->other_platform_url }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-1 bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-sm font-medium transition-colors">
                            {{ $project->other_platform_label ?: 'View' }}
                        </a>
                    @endif

                    <button onclick="openProjectModal({{ $project->id }}, @json($project))"
                            class="inline-flex items-center gap-1 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 px-3 py-1 rounded text-sm font-medium transition-colors border border-indigo-200">
                        Edit
                    </button>
                    <form action="{{ route('user.projects.destroy', $project->id) }}" method="POST"
                          onsubmit="return confirm('Remove this project?')" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1 rounded text-sm font-medium transition-colors border border-red-200">
                            Remove
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

{{-- ── Add / Edit Project Modal ─────────────────────────────────────────── --}}
<div id="project-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-modal="true" role="dialog">
    <div class="flex min-h-full items-center justify-center p-4">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-gray-900/50 transition-opacity" onclick="closeProjectModal()"></div>

        <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto z-10">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h3 id="modal-title" class="text-base font-semibold text-gray-900">Add Project</h3>
                <button onclick="closeProjectModal()" class="text-gray-400 hover:text-gray-600 rounded">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form id="project-form" method="POST" action="{{ route('user.projects.store') }}" class="px-6 py-5 space-y-4">
                @csrf
                <span id="method-field"></span>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">
                        Project Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="modal-title-input" required maxlength="255"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Description</label>
                    <textarea name="description" id="modal-description" rows="3" maxlength="1000"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Status</label>
                    <select name="status" id="modal-status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="in_progress">In Progress</option>
                        <option value="published">Published</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Live URL</label>
                    <input type="url" name="live_url" id="modal-live-url" placeholder="https://myproject.com"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                            GitHub
                        </label>
                        <input type="url" name="github_url" id="modal-github" placeholder="https://github.com/…"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">GitLab</label>
                        <input type="url" name="gitlab_url" id="modal-gitlab" placeholder="https://gitlab.com/…"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Bitbucket</label>
                        <input type="url" name="bitbucket_url" id="modal-bitbucket" placeholder="https://bitbucket.org/…"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Other platform name</label>
                        <input type="text" name="other_platform_label" id="modal-other-label" placeholder="e.g. Replit, Vercel…" maxlength="100"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-1">Other platform URL</label>
                        <input type="url" name="other_platform_url" id="modal-other-url" placeholder="https://…"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-2 border-t border-gray-100">
                    <button type="button" onclick="closeProjectModal()"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold transition">
                        Save project
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openProjectModal(id, project) {
    const modal   = document.getElementById('project-modal');
    const form    = document.getElementById('project-form');
    const title   = document.getElementById('modal-title');
    const method  = document.getElementById('method-field');

    if (id && project) {
        title.textContent = 'Edit Project';
        form.action = '/my-projects/' + id;
        method.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('modal-title-input').value  = project.title        || '';
        document.getElementById('modal-description').value  = project.description  || '';
        document.getElementById('modal-status').value       = project.status       || 'in_progress';
        document.getElementById('modal-live-url').value     = project.live_url     || '';
        document.getElementById('modal-github').value       = project.github_url   || '';
        document.getElementById('modal-gitlab').value       = project.gitlab_url   || '';
        document.getElementById('modal-bitbucket').value    = project.bitbucket_url|| '';
        document.getElementById('modal-other-label').value  = project.other_platform_label || '';
        document.getElementById('modal-other-url').value    = project.other_platform_url   || '';
    } else {
        title.textContent = 'Add Project';
        form.action = '{{ route("user.projects.store") }}';
        method.innerHTML = '';
        form.reset();
    }

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeProjectModal() {
    document.getElementById('project-modal').classList.add('hidden');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeProjectModal();
});
</script>
