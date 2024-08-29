@include('static.base')
@include('static.nav')
<div class="mt-10 mb-10 text-center">
    <a
        href="/deck/{{$id}}/new_card"
        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
    >New Card
    </a>

    <a
        href="/deck/{{$id}}/play"
        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
    >PLAY
    </a>
</div>
<div class="relative overflow-x-auto rounded-lg">
    <table class="text-center w-[97%] ml-7 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                In English
            </th>
            <th scope="col" class="px-6 py-3">
                In Ukraine
            </th>
            <th scope="col" class="px-6 py-3">
                Example tense
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$item->name}}
                </th>
                <td class="px-6 py-4">
                    {{$item->translate}}
                </td>
                <td class="px-6 py-4">
                    {{$item->tense}}
                </td>
                <td class="px-6 py-4">

                    <a href="/edit/card/{{$item->id}}"
                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Edit
                    </a>
                    <form action="/delete/card/{{$item->id}}" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@include('static.endbase')
