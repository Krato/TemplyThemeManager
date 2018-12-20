<?php

namespace Infinety\TemplyThemeManager\Events;

use App\Order;
use Illuminate\Queue\SerializesModels;

class ThemeActivated
{
    use SerializesModels;

    /**
     * @var mixed
     */
    public $theme;

    /**
     * @var mixed
     */
    public $pallete;

    /**
     * Create a new event instance.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function __construct($theme, $pallete)
    {
        $this->theme = $theme;
        $this->pallete = $pallete;
    }
}
