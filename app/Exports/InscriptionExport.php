<?php

namespace App\Exports;

use App\Inscription;
use App\User;
USE DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InscriptionExport implements FromQuery, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithEvents
{
    use Exportable;
    /**
     * @inheritDoc
     */



    public function query()
    {
        return User::query()
            ->select(
                DB::raw('if(users.type_document = 1,"DNI","PASAPORTE")')

                ,'users.document',
            'users.last_name','users.name',
            'users.position','users.area',
            'users.management','companies.ruc as ruc',
            'companies.name as company','unities.name as unity'
            )
            ->join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->join('companies', 'companies.id', '=', 'users.company_id')
            ->join('unities', 'unities.id', '=', 'users.unity_id')
            ->where('model_has_roles.role_id', 2)
            ->whereIn('users.state', [1,2]);
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return [
            'Tipo_Documento',
            'Dni/Documento',
            'Apellidos',
            'nombres',
            'Cargo',
            'Area',
            'Gerencia',
            'Ruc',
            'Empresa',
            'Unidad_Minera',
        ];
    }


    /**
     * @inheritDoc
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }

    /**
     * @inheritDoc
     */
    public function registerEvents(): array
    {
        // Estilos de la cabecera del excel


        $styleArray = [
            'font' => [
                'bold' => false,
            ]
        ];

        return [
            AfterSheet::class => function (AfterSheet $event) use($styleArray) {
                $event->sheet->getStyle('A1:I1')->applyFromArray($styleArray);

            },
        ];
    }
}
