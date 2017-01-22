<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;
use Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'name'   => 'required|min:4|max:14|string',
            'amount' => 'required',
        ]);

      
        if ($validate->fails()) {
            return response([
                'Mensaje' => 'el formulario contiene errores!',
                'errors'  => $validate->errors(),
            ], 401);
        }

        $trasaction = Transactions::create($request->all());

        
        if ($trasaction) {
            return response([
                'mensaje' => 'Creado con exito',
                'id'      => $trasaction->id],
                200);

        }

        
        return response([
            'mensaje' => 'La trasaccion no ha sido creada con exito'],
            500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $trasaction = Transactions::findOrFail($id);

        if ($trasaction) {
            return response([
                'mensaje' => 'Usuario encontrado',
                'data'    => $trasaction,
            ], 200);
        }

        return response([
            'mensaje' => 'transaccion no encontrada',
        ], 401);
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
        $validate = Validator::make($request->all(), [
            'name'   => 'required|min:4|max:14|string',
            'amount' => 'required',
        ]);

       
        if ($validate->fails()) {
            return response([
                'Mensaje' => 'el formulario contiene errores!',
                'errors'  => $validate->errors(),
            ], 401);
        }

        $trasaction = Transactions::findOrFail($id);
        $trasaction->update($request->all());

        if ($trasaction) {
            
            return response([
                'mensaje' => 'Transaccion Editada',
                'id'      => $id,
            ], 200);
        }

        return response([
            'mensaje' => 'la Transaccion no ha sido editada',
            'id'      => $id,
        ], 401);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        $trasaction = Transactions::destroy($id);

        if ($trasaction) {
            return response([
                'mensaje' => 'Transaccion Eliminada con Exito!',
                'id'      => $id,
            ], 200);
        }
        return response([
            'mensaje' => 'Error al eliminar la transaccion.',
            'id'      => $id,
        ], 401);
    }
}
