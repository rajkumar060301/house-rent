<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 2px 2px;
            cursor: pointer;
        }

        button:hover {
            background-color: pink;
        }
        .deleteButton{
            background-color: red;
        }
    </style>
</head>

<body>
    <h1>Welcome to the Home Page!</h1>
    <p>This is a basic home page created with Laravel.</p>
    <div>
        User ID: {{ session('userId') }}<br>
        Full Name: {{ isset($user) ? $user->full_name : 'N/A' }}<br>
        <a href="{{ route('logout') }}">Log Out</a>
    </div>
    <h1>Data Page</h1>

    <table border="1" id="userTable">
        <tr>
            <th>ID</th>
            <th>FULL NAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>ADDRESS</th>
            <th>PASSWORD</th>
            <th>UPDATE</th>
            <th>DELETE</th>
        </tr>

        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->full_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->password }}</td>
            <td><a href="{{ route('update', ['id' => $user->id, 'full_name' => $user->full_name, 'email' => $user->email, 'phone' => $user->phone, 'address' => $user->address, 'password'=>$user->password]) }}"><button class="updateButton">Update</button></a></td>
            <td><button class="deleteButton" data-userid="{{ $user->id }}">Delete</button></td>
            
        </tr>
        @endforeach
    </table>
</body>
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
</html>
