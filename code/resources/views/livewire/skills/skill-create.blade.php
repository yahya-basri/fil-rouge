<div class="mt-8">
    <h1 class="text-2xl font-semibold">{{ $module->name }}</h1>
    <h3 class="mt-4 text-lg font-medium">Add New Skill</h3>

    <form
        wire:submit.prevent="createSkill"
        class="mt-5 space-y-6"
    >
        @csrf

        <flux:input
            type="text"
            wire:model="skillName"
            placeholder="Skill Name"
            class="w-full"
        />

        <flux:textarea
            wire:model="skillContent"
            placeholder="Skill Content"
            class="w-full h-32"
        ></flux:textarea>

        <flux:button type="submit" variant="primary">
            Add Skill
        </flux:button>
    </form>
</div>