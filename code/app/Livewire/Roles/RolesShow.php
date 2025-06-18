<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;


class RolesShow extends Component
{
    public $role;

    public function render()
    {
        return view('livewire.roles.roles-show');
    }

    public function mount($id){
        $this->role = Role::find($id); 
    }
}
