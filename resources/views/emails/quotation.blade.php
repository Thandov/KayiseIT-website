<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quotation Email</title>
</head>
<body>
    <h2>Quotation Details:</h2>
    <p><strong>Service:</strong> {{ $service_name }}</p>
    <p><strong>Subservices:</strong></p>
    <ul>
        @if($subservices)
        @foreach($subservices as $subservice)
            <li>{{ $subservice }}</li>
        @endforeach
        @endif
    </ul>
    <p><strong>Options:</strong></p>
    <ul>
    @if($option_name)
        @foreach($option_name as $key => $option)
            <li>{{ $option }}: {{ $option_price[$key] }}</li>
        @endforeach
    @endif
</ul>

    <p><strong>Total Price:</strong> {{ $total_price }}</p>
</body>
</html>
