<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
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
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets;

//añadiendo multipleSheets(ventas)
class GradeExport implements FromQuery, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithEvents
//,WithMultipleSheets,WithMapping 
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(String $start_date)
    {
        $this->start_date = $start_date;
        
    }
    /*
    //llamando a las hojas para la ventana
    public function sheets(): array
    {
        $sheets = [];
        $i=0;

        for ($i = 1; $i <= 4; $i++) {
            $sheets[] = new GradePerMonthSheet($this->year, $month);
        }

        return $sheets;
    }
    
    public function map($user): array
    {
        return [
            $user->name,
            $user->document,
            Date::dateTimeToExcel($invoice->created_at),
        ];
    }
    */
    //Consulta para Exportar datos del usuario y sus notas
    public function query(){

        $query = InscriptionUser::query()
        ->select('users.document','users.last_name','users.name','users.position','users.area','users.management','companies.ruc','inscription_user.company as company',
        'inscriptions.start_date','unities.name as unity',
        DB::raw('GROUP_CONCAT(CONCAT(facilitador.name, " ",facilitador.last_name) separator " / ")  as Facilitador'),  
        DB::raw('SUM(CASE WHEN course_id=1 THEN inscription_user.grade ELSE 0 END) as IPERC'),
        DB::raw('SUM(CASE WHEN course_id=2 THEN inscription_user.grade ELSE 0 END) as Liderazgo'),
        DB::raw('SUM(inscriptions.hours) as hours'))
        
        ->join('inscriptions','inscriptions.id','=','Inscription_user.inscription_id')
        ->join('users','users.id','=','inscription_user.user_id')
        ->join('users as facilitador','facilitador.id','=','inscriptions.user_id')
        ->join('courses','courses.id','=','inscriptions.course_id')
        ->join ('unities', 'inscription_user.unity_id', '=' ,'unities.id')
        ->join('companies','inscription_user.company_id','=','companies.id')

        ->where('inscriptions.state','<>' ,0)   
        ->whereIn('inscription_user.state', [1,2]) 
        ->groupBy ('users.name','users.last_name','inscriptions.start_date');


        return $query;
    }
    //cabeceras
    public function headings(): array
    {
        return [
            'Dni',
            'Apellidos',
            'Nombres',
            'Cargo',
            'Area',
            'Gerencia',
            'Ruc',
            'Contratista',
            'Fecha Inicio',
            'Unidad Minera',
            'Facilitador', 
            'IPERC',
            'LIDERAZGO Y MOTIVACION',
            'Horas',
            
            
        ];
    }
    
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
