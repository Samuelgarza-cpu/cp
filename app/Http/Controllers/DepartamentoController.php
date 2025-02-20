<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\DepartamentoView;
use App\Models\ObjResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Response $response)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $list = DepartamentoView::all();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de comunidades.';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Mostrar listado para un selector.
     *
     * @return \Illuminate\Http\Response $response
     */
    public function selectIndex(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = DepartamentoView::where('activo', true)
                ->select('id as id', DB::raw("CONCAT(departamento, ' (', clave_org, ')') as label"))
                ->orderBy('departamento', 'asc')->get();

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | lista de departamentos.';
            $response->data["alert_text"] = "departamentos encontrados";
            $response->data["result"] = $list;
            $response->data["toast"] = false;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Response $response)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $list = DepartamentoView::all();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | departamento creado.';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $msg = "DepartamentoController ~ store ~ Error al crear -> " . $ex->getMessage();
            Log::error($msg);
            $response->data = ObjResponse::CatchResponse($msg);
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response, string $id)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $departmaneto = DepartamentoView::where('id', $id)->firstOrFail();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | departamento encontrado.';
            $response->data["result"] = $departmaneto;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
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
