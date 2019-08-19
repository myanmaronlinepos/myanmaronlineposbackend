<?php

namespace App\Models\DataModel;

class DashBoardData {
    public $costData;
    public $sellData;
    public $profitData;

    /**
     * Class constructor.
     */
    public function __construct($costData,$sellData,$profitData)
    {
        $this->costData=$costData;
        $this->sellData=$sellData;
        $this->profitData=$profitData;
    }
}