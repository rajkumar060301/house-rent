<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>User Dashboard</title>

</head>

<body>
    <header>
        <h1>User Dashboard</h1>
    </header>

    <nav>
        <a href="#">Home</a>
        <a href="#">Profile</a>
        <a href="{{ route('logout') }}">Logout</a>
    </nav>
    <h2>Welcome, {{ session('fullName') }}!</h2>
            <div class="row mb-3">
            <div class="col-md-6"></div> <!-- Empty column to create space on the left -->
            <div class="col-md-6 text-right">
                <button class="btn btn-success add-user-button" data-toggle="modal" data-target="#myModal">Add User</button>
            </div>
        </div> 
    <div class="container1">       
        @if(session()->has('userId'))
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="userTable">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>FULL NAME</th>
                        <th>EMAIL</th>
                        <th>PHONE</th>
                        <th>ADDRESS</th>
                        <th>UPDATE</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            <a href="{{ route('update', ['id' => $user->id, 'full_name' => $user->full_name, 'email' => $user->email, 'phone' => $user->phone, 'address' => $user->address]) }}" class="btn btn-primary">Update</a>
                        </td>
                        <td>
                            <button class="btn btn-danger deleteButton" data-userid="{{ $user->id }}">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>User not authenticated. Please log in.</p>
        @endif
    </div>
    <div class="container">
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg"> <!-- Added 'modal-lg' class for a large modal -->
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('home.dataTabel') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="full_name">Full Name:</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name')}}" required>
                            <!-- <div class="invalid-feedback">
                                Please provide a valid name.
                            </div> -->
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email')}}" required>
                            <!-- <div class="invalid-feedback">
                                Please provide a valid email address.
                            </div> -->
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone')}}" required>
                            <!-- <div class="invalid-feedback">
                                Please provide a valid phone number.
                            </div> -->
                        </div>

                        <div class="form-group">
                            <label for="address">House Address:</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address')}}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <!-- <div class="invalid-feedback">
                                Please provide a password.
                            </div> -->
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password:</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            <!-- <div class="invalid-feedback">
                                Please confirm your password.
                            </div> -->
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Document ready function to ensure DOM is loaded
        $(document).ready(function () {
            // Click event for delete buttons
            $('#userTable').on('click', '.deleteButton', function () {
                var userId = $(this).data('userid');
                var row = $(this).closest('tr'); // Get the parent row
                // Send AJAX request to delete user
                $.ajax({
                    url: '/users/' + userId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        if (data.success) {
                            // Remove the row from the table
                            row.remove();
                        } else {
                            console.error('Failed to delete user.');
                        }
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });

            });


        });
    </script>
    
</body>

</html>
