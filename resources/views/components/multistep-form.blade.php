<!-- resources/views/components/multistep-form.blade.php -->

@props(['slides'])
@props(['linking'])

<div class="flex items-start justify-center">

    <div class="w-full bg-white p-8 shadow-sm sm:rounded-lg overflow-hidden">
        <!-- Progress Bar -->
        <div class="relative progresswrapper w-full bg-gray-300 rounded-lg h-4 mb-6">
            <div id="progress" class="absolute top-0 left-0 h-full bg-blue-500 rounded-lg" style="width: 0%; transition: width 0.3s;"></div>
            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-white font-bold">
                <span id="progressPercentage">0%</span>
            </div>
        </div>

        <form action="{{$linking}}" method="POST" class="flex flex-col" id="multi-step-form">
            @csrf
            @foreach($slides as $index => $slideRoute)
            <?php $slideContent = view($slideRoute)->render(); ?>
            <div class="step @if($index === 0) block @else hidden @endif" data-step="{{ $index + 1 }}">
                {!! $slideContent !!}
            </div>
            @endforeach

            <div class="flex justify-between mt-4">
                <button type="button" onclick="prevStep()" class="prev-button px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600" @if(count($slides)===0) style="display: none;" @endif>Previous</button>
                <button type="button" onclick="nextStep()" class="next-button ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600" @if(count($slides)===0) style="display: none;" @endif>Next</button>
                <button type="submit" class="submit-button ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600" @if(count($slides) !==0) style="display: none;" @endif>Submit</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('multi-step-form');
        const steps = form.querySelectorAll('.step');
        let currentStep = 1;

        function showStep(step) {
            steps.forEach((stepElement) => {
                stepElement.style.display = 'none';
            });
            steps[step - 1].style.display = 'block';
        }

        window.nextStep = function() {
            if (currentStep < steps.length) {
                showStep(currentStep + 1);
                currentStep++;
            }
            updateButtonVisibility();
            updateProgressBar();
        }

        window.prevStep = function() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
                currentStep--;
            }
            updateButtonVisibility();
            updateProgressBar();
        }

        function updateButtonVisibility() {
            const prevButton = form.querySelector('.prev-button');
            const nextButton = form.querySelector('.next-button');
            const submitButton = form.querySelector('.submit-button');

            if (currentStep === 1) {
                prevButton.style.display = 'none';
            } else {
                prevButton.style.display = 'block';
            }

            if (currentStep === steps.length) {
                nextButton.style.display = 'none';
                submitButton.style.display = 'block';
            } else {
                nextButton.style.display = 'block';
                submitButton.style.display = 'none';
            }
        }

        // JavaScript code to update the progress bar
        const progressBar = document.getElementById('progress');
        const progressPercentage = document.getElementById('progressPercentage');
        const totalSteps = steps.length;

        function updateProgress(currentStep) {
            const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
            progressBar.style.width = `${progress}%`;
            progressPercentage.textContent = `${Math.round(progress)}%`; // Show percentage
        }

        // Call this function whenever you navigate to the next or previous step
        function updateProgressBar() {
            updateProgress(currentStep);
        }

        // Initial setup
        showStep(currentStep);
        updateButtonVisibility();
        updateProgressBar();
    });
</script>