@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-4xl font-bold serif-title mb-2">Score Participant</h1>
    <p class="text-gray-600 text-lg mb-2">{{ $user->name }}</p>
    <div class="divider mb-8"></div>

    <form action="{{ route('judges.store-score', [$judge, $user]) }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="points" class="block text-sm uppercase tracking-wider text-gray-600 mb-2">Points (1-100)</label>
            <input type="number" name="points" id="points" required min="1" max="100"
                value="{{ $existingScore?->points ?? old('points') }}"
                class="w-full px-4 py-2 border border-black focus:outline-none focus:ring-2 focus:ring-blue-900 text-sm"
                placeholder="Enter score between 1 and 100">
            @error('points')
                <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end space-x-4 pt-4">
            <a href="{{ route('judges.index', $judge) }}" 
               class="text-sm text-gray-600 hover:text-gray-800 border-b-2 border-transparent hover:border-gray-800 transition-all duration-200">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-blue-900 text-white text-sm uppercase tracking-wider hover:bg-blue-800 transition-colors duration-200">
                {{ $existingScore ? 'Update Score' : 'Submit Score' }}
            </button>
        </div>
    </form>

    @if($existingScore)
        <div class="mt-12 pt-8 border-t border-gray-200">
            <p class="text-sm text-gray-600 uppercase tracking-wider mb-4">Current Score</p>
            <p class="text-4xl font-mono text-blue-900">{{ $existingScore->points }}</p>
        </div>
    @endif
</div>
@endsection
