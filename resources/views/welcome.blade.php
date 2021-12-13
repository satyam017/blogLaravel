<x-layout>
    @include('_post-header')

    <main class="container max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if($posts->count())
            <x-post-featured :post="$posts[0]"/>
            @if($posts->count() > 1)
                <div class="row">
                 @foreach($posts->skip(1) as $post)
                    <div class="mt-5 {{ $loop->iteration < 3  ? 'col-sm-6' : 'col-sm-4'}}">
                        <article class=" transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
                            <div class="py-6 px-5">
                                <div>
                                    <img src="/images/illustration-1.png" alt="Blog Post illustration" class="rounded-xl">
                                </div>

                                <div class="mt-8 flex flex-col justify-between">
                                    <header>
                                        <div class="space-x-2">
                                            <a href="#"
                                                class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                                                style="font-size: 10px">{{$post->category->name}}</a>

                                        </div>

                                        <div class="mt-4">
                                            <h1 class="text-3xl">
                                                {{$post->title}}
                                            </h1>

                                            <span class="mt-2 block text-gray-400 text-xs">
                                                Published <time>{{$post->created_at->diffForHumans()}}</time>
                                            </span>
                                        </div>
                                    </header>

                                    <div class="text-sm mt-4">
                                        <p>
                                        {{ $post->excerpt }}
                                        </p>

                                    </div>

                                    <footer class="flex justify-between items-center mt-8">
                                        <div class="flex items-center text-sm">
                                            <img src="/images/lary-avatar.svg" alt="Lary avatar">
                                            <div class="ml-3">
                                                <a href="../authors/{{$post->author->id}}"><h5 class="font-bold">{{$post->author->name}}</h5></a>
                                                <h6>Mascot at Laracasts</h6>
                                            </div>
                                        </div>

                                        <div>
                                            <a href="/posts/{{$post->slug}}"
                                                class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                                            >
                                                Read More
                                            </a>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach

                </div>

                {{$posts->links()}}
                @endif
            @else
            <p>no post</p>
        @endif

        <!-- <div class="lg:grid lg:grid-cols-3">
          <x-post-card></x-post-card>
          <x-post-card></x-post-card>
          <x-post-card></x-post-card>
        </div> -->
    </main>
</x-layout>
