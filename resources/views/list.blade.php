<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4">Member List</h2>

    <!-- Add New Button -->
    <div class="mb-3">
        <a href="{{ route('membership.create') }}" class="btn btn-success">+ Add New</a>
    </div>

    <form method="GET" action="{{ url('/') }}" class="mb-3 d-flex align-items-center gap-3">
    
        <!-- search -->
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search members..." value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
        </div>

        <!-- page size -->
        <div class="d-flex align-items-center">
            <label for="perPageSelect" class="me-2">Rows per page:</label>
            <select name="perPage" id="perPageSelect" class="form-select w-auto">
                @foreach ([10, 20, 50, 100] as $size)
                    <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>{{ $size }}</option>
                @endforeach
            </select>
        </div>

    </form>

    <!-- Member Table -->
    <table class="table table-bordered">
    <thead>
        <tr>
            <th><a href="{{ request()->fullUrlWithQuery(['sortBy' => 'id', 'sortOrder' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">ID</a></th>
            <th><a href="{{ request()->fullUrlWithQuery(['sortBy' => 'name', 'sortOrder' => $sortBy == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Name</a></th>
            <th><a href="{{ request()->fullUrlWithQuery(['sortBy' => 'email', 'sortOrder' => $sortBy == 'email' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Email</a></th>
            <th>Actions</th>
        </tr>
    </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>
                        <a href="{{ url('/view?id=' . $member->id) }}" class="btn btn-sm btn-info">View / Edit</a>
                        <a href="javascript:void(0)" data-id="{{ $member->id }}" class="btn btn-sm btn-danger delete-btn">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No members found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex align-items-center justify-content-between mt-3">
    <a href="{{ $members->appends(request()->query())->previousPageUrl() }}" class="btn btn-outline-primary {{ $members->onFirstPage() ? 'disabled' : '' }}">Previous</a>

    <form method="GET" action="{{ url('members') }}" id="paginationForm" class="d-flex align-items-center">
        <label class="me-2">Page:</label>
        <input type="number" name="page" id="pageInput" min="1" max="{{ $members->lastPage() }}" class="form-control w-auto me-2" value="{{ $members->currentPage() }}">
        <span>/ {{ $members->lastPage() }}</span>
    </form>

    <a href="{{ $members->appends(request()->query())->nextPageUrl() }}" class="btn btn-outline-primary {{ $members->hasMorePages() ? '' : 'disabled' }}">Next</a>
    </div>


</div>

</body>
<script>
    let maxPage = {{ $members->lastPage() }};

    document.getElementById('pageInput').addEventListener('change', function () {
        let page = parseInt(this.value);

        if (page < 1) page = 1;
        if (page > maxPage) page = maxPage;

        console.log("Max Page:", maxPage); 
        console.log("Selected Page:", page);
        
        window.location.href = "page=" + page;
    });

    document.getElementById('perPageSelect').addEventListener('change', function () {
        let perPage = this.value;
        let params = new URLSearchParams(window.location.search);
        params.set('perPage', perPage);
        params.delete('page'); 

        window.location.href =  '?' + params.toString();
    });
    document.getElementById('perPageSelect').addEventListener('change', function () {
        this.form.submit();
    });


    $(document).ready(function(){
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete?')) {
                var id = this.getAttribute('data-id');

                $.ajax({
                    url: "{{ route('membership.delete_process') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert('Delete success');
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseJSON.error);
                    }
                });
            }
        });
    });
</script>
</html>
