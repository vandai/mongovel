<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-right m-4">
                <a href="{{ route('create-post') }}">
                    <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">+ New Post</button>
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
            <!-- Content -->
            <section class="text-gray-600 body-font overflow-hidden">
                <div class="container px-5 py-24 mx-auto">
                    <div class="-my-8 divide-y-2 divide-gray-100">
                        @foreach($posts as $post)
                        <div class="py-8 flex flex-wrap md:flex-nowrap">
                            <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                            <!-- <span class="font-semibold title-font text-gray-700">CATEGORY</span> -->
                            <span class="mt-1 text-gray-500 text-sm">{{ date('d M Y H:i:s', strtotime($post->created_at)) }}</span>
                            </div>
                            <div class="md:flex-grow">
                                <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{ $post->title }}</h2>
                                <a href="{{ route('edit-post', $post->id) }}" class="text-indigo-500 inline-flex items-center mt-4">Edit
                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                </a> 
                                <a href="javascript:void(0)" onclick="delete_post('{{ $post->_id }}')" class="text-red-500 inline-flex items-center mt-4">
                                    Delete
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
					<div class="py-8 w-full">
					{{ $posts->links() }}
					</div>
                </div>
                <form id="form_delete_post" action="{{route('delete-post')}}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" id="post_id_delete" value="">
                </form>
                </section>
            <!-- End Content  -->
            </div>
        </div>
        <script>
            function delete_post(post_id)
            {
                if(confirm('Hapus this post?'))
                {
                    document.getElementById("post_id_delete").value = post_id;
                    document.getElementById("form_delete_post").submit();
                }
            }
        </script>
    </div>
</x-app-layout>
