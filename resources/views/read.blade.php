<x-read-layout>
<div>
    <!--Title-->
	<div class="text-center pt-16 md:pt-32">
		<p class="text-sm md:text-base text-green-500 font-bold">{{ date('d F Y', strtotime($post->created_at)) }} <span class="text-gray-900">/</span> {{ strtoupper($post->category) }}</p>
		<h1 class="font-bold break-normal text-3xl md:text-5xl">{{ $post->title }}</h1>
	</div>

    <!--image-->
	@if($post->image != '')
	<div class="container w-full max-w-6xl mx-auto bg-white bg-cover mt-8 rounded" style="background-image:url('{{Storage::url($post->image)}}'); height: 75vh;"></div>
	@else
	<div class="container w-full max-w-6xl mx-auto bg-white bg-cover mt-8 rounded" style="background-image:url('https://source.unsplash.com/collection/1118905/'); height: 75vh;"></div>
	@endif

    <!--Container-->
	<div class="container max-w-5xl mx-auto -mt-32">
		
		<div class="mx-0 sm:mx-6">
			
			<div class="bg-white w-full p-8 md:p-24 text-xl md:text-2xl text-gray-800 leading-normal" style="font-family:Georgia,serif;">
				
				<!--Post Content-->
				

				<!--Lead Para-->
				<div class="text-2xl md:text-3xl mb-5">
					{!! $intro !!}
                </div>

				<div class="py-6">
					{!! $post->content !!}
                </div>				
												
				<!--/ Post Content-->
						
			</div>
			
			
				<!--Subscribe-->	
				<div class="container font-sans bg-green-100 rounded mt-8 p-4 md:p-24 text-center">
					<h2 class="font-bold break-normal text-2xl md:text-4xl">Subscribe to Akemapa.xyz</h2>
					<h3 class="font-bold break-normal font-normal text-gray-600 text-base md:text-xl">Get the latest posts delivered right to your inbox</h3>
					<div class="w-full text-center pt-4">
                        <form action="{{route('subscribe')}}" method="post">
                            @csrf
							<div class="max-w-sm mx-auto p-1 pr-0 flex flex-wrap items-center">
								<input type="email" name="email" placeholder="youremail@example.com" required class="flex-1 appearance-none rounded shadow p-3 text-gray-600 mr-2 focus:outline-none">
								<button type="submit" class="flex-1 mt-4 md:mt-0 block md:inline-block appearance-none bg-green-500 text-white text-base font-semibold tracking-wider uppercase py-4 rounded shadow hover:bg-green-400">Subscribe</button>
							</div>
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
                            @if (session('success-message'))
                            <div class="flex flex-col justify-center pl-4 py-4">
                                <p class="text-xs text-gray-600 dark:text-gray-400 font-normal">{{ session('success-message') }}</p>
                            </div>
                            @endif
						</form>
					</div>
				</div>
				<!-- /Subscribe-->
			
	
				<!--Author-->
				<div class="flex w-full items-center font-sans p-8 md:p-24">
					<img class="w-10 h-10 rounded-full mr-4" src="http://i.pravatar.cc/300" alt="Avatar of Author">
					<div class="flex-1">
						<p class="text-base font-bold text-base md:text-xl leading-none">Akemapa XYZ</p>
						<p class="text-gray-600 text-xs md:text-base">Personal blog of me, theme by <a class="text-gray-800 hover:text-green-500 no-underline border-b-2 border-green-500" href="https://www.tailwindtoolbox.com">TailwindToolbox.com</a></p>
					</div>
					<div class="justify-end">
                        <a href="https://akemapa.me" target=_blank>
						    <button class="bg-transparent border border-gray-500 hover:border-green-500 text-xs text-gray-500 hover:text-green-500 font-bold py-2 px-4 rounded-full">Read More</button>
                        </a>
					</div>
				</div>
				<!--/Author-->
			
		</div>

        <div class="bg-gray-200">
	
		<div class="container w-full max-w-6xl mx-auto px-2 py-8">
			<div class="flex flex-wrap -mx-2">
				@foreach($random as $rand)
				<div class="w-full md:w-1/3 px-2 pb-12">
					<div class="h-full bg-white rounded overflow-hidden shadow-md hover:shadow-lg relative smooth">
						<a href="{{route('read-post', $rand->_id)}}" class="no-underline hover:no-underline">
							@if($rand->image != '')
							    <img src="{{ Storage::url($rand->image) }}" class="h-48 w-full rounded-t shadow-lg">
							@else
								<img src="https://source.unsplash.com/_AjqGGafofE/400x200" class="h-48 w-full rounded-t shadow-lg">
							@endif
							<div class="p-6 h-auto md:h-48">	
								<p class="text-gray-600 text-xs md:text-sm">{{ strtoupper($rand->category )}}</p>
								<div class="font-bold text-xl text-gray-900">{{ $rand->title }}</div>
								<p class="text-gray-800 font-serif text-base mb-5">
									{{ Str::words(strip_tags($rand->content), '20') }}
								</p>
							</div>
							<div class="flex items-center justify-between inset-x-0 bottom-0 p-6">
								<img class="w-8 h-8 rounded-full mr-4" src="http://i.pravatar.cc/300" alt="Avatar of Author">
								<p class="text-gray-600 text-xs md:text-sm">READ MORE</p>
							</div>
						</a>
					</div>
				</div>
				@endforeach
				
			</div>
		</div>


	</div>
	

	</div>
            
</div>
</x-read-layout>