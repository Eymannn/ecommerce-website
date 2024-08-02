<x-layout>
    <form action="{{ route('user.updateAchievements', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        @foreach($achievements as $achievement)
        <div class="flex items-center">
            <input id="{{ $achievement['name'] }}" type="checkbox" name="achievements[]" value="{{ $achievement['name'] }}" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" {{ array_key_exists($achievement['name'], $user->achievements ?? []) ? 'checked' : '' }}>
            <label for="{{ $achievement['name'] }}" class="ml-2 block text-sm text-gray-900 flex items-center">
                {!! $achievement['badge'] !!}
                <span class="ml-2">{{ $achievement['name'] }}</span>
            </label>
        </div>
    @endforeach
        
        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Update Achievements</button>
    </form>
</x-layout>
