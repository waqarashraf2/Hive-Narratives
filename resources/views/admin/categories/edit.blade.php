@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="bg-white p-6 shadow rounded">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Edit Category</h2>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Category Name</label>
        <input type="text" name="name" class="w-full px-4 py-2 border rounded" value="{{ $category->name }}" required>

        <button type="submit" class="mt-4 px-4 py-2 bg-purple-700 text-white rounded">Update</button>
    </form>
</div>
@endsection
