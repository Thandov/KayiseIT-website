<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate support request</title>
</head>
<body>
    <h1>Certificate generation failed — learner requested help</h1>
    <p><strong>ID number:</strong> {{ $payload['id_number'] }}</p>
    <p><strong>Name:</strong> {{ $payload['name'] }}</p>
    <p><strong>Surname:</strong> {{ $payload['surname'] }}</p>
    <p><strong>Email:</strong> {{ $payload['email'] }}</p>
    <p>The learner submitted this from the public LMS certification page after automated PDF generation did not complete.</p>
</body>
</html>
