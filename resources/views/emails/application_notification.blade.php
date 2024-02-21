@php
    $applicant = $request->all();
@endphp

<h1>New Drone Application</h1>

<p><strong>Name:</strong> {{ $applicant['name'] }}</p>
<p><strong>Surname:</strong> {{ $applicant['surname'] }}</p>
<p><strong>Date of Birth:</strong> {{ $applicant['dob'] }}</p>
<p><strong>Age:</strong> {{ $applicant['age'] }}</p>
<p><strong>Gender:</strong> {{ $applicant['gender'] }}</p>
<p><strong>Level:</strong> {{ $applicant['highest_level'] }}</p>
<p><strong>School:</strong> {{ $applicant['school_name'] }}</p>
<!-- Add more fields as needed -->

