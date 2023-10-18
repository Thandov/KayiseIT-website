   <div class="webmockup">
       <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[250px] md:max-w-[412px]">
           <div class="rounded-lg overflow-hidden h-[156px] md:h-[230px] bg-white dark:bg-gray-800">
               <div class="content h-100">
                   @php
                   $slides = App\Models\Carousel::select('title', 'middletxt', 'btmtxt', 'image')->get();
                   @endphp

                   <div class="owl-carousel owl-theme" id="headercara">
                       @foreach ($slides as $slide)
                       <x-carousel-item pic="{{$slide->image ?? ''}}" topTitle="{{$slide->title ?? ''}}" mainTitle="{{$slide->middletxt ?? ''}}" bottomTitle="{{$slide->btmtxt ?? ''}}" />
                       @endforeach
                   </div>
               </div>
           </div>
       </div>
       <div class="relative mx-auto bg-gray-900 dark:bg-gray-700 rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[497px]">
           <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-gray-800"></div>
       </div>
   </div>