<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContactsExport implements FromView, ShouldAutoSize
{

    public function  view(): View
    {
        $contacts = auth()->user()->contacts->sortBy('last_name');
        return view('exports.contacts-export', ['contacts' => $contacts]);
    }

}
