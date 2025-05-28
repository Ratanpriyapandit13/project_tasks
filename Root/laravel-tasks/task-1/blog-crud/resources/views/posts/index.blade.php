<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-6">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Blog Posts</h1>
            <a href="{{ route('posts.create') }}"
               class="bg-blue-600 hover:bg-blue-700 font-semibold px-5 py-2 rounded shadow">
                + Create Post
            </a>
        </div>

        @if($posts->isEmpty())
            <div class="text-center text-gray-500">No posts available.</div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                        <h2 class="text-xl font-bold text-blue-700 mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="hover:underline">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="text-sm text-gray-500 mb-4">
                            by {{ $post?->user?->name }} • {{ $post->created_at->diffForHumans() }}
                        </p>

                        <div class="flex items-center space-x-4 text-sm">
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}"
                                   class="text-indigo-600 hover:text-indigo-800 font-medium">
                                  Edit
                                </a>
                            @endcan

                            @can('delete', $post)
                                <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 font-medium">
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
