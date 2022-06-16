<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Utils\Fecha;
use App\Models\Descarga;
use App\Models\Pago;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    /**
     * 0 Inicio
     * 1 Pago
     * 2 Desarrollo
     * 3 Listo
     */
    private $ESTADO = [
        0 => ["Aceptado", "Pendiente pago inicial"], //  Ingresar comprobante
        1 => ["En Validación", "Pago en revisión"], // Validar pago
        2 => ["En proceso", " La parte I está en proceso"],
        3 => ["Parte I Finalizada", "Pendiente pago I"],
        4 => ["En validación", "Pago I en revisión"],
        5 => ["Disponible Parte I", "Disponible para su descarga"],
        6 => ["En proceso", " La parte II está en proceso"],
        7 => ["Parte II Finalizada", "Pendiente pago"],
        8 => ["En validación", "Pago en revisión"],
        9 => ["Desarrollo finalizado", "Disponible para su descarga"],
        10 => ["Finalizado", "Proyecto  finalizado"],
    ];

    /**
     * Obtiene el estado actual de proyecto y muestra la vista correspondiente
     */
    public function Status($id)
    {
        try
        {
            // Validar ID de proyecto
            $project = Project::where("clave", $id)->first();
            if ($project == null) return view("errors.404"); // No existe

            // Obtener el estado del proyecto
            $estado = $this->ESTADO[$project->estado];
            return view(
                "project.status.aceptado",
                [
                    "proyecto" => $project, "estado" => $estado,
                ]
            );
        }
        catch (Exception $e)
        {
            dd($e);
            return view("errors.500");
        }
    }

    /**
     * Guardar pago inicial
     */
    public function PagoInicial(Request $request)
    {
        try
        {
            DB::beginTransaction();
            $project = Project::find($request->p_id);

            if ($project->estado != 0) return view("status.errorestado", $project);
            // Crear pago
            $path = $request->file('image')->store('public/pagos');
            $pago = new Pago();
            $pago->ruta = $path;
            $pago->project_id = $project->id;
            $pago->tipo = 1; // Inicial
            $pago->fecha = date("Y-m-d h:i:s");
            $pago->save();
            // Actualizar projecto
            $project->estado = 1; // Revision pago inicial
            $project->update();
            DB::commit();
            // Obtener el estado del proyecto
            return redirect(
                "project/status/" . $project->clave
            );
        }
        catch (Exception $e)
        {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Guardar el segundo pago
     */
    public function PagoDos(Request $request)
    {
        try
        {
            $project = Project::find($request->p_id);

            if ($project->estado != 3) return view("status.errorestado", $project);
            DB::beginTransaction();
            // Crear pago
            $path = $request->file('image')->store('public/pagos');
            $pago = new Pago();
            $pago->ruta = $path;
            $pago->project_id = $project->id;
            $pago->tipo = 2; // Segundo
            $pago->fecha = date("Y-m-d h:i:s");
            $pago->save();
            // Actualizar projecto
            $project = Project::find(1);
            $project->estado = 4; // Revision pago inicial
            $project->update();
            DB::commit();
            // Obtener el estado del proyecto
            return redirect(
                "project/status/" . $project->clave
            );
        }
        catch (Exception $e)
        {
            DB::rollBack();
            dd($e);
        }
    }

    public function DescargarFase1($clave)
    {
        try
        {
            DB::beginTransaction();
            // Obtener proyecto
            // Validar ID de proyecto
            $project = Project::where("clave", $clave)->first();
            if ($project == null) return view("errors.404"); // No existe
            $descarga = Descarga::where("proyecto_id", $project->id)
                ->where("tipo", 1) // fase1
                ->first();
            // Comprobar estado
            $aux_fecha = explode(" ", $descarga->fecha_descarga)[0];
            $fecha = Fecha::FechaCompleta($aux_fecha, "-", " de ", " del ");
            $hora = explode(" ", $descarga->fecha_descarga)[1];
            if ($project->estado > 5)
            {
                return view(
                    "project.status.descargado1",
                    compact("project", "descarga", "fecha", "hora")
                );
            }
            // Obtener archivo
            $nombre = pathinfo($descarga->file)["basename"];
            $pathtoFile = storage_path("app/") . $descarga->file;
            $project->estado = 6; // Descargado. Sigue parte 2
            $project->update();
            $descarga->estado = 1; // Descargado
            $descarga->fecha_descarga = date("Y-m-d h:i:s"); // Descargado
            $descarga->update();
            DB::commit();
            return response()->download($pathtoFile, $nombre);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            dd($e);
        }
    }

    public function FinalPay(Request $request)
    {
        try
        {
            DB::beginTransaction();
            $project = Project::find($request->p_id);
            if ($project->estado != 7) return view("status.errorestado", $project);
            // Crear pago
            $path = $request->file('image')->store('public/pagos');
            $pago = new Pago();
            $pago->ruta = $path;
            $pago->project_id = $project->id;
            $pago->tipo = 3; // Final
            $pago->fecha = date("Y-m-d h:i:s");
            $pago->save();
            // Actualizar projecto
            $project = Project::find($project->id);
            $project->estado = 8; // Revision pago inicial
            $project->update();
            DB::commit();

            // Obtener el estado del proyecto
            return redirect(
                "project/status/" . $project->clave
            );
            DB::commit();
        }
        catch (Exception $e)
        {
            dd($e);
        }
    }

    public function DescargarFinal($clave)
    {
        try
        {
            DB::beginTransaction();
            // Obtener proyecto
            // Validar ID de proyecto
            $project = Project::where("clave", $clave)->first();
            if ($project == null) return view("errors.404"); // No existe
            $descarga = Descarga::where("proyecto_id", $project->id)
                ->where("tipo", 2) // fase2
                ->first();
            if ($project->estado != 9)
            {
                // Comprobar estado
                $aux_fecha = explode(" ", $descarga->fecha_descarga)[0];
                $fecha = Fecha::FechaCompleta($aux_fecha, "-", " de ", " del ");
                $hora = explode(" ", $descarga->fecha_descarga)[1];
                return view(
                    "project.status.descargado1",
                    compact("project", "descarga", "fecha", "hora")
                );
            }
            // Obtener archivo
            $nombre = pathinfo($descarga->file)["basename"];
            $pathtoFile = storage_path("app/") . $descarga->file;
            $project->estado = 10; // Descargado. Sigue parte 2
            $project->update();
            $descarga->estado = 1; // Descargado
            $descarga->fecha_descarga = date("Y-m-d h:i:s"); // Descargado
            $descarga->update();
            DB::commit();
            // dd($pathtoFile);
            return response()->download($pathtoFile, $nombre);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->id);
        // dd($request->id);
        dd($request->has("tk"));
        return view("project");
    }

    /**
     * asdf
     */
    public function Cambiar(Request $request)
    {
        try
        {
            $project = Project::find($request->p_id);
            $asd=$request->estado+1;
            if($asd>=11) $asd=0;
            $project->estado =$asd;
            $project->update();
            return redirect(
                "project/status/" . $project->clave
            );
        }
        catch (Exception $e)
        {
            dd($e);
        }
    }
}
