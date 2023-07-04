<?php


namespace App\Exports;

use App\Models\Requests;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoicesExport implements FromCollection
{
    public function __construct(InvoicesRepository $invoices)
    {
        $this->invoices = $invoices;
    }

    public function collection()
    {
        return $this->invoices->all();
    }
}
