@props(['sidebar'])
<div class="col-3 ">
    <div class="p-3 transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
        <h4>
            Sidebar
        </h4>
        <ul class="ps-0">
            <li class="pt-3">
                <a class="text-decoration-none  {{request()->is('admin/posts/dashboard') ? 'text-blue-500' : 'text-black'}}" href="/admin/posts/dashboard">UserDashboard</a>
            </li>
            <li class="pt-3">
                <a class="text-decoration-none  {{request()->is('admin/posts/createPost') ? 'text-blue-500' : 'text-black'}}" href="/admin/posts/createPost">Create new post</a>
            </li>
            <li class="pt-3">
                <a class="text-decoration-none  {{request()->is('admin/posts/allPost') ? 'text-blue-500' : 'text-black'}}" href="/admin/posts/allPost">All post</a>
            </li>
        </ul>
    </div>
</div>

