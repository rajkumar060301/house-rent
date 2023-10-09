<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class UserControllers extends Controller
{
    
    public function index(){
        return view('register');
    }

    public function loginForm(){
        return view('users.login');
    }

    public function homePage(){
        return view('home');
    }

    
    public function dataTabel()
    {
        $users = User::all(); // Fetch data from the 'users' table
    
        return view('home', compact('users'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = Validator::make($request->all(),[
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|nullable|string',
            'address' => 'required|nullable|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if($validatedData->fails()){
            return redirect('/')->withErrors($validatedData)->withInput();

        }
        $user = new User();
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // Redirect with a success message
        return redirect()->route('users.loginForm')->with('success', 'User created successfully');
  
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Get the authenticated user's ID
            $userId = Auth::user()->id;
            $full_name = Auth::user()->full_name;

            // Store the user ID in the session
            session(['userId' => $userId]);
            session(['fullName' => $full_name]);
            return redirect()->route('home.dataTabel');
        }

        return redirect()->route('users.loginForm')->with('error', 'Invalid email or password');
    }

    // showHomePage in data
    public function showHomePage() {
        // Get user ID from session
        $userId = Session::get('userId');

        // Fetch user data based on the user ID
        $user = User::find($userId);
        return view('home', compact('user'));
    }



    // Delete the row with id     // Remove the specified user from the database.
    public function delete(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }

        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }

    //Update data
    public function showUpdateForm($id, $full_name, $email, $phone, $address) {
        return view('update', compact('id', 'full_name', 'email', 'phone', 'address'));
    }
    

    // Update quaery
    public function update(Request $request, $id) {
        // Validate the form data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);
    
        // Find the user by ID
        $user = User::find($id);
    
        // Update user data
        $user->update([
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);
    
        // Redirect the user to a success page or any other appropriate page
        return redirect('/home');
    }


    // Logout 

    public function logout() {
        Auth::logout(); // Logout the user
        Session::forget('userId'); // Remove the user ID from the session
        return redirect('/login'); // Redirect to the login page
}
}
