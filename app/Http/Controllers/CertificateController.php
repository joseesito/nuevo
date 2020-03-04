<?php

namespace App\Http\Controllers;

use App\InscriptionUser;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /*
     * creacio nde certficado con DOMPDF
     */
    public function index (Request $request) {
        $doc = null;
        $query = [];

        return view('certificates.certificate', compact('query', 'doc'));
    }

    public function certificate (Request $request) {
        $doc = $request->doc;
        $query = InscriptionUser::select(
            'users.last_name', 'users.name', 'users.document', 'inscriptions.name as course', 'inscriptions.start_date'
        )
            ->join('inscriptions','inscriptions.id', '=', 'inscription_user.inscription_id')
            ->join('users', 'users.id', '=', 'inscription_user.user_id')
            ->where('users.document','=', $request->doc)
            ->get();
        // dd($query);

        return view('certificates.certificate', compact('query', 'doc'));
    }


}
