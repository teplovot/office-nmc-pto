<div id="chat-container" x-data="{ open: false, recipient: null }" class="fixed bottom-4 right-4">
    <!-- Кнопка чату -->
    <button @click="open = !open"
        class="bg-blue-600 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-700 transition">
        💬 Чат
    </button>

    <!-- Панель чату -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-full opacity-0"
        class="fixed bottom-16 right-4 w-80 bg-white shadow-lg border rounded-lg overflow-hidden">

        <div class="bg-blue-600 text-white px-4 py-2 flex justify-between items-center">
            <p>Чат</p>
            <button @click="open = false" class="text-white text-3xl leading-none">&times;</button>
        </div>

        <div class="p-2 border-b">
            <label for="recipient" class="text-sm text-gray-700">Кому:</label>
            <select id="recipient" x-model="recipient" class="w-full mt-1 border rounded px-2 py-1 text-sm">
                <option value="" disabled selected>Оберіть користувача</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <audio id="notify-sound" src="{{ asset('sounds/new_message.mp3') }}" preload="auto"></audio>
        <ul id="chat-box" class="p-3 h-56 overflow-y-auto text-sm"></ul>

        <div class="border-t p-2 flex">
            <input id="message" type="text" placeholder="Введіть повідомлення..."
                class="flex-1 border rounded px-2 py-1 text-sm focus:outline-none">
            <button id="send" class="ml-2 bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">➤</button>
        </div>
    </div>
</div>

<script>
    const crfToken = '{{ $csrfToken }}';
    const authId = '{{ $authId }}';
</script>
