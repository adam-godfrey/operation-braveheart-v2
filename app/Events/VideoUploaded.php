<?php

namespace App\Events;

use App\Models\Admin\LotterySetting;
use Illuminate\Queue\SerializesModels;

class VideoUploaded
{
    use SerializesModels;

    public $setting;

    /**
     * Create a new event instance.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function __construct(LotterySetting $setting)
    {
        $this->setting = $setting;
    }
}