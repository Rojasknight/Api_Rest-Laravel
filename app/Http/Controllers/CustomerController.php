<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Validator;

class CustomerController extends Controller
{
    /**
     *  
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with('transactions')->paginate(5);
        return $customers;
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
            'first_name' => 'required|min:5|max:16|string', 
            'last_name'  => 'required|min:5|max:16|string',
            'email'      => 'required|email|unique:customers,email',
        ]);

    
        if ($validate->fails()) {
            return response([
                'Mensaje' => 'el formulario contiene errores!',
                'errors'  => $validate->errors(),
            ], 401);
        }

        $customers = Customer::create($request->all());

        
        if ($customers) {
            return response([
                'mensaje' => 'Creado con exito',
                'id'      => $customers->id],
                200);


        }


        return response([
            'mensaje' => 'el cliente no ha sido creado con exito'],
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
        return Customer::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
            'first_name' => 'required|min:5|max:16|string', 
            'last_name'  => 'required|min:5|max:16|string',
            'email'      => 'required|email:customers,email,' . $id . ',id',

            
        ]);

        
        if ($validate->fails()) {
            return response([
                'Mensaje' => 'el formulario contiene errores!',
                'errors'  => $validate->errors(),
            ], 401);
        }

        $customers = Customer::findOrFail($id);
        
        $customers->update($request->all());

        if ($customers) {
            
            return response([
                'mensaje' => 'Cliente Editado',
                'id'      => $id,
            ], 200);
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
        $customers = Customer::destroy($id);

        if ($customers) {
            return response([
                'mensaje' => 'Cliente Eliminado con Exito!',
                'id'      => $id,
            ], 200);
        }
        return response([
            'mensaje' => 'Error al eliminar el cliente.',
            'id'      => $id,
        ], 401);
    }
}
