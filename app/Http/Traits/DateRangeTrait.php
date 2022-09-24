<?php
namespace App\Http\Traits;
use Carbon\CarbonPeriod;

trait DateRangeTrait {
    public function yearRange() {
        return CarbonPeriod::create('2020-01-01','P1Y', '2035-01-01');
    }
    public function monthRange() {
        return CarbonPeriod::create('2020-01-01','P1M', '2020-12-01');
    }
}