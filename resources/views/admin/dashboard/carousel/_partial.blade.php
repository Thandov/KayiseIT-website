<!-- partials.carousels.blade.php -->
@foreach ($carousels as $carousel)
<!-- Your carousel item display logic -->
<div class="caraslide max-w-md py-4 px-4 bg-white shadow-lg rounded-lg mb-4 relative" style="background-image: url('{{ asset($carousel->image) }}'); height: 250px; background-position: center; background-size:cover">
    <div class="black-overlay rounded-lg overflow-hidden"></div>
    <a href="{{ route('admin.dashboard.carousel.viewcarousel', $carousel->id) }}">
        <div class="rounded-lg h-100 flex flex-col justify-center items-start absolute p-4" style="z-index: 50; top: 0; bottom: 0; right: 0; left: 0">
            <p class="text-white-800 text-md font-semibold">{{$carousel->title ?? ''}}</p>
            <p class="text-white-800 text-md font-semibold">{{$carousel->middletxt ?? ''}}</p>
            <p class="text-white-800 text-md font-semibold">{{$carousel->btmtxt ?? ''}}</p>
        </div>
    </a>
</div>
@endforeach