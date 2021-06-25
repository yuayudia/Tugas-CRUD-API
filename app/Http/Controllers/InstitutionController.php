<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Institution;
class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institution::all();
        return response()->json($institutions);
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
       $validate = Validator::make($request->all(), [
           'name' => 'required',
           'description' => 'required'
       ]);
       if ($validate->passes()) {
           $id = Institution::create($request->all());
           return response()->json([
               'pesan' => 'Data berhasil ditambahkan',
               'data' => $id
           ]);
       }
       return response()->json([
           'pesan' => 'Data gagal ditambahkan',
           'data' => $validate->errors()->all()
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Institution::where('id', $id)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['pesan'=>'Data tidak ditemukan'], 404);
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
        $data = Institution::where('id', $id)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required'
            ]);
            if ($validate->passes()) {
               $data->update($request->all());
               return response()->json([
                   'pesan' => 'Data berhasil di update',
                   'data' => $data
               ], 200);
            } else {
                return response()->json([
                    'pesan' => 'Data gagal di update',
                    'data' => $validate->errors()->all()
                ]);
            }
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
        $data = Institution::where('id', $id)->first();
        if (empty($data)) {
            return response()->json(['pesan' => 'Data tidak ditemukan'], 404);
        }
       $data->delete();
       return response()->json(['pesan' => 'Data berhasil dihapus'], 200);
    }
}
