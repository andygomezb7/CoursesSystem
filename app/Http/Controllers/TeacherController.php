<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\profesores;
use Validator;
use Redirect;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = profesores::paginate(10);
          
        return view('teachers', compact('users'));
    }

    public function change (Request $request, $id) {
        $user = profesores::find($id);
        if (@$request->name && @$request->value) {
            profesores::where('id',$id)->update([
                @$request->name => @$request->value
            ]);
        }
        // return view('teachers', compact('user'));
    }

    public function put ($id) {
        $user = profesores::find($id);

        return view('teachers', compact('user'));
    }

    public function delete ($id) {
        profesores::where('id', $id)->delete();
        return Redirect::route('teachers.home');
    }

     public function update(Request $request)
    {
        $rules = [];
        $rules["name"] = 'required';
        $rules["telefono"] = 'required';
        $rules["correo"] = 'required';

        $validator = Validator::make($request->all(), $rules);


        if ($validator->passes()) {
            profesores::create([
                'Nombre'=>$request->input('name'),
                'Telefono'=>$request->input('telefono'),
                'Correo'=>$request->input('correo')
            ]);

            return response()->json(['success'=>'done']);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }
}