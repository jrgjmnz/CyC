<?php

namespace App\Exports;

use App\Convenio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportesConvenioExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Convenio::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Proveedor ID',
            'Licitacion',
            'Objeto Contrato',
            'Fecha Inicio',
            'Fecha Termino',
            'Boleta ID',
            'Alerta Vencimiento',
            'Estado Alerta',
            'Created At',
            'Updated At',
            'Deleted At',

        ];
    }
}
