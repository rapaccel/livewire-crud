<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
         return view('dashboard')
        ->layout('components.layouts.app', ['title' => __('Dashboard')]);
    }
}
