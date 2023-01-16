<x-app-layout title="Website-Development">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Website Development') }}
        </h2>
    </x-slot>

    @if(session('success'))
    <div class="alert alert-success">
        {!! session('success') !!}
    </div>
    @endif


    <form action="{{url('submit-form')}}" method="post">
        @csrf
        <input type="hidden" name="bid" value="1">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grind-cols-5 md:grid-cols-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-8 md:mr-5">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="text-large font-bold text-center text-xl py-3">Get A Quotation For Your Website</h2>
                            <div class="grid grind-cols-5 md:grid-cols-12">
                                <div class="col-span-6 md:mr-2">
                                    <label for="garden_size"
                                        class="block text-sm font-medium text-gray-700 m-0 p-0">Type Of Website</label>
                                    <select id="type" name="type"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="" selected disabled hidden>Select</option>
                                        <option {{$property[0]->garden_size ?? '' == "0" ? 'selected' : '' }} value="personal">
                                            Personal Website</option>
                                        <option {{$property[0]->garden_size  ?? '' == "1" ? 'selected' : '' }}
                                            value="business">
                                            Business Website</option>

                                    </select>
                                </div>
                            </div>

                            <div class="grid grind-cols-5 md:grid-cols-12">
                                <div class="col-span-6 md:mr-2">
                                    <label for="garden_size"
                                        class="block text-sm font-medium text-gray-700 m-0 p-0">Number Of Webpages</label>
                                    <select id="pages" name="pages"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="" selected disabled hidden>Select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="more">More</option>

                                    </select>
                                </div>
                            </div>

                            <div class="grid grind-cols-5 md:grid-cols-12">
                                <div class="col-span-6 md:mr-2">
                                    <label for="Hosting"
                                        class="block text-sm font-medium text-gray-700 m-0 p-0">Require Hosting?</label>
                                    <select id="hosting" name="hosting"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="" selected disabled hidden>Select</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grind-cols-5 md:grid-cols-12">
                                <div class="col-span-6 md:mr-2">
                                    <label for="maintenance"
                                        class="block text-sm font-medium text-gray-700 m-0 p-0">Require Maintenance?</label>
                                    <select id="maintenance" name="maintenance" placeholder="-select-"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="" selected disabled hidden>Select</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>

                            

                            
                            

                            
                        </div>
                    </div>

                    <!-- Right Sidebar -->
                    <div class="md:col-span-4 md:col-start-9">
                        <div class="sticky">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-5">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12"><h1>You Will Get A Quote For The Following:</h1></div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-12"><span id="type"></span><span id="webtype"></span></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-12"><span id="pages"></span><span id="pnum"></span></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-12"><span id="host"></span><span id="hostprice"></span></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-12"><span id="main"></span><span id="price"></span></span>
                                    </div>
                                    

                                    
                                </div>

                                
                                <div class="p-6 bg-white border-b border-gray-200">
                                @if (Auth::check())
                                   <button type="submit" id="book" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Get Quote</button>
                                @else
                                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Get Quote</a>
                                @endif
                                </div>


                            </div>
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-5 mt-3">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <h4 class="text-bold">Our Promise to You</h4>
                                    <p>We want to ensure that you are 100% happy and satisfied with our service. If you
                                        are unhappy in any way, our support team is on standby ready to help.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</x-app-layout>
<script>

//right bar

//type
$(document).ready(function() {
  $('#type').change(function() {
    if ($(this).val() === 'business') {
      $('#webtype').text('A Business Website With:');
    } else {
      $('#webtype').text('A Personal Website With:');
    }
  });
});

//hosting

$(document).ready(function() {
  $('#hosting').change(function() {
    if ($(this).val() === 'yes') {
      $('#host').text('Hosting');
    } else {
      $('#host').text('');
    }
  });
});

//pages
$(document).ready(function() {
  $('#pages').change(function() {
    if ($(this).val() === '1') {
      $('#pnum').text(1 + ' Webpage');
    } 
    else if ($(this).val() === '2') {
      $('#pnum').text(2 + ' Webpages');
    }
    else if ($(this).val() === '3') {
      $('#pnum').text(3 + ' Webpages');
    }
    else if ($(this).val() === '4') {
      $('#pnum').text(4 + ' Webpages');
    }
    else if ($(this).val() === '5') {
      $('#pnum').text(5 + ' Webpages');
    }
    else {
      $('#pnum').text(5 + '+ Webpages ');
    }
  });
});


//maintenance


$(document).ready(function() {
  $('#maintenance').change(function() {
    if ($(this).val() === 'yes') {
      $('#main').text('Maintenance');
    } else {
      $('#main').text('');
    }
  });
});

</script>


<!--
<script>
$(document).ready(function() {
  $('#maintenance').change(function() {
    if ($(this).val() === 'yes') {
      $('#price').text(200);
    } else {
      $('#price').text(0);
    }
  });
});
</script> -->