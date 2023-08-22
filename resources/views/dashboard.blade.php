<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home Page') }} 
        </h2>
    </x-slot>


@foreach($posts as $post)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 style="font-weight: bold; text-transform: uppercase; color: #333;">{{ $post->title }}</h1>
                    <h2>{{ $post->author->name }}</h2>
                    <p>{{ $post->content }}</p>
                    <p style="font-style: italic; color: #3996B1;"> @if ($postLikesCounts[$post->id] == 1)
                                                                        1 person hooked on this
                                                                    @else
                                                                        {{ $postLikesCounts[$post->id] }} people hooked on this
                                                                    @endif
                    @auth
                    @if($user->likes->contains('target_id', $post->id))
                        <form action="{{ route('unlike', $post) }}" method="POST">
                            @csrf
                            <button type="submit" style="background-color: #E22F4F; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px;">Unlike</button>
                        </form>
                    @else
                        <form action="{{ route('like', $post) }}" method="POST">
                            @csrf
                            <button type="submit" style="background-color: #A9BCB2; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px;">Like</button>
                        </form>
                    @endif

                    @else
                        Please log in to like this post. Likes:
                    @endauth
                    </p>
                    <p style="font-style: italic; color: #3996B1;">Comments: {{ $post->comments->count() }}</p>
                    @foreach($post->comments as $comment)
                        <div class="comment">
                            <p style="font-weight: bold; text-transform: uppercase; color: #333;">{{ $comment->user->name }}</p>
                            <p>{{ $comment->content }}</p>
                            @auth
                                @if($user->id == $comment->user_id)
                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                        @csrf
                                        
                                        @method('DELETE')
                                        <button type="submit" style="background-color: #E22F4F; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px;">Delete</button>
                                    </form> <br>
                                    <a href="{{ route('comment.edit', $comment->id) }}" style="background-color: #A9BCB2; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px;">Edit</a> <br>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
@endforeach


</x-app-layout>
