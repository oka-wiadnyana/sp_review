<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=Validator::make(
            $request->all(),
            [
                'service_unit'=>'required',
                'service_name'=>'required',
                'file'=>'required_with:old_file|mimes:pdf',
            ]
            );

            if($validate->fails()){
                return response('Isi semua field',200);
            }

            $file=$request->file('file');

            $file_name='Standar-Pelayanan-'.$request->service_unit.'-'.time().'.'.$file->getClientOriginalExtension();

            if($file->isValid()){
                $file->storeAs('sp',$file_name,'real_public');
            }

            try{
                Service::create([
                    'service_unit'=>$request->service_unit,
                    'service_name'=>$request->service_name,
                    'file'=>$file_name,
                ]);

                return response('Insert success',200);
            }catch(Exception $e){

                return response($e->getMessage(),200);
            }
           



            
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
