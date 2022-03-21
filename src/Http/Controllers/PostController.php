<?php

namespace Hore\HorePackage\Http\Controllers;

use App\Http\Controllers\Controller;
use Hore\HorePackage\Models\postTransactions;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{

    private  $massages =[
        'required' => 'di isi ya kakak!',
        'numeric' => 'yang ini harus nomer kak!!',
        'in'=> 'harus pilih yang bener dong kak'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // list data
        $transaction = postTransactions::orderBy('time' ,"DESC")->get();
        $response = [
            'massage' => "data tampil nih!!",
            'data' => $transaction
        ];

        return response()->json($response,Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'amount' => 'required|numeric',
            'type'=> 'required|in:expenses,revenue'
        ],$this->massages);


        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $transaction = postTransactions::create($request->all());
            $response = [
                'massage' => 'data berhasil di tambahin nih!!',
                'data ' => $transaction
            ];

            return response()->json($response,Response::HTTP_CREATED);
        } catch (QueryException $e) {
            //throw $th;
            $response = [
                'massage' => 'yah!! gagal bang,nih gagalnya'.$e->errorInfo
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = postTransactions::findOrFail($id);


        $response = [
            'massage'=> "dapet nih data berdasarkan id!",
            'data' => $transaction
        ];

        return response()->json($response,Response::HTTP_OK);
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
        //
        $transaction = postTransactions::findOrFail($id);


        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'amount' => 'required|numeric',
            'type'=> 'required|in:expenses,revenue'
        ],$this->massages);


        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $transaction->update($request->all());
            $response = [
                'massage' => 'data berhasil di ubah nih!!',
                'data ' => $transaction
            ];

            return response()->json($response,Response::HTTP_OK);
        } catch (QueryException $e) {
            //throw $th;
            $response = [
                'massage' => 'yah!! gagal bang,nih gagalnya'.$e->errorInfo
            ];
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
        $transaction = postTransactions::findOrFail($id);

        try {
            $transaction->delete();
            $response = [
                'massage' => 'data berhasil di hapus nih!!',
                'data ' => $transaction
            ];

            return response()->json($response,Response::HTTP_OK);
        } catch (QueryException $e) {
            //throw $th;
            $response = [
                'massage' => 'yah!! gagal bang,nih gagalnya'.$e->errorInfo
            ];
        }
    }
}
