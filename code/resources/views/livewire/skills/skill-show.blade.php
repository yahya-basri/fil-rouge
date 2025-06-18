<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1" class="mb-2">
            Part of the <a href="{{ route('module.show', ['id' => $skill->module->id]) }}">{{ $skill->module->name }}</a> module 
        </flux:heading>
        <flux:separator variant="subtle" />
    </div>
    <p>
        <p>{{$skill->content}}</p>
    </p>
</div>