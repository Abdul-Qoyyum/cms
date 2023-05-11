<?php

namespace App\Exports;

use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactExport implements FromCollection
{
    /**
     * @var string $_userId
     */
    private string $_userId;

    public function __construct($userId){
        $this->_userId = $userId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        Log::info("User : $this->_userId");
        return Contact::query()->where('user_id',$this->_userId)->get();
    }
}
