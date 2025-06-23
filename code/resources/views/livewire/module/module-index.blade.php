<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Modules') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage modules') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @can('module.create')
    <a href=" {{route("module.create")}} " type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Create module</a>
    @endcan



<div class="mt-5 grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($modules as $module)
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm
        dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ $module->name }}
            </h5>

            <a href="{{ route('module.show', $module->id) }}"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white
            bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Read more
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" viewBox="0 0 14 10" fill="none"
            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M1 5h12m0 0L9 1m4 4L9 9"
            stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            </a>
        </div>
    @endforeach
</div>

</div>
