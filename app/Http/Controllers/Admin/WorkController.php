<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Work;
use App\Type;
use App\Student;
use App\Academic;
use App\Http\Requests\WorkStoreRequest;
use App\Http\Requests\WorkUpdateRequest;
class WorkController extends Controller
{

    
    /* security verification */
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = Work::orderBy('id','DESC')->paginate();
        $types = Type::orderBy('id','ASC')->get();
        $students = Student::orderBy('id','ASC')->get();
        $academics = Academic::orderBy('id','ASC')->get();
        //dd($types); //funcionara para revisar los datos de la bd 
        return view('admin.works.index', compact('works','types','students','academics'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $students = Student::orderBy('id','ASC')->get();
        $academics = Academic::orderBy('id','ASC')->get();
        $types = Type::orderBy('id','ASC')->get();
        $works = Work::orderBy('id','DESC')->paginate();
        return view('admin.works.create',compact('types','works','students','academics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkStoreRequest $request)
    {
        $work = Work::create($request->all());
        return  redirect()->route('works.index',$work->id)->with('info','Actividad de titulación creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $work=Work::find($id);
        $types = Type::orderBy('id','ASC')->get();
        $students = Student::orderBy('id','ASC')->get();
        $academics = Academic::orderBy('id','ASC')->get();
        //dd($types); //funcionara para revisar los datos de la bd 
        return view('admin.works.show',compact('work','types','students','academics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $work=Work::find($id);
        $students = Student::orderBy('id','ASC')->get();
        $academics = Academic::orderBy('id','ASC')->get();
        $types = Type::orderBy('id','ASC')->get();
        return view('admin.works.edit',compact('work','types','students','academics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkUpdateRequest $request, $id)
    {
        $work=Work::find($id);
        $work->fill($request->all())->save();
        return  redirect()->route('works.index',$work->id)->with('info','Actividad de titulación actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $work=Work::find($id)->delete();
       return back()->with('info','Eliminado correctamente'); 
    }
}