<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NavMenu extends Component
{
    public array $menus;
    public bool $responsive;

    public function __construct(bool $responsive = false)
    {
        $this->responsive = $responsive;
        $this->menus = $this->getMenus();
    }

    public function render()
    {
        return view('components.nav-menu', [
            'menus' => $this->menus,
            'responsive' => $this->responsive,
        ]);
    }

    protected function getMenus(): array
    {
        return Auth::user()?->getMenus() ?? [];
    }
}
