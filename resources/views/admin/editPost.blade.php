<x-layout>
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <div class="container ">
            <div class="row">
                <x-aside ></x-aside>
                <div class="col-8 offset-1 ">
                    <h1 class="">Edit Post</h1>
                    <form class="mt-5" METHOD="POST" action="/admin/posts/{{$post->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Title</label>
                                <input type="text" value="{{ $post->title }}" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Enter Post Tittle">
                                @error('title')
                                {{$message}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Select Category</label>
                                <select class="form-select"  name="category_id">
                                    <option >Select a category for this post</option>
                                    @php
                                        $categories = \App\Models\Category::all();
                                    @endphp
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{$post->category_id == $cat->id ? 'selected' : ''}}>{{ $cat->name }}</option>
                                    @endforeach
                                    @error('category_id')
                                    {{$message}}
                                    @enderror
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Slug</label>
                                <input type="text" name="slug" value="{{ $post->slug}}" class="form-control" id="exampleFormControlInput1" placeholder="Enter Slug for Post">
                                @error('slug')
                                {{$message}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Upload a thumbnail for a post</label>
                                <input type="file" value="{{ $post->thumbnail}}" name="thumbnail" class="form-control"  placeholder="Phutu Dal na">
                                @error('excerpt')
                                {{$message}}
                                @enderror
                                <img src="/storage/{{ $post->thumbnail }}" width="30%" class="mt-3 rounded" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Exerpt</label>
                                <textarea name="excerpt" value="{{ $post->excerpt }}" class="form-control" id="exampleFormControlTextarea1" placeholder="Enter Excerpt Here Now!" rows="3">{{ $post->excerpt }}</textarea>
                                @error('excerpt')
                                {{$message}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                                <textarea name="body" value="" class="form-control" id="exampleFormControlTextarea1" placeholder="Enter Body of the Post Now you MF" rows="10">{{ $post->body}}</textarea>
                                @error('body')
                                {{$message}}
                                @enderror
                            </div>
                            <div class="col-auto">
                                <button type="submit"  class="btn btn-primary mb-3">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-layout>
