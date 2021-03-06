<?php

namespace App\Exports;

use App\InscriptionUser;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InscriptionUsersExport implements FromQuery, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithEvents
{
    use Exportable;
    /**
     * @inheritDoc
     */

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        $list = InscriptionUser::query()
            ->select('users.document',
                'users.last_name', 'users.name',
                'users.position',
                'users.area',
                'users.management',
                'companies.ruc',
                DB::raw('IF(IFNULL(companies.id,-1) =  -1, inscription_user.company, companies.name) as company'),
                'inscription_user.grade',
                'users.send_email'

                )
            ->join('users', 'users.id', '=', 'inscription_user.user_id')
            ->leftJoin('companies', 'companies.id', '=', 'inscription_user.company_id')
            ->where('inscription_user.inscription_id', $this->id)
            ->whereIn('inscription_user.state', [1,2]);
        return $list;
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return [
            'Dni/Documento',
            'Apellidos',
            'nombres',
            'Cargo',
            'Area',
            'Gerencia',
            'Ruc',
            'Empresa',
            'Nota',
            'Correo Envio',
        ];
    }

    /**
     * @inheritDoc
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
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
                'bold' => true,
            ]
        ];

        return [
            AfterSheet::class => function (AfterSheet $event) use($styleArray) {
                $event->sheet->getStyle('A1:I1')->applyFromArray($styleArray);
            },
        ];
    }
}
