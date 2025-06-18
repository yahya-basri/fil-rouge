<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Roles') }}</flux:heading>
        <flux:separator variant="subtle" />
    </div>

    <a href=" {{route("roles.create")}} " type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Create role</a>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Permissions
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td class="px-6 py-2 font-medium text-gray-900 dark:text-white"> {{$role->id}} </td>
                    <td class="px-6 py-2 font-medium text-gray-900 dark:text-white"> {{$role->name}} </td>
                    <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                        @if ($role->permissions)
                            @foreach ($role->permissions as $permission)
                                <flux:badge> {{$permission->name}} </flux:badge>
                            @endforeach
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href=" {{route("roles.edit", $role->id)}} " class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-1">Edit</a>
                        <a wire:click='delete({{$role->id}})' wire:confirm="Are you sure yo want to remove this role" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                        <a href=" {{route("roles.show", $role->id)}} " class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

