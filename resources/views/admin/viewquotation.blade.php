<x-app-layout>
    


    
            <div>Quote ID : {{ $website->id }}</div>
            <div>Website Type : {{ $website->type }}</div>
            <div>Number Of Pages : {{ $website->pages }} Price :R {{ $website->pages_price }}</div>
            <div>Hosting : {{ $website->hosting }} Price :R {{ $website->hosting_price }}</div>
            <div>Maintenance : {{ $website->maintenance }} Price :R {{ $website->maintenance_price }}</div>
            <div>Total Price :R {{ $website->total }}</div>
        


</x-app-layout>