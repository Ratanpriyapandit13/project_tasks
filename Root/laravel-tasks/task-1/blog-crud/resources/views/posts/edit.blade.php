<x-app-layout>
    <div class="max-w-2xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Post</h2>

        <form method="POST" action="{{ route('posts.update', $post) }}" class="bg-white shadow-md rounded-lg p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $post->title) }}"
                       required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                <textarea name="body" id="body" rows="6" required
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700  px-4 py-2 rounded-md font-semibold shadow">
                    Update
                </button>
                <a href="{{ route('posts.index') }}"
                   class="text-gray-600 hover:text-gray-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
