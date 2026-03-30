
@if(count($applications) > 0)
<div class="mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Internship & Programme Applications</h3>
    <table class="w-full text-sm text-left text-gray-500 bg-white border border-gray-200 rounded-lg overflow-hidden">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 font-semibold">
            <tr>
                <th scope="col" class="px-6 py-3">Application ID</th>
                <th scope="col" class="px-6 py-3">Programme</th>
                <th scope="col" class="px-6 py-3">Field</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Applied</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($applications as $application)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $application->app_id }}</td>
                <td class="px-6 py-4">{{ $application->app_type ?? 'N/A' }}</td>
                <td class="px-6 py-4">{{ $application->field ?? 'N/A' }}</td>
                <td class="px-6 py-4">
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'accepted' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                        ];
                        $badgeClass = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800';
                        $statusText = ucfirst($application->status ?? 'pending');
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold inline-block {{ $badgeClass }}">
                        {{ $statusText }}
                    </span>
                </td>
                <td class="px-6 py-4">{{ $application->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <a href="#" onclick="viewApplicationDetail({{ $application->id }})" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                        View
                    </a>
                </td>
            </tr>
            <!-- Application Details Row -->
            <tr class="bg-gray-50 hidden" id="detail-{{ $application->id }}">
                <td colspan="6" class="px-6 py-4">
                    <div class="bg-white border-l-4 border-blue-500 p-4 rounded">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-semibold">Partner</p>
                                <p class="text-gray-900">{{ $application->program_partner ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-semibold">Age</p>
                                <p class="text-gray-900">{{ $application->age ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-semibold">School</p>
                                <p class="text-gray-900">{{ $application->high_school ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-semibold">Qualification</p>
                                <p class="text-gray-900">{{ $application->qualification ?? 'N/A' }}</p>
                            </div>
                        </div>

                        @if($application->responded_at)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <p class="text-xs text-gray-500 uppercase font-semibold mb-2">Response from KAYISE IT</p>
                            <p class="text-sm text-gray-600 mb-2">
                                <strong>Received on:</strong> {{ $application->responded_at->format('d M Y, H:i') }}
                            </p>
                            <div class="bg-blue-50 border border-blue-200 rounded p-3">
                                <p class="text-sm text-gray-800">{{ $application->admin_message }}</p>
                            </div>
                        </div>
                        @else
                            @if($application->status === 'pending')
                            <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded text-sm text-yellow-800">
                                Your application is being reviewed. We will notify you of our decision via email.
                            </div>
                            @endif
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
<br>
<br>
<br>
@if(count($droneapps) > 0)
<div class="mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Drone Applications</h3>
    <table class="w-full text-sm text-left text-gray-500 bg-white border border-gray-200 rounded-lg overflow-hidden">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 font-semibold">
            <tr>
                <th scope="col" class="px-6 py-3">Programme</th>
                <th scope="col" class="px-6 py-3">Course</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Date Applied</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($droneapps as $droneapp)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-medium text-gray-900">Drone Programme</td>
                <td class="px-6 py-4">{{ $droneapp->course ?? 'N/A' }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold inline-block bg-yellow-100 text-yellow-800">
                        Submitted
                    </span>
                </td>
                <td class="px-6 py-4">{{ $droneapp->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@if(count($applications) == 0 && count($droneapps) == 0)
<div class="text-center py-8">
    <p class="text-gray-500 mb-4">You haven't submitted any applications yet.</p>
    <a href="{{ route('opportunities') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
        Explore Opportunities
    </a>
</div>
@endif

<script>
function viewApplicationDetail(id) {
    const detailRow = document.getElementById('detail-' + id);
    if (detailRow.classList.contains('hidden')) {
        detailRow.classList.remove('hidden');
    } else {
        detailRow.classList.add('hidden');
    }
}
</script>