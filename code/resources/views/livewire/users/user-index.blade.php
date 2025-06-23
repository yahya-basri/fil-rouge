<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Users') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage all  your users') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    
    @can("users.create")
    <a href=" {{route("users.create")}} " type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Create user</a>
    @endcan

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
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="px-6 py-2 font-medium text-gray-900 dark:text-white"> {{$user->id}} </td>
                    <td class="px-6 py-2 font-medium text-gray-900 dark:text-white"> {{$user->name}} </td>
                    <td class="px-6 py-2 font-medium text-gray-900 dark:text-white"> {{$user->email}} </td>
                    <td class="px-6 py-2 font-medium text-gray-900 dark:text-white"> 
                        @if ($user->roles)
                            @foreach ($user->roles as $role)
                                <flux:badge> {{$role->name}} </flux:badge>
                            @endforeach
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href=" {{route("users.edit", $user->id)}} " class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-1">Edit</a>
                        <a wire:click='delete({{$user->id}})' wire:confirm="Are you sure yo want to remove this user" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                        <a href=" {{route("users.show", $user->id)}} " class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
