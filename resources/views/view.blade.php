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
    <h2 class="mb-4">Member Details #{{ $member->id }}</h2>
    <div class="card">
        @if ($member)
            <form id="membershipForm">
                @csrf
                <input type="hidden" name="id" value="{{ $member->id }}">

                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Name</strong></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $member->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label"><strong>Email</strong></label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $member->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label"><strong>Phone</strong></label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $member->phone }}" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label"><strong>Membership Type</strong></label>
                    <select class="form-select" name="type" id="type" required>
                        <option value="regular" {{ $member->type == 'regular' ? 'selected' : '' }}>Regular Member</option>
                        <option value="vip" {{ $member->type == 'vip' ? 'selected' : '' }}>VIP Member</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Joined On</strong></label>
                    <input type="text" class="form-control" value="{{ $member->create_at->format('Y-m-d H:i:s') }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Last Update</strong></label>
                    <input type="text" class="form-control" value="{{ $member->update_at->format('Y-m-d H:i:s') }}" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </form>
        @else
            <div class="card-header">
                No Found
            </div>
        @endif
    </div>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#membershipForm').submit(function (e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('membership.update_process') }}", 
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    alert("Member updated successfully!");
                    location.reload();
                } else {
                    alert("Failed to update member.");
                }
            },
            error: function (xhr) {
                alert("An error occurred: " + xhr.responseJSON.message);
            }
        });
    });
});
</script>
</html>
