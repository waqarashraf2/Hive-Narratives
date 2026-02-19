@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="bg-white p-6 shadow rounded">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Edit User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Name</label>
        <input type="text" name="name" class="w-full px-4 py-2 border rounded" value="{{ $user->name }}" required>

        <label class="block mb-2 mt-2">Email</label>
        <input type="email" name="email" class="w-full px-4 py-2 border rounded" value="{{ $user->email }}" required>

        <label class="block mb-2 mt-2">Role</label>
        <select name="role" class="w-full px-4 py-2 border rounded">
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>

        <button type="submit" class="mt-4 px-4 py-2 bg-purple-700 text-white rounded">Update</button>
    </form>
</div>
@endsection
