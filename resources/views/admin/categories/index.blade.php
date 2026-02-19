@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
<div class="bg-white p-6 shadow rounded">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Categories</h2>

    <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-purple-700 text-white rounded">Add Category</a>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $category->id }}</td>
                    <td class="px-4 py-2">{{ $category->name }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
