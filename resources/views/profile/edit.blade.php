@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <h2 class="mb-4"><i class="fas fa-user-edit text-primary"></i> Edit Profile</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" id="nameInput" placeholder="Name" required>
                    <label for="nameInput"><i class="fas fa-user"></i> Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" id="emailInput" placeholder="Email" required>
                    <label for="emailInput"><i class="fas fa-envelope"></i> Email</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" id="usernameInput" placeholder="Username" required>
                    <label for="usernameInput"><i class="fas fa-at"></i> Username</label>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-venus-mars"></i> Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $user->date_of_birth) }}" id="dobInput" placeholder="Date of Birth">
                    <label for="dobInput"><i class="fas fa-calendar"></i> Date of Birth</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="location" class="form-control" value="{{ old('location', $user->location) }}" id="locationInput" placeholder="Location">
                    <label for="locationInput"><i class="fas fa-map-marker-alt"></i> Location</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="bio" class="form-control" id="bioInput" style="height: 100px" placeholder="Short Bio">{{ old('bio', $user->bio) }}</textarea>
                    <label for="bioInput"><i class="fas fa-info-circle"></i> Short Bio</label>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-list"></i> Select Your Interests</label>
                    <select name="categories[]" class="form-select" multiple required>
                        <option value="Technology" {{ in_array('Technology', json_decode($user->categories ?? '[]')) ? 'selected' : '' }}>Technology</option>
                        <option value="Health" {{ in_array('Health', json_decode($user->categories ?? '[]')) ? 'selected' : '' }}>Health</option>
                        <option value="Finance" {{ in_array('Finance', json_decode($user->categories ?? '[]')) ? 'selected' : '' }}>Finance</option>
                        <option value="Travel" {{ in_array('Travel', json_decode($user->categories ?? '[]')) ? 'selected' : '' }}>Travel</option>
                        <option value="Personal Development" {{ in_array('Personal Development', json_decode($user->categories ?? '[]')) ? 'selected' : '' }}>Personal Development</option>
                        <option value="Islamic Content" {{ in_array('Islamic Content', json_decode($user->categories ?? '[]')) ? 'selected' : '' }}>Islamic Content</option>
                        <option value="Motivational" {{ in_array('Motivational', json_decode($user->categories ?? '[]')) ? 'selected' : '' }}>Motivational</option>
                        <option value="Quotes" {{ in_array('Quotes', json_decode($user->categories ?? '[]')) ? 'selected' : '' }}>Quotes</option>
                    </select>
                    <small class="text-muted"><i class="fas fa-hand-pointer"></i> Hold Ctrl or Cmd to select multiple.</small>
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class="fas fa-image"></i> Profile Photo</label>
                    <input type="file" id="profilePhotoInput" class="form-control">
                    <div class="mt-3">
                        <img id="profilePreview" src="{{ asset('storage/' . $user->profile_photo) }}" width="100" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                    <button type="button" id="cropButton" class="btn btn-outline-primary mt-2" style="display:none;">
                        <i class="fas fa-crop"></i> Crop & Upload
                    </button>
                    <input type="hidden" name="cropped_image" id="croppedImageInput">
                </div>

                <button type="submit" class="btn btn-success w-100 py-2"><i class="fas fa-save"></i> Update Profile</button>
            </form>

            <hr class="my-5">

            <h3 class="mb-3"><i class="fas fa-lock text-danger"></i> Update Password</h3>
            <form action="{{ route('profile.update.password') }}" method="POST">
                @csrf

                <div class="form-floating mb-3">
                    <input type="password" name="current_password" class="form-control" id="currentPass" placeholder="Current Password" required>
                    <label for="currentPass"><i class="fas fa-key"></i> Current Password</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="new_password" class="form-control" id="newPass" placeholder="New Password" required>
                    <label for="newPass"><i class="fas fa-lock-open"></i> New Password</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="new_password_confirmation" class="form-control" id="confirmPass" placeholder="Confirm Password" required>
                    <label for="confirmPass"><i class="fas fa-lock"></i> Confirm Password</label>
                </div>

                <button type="submit" class="btn btn-danger w-100 py-2"><i class="fas fa-sync-alt"></i> Update Password</button>
            </form>
        </div>
    </div>
</div>

<!-- Cropper.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let cropper;
        const profilePhotoInput = document.getElementById("profilePhotoInput");
        const profilePreview = document.getElementById("profilePreview");
        const cropButton = document.getElementById("cropButton");
        const croppedImageInput = document.getElementById("croppedImageInput");

        profilePhotoInput.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    profilePreview.src = e.target.result;
                    profilePreview.style.display = "block";
                    
                    if (cropper) cropper.destroy();

                    cropper = new Cropper(profilePreview, {
                        aspectRatio: 1,
                        viewMode: 1,
                        autoCropArea: 1,
                    });

                    cropButton.style.display = "inline-block";
                };
                reader.readAsDataURL(file);
            }
        });

        cropButton.addEventListener("click", function () {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({ width: 200, height: 200 });

                canvas.toBlob(function (blob) {
                    const formData = new FormData();
                    formData.append("cropped_image", blob);
                    formData.append("_token", "{{ csrf_token() }}");

                    fetch("{{ route('profile.update.photo') }}", {
                        method: "POST",
                        body: formData,
                    }).then(response => response.json())
                      .then(data => {
                          if (data.success) {
                              profilePreview.src = data.image_url;
                              alert("Profile photo updated successfully!");
                          } else {
                              alert("Upload failed!");
                          }
                      });
                }, "image/jpeg");
            }
        });
    });
</script>
@endsection
