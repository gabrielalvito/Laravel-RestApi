<?php

namespace App\Http\Controllers\API;

use App\Helpers\RestApi;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mahasiswa::all();
        
        if($data){
            return RestApi::createApi(200, 'Berhasil', $data);
        }else{
            return RestApi::createApi(400, 'Gagal');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'nim' => 'required',
                'nama' => 'required',
                'angkatan' => 'required',
                'semester' => 'required',
                'ipk' => 'required',
                'email' => 'required',
                'telepon' => 'required',
            ]);

            $mahasiswa = Mahasiswa::create([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'angkatan' => $request->angkatan,
                'semester' => $request->semester,
                'ipk' => $request->ipk,
                'email' => $request->email,
                'telepon' => $request->telepon
            ]);

            $data = Mahasiswa::where('id', '=', $mahasiswa->id)->get();

            if($data){
                return RestApi::createApi(200, 'Berhasil', $data);
            }else{
                return RestApi::createApi(400, 'Gagal');
            }

        }catch(Exception $error){
            return RestApi::createApi(400, 'Gagal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        $data = Mahasiswa::where('nim', '=', $nim)->get();

        if($data){
            return RestApi::createApi(200, 'Berhasil', $data);
        }else{
            return RestApi::createApi(400, 'Gagal');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'nim' => 'required',
                'nama' => 'required',
                'angkatan' => 'required',
                'semester' => 'required',
                'ipk' => 'required',
                'email' => 'required',
                'telepon' => 'required',
            ]);

            $mahasiswa = Mahasiswa::findOrFail($id);

            $mahasiswa -> update([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'angkatan' => $request->angkatan,
                'semester' => $request->semester,
                'ipk' => $request->ipk,
                'email' => $request->email,
                'telepon' => $request->telepon
            ]);

            $data = Mahasiswa::where('id', '=', $mahasiswa->id)->get();

            if($data){
                return RestApi::createApi(200, 'Berhasil', $data);
            }else{
                return RestApi::createApi(400, 'Gagal');
            }

        }catch(Exception $error){
            return RestApi::createApi(400, 'Gagal');
        }
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
