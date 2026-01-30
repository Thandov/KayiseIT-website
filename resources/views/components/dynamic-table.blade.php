@php
$decodedString = htmlspecialchars_decode($trcontent);

// Convert the regular string to an array using json_decode
$post = json_decode($decodedString);
@endphp
<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    @if ($post[0] ?? '')
                    @foreach ($post[0] as $key => $value)
                    <th class="px-4 py-3">{{ $key }}</th>
                    @endforeach
                    @endif

                    <th width="20%"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @foreach ($post as $item)
                <tr class="text-sm text-gray-500">
                    @foreach ($item as $value)
                    <td class="px-4 py-3">{{ $value }}</td>

                    @endforeach
                    <td class="px-4 py-3 grid grid-cols-2 gap-1 justify-end items-center">
                        <x-front-end-btn linking="" color="blue" showme="" name="Edit" />
                        <form action="{{route('dashboard.blogs.categories.deleting', ['id' => $item->{'Category ID'}])}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
                            @csrf
                            <x-front-end-btn linking="{{route('dashboard.blogs.categories.deleting', ['id' => $item->{'Category ID'}])}}" color="submit" showme="category_delete" name="Delete" />
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>