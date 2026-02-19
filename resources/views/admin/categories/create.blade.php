@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
<div class="bg-white p-6 shadow rounded">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Add New Category</h2>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <label class="block mb-2">Category Name</label>
        <input type="text" name="name" class="w-full px-4 py-2 border rounded" required>

        <button type="submit" class="mt-4 px-4 py-2 bg-purple-700 text-white rounded">Save</button>
    </form>
</div>
@endsection
