<div class="shadow rounded px-4 py-2 {{ $todo->is_done ? 'bg-green-300' : 'bg-gray-50' }}">
    <div class="text-lg font-bold flex items-center justify-between">
        <div>{{ $todo->title }}</div>
        <div class="flex items-center">
            <a href="{{ route('todo.edit', $todo->id) }}" class="inline-block px-2 py-1 bg-blue-600 text-white  text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Edit</a>

            <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" class="flex ml-2">
                @csrf
                @method('DELETE')
                <x-button color="red" small>Delete</x-button>
            </form>

            <form action="{{ route('todo.change-is-done', $todo->id) }}" method="POST" class="flex ml-2">
                @csrf
                <x-button :color="$todo->is_done ? 'gray' : 'blue'" small>
                    {{ $todo->is_done ? 'Mark As Undone' : 'Mark As Done' }}
                </x-button>
            </form>
        </div>
    </div>
    <div class="text-gray-600 mt-2">{{ $todo->body }}</div>
</div>
