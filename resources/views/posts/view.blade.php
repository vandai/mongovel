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
                        <div class="py-8 flex flex-wrap md:flex-nowrap">
                            <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                            <!-- <span class="font-semibold title-font text-gray-700">CATEGORY</span> -->
                            <span class="mt-1 text-gray-500 text-sm">{{ date('d M Y H:i:s', strtotime($post->created_at)) }}</span>
                            </div>
                            <div class="md:flex-grow">
                                <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{ $post->title }}</h2>
                                <p class="leading-relaxed">{!! $post->content !!}</p>
                            </div>
                        </div>

                        @if($post->attachment != '')
                        <div class="py-8 flex flex-wrap md:flex-nowrap">
                            <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                                <span class="font-semibold title-font text-gray-700">Attachment</span>
                            </div>
                            <div class="md:flex-grow">
                                <a href="{{ Storage::url($post->attachment) }}" target="_blank">
                                    <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">View File</button>
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </section>
            <!-- End Content  -->
            </div>
        </div>
    </div>
</x-app-layout>
