@include('static.base')
@include('static.nav')
<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-xs">
        <form action="/deck/{{$item->deck_id}}/card/{{$item->id}}" method="post" class="h-full bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    New word in card
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="name" name="name" type="text" placeholder="Word" value="{{$item->name}}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="translate">
                    New translate in card
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="translate" name="translate" type="text" placeholder="Translate" value="{{$item->translate}}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tense">
                    New word in card
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="tense" name="tense" type="text" placeholder="Tense" value="{{$item->tense}}">
            </div>
            <button
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="submit" placeholder="Deck name">Submit</button>
        </form>

        <p class="text-center text-gray-500 text-xs">
            &copy;2020 Acme Corp. All rights reserved.
        </p>
    </div>
</div>

@include('static.endbase')

