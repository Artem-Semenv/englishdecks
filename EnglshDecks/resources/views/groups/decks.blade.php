@include('static.base')
<body class="">
@include('static.nav')
<div class="w-full max-w-xs ml-14 mr-14 mt-10">

    @foreach($items as $item)
        <div class="flex w-[300px] h-[40px] items-center border border-black rounded-lg mb-2">
            <p class="font-bold text-[22px] ml-3 w-[80%]">{{$item->name}}</p>

            <form action="/deck/{{$item->id}}" method="POST" class="mr-2">
                @csrf
                @method('DELETE')
                <button
                    class="text-white font-bold w-[65px] h-[30px] rounded-lg bg-red-500 hover:bg-red-600 text-center justify-center"
                    type="submit">Delete
                </button>
            </form>

            <a href="/deck/{{$item->id}}/cards"
               class="text-white font-bold w-[90px] h-[28px] rounded-lg bg-blue-500 hover:bg-blue-600 text-center justify-center"
               type="submit">Check
            </a>
        </div>
    @endforeach


</div>
@include('static.endbase')
