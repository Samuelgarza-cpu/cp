<?php

namespace App\Http\Controllers;

use App\Models\codigospostales;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CodigoPostal;
use App\Models\Community;
use App\Models\VWCommunityGPD;
use App\Models\ObjResponse;
use App\Models\Perimeter;
use App\Models\Municipality;

class CodigoPostalController extends Controller
{
    public function index(Response $response, $cp)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $list = CodigoPostal::where('codigopostal', $cp)->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de comunidades.';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function indexGPD(Response $response, $cp)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $list = VWCommunityGPD::where('codigopostal', $cp)->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de comunidades GPD.';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function indexCommunities(Response $response, Int $municipio_id = null)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            if ($municipio_id > 0) $list = CodigoPostal::select('Colonia')->where('MunicipioId', $municipio_id)->get();
            else $list = CodigoPostal::all();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de comunidades.';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function indexCommunitiesGPD(Response $response, Int $municipio_id = null)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            if ($municipio_id > 0) $list = VWCommunityGPD::select('Colonia')->where('MunicipioId', $municipio_id)->get();
            else $list = VWCommunityGPD::all();

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de comunidades GPD.';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function showCommunity(Response $response, $id)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $community = Community::where('id', $id)->first();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Comunidad encontrada.';
            $response->data["result"] = $community;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function showCommunityGPD(Response $response, $id)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $community = VWCommunityGPD::where('id', $id)->first();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Comunidad GPD encontrada.';
            $response->data["result"] = $community;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function createOrUpdateCommunity(Response $response, Request $request)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $community = null;
            if ($request->id > 0) $community = Community::where('id', $request->id)->first();
            if (!$community) $community = new Community();

            // $municipio = $this->getMunicipioByName($request->municipality);

            $community->name = $request->name;
            $community->postalCode = $request->postalCode;
            $community->type = $request->type;
            $community->zone = $request->zone;
            $community->municipalities_id = $request->municipalities_id;
            $community->perimeter_id = $request->perimeter_id;
            $community->save();
            // if ($request->active != "") $perimeter->active = (bool)$request->active; 

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = $request->id > 0 ? 'Peticion satisfactoria | Comunidad actualizda.' : 'Peticion satisfactoria | Comunidad creada.';
            $response->data["alert_title"] = $request->id > 0 ? 'Comunidad actualizda.' : 'Comunidad creada.';
            $response->data["alert_text"] = $request->id > 0 ? 'Comunidad actualizda.' : 'Comunidad creada.';
            $response->data["result"] = $community;
        } catch (\Exception $ex) {
            $msg =  "Error al crear o actualizar perimetro: " . $ex->getMessage();
            error_log($msg);

            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function colonia(Response $response, $id)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $list = CodigoPostal::where('id', $id)->first();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Comunidad encontrada.';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function perimeters(Response $response, Request $request)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $list = $request->id > 0 ? Perimeter::find($request->id) : Perimeter::all();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = $request->id > 0 ? 'Peticion satisfactoria | Perimetro encontrado.' : 'Peticion satisfactoria | Perimetros encontrados.';
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
    public function selectIndexPerimeters(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = Perimeter::where('active', true)
                ->select('perimeters.id as id', 'perimeters.perimeter as label')
                ->orderBy('perimeters.perimeter', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de perimetros';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function createOrUpdatePerimeter(Response $response, Request $request)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $perimeter = Perimeter::where('id', $request->id)->first();
            if (!$perimeter) $perimeter = new Perimeter();

            $perimeter->perimeter = $request->perimeter;
            if ($request->active != "") $perimeter->active = (bool)$request->active;

            $perimeter->save();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = $request->id > 0 ? 'Peticion satisfactoria | Perímetro actualizdo.' : 'Peticion satisfactoria | Perímetro creado.';
            $response->data["alert_title"] = $request->id > 0 ? 'Perímetro actualizdo.' : 'Perímetro creado.';
            $response->data["alert_text"] = $request->id > 0 ? 'Perímetro actualizdo.' : 'Perímetro creado.';
            // $response->data["result"] = $perimeter;

        } catch (\Exception $ex) {
            $msg =  "Error al crear o actualizar perimetro: " . $ex->getMessage();
            error_log($msg);

            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function communitiesByPerimeter(Response $response, Int $perimeter_id)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $list = CodigoPostal::where('PerimetroId', $perimeter_id)->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Comunidades por perimetro encontrados.';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function communitiesGPDByPerimeter(Response $response, Int $perimeter_id)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $list = VWCommunityGPD::where('PerimetroId', $perimeter_id)->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Comunidades GPD por perimetro encontrados.';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function assignPerimeterToCommunity(Response $response, Int $perimeter_id, Int $community_id)
    {
        try {
            $response->data = ObjResponse::DefaultResponse();
            $community = Community::where('id', $community_id)->first();
            if ($community) {
                $community->perimeter_id = $perimeter_id;
                $community->save();

                $response->data = ObjResponse::CorrectResponse();
                $response->data["message"] = 'Peticion satisfactoria | Perimetro asignado.';
                $response->data["alert_title"] = 'Perímetro asignado.';
                $response->data["alert_text"] = 'Perímetro asignado.';
                // $response->data["result"] = $list;
            } else {
                $response->data["message"] = 'Peticion no satisfactoria | No se encontro communidad.';
                $response->data["alert_title"] = 'No se encontro communidad.';
                $response->data["alert_text"] = 'No se encontro communidad.';
            }
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function getMunicipioByName($municipio)
    {
        try {
            // $response->data = ObjResponse::DefaultResponse();
            $municipio = Municipality::where('name', $municipio)->first();
            // $response->data = ObjResponse::CorrectResponse();
            // $response->data["message"] = 'Peticion satisfactoria | Municipio encontrado.';
            // $response->data["result"] = $municipio;

            return $municipio;
        } catch (\Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        // return response()->json($response, $response->data["status_code"]);
    }
}
