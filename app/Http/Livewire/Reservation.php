<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DateVerification extends Component
{
    public $startDate;
    public $endDate;

    public function verifyDates()
    {
        // TODO: Verify if the start and end dates are valid
    }

    public function render()
    {
        return view('livewire.date-verification');
    }
}

