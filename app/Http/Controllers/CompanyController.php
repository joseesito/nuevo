<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\SaveCompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::get();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create', ['company' => new Company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //-- Validamos los campos
        $fields = request()->validate([
            'ruc' => 'required|min:11|max:11|unique:companies',
            'name' => 'required',
            'address' => 'present',
            'phone' => 'nullable|alpha_dash',
        ]);

        //-- registramos al compania con los compos previamente validados.
        $company = Company::create($fields);

        return redirect()->route('companies.index')
            ->with('success','La Empresa  con Ruc: ' . $company->ruc .  ' y Razón Social: '. $company->name.' fue registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(SaveCompanyRequest $request, Company $company)
    {
        // -- recuperamos los campos validados
        $fields = $request->validated();

        //-- Actualizamos los campos de la empresa con los campos validados.
        $company->update($fields);

        return redirect()->route('companies.index')
            ->with('success','La Empresa  con Ruc: ' . $company->ruc .  ' y Razón Social: '. $company->name.' fue actuliazada correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
