<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\materias;
use App\profesores;
use Validator;
use Redirect;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = materias::paginate(10);
        $teachers = profesores::paginate(10);
          
        return view('courses', compact('users', 'teachers'));
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

    public function put ($id) {
        $user = materias::find($id);
        $teachers = profesores::paginate(10);
        return view('courses', compact('user', 'teachers'));
    }

    public function delete ($id) {
        materias::where('id', $id)->delete();
        return Redirect::route('courses.home');
    }

     public function update(Request $request)
    {
        $rules = [];
        $rules["name"] = 'required';
        $rules["credito"] = 'required';
        $rules["horario"] = 'required';
        $rules["profesor"] = 'required';

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            materias::create([
                'nombrecurso'=>$request->input('name'),
                'creditos'=>$request->input('credito'),
                'horario'=>$request->input('horario'),
                'idprofesor'=>$request->input('profesor')
            ]);

            return response()->json(['success'=>'done']);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }
}