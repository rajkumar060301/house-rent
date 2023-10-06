<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"> <!-- External CSS file -->
</head>
<body>
    <div class="registration-form">
        <h1>House Owner Updations</h1>
        <form action="/update/{{ $id }}" method="post">                           
        @csrf
            <!-- Full Name (required) -->
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="{{$full_name}}">
            <span style="color:red"></span>
           
            <!-- Email Address (required) -->
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" value="{{$email}}">
            <span style="color:red"></span>
            
            <!-- Phone Number (required) -->
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="{{ $phone}}">
            <span style="color:red"></span>
            
            <!-- House Address -->
            <label for="address">House Address:</label>
            <input type="text" id="address" name="address" value="{{ $address}}">
            <span style="color:red"></span>
            
            <!-- Password (required) -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="{{$password}}">
            <span style="color:red"></span>

            <!-- Submit Button -->
            <button type="submit">Update</button>

        </form>
    </div>
</body>
</html>
