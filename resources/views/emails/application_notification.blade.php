<!DOCTYPE html>
<html>
<head>
    <title>Notification - New Drone Application</title>
</head>
<body>
    @php
    $applicant = $request->all();
@endphp

<h2><strong>Applicant Details</strong></h2>
<br>
<p><strong>Name:</strong> {{ $applicant['name'] }}</p>
<p><strong>Surname:</strong> {{ $applicant['surname'] }}</p>
<p><strong>Date of Birth:</strong> {{ $applicant['dob'] }}</p>
<p><strong>Age:</strong> {{ $applicant['age'] }}</p>
<p><strong>Gender:</strong> {{ $applicant['gender'] }}</p>
<p><strong>Level:</strong> {{ $applicant['highest_level'] }}</p>
<p><strong>School:</strong> {{ $applicant['school_name'] }}</p>
<p><strong>Phone number:</strong> {{ $applicant['number'] }}</p>
<p><strong>Address:</strong> {{ $applicant['address'] }}</p>
<br>
<h2><strong>Guardian Details</strong></h2>
<br>
<p><strong>Name:</strong> {{ $applicant['guardian_name'] }}</p>
<p><strong>Relation:</strong> {{ $applicant['relation'] }}</p>
<p><strong>Email:</strong> {{ $applicant['guardian_email'] }}</p>
<p><strong>Phone Number:</strong> {{ $applicant['guardian_number'] }}</p>
<p><strong>Address:</strong> {{ $applicant['guardian_address'] }}</p>
<br>
<h2><strong>Next Of Kin Details</strong></h2>
<br>
<p><strong>Name:</strong> {{ $applicant['kin_name'] }}</p>
<p><strong>Relation:</strong> {{ $applicant['kin_relation'] }}</p>
<p><strong>Phone Number:</strong> {{ $applicant['kin_number'] }}</p>

</body>
</html>
