<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;



class AuthController extends Controller
{
    // Show Login Form
    public function loginForm() {
        return view('login'); // Fixed view path
    }

    // Handle Login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Show Register Form
    public function registerForm() {
        return view('register'); // Fixed view path
    }

    // Handle Registration
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
    
        // Generate a unique username based on the name
        $username = $this->generateUniqueUsername($request->name);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $username,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);
    
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
    
    // Generate Unique Username
    private function generateUniqueUsername($name) {
        // Convert name to lowercase, replace spaces with underscores
        $baseUsername = strtolower(str_replace(' ', '_', $name));

        // Check if the username exists
        $username = $baseUsername;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }




public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Create new user if not exists
            $username = $this->generateUniqueUsername($googleUser->getName());

            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'username' => $username,
                'password' => bcrypt(uniqid()), // Dummy password
                'role' => 'user',
            ]);
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    } catch (\Exception $e) {
        return redirect()->route('login')->withErrors(['google_error' => 'Google login failed.']);
    }
}





    

    // profile show 

    public function profile()
    {
        $user = Auth::user(); // Get the logged-in user
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'Unauthorized.');
        }
    
        // Fetch the user's bookmarks along with related blog details
        $bookmarks = $user->bookmarks()->with('blog')->latest()->get();
    
        return view('profile.profile', compact('user', 'bookmarks'));
    }
    



    // Show the Edit Profile Form
public function editProfile() {
    $user = Auth::user();

    if (!$user || !($user instanceof User)) {
        return redirect()->route('login')->with('error', 'Unauthorized.');
    }

    return view('profile.edit', ['user' => $user]);
}



    // Update Profile
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        // Ensure $user is an instance of User
        if (!$user || !($user instanceof User)) {
            return redirect()->route('login')->with('error', 'Unauthorized.');
        }
    
        // Validate input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'gender' => 'nullable|string|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:500',
            'categories' => 'required|array|min:1|max:5', // Min 1 and Max 5 interests
            'categories.*' => 'string|in:Technology,Health,Finance,Travel,Personal Development,Islamic Content,Motivational,Quotes',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Handle Profile Photo Upload
        if ($request->hasFile('profile_photo')) {
            // Delete previous photo if exists
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }
    
            // Store new photo
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $photoPath;
        }
    
        // Assign user input to fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->date_of_birth;
        $user->location = $request->location;
        $user->bio = $request->bio;
        $user->categories = json_encode($request->categories); // Store multiple interests as JSON
    
        // Save changes
        $user->save();
    
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
    
    
    




    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);
    
        /** @var \App\Models\User $user */
        $user = Auth::user();
    
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }
    
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
    
        return redirect()->route('profile.edit')->with('success', 'Password updated successfully!');
    }
    




    public function updateProfilePhoto(Request $request)
    {
        $user = User::find(Auth::id()); // Get authenticated user
    
        // ✅ Image Validation (Max: 2MB, Allowed Formats: jpg, jpeg, png, gif)
        $request->validate([
            'cropped_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        if ($request->hasFile('cropped_image')) {
            // ✅ Delete old profile photo if it exists
            if ($user->profile_photo) {
                $oldPhotoPath = $user->profile_photo;
                if (Storage::disk('public')->exists($oldPhotoPath)) {
                    Storage::disk('public')->delete($oldPhotoPath);
                }
            }
    
            // ✅ Store the new cropped image
            $image = $request->file('cropped_image');
            $imagePath = $image->store('profile_photos', 'public'); // Saves in storage/app/public/profile_photos
    
            // ✅ Update user record with new photo path
            $user->profile_photo = $imagePath;
            $user->save();
    
            return response()->json([
                'success' => true, 
                'image_url' => asset('storage/' . $imagePath)
            ]);
        }
    
        return response()->json(['success' => false, 'message' => 'No file uploaded.']);
    }
    
    
    


    

    // Format Username
    private function formatUsername($username) {
        $username = preg_replace('/[^a-zA-Z0-9_]/', '', strtolower(str_replace(' ', '_', $username)));
    
        $originalUsername = $username;
        $counter = 1;
    
        while (User::where('username', $username)->where('id', '!=', Auth::id())->exists()) {
            $username = $originalUsername . $counter;
            $counter++;
        }
    
        return $username;
    }
    
    

    // Logout
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
