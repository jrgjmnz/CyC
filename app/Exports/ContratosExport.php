<?php

namespace App\Exports;

use App\Contrato;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ContratosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contrato::all();
    }

    public function headings(): array
    {
        return [
        'ID',
        'Proveedor ID',
        'Licitacion',
        'Moneda ID',
        'Precio',
        'Diferencial',
        'Cargo ID',
        'Nombre Admin Tecnico',
        'Fecha Inicio',
        'Fecha Termino',
        'Fecha Aprobación',
        'Alerta Vencimiento',
        'Objeto Contrato',
        'Boleta ID',
        'Estado Alerta',
        'Tipo Contrato (0=Licitacion | 1=Trato Directo)',
        'Created At',
        'Updated At',
        'Deleted At',

        ];
    }    
}
