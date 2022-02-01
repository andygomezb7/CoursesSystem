<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\estudiantes;
use Validator;
use Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = estudiantes::paginate(10);
          
        return view('users', compact('users'));
    }

    public function change (Request $request, $id) {
        $user = estudiantes::find($id);
        if (@$request->name && @$request->value) {
            estudiantes::where('id',$id)->update([
                @$request->name => @$request->value
            ]);
        }
        // return view('users', compact('user'));
    }

    public function put ($id) {
        $user = estudiantes::find($id);

        return view('users', compact('user'));
    }

    public function delete ($id) {
        estudiantes::where('id', $id)->delete();
        return Redirect::route('users.home');
    }

     public function update(Request $request)
    {
        $rules = [];
        $rules["name"] = 'required';
        $rules["telefono"] = 'required';
        $rules["correo"] = 'required';

        $validator = Validator::make($request->all(), $rules);


        if ($validator->passes()) {
            estudiantes::create([
                'Nombre'=>$request->input('name'),
                'Telefono'=>$request->input('telefono'),
                'Correo'=>$request->input('correo')
            ]);

            return response()->json(['success'=>'done']);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }
}