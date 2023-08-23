<x-app-layout>
    <x-breadcrumb></x-breadcrumb>

    <h1 style="color: #64bc5c" class="text-center mb- font-bold text-4xl md:text-4xl">Our Blogs</h1>

    <h1 class="text-center font-semibold text-gray-800 dark:text-white mt-2  md:text-xl">A Center of all our resources and insights</h1>                     
    <hr class="border-t-6 border-blue-900 my-4 mx-auto w-1/5">
    
    <div class="max-w-7xl mx-auto mt-16 sm:px-6 lg:px-8">   
        <div class="p-12">
        <h1 style="color: #64bc5c" class="mb-6 font-bold text-4xl md:text-3xl">Latest Post</h1>
        @if($blogs->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="max-w-2xl rounded-lg overflow-hidden shadow-sm border bg-white dark:bg-gray-800 relative mb-8">
               <img class="w-full h-600 object-cover" src="{{ asset($blogs->first()->icon) }}" alt="Blog Image">
            </div>
            <div class="max-w-md rounded-lg overflow-hidden  bg-gray dark:bg-gray-800 relative mb-4">
                <!-- Content for the second card -->
                <div class="py-2">
                    <span class="inline-block bg-indigo-500 text-white text-xs px-2 py-1 rounded-full uppercase font-semibold">Category</span>                 
                       <h1 class="text-4xl font-semibold text-gray-800 dark:text-white ">{{ $blogs->first()->title }}</h1>
                    @if($blogs->isNotEmpty() && !empty(trim($blogs->first()->subtitle)))
                    <p class="text font-semibold text-gray-800 dark:text-white">{!! $blogs->first()->subtitle !!}</p>
                    <h6 style="color: #070707" class="text-center mb-5 font-italic text-2xl md:text-2xl">{!! $blogs->first()->subtitle !!}</h6>

                    @endif 
             
                    <h1 class="text font-semibold text-gray-800 dark:text-white mt-2">Author: Mary Jane Doe/ Created at: 27 August 2023</h1>                     
                <div class="grid grid-cols-2 items-center justify-between mt-20">
                        <a href="/viewblog/{{$blogs->first()->id}}" class="bg-white-600 px-3 py-2 text-sm font-semibold text-primary shadow-sm hover:bg-grey-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-grey-600">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <h3 style="color: #64bc5c" class="mb-6 font-bold text-3xl md:text-3xl">Trending </h3>
         <div class="slider-container">
       <div class="slider-content">
        @foreach($blogs->skip(1)->take(3) as $relatedBlog)
        <div class="max-w-xs rounded-lg overflow-hidden shadow-sm border bg-white dark:bg-gray-800 relative slide-left inline-block mx-2 p-2">
            <span class="absolute top-0 left-0 bg-gray-800 text-white px-2 py-1 rounded-tr-lg text-xs font-semibold">{{ date('d M Y', strtotime($relatedBlog->created_at)) }}</span>
                <img class="w-full h-32 object-cover" src="{{ asset($relatedBlog->icon) }}" alt="Blog Image">
                <div class="px-4 py-2">
                    <span class="inline-block bg-indigo-500 text-white text-xs px-2 py-1 rounded-full uppercase font-semibold">Category{{ $relatedBlog->category }}</span>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-2">{{ $relatedBlog->title }}</h3>
                    <h6 style="color: #070707" class="text-center mb-5 font-italic text-2xl md:text-2xl">{{ $relatedBlog->subtitle ?? '' }}</h6>
                </div>
                <div class="grid grid-cols-2 items-center justify-between">
                    <a href="/viewblog/{{$relatedBlog->id}}" class="bg-white-600 px-3 py-2 text-sm font-semibold text-primary shadow-sm hover:bg-grey-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-grey-600">View More</a>
                </div>
            </div>
            @endforeach         
        </div>         
    </div>   
    <h3 style="color: #64bc5c" class=" text-center mb-8 font-bold text-3xl md:text-3xl">All Blogs</h3>


</x-app-layout>
<script>
    // JavaScript to update the slider after every set of 4 blogs
    const sliderContent = document.querySelector('.slider-content');
    sliderContent.addEventListener('animationiteration', () => {
        void sliderContent.offsetWidth; // Trigger reflow to restart the animation
        void sliderContent.offsetWidth; // Trigger reflow to restart the animation
        sliderContent.style.animation = 'slideLoop 20s infinite linear';
    });
</script>