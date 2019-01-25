<?php

namespace Infinety\TemplyThemeManager\Events;

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
    public $palette;

    /**
     * Create a new event instance.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function __construct($theme, $palette)
    {
        $this->theme = $theme;
        $this->palette = $palette;
    }
}
