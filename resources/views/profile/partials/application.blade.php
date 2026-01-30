
@if(count($applications) > 0)
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-white">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                # Application No:
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($applications as $application)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">{{ $application->app_id }}</td>
            <td class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Submitted</td>
            <td class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">{{ \Carbon\Carbon::parse($application->created_at)->format('d M Y')  }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
<br>
<br>
<br>
@if(count($droneapps) > 0)
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-white">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                # Programme:
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($droneapps as $droneapp)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">{{ $droneapp->course }}</td>
            <td class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Submitted</td>
            <td class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">{{ \Carbon\Carbon::parse($droneapp->created_at)->format('d M Y')  }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif