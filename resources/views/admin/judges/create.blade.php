@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-4xl font-bold serif-title mb-2">Add New Judge</h1>
    <div class="divider mb-8"></div>

    <form action="{{ route('admin.judges.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="username" class="block text-sm uppercase tracking-wider text-gray-600 mb-2">Username</label>
            <input type="text" name="username" id="username" required
                class="w-full px-4 py-2 border border-black focus:outline-none focus:ring-2 focus:ring-black text-sm"
                value="{{ old('username') }}">
            @error('username')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="display_name" class="block text-sm uppercase tracking-wider text-gray-600 mb-2">Display Name</label>
            <input type="text" name="display_name" id="display_name" required
                class="w-full px-4 py-2 border border-black focus:outline-none focus:ring-2 focus:ring-black text-sm"
                value="{{ old('display_name') }}">
            @error('display_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end space-x-4 pt-4">
            <a href="{{ route('admin.index') }}" 
               class="text-sm text-black hover:text-gray-600 border-b-2 border-transparent hover:border-black transition-all duration-200">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-black text-white text-sm uppercase tracking-wider hover:bg-gray-800 transition-colors duration-200">
                Create Judge
            </button>
        </div>
    </form>
</div>
@endsection
