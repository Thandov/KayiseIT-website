<!-- {"id":1,"user_id":1,"title":"Love","middletxt":"Lives","btmtxt":"Here","image":"\/images\/carousel\/Thando_Hlophe.jpg","created_at":"2023-07-30T07:43:28.000000Z","updated_at":"2023-07-30T07:58:52.000000Z"} -->
<div class="jumbotron bg-gray-400 bg-gradient position-relative">
    @php
    $slides = App\Models\Carousel::select('title', 'middletxt', 'btmtxt', 'image')->get();
    @endphp

    <div class="owl-carousel owl-theme" id="headercara">
        @foreach ($slides as $slide)
        <x-carousel-item pic="{{$slide->image ?? ''}}" topTitle="{{$slide->title ?? ''}}" mainTitle="{{$slide->middletxt ?? ''}}" bottomTitle="{{$slide->btmtxt ?? ''}}" />
        @endforeach
    </div>
</div>