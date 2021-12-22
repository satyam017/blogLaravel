<x-layout>
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <div class="container ">
            <div class="row">
                <x-aside ></x-aside>
                <div class="col-8 offset-1 ">
                    <h1 class="">Create a Post Right Now!!</h1>
                    <form class="mt-5" METHOD="POST" action="/admin/posts" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Title</label>
                                <input type="text" value="{{ old('title') }}" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Enter Post Tittle">
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
                                             <option value="{{ $cat->id }}" {{old('category_id')== $cat->id ? 'selected' : ''}}>{{ $cat->name }}</option>
                                        @endforeach
                                    @error('category_id')
                                    {{$message}}
                                    @enderror
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Slug</label>
                                <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" id="exampleFormControlInput1" placeholder="Enter Slug for Post">
                                @error('slug')
                                {{$message}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Upload a thumbnail for a post</label>
                                <input type="file" value="{{ old('title') }}" name="thumbnail" class="form-control"  placeholder="Phutu Dal na">
                                    @error('excerpt')
                                    {{$message}}
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Exerpt</label>
                                <textarea name="excerpt" value="{{ old('excerpt') }}" class="form-control" id="exampleFormControlTextarea1" placeholder="Enter Excerpt Here Now!" rows="3">{{ old('excerpt') }}</textarea>
                                @error('excerpt')
                                {{$message}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                                <textarea name="body" value="" class="form-control" id="exampleFormControlTextarea1" placeholder="Enter Body of the Post Now you MF" rows="10">{{ old('body') }}</textarea>
                                @error('body')
                                {{$message}}
                                @enderror
                            </div>
                            <div class="col-auto">
                                <button type="submit"  class="btn btn-primary mb-3">Dabbao</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-layout>
