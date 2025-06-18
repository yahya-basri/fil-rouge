<div class="mt-8">
    <h1 class="text-2xl font-semibold">{{$this->name }}</h1>
    <h3 class="mt-4 text-lg font-medium">Edit skill</h3>

    <form
        wire:submit="submit,"
        class="mt-5 space-y-6"
    >
        @csrf

        <flux:input
            type="text"
            wire:model="name"
            placeholder="Title"
            class="w-full"
        />

        <flux:textarea
            wire:model="content"
            placeholder="Content"
            class="w-full h-32"
        ></flux:textarea>

        <flux:button wire:click="editSkill({{ $skill->id }})" type="submit" variant="primary">
            Edit Skill
        </flux:button>
    </form>
</div>