@foreach ($newClients as $newclient)
<div class="shadow bg-white border-2 border-green-400 hover:border-green-600 rounded-lg py-4 px-2 w-100 h-32">
    <a href="{{route('dashboard.clients.viewclient', $newclient->id)}}">
        <h3 class="fw-bold">{{$newclient->name}}</h3>
        <p class="text-xs">{{ $newclient->created_at->format('d M Y D') }}</p>
        <p class="text-xs">{{ $newclient->created_at->format('H:i') }}</p>
</a>
</div>
@endforeach