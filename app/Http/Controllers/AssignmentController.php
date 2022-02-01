<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\asignacion;
use App\materias;
use App\estudiantes;
use Validator;
use Redirect;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $asignacion = asignacion::paginate(10);
        $users = materias::paginate(10);
        $estudiantes = estudiantes::paginate(10);
          
        return view('assignment', compact('asignacion' ,'users', 'estudiantes'));
    }

    public function change (Request $request, $id) {
        $user = materias::find($id);
        if (@$request->name && @$request->value) {
            materias::where('id',$id)->update([
                @$request->name => @$request->value
            ]);
        }
        // return view('teachers', compact('user'));
    }

    public function delete ($id) {
        asignacion::where('id', $id)->delete();
        return Redirect::route('assignment.home');
    }

    public function assign (Request $request, $idEstudiante, $idMateria) {
        asignacion::create([
            'idestudiante'=>$idEstudiante,
            'idmateria'=>$idMateria,
        ]);

        return response()->json(['success'=>'done']);
    }
}