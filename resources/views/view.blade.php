<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4">Member Details</h2>
    <div class="card">
        @if ($member)
            <div class="card-header">
                Member #{{ $member->id }}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $member->name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $member->email }}</p>
                {{-- You can add more member fields here if needed --}}
                <p class="card-text"><strong>Joined on:</strong> {{ $member->create_at->format('Y-m-d H:i:s') }}</p>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
        @else
            <div class="card-header">
                No Found
            </div>
        @endif
    </div>
</div>

</body>
</html>
