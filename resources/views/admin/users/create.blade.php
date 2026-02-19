@extends('layouts.admin')

@section('title', 'Add User')

@section('content')
<div class="bg-white p-6 shadow rounded">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Add New User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <label class="block mb-2">Name</label>
        <input type="text" name="name" class="w-full px-4 py-2 border rounded" required>

        <label class="block mb-2 mt-2">Email</label>
        <input type="email" name="email" class="w-full px-4 py-2 border rounded" required>

        <label class="block mb-2 mt-2">Password</label>
        <input type="password" name="password" class="w-full px-4 py-2 border rounded" required>

        <label class="block mb-2 mt-2">Role</label>
        <select name="role" class="w-full px-4 py-2 border rounded">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit" class="mt-4 px-4 py-2 bg-purple-700 text-white rounded">Save</button>
    </form>
</div>
@endsection
