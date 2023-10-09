<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Owner Registration</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- External CSS file -->
</head>
<body>
    <div class="registration-form">
        <h1>House Owner Registration</h1>
        <form action="{{ route('users.store') }}" method="post">                           
        @csrf
            <!-- Full Name (required) -->
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name')}}">
            @if($errors->any())
            <span style="color:red">{{$errors->first('full_name')}}</span>
            @endif
            <!-- Email Address (required) -->
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" value="{{ old('email')}}">
            @if($errors->any())
            <span style="color:red">{{$errors->first('email')}}</span>
            @endif
            <!-- Phone Number (required) -->
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone')}}">
            @if($errors->any())
            <span style="color:red">{{$errors->first("phone")}}</span>
            @endif
            <!-- House Address -->
            <label for="address">House Address:</label>
            <input type="text" id="address" name="address" value="{{ old('address')}}">
            @if($errors->any())
            <span style="color:red">{{$errors->first('address')}}</span>
            @endif
            <!-- Password (required) -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="{{ old('password')}}">
            @if($errors->any())
            <span style="color:red">{{$errors->first('password')}}</span>
            @endif
            <!-- Confirm Password (required) -->
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" value="">

            <!-- Submit Button -->
            <button type="submit">Register</button>
            <p>Already Registered? <a href="{{ route('login') }}">Login Here</a></p>

        </form>
    </div>
</body>
</html>
