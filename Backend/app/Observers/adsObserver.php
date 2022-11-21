<?php

namespace App\Observers;

use App\Models\Ads;
use Illuminate\Support\Facades\File;

class adsObserver
{
    /**
     * Handle the Ads "created" event.
     *
     * @param  \App\Models\Ads  $ads
     * @return void
     */
    public function created(Ads $ads)
    {
        //
    }

    /**
     * Handle the Ads "updated" event.
     *
     * @param  \App\Models\Ads  $ads
     * @return void
     */
    public function updated(Ads $ads)
    {
        //
    }

    /**
     * Handle the Ads "deleted" event.
     *
     * @param  \App\Models\Ads  $ads
     * @return void
     */
    public function deleted(Ads $ads)
    {
        //
    }
    public function deleting(Ads $ads)
    {
        $image=$ads->image;
        $image_path=public_path($image);
        File::delete($image_path);
    }
    /**
     * Handle the Ads "restored" event.
     *
     * @param  \App\Models\Ads  $ads
     * @return void
     */
    public function restored(Ads $ads)
    {
        //
    }

    /**
     * Handle the Ads "force deleted" event.
     *
     * @param  \App\Models\Ads  $ads
     * @return void
     */
    public function forceDeleted(Ads $ads)
    {
        //
    }
}
