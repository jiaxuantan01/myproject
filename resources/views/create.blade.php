<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4">Membership Application</h2>

            <!-- Add Back Button -->
            <div class="mb-3">
                <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
            </div>

            <form id="membershipForm">
            <div id="message" class="mt-3"></div>

                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    <div class="text-danger" id="nameError"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    <div class="text-danger" id="emailError"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                    <div class="text-danger" id="phoneError"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Membership Type</label>
                    <select name="type" id="type" class="form-select" required>
                        <option value="regular" {{ old('type') == 'regular' ? 'selected' : '' }}>Regular Member</option>
                        <option value="vip" {{ old('type') == 'vip' ? 'selected' : '' }}>VIP Member</option>
                    </select>
                    <div class="text-danger" id="typeError"></div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $("#membershipForm").on("submit", function (event) {
        event.preventDefault();

        let formData = $(this).serialize(); //

        $(".text-danger").html("");

        $.ajax({
            url: "{{ route('membership.create_process') }}",
            type: "POST",
            data: formData,
            success: function (response) {
                $("#message").html('<div class="alert alert-success">Submit Success</div>');
                $("#membershipForm")[0].reset(); 
            },
            error: function (xhr) {
                $("#message").html('<div class="alert alert-danger">Submit Fail</div>');

                if (xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $("#" + key + "Error").html(value[0]);
                    });
                }
            }
        });
    });
});

</script>
</html>
