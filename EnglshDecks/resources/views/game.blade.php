@include('static.base')
<div class="relative flex justify-center items-center h-screen">
    <div class="absolute z-0">
        <form id="myForm" action="/deck/{{$id}}/play" method="POST">
            @csrf
            <input type="hidden" name="responses" id="responsesInput">
            <button type="submit" id="finishSessionBtn">Finish Session</button>
        </form>
    </div>
    <@php
    $count = 1;
    @endphp
    @foreach($items as $item)
        <@php
            $count++;
        @endphp
        <div
            class="card absolute z-{{$count}} flex flex-col items-center bg-white w-70 h-96 rounded shadow-lg transition transform duration-500 p-4">
            <div class="h-[70%]">
                <p class="englishWord text-center p-1 border border-black rounded-lg mb-5">{{$item->name}}</p>
                <p class="ukraineWord text-center p-1 border border-black rounded-lg" hidden>{{$item->translate}}</p>
            </div>

            <div class="h-[30%]">
                <div class="action-buttons" hidden>
                    <button
                        class="dontKnowBtn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        I don't know this
                    </button>
                    <button
                        class="knowBtn focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        I know this
                    </button>
                </div>
                <button
                    class="showTranslate bottom-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Show translate
                </button>
            </div>
        </div>
    @endforeach
</div>

<script>
    let userResponses = {};



    document.querySelectorAll('.card').forEach(card => {
        const showTranslateBtn = card.querySelector('.showTranslate');
        const ukraineWord = card.querySelector('.ukraineWord');
        const actionButtons = card.querySelector('.action-buttons');

        showTranslateBtn.addEventListener('click', () => {
            ukraineWord.hidden = false;
            actionButtons.hidden = false;
            showTranslateBtn.hidden = true;
        });

        const knowBtn = card.querySelector('.knowBtn');
        const dontKnowBtn = card.querySelector('.dontKnowBtn');

        knowBtn.addEventListener('click', () => {
            console.log('Know button clicked' + userResponses);
            swipeCard(card, true);
        });
        dontKnowBtn.addEventListener('click', () => {
            console.log('Don\'t know button clicked' + userResponses);
            swipeCard(card, false);
        });
    });

    function swipeCard(card, isKnown) {
        const englishWord = card.querySelector('.englishWord').textContent;
        userResponses[englishWord] = isKnown ? "know" : "unknow";

        card.classList.add(isKnown ? 'translate-x-full' : '-translate-x-full', 'opacity-0');
        setTimeout(() => {
            card.remove();
        }, 500);
    }

    document.getElementById('finishSessionBtn').addEventListener('click', function (e) {
        e.preventDefault();

        document.getElementById('responsesInput').value = JSON.stringify(userResponses);

        document.getElementById('myForm').submit();
    });

</script>

@include('static.endbase')
