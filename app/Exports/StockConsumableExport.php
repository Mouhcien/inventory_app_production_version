<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockConsumableExport implements FromCollection, WithHeadings
{
    protected array $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return new Collection($this->data);

    }

    public function headings(): array
    {
        return ['Consommable', 'Type', 'Equipements', 'Quantité livré', 'Quantité resté', 'Date de livraison'];
    }
}
