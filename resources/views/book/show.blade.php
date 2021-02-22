<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-3 gap-4">
                    <div class="...">
                        <img class="w-full h-full p-14" src="{{ asset('storage/covers/'. $book->cover) }}" alt="Book cover">
                    </div>
                    <div class="col-span-2 ... py-10">
                        <div class="p-14">
                            <div class="divide-y">
                                <p class="text-4xl font-bold text-gray-900 py-4">{{ $book->title }}</p>
                                <div class="text-2xl font-medium text-gray-400 py2">Author(s):
                                    @foreach($book->authors as $author)
                                        <span>
                                            {{ $author->author }}
                                            @if(!$loop->last)
                                                <span>, </span>
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="text-md font-light text-gray-600">Genre(s):
                                @foreach($book->genres as $genre)
                                    <span>
                                        {{ $genre->genre}}
                                        @if(!$loop->last)
                                            <span>, </span>
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                            <p class="py-10">{{ $book->description }}</p>
                            <div class="text-center">
                                <a class="text-red-500" href="{{ route('report', $book->id) }}">Report this book to administrator</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-3 ...">
                    @if(!Auth::guest() && $book->isRated === 'no')
                        <div class="text-center">
                            <div class="py-4">
                                <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                        <form method="POST" action="{{ route('rate.store') }}">
                                            @csrf
                                            <input type="hidden" value="{{$book->id}}" name="book_id">
                                            <!-- Rate -->
                                            <div class="m-2">
                                                <x-label for="rate" :value="__('Rate')" />

                                                <select name="rate" id="rate" class="form-select block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value=0 default>0</option>
                                                    <option value=1>1</option>
                                                    <option value=2>2</option>
                                                    <option value=3>3</option>
                                                    <option value=4>4</option>
                                                    <option value=5>5</option>
                                                </select>
                                            </div>

                                            <!-- Review -->
                                            <div class="m-2">
                                                <x-label for="review" :value="__('Review')" />

                                                <textarea  id="review" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="review" :value="old('review')" required rows="5"></textarea>
                                            </div>

                                            <div class="flex items-center justify-center mt-4 my-4">
                                                <x-button class="ml-4 p-4">
                                                    {{ __('Rate and Review') }}
                                                </x-button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(count($rates))
                        @foreach($rates as $rate)
                            <div class="py-4 bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg flex space-x-4 ...">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex-1 ...">
                                    <div class="py-2 px-10">{{ $rate->user->name }}</div>
                                    <div class="py-2 px-10">{{ $rate->rateInfo }}</div>
                                    <div class="py-2 px-10">2021-02-11</div>
                                </div>
                                <div class="p-4 m-4 bg-white w-full flex-2 ...">{{ $rate->review }}</div>
                            </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>