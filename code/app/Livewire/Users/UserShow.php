<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserShow extends Component
{
    public $user;
    public $roles = [];

    public function render()
    {
        return view('livewire.users.user-show');
    }


    public function mount($id){
        $this->user = User::find($id); 
        $this->roles = $this->user->roles()->pluck("name");
    }
}
