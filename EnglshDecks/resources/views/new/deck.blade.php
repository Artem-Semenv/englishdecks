@include('static.base')
@include('static.nav')
<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-xs">
        <form action="/deck" method="post" class="h-full bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="deck">
                    Name of deck
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="deck" name="name" type="text" placeholder="Deck">
            </div>
            <button
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="submit" placeholder="Deck">Submit</button>
        </form>

        <p class="text-center text-gray-500 text-xs">
            &copy;2020 Acme Corp. All rights reserved.
        </p>
    </div>
</div>

@include('static.endbase')

