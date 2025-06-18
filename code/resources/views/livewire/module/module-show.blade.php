<div>
    {{-- Module header ---------------------------------------------------- --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1" class="mb-2">
            {{ $module->name }}
        </flux:heading>
        <a href="{{ route('skills.create', $module->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-1">Add skill</a>
        <flux:separator variant="subtle" />
    </div>

    <div class="inline-flex rounded-md shadow-xs">
        <ul class="list-disc list-inside">
            @foreach ($skills as $skill)
                <div class="inline-flex rounded-md shadow-xs">
                    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <p class="mb-3 font-normal text-2xl text-gray-700 dark:text-gray-400"> {{$skill->name}} </p>
                        <a href="{{route("skill.show", ['id' => $skill->id])}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Show more
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                        <a href="{{ route('skills.edit', $skill->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-1">Edit</a>
                        <a wire:click="deleteSkill({{ $skill->id }})" wire:confirm="Are you sure you want to remove this module?" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                    </div>
                </div>
            @endforeach
        </ul>
    </div>
    
</div>
