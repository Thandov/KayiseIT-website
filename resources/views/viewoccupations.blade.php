<x-app-layout>
    <section id="career-mapping">
        <div class="container py-5 px-4 md:px-8 max-w-screen-xl mx-auto">
            <div class="flex justify-center my-4 rounded-md mx-auto">
                <img class="h-40" src="{{ asset('images/occupations_logo/'.$occupations->image) }}">
            </div>
            <h2 class="bigtxt font-bold text-5xl mb-3 text-center">{{ $occupations->occupation_name }}</h2>
            <p class="text-center">Choose your specialization</p>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs justify-center" id="myTabs" role="tablist">
                @foreach($specializations as $index => $specialization)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $index === 0 ? 'active' : '' }}" id="tab{{ $index }}" data-toggle="tab" href="#content{{ $index }}" role="tab" aria-controls="content{{ $index }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                            {{ $specialization->specialization_name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            
            <!-- Tab content -->
            <div class="tab-content" id="myTabContent">
                @foreach($specializations as $index => $specialization)
                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="content{{ $index }}" role="tabpanel" aria-labelledby="tab{{ $index }}">
                        <!-- Content for each tab -->
                        <a href="{{ route('viewspecialization', $specialization->spec_id) }}">
                            <div class="bg-white rounded-lg shadow-md flex items-center justify-center w-auto h-28">
                                <h2 class="text-xl font-bold smalltxt text-center">{{ $specialization->specialization_name }}</h2>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>

<!-- Include necessary Bootstrap and jQuery libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Initialize Bootstrap tabs
    $(document).ready(function() {
        $('.nav-tabs a').tab();
    });
</script>
