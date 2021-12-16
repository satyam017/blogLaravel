    <x-layout>
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
            <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                    <img src="/images/illustration-1.png" alt="" class="rounded-xl">

                    <p class="mt-4 block text-gray-400 text-xs">
                        Published <time>{{$post->created_at->diffForHumans()}}</time>
                    </p>

                    <div class="flex items-center lg:justify-center text-sm mt-4">
                        <img src="/images/lary-avatar.svg" alt="Lary avatar">
                        <div class="ml-3 text-left">
                            <h5 class="font-bold">{{$post->author->name}}</h5>
                            <h6>Mascot at Laracasts</h6>
                        </div>
                    </div>
                </div>

                <div class="col-span-8">
                    <div class="hidden lg:flex justify-between mb-6">
                        <a href="/"
                            class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path class="fill-current"
                                        d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                    </path>
                                </g>
                            </svg>

                            Back to Posts
                        </a>

                        <div class="space-x-2">
                            <a href="../categories/{{$post->category->slug}}"
                                class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                                style="font-size: 10px">{{$post->category->name}}</a>
                        </div>
                    </div>

                    <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                        {{$post->title}}
                    </h1>

                    <div class="space-y-4 lg:text-lg leading-loose">
                        <p>{{$post->body}}</p>
                    </div>
                </div>
            </article>

            {{--    Comments        --}}

            <section class="">
                <article class="mt-2 flex offset-5 col-7 ">
                    @auth
                    <form method="POST" action="/posts/{{ $post->slug }}/comments" class="w-100 border border-gray-200 p-4 rounded-xl">
                        @csrf
                        <header class="flex items-center">
                            <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" class="rounded-circle" alt="image Avtar" >
                            <h2 class="ml-4 text-sm ">
                                Want to praticipate?
                            </h2>
                        </header>
                        <div class="mt-6">
                            <textarea name="body" class="w-100" cols="50" rows="10" placeholder="Think something and write it quickly you piece of shit!!">
                            </textarea>
                        </div>
                        <footer class="flex justify-end mt-10">
                            <button type="submit" class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600"> Post

                            </button>
                        </footer>
                    </form>
                    @else
                        <div class="w-100 border border-gray-200 p-4 rounded-xl">
                            <p class="mb-0 text-md text-black" "><a href="/login" style="text-decoration: none; color: #000;">Please Login To Comment your thoughts</a></p>
                        </div>
                    @endauth
                </article>
                @foreach($post->comments as $comment)
                    <article class="mt-2 flex offset-5 col-7 bg-gray-100 border-gray-200 p-4 rounded-xl ">
                    <div class="me-3 flex-shrink-0">
                        <img src="https://i.pravatar.cc/200?u={{$comment->user_id}}" class="rounded-circle" alt="image Avtar" width="100px">
                    </div>
                    <header>
                        <strong>
                            <h3 class="font-bold">
                                {{$comment->author->name}}
                            </h3>
                            <p class="text-xs">
                               <time>{{$comment->created_at->format('F j, Y g:i a')}}</time>
                            </p>
                        </strong>
                        <p>
                           {{ $comment->body }}
                        </p>
                    </header>
                </article>
                @endforeach
            </section>
        </main>
    </x-layout>
