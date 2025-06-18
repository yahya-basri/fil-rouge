<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1" class="mb-2">{{ __('Create module') }}</flux:heading>
        <flux:separator variant="subtle" />
    </div>

    <a href=" {{route("module.index")}} " type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Back</a>

    <div class="w-120">
        <form wire:submit="submit" class="mt-5 space-y-6">
            <flux:input wire:model="name" label="Name" placeholder="Name"/>
            <flux:button type="submit" variant="primary">Submit</flux:button>
        </form>
    </div>
</div>

