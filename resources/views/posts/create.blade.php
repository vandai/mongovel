<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
            <!-- Content -->
            <section class="text-gray-600 body-font overflow-hidden">
                <div class="container px-5 py-24 mx-auto">
                @if ($errors->any())
                    <div class="alert alert-danger border rounded bg-gray-100 text-red-700 p-5">
                        <h3>FAILED!</h3>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form action="{{route('submit-post')}}"method="POST" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="lg:w-full mx-auto">
                            <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="title" class="leading-7 text-sm text-gray-600">Title</label>
                                        <input type="text" id="title" name="title" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="content" class="leading-7 text-sm text-gray-600">Message</label>
                                        <textarea id="content" name="content"></textarea>
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="image" class="leading-7 text-sm text-gray-600">Featured Image</label>
                                        <input type="file" id="image" name="image" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                </div>
                                <div class="p-2 w-1/2">
                                    <div class="relative">
                                        <label for="category" class="leading-7 text-sm text-gray-600">Category</label>
                                        <input type="text" id="category" name="category" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                </div>
                                <div class="p-2 w-1/2">
                                    <div class="relative">
                                        <label for="meta" class="leading-7 text-sm text-gray-600">Meta</label>
                                        <input type="text" id="meta" name="meta" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                </div>
                                <div class="p-2 w-1/2">
                                    <div class="relative">
                                    <label class="inline-flex items-center mt-3">
                                        <input type="checkbox" id="featured" name="featured" value="1" class="form-checkbox h-5 w-5 text-green-600"><span class="ml-2 text-gray-700"> Featured Post</span>
                                    </label>    
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Submit</button>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <!-- End Content  -->
            </div>
        </div>
    </div>

<script>
$(document).ready(function() {
  $('#content').summernote({
        tabsize: 2,
        height: 450
      });
});
</script>

</x-app-layout>
