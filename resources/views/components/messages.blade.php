@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="bg-red-200 relative text-red-500 py-3 px-3 rounded-lg">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
        <div class="bg-green-200 relative text-green-500 py-3 px-3 rounded-lg">
            {{session('success')}}
        </div>
@endif

@if(session('error'))
        <div class="bg-red-200 relative text-red-500 py-3 px-3 rounded-lg">
            {{session('error')}}
        </div>
@endif