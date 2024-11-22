<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="text-center bg-white p-5 rounded shadow">
        <h1 class="mb-3">Thank You for Participating!</h1>
        <p class="mb-4">We’ve successfully registered your participation.</p>

        <!-- Display success or error message -->
        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @elseif($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Add Event to Google Calendar Button -->
        <a href="{{ route('google.addEvent') }}" class="btn btn-primary">
            Add Event to Google Calendar
        </a>
    </div>
    
    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
