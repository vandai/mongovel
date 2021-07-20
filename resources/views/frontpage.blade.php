<x-blog-layout>


    <div class="bg-gray-200 w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t">
            
        <!--Lead Card-->
        @if($featured != '')
        <div class="flex h-full bg-white rounded overflow-hidden shadow-lg">
            <a href="{{ route('read-post',[$featured->id]) }}" class="flex flex-wrap no-underline hover:no-underline">
                @if($featured->image != '')
                <div class="w-full rounded-t">	
                    <img src="{{ Storage::url($featured->image) }}" class="h-full w-full shadow">
                </div>
                @endif
                <div class="w-full flex flex-col flex-grow flex-shrink">
                    <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                        <p class="w-full text-gray-600 text-xs md:text-sm pt-6 px-6">{{ $featured->category }}</p>
                        <div class="w-full font-bold text-xl text-gray-900 px-6">{{ $featured->title }}</div>
                        <p class="text-gray-800 font-serif text-base px-6 mb-5">
                            {{ Str::words(strip_tags($featured->content), '100') }}
                        </p>
                    </div>

                    <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('read-post',[$featured->id]) }}" class="flex flex-wrap no-underline hover:no-underline">
                                <p class="text-gray-600 text-xs md:text-sm">READ MORE</p>
                            </a>
                        </div>
                    </div>
                </div>

            </a>
        </div>
        @endif
        <!--/Lead Card-->


        <!--Posts Container-->
        <div class="flex flex-wrap justify-between pt-12 -mx-6">

            @foreach($posts as $post)
            <!--1/3 col -->
            <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                    <a href="{{ route('read-post',[$post->id]) }}" class="flex flex-wrap no-underline hover:no-underline">
                        @if($post->image != '')
                        <img src="{{ Storage::url($post->image) }}" class="h-64 w-full rounded-t pb-6">
                        @else 
                        <img src="https://source.unsplash.com/collection/539527/800x600" class="h-64 w-full rounded-t pb-6">
                        @endif
                        <div class="w-full font-bold text-xl text-gray-900 px-6">{{ $post->title }}</div>
                        <p class="text-gray-800 font-serif text-base px-6 mb-5">
                        {{ Str::words(strip_tags($post->content), '50') }}
                        </p>
                    </a>
                </div>
                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('read-post',[$post->id]) }}">
                            <p class="text-gray-600 text-xs md:text-sm">READ MORE</p>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="w-full">{{ $posts->links() }}</div>
        </div>
    </div>
    <!--/ Post Content-->
					
</x-blog-layout>