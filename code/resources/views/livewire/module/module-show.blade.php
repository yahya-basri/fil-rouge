<div>
    {{-- Module header --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1" class="mb-2">
            {{ $module->name }}
        </flux:heading>
        <a href="{{ route('module.edit', $module->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-1">Edit Module</a>
        <a wire:click="deleteModule" wire:confirm="Are you sure you want to remove this module and all its skills?" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete Module</a>
        <a href="{{ route('skills.create', $module->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-1">Add skill</a>
        <flux:separator variant="subtle" />
    </div>

    {{-- Completion Progress Bar --}}
    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mb-2">
        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $completionPercentage }}%"></div>
    </div>
    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">{{ number_format($completionPercentage, 0) }}% complete</p>

    {{-- Skills List --}}
    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Module Skills</h2>
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($skills as $skill)
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-between">
                <div>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" wire:model.live="skillCompleted.{{ $skill->id }}" id="skill-{{ $skill->id }}" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                        <label for="skill-{{ $skill->id }}" class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white cursor-pointer">{{ $skill->name }}</label>
                    </div>
                    @if($skill->content)
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-sm">{{ Str::limit($skill->content, 100) }}</p>
                    @endif
                </div>
                <div class="mt-4 flex flex-wrap gap-2">
                    <a href="{{ route('skill.show', $skill->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Show details
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                    <a href="{{ route('skills.edit', $skill->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:border-blue-500 dark:text-blue-500 dark:hover:bg-blue-500 dark:hover:text-white dark:focus:ring-blue-800">Edit</a>
                    <button type="button" wire:click="deleteSkill({{ $skill->id }})" wire:confirm="Are you sure you want to remove this skill?" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-red-600 border border-red-600 rounded-lg hover:bg-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-500 dark:hover:text-white dark:focus:ring-red-800">Delete</button>
                </div>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-400 col-span-full">No skills available for this module yet. Add one above!</p>
        @endforelse
    </div>
</div>