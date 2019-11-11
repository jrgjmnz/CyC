<?php

namespace App\Exports;

use App\OrdenCompra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdenesCompraExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OrdenCompra::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Contrato ID',
            'Licitacion ID',
            'Número Orden Compra',
            'Fecha Envío',
            'Total',
            'Estado',
            'Created At',
            'Updated At',
            'Deleted At',    

        ];
    }    
}