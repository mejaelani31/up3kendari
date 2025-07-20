<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; // Pastikan untuk mengimpor Auth

class SidebarMenu extends Component
{
    /**
     * Merender tampilan komponen.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.sidebar-menu');
    }
}
