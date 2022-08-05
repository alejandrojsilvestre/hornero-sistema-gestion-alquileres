<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\User;

class UsersComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $users = User::orderBy('id', 'asc')->get()->pluck('nombre','id');
        $view->with('users', $users);
    }
}