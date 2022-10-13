<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rules;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->usuarios|crear->usuarios|editar->usuarios|borrar->usuarios',['only'=>['index']]);
        $this->middleware('permission:crear->usuarios',['only'=>['create','store']]);
        $this->middleware('permission:editar->usuarios',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->usuarios',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios=User::all();
        return view('usuarios.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/personas');
        $roles=Role::pluck('name','name')->all();
        return view('usuarios.create',compact('roles'))
        ->with('personas', json_decode($response,true));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate ($request,[
            'persona'=>'required',
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>['required', 'same:confirm-password', Rules\Password::defaults() -> mixedCase() -> numbers() 
            -> letters() -> symbols()],
            'roles'=>'required'
        ]);

        $input=$request->all();
        $input['password'] = Hash::make($input['password']);

        $user=User::create($input);
        $user->assignRole($request->input('roles'));

        $response = Http::post('http://localhost:3000/empleados/insertar', [
            'cod_persona' => $request->persona,
            'user_registro' => Auth()->user()->name
        ]);

        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        $roles=Role::pluck('name','name')->all();
        $userRole=$user->roles->pluck('name','name')->all();
        return view('usuarios.edit',compact('user','roles','userRole'));
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
        $this->validate ($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>['required', 'same:confirm-password', Rules\Password::defaults() -> mixedCase() -> numbers() 
            -> letters() -> symbols()],
            'roles'=>'required'
        ]);

        $input=$request->all();
        if (!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input=Arr::except($input,array('password'));
        }

        $user=User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index')->with('eliminar', 'Ok');
    }
}
