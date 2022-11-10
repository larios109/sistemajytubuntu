<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Agregamos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\auth;

class RolController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:visualizar roles|crear rol|editar rol|borrar rol',['only'=>['index']]);
        $this->middleware('permission:crear rol',['only'=>['create','store']]);
        $this->middleware('permission:editar rol',['only'=>['edit','update']]);
        $this->middleware('permission:borrar rol',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::paginate(50);
        $user = Auth::user();
        $fecha = now();
        return view ('roles.index',compact('roles'),["user"=>$user, "fecha"=>$fecha]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission=Permission::get();

        $personas = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->where('id', '<', '5')->get();

        $direcciones = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [5, 8])->get();

        $Correos = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [9, 12])->get();

        $telefonos = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [13, 16])->get();

        $colaboradores = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [17, 20])->get();

        $pagosalario = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [21, 24])->get();

        $materiaentrante = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [25, 28])->get();

        $materiasaliente = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [29, 32])->get();

        $categorias = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [33, 36])->get();

        $productos = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [37, 40])->get();

        $insumos = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [41, 44])->get();

        $solicitud = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [45, 48])->get();

        $reportes = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->where('id', '=', '49')->get();

        $bitacora = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->where('id', '=', '50')->get();

        $roles = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [51, 54])->get();

        $preguntas = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [55, 58])->get();

        $backup = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [59, 61])->get();

        $usuaruios = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [62, 65])->get();

        return view ('roles.create',compact('permission'),["personas"=>$personas, "usuaruios"=>$usuaruios,
        "direcciones"=>$direcciones, "Correos"=>$Correos, "telefonos"=>$telefonos, "colaboradores"=>$colaboradores,
        "pagosalario"=>$pagosalario, "materiaentrante"=>$materiaentrante, "materiasaliente"=>$materiasaliente,
        "categorias"=>$categorias, "productos"=>$productos, "insumos"=>$insumos, "solicitud"=>$solicitud,
        "reportes"=>$reportes, "bitacora"=>$bitacora, "roles"=>$roles, "preguntas"=>$preguntas, "backup"=>$backup]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index');   
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
        $role = Role::find($id);

        $permission=Permission::get();

        $personas = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->where('id', '<', '5')->get();

        $direcciones = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [5, 8])->get();

        $Correos = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [9, 12])->get();

        $telefonos = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [13, 16])->get();

        $colaboradores = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [17, 20])->get();

        $pagosalario = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [21, 24])->get();

        $materiaentrante = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [25, 28])->get();

        $materiasaliente = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [29, 32])->get();

        $categorias = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [33, 36])->get();

        $productos = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [37, 40])->get();

        $insumos = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [41, 44])->get();

        $solicitud = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [45, 48])->get();

        $reportes = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->where('id', '=', '49')->get();

        $bitacora = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->where('id', '=', '50')->get();

        $roles = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [51, 54])->get();

        $preguntas = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [55, 58])->get();

        $backup = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [59, 61])->get();

        $usuaruios = DB::table('permissions')
        ->select('id', 'name', 'guard_name')
        ->whereBetween('id', [62, 65])->get();

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit',compact('role','permission','rolePermissions'),["personas"=>$personas,
        "direcciones"=>$direcciones, "Correos"=>$Correos, "telefonos"=>$telefonos, "colaboradores"=>$colaboradores,
        "pagosalario"=>$pagosalario, "materiaentrante"=>$materiaentrante, "materiasaliente"=>$materiasaliente,
        "categorias"=>$categorias, "productos"=>$productos, "insumos"=>$insumos, "solicitud"=>$solicitud,
        "reportes"=>$reportes, "bitacora"=>$bitacora, "roles"=>$roles, "preguntas"=>$preguntas, "backup"=>$backup, "usuaruios"=>$usuaruios]);
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
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar = Http::delete('http://localhost:3000/roles/eliminar/'.$id);
        return redirect()->route('roles.index');
    }
}