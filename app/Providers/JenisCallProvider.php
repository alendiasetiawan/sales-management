<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class JenisCallProvider extends ServiceProvider
{
    public const COLD_CALL = 'Cold Call';
    public const WARM_CALL = 'Warm Call';
    public const LEAD_GENERATED = 'Lead Generated';
    public const SALES_CLOSING = 'Sales Closing';
}
