<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Internship Application</title>
</head>
<body>
    <p>A new internship application has been submitted.</p>
    
    <p>Applicant Details:</p>
    <ul>
        <li>Name: {{ $internship->name }}</li>
        <li>Email: {{ $internship->email }}</li>
        <li>Phone: {{ $internship->phone_no }}</li>
        <li>Address: {{ $internship->address }}</li>
        <li>ID: {{ $internship->id_number }}</li>
        <li>Age: {{ $internship->age }}</li>
        <li>Qualification: {{ $internship->qualification }}</li>
        <li>Year: {{ $internship->year_obtained }}</li>
        <li>Institution: {{ $internship->institution }}</li>
    </ul>
</body>
</html>
