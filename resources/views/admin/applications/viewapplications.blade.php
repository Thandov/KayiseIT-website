<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Application Details</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div><strong>Name:</strong> {{ $application->name ?? 'N/A' }}</div>
                <div><strong>Email:</strong> {{ $application->email ?? 'N/A' }}</div>
                <div><strong>ID Number:</strong> {{ $application->id_no ?? 'N/A' }}</div>
                <div><strong>Status:</strong> {{ ucfirst($application->status ?? 'pending') }}</div>
                <div><strong>Application Type:</strong> {{ $application->app_type ?? 'N/A' }}</div>
                <div><strong>Field:</strong> {{ $application->field ?? 'N/A' }}</div>
                <div><strong>Program Partner:</strong> {{ $application->program_partner ?? 'N/A' }}</div>
                <div><strong>Age:</strong> {{ $application->age ?? 'N/A' }}</div>
                <div class="md:col-span-2"><strong>Address:</strong> {{ $application->address ?? 'N/A' }}</div>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-3">Supporting Documents</h2>
                <div class="space-y-2 text-sm">
                    <div><strong>CV:</strong> {{ $application->cv_path ?? 'N/A' }}</div>
                    <div><strong>ID Copy:</strong> {{ $application->id_copy_path ?? 'N/A' }}</div>
                    <div><strong>Qualification Copy:</strong> {{ $application->qualification_copy_path ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>