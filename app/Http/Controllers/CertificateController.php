<?php

namespace App\Http\Controllers;

use App\InscriptionUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class CertificateController extends Controller
{
    /*
     * creacio nde certficado con DOMPDF
     */
    public function index (Request $request) {
        $doc = null;
        $query = [];
        return view('certificates.index', compact('query', 'doc'));
    }

    public function list_certificate (Request $request) {
        $doc = $request->doc;
        $query = InscriptionUser::select(
            'inscription_user.id',
            'users.last_name', 'users.name', 'users.document', 'inscriptions.name as course',
            'inscriptions.start_date',
            'inscription_user.grade',
            DB::raw('IF(inscription_user.grade >= inscription_user.grade_min, 1, 0) as approved')
        )
            ->join('inscriptions','inscriptions.id', '=', 'inscription_user.inscription_id')

            ->join('users', 'users.id', '=', 'inscription_user.user_id')
            ->where('users.document','=', $request->doc)
            ->get();

        return view('certificates.index', compact('query', 'doc'));
    }

    public function certificate (Request $request, InscriptionUser $inscriptionUser) {

        setlocale(LC_TIME, 'Spanish');
        $date = implode("-", array_reverse(explode("/", $inscriptionUser->inscription->start_date)));
        $date = Carbon::parse($date);
        $day = $date->day;
        $month = $date->localeMonth;
        $year = $date->year;
        $date = str_pad($day, 2, "0", STR_PAD_LEFT). ' de '. ucfirst($month). ' del '. $year;

        $pdf = PDF::loadView('certificates.design', compact('inscriptionUser', 'date'))
            ->setPaper('a4', 'landscape');

//        dd($inscriptionUser->inscription->start_date);
        return $pdf->download(
            'CERTIFICADO DE  '. $inscriptionUser->user->document.'-'.$inscriptionUser->user->name. ' '. $inscriptionUser->user->last_name.
            '- CURSO ' .strtoupper($inscriptionUser->inscription->name.'.pdf')
        );
    }
}
