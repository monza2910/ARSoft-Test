<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public $complete;
    public $incomplete;
    public function __construct()
    {
        $this->complete = Task::where('status','complete')->count();
        $this->incomplete = Task::where('status','incomplete')->count();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('task.index',[
            'tasks'     => Task::all(),
            'complete'  => $this->complete,
            'incomplete'  => $this->incomplete,
            'title'     => 'Halaman Task'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_deadline'  => 'required',
            'warna'             => 'required',
            'keterangan'        => 'required|max:50'
        ]);

        try {
            Task::create([
                'tanggal_deadline'  => $request->tanggal_deadline,
                'warna'             => $request->warna,
                'keterangan'        => $request->keterangan,
                'status'            => 'incomplete'
            ]);

            Alert::success('Task Berhasil Ditambahkan');
            return redirect()->route('task.index');
        } catch (\Throwable $th) {
            Alert::error('Error Title', 'Error' . $th->getMessage());
            return redirect()->back()->withInput($request->all());
        }


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
    public function edit(Request $request)
    {
        $data = Task::findOrFail($request->get('id'));
        echo json_encode($data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task   = Task::findOrFail($id);
        try {
            $task->delete();
            Alert::success('Task Berhasil Dihapus');
            return redirect()->route('task.index');
        } catch (\Throwable $th) {
            Alert::error('Error Title', 'Error' . $th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function updateStatus($id){
        try {
            Task::where('id',$id)->update([
                'status'    => 'complete',
            ]);
            Alert::success('Task Berhasil DiUpdate');
            return redirect()->route('task.index');
        } catch (\Throwable $th) {
            Alert::error('Error Title', 'Error' . $th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function sortBy($by,$sort){
        if ($by == "created_at") {
            if ($sort == 'desc') {
                return view('task.index',[
                    'complete'  => $this->complete,
                'incomplete'  => $this->incomplete,
                    'tasks' => Task::orderBy('created_at','desc')->get(),
                    'title' => 'Halaman Task'
                ]);
            } else {
                return view('task.index',[
                    'complete'  => $this->complete,
                    'incomplete'  => $this->incomplete,
                    'tasks' => Task::orderBy('created_at','asc')->get(),
                    'title' => 'Halaman Task'
                ]);
            }

        } else {
            if ($sort == 'desc') {
                return view('task.index',[
                    'complete'  => $this->complete,
                    'incomplete'  => $this->incomplete,
                    'tasks' => Task::orderBy('tanggal_deadline','desc')->get(),
                    'title' => 'Halaman Task'
                ]);
            } else {
                return view('task.index',[
                    'complete'  => $this->complete,
                    'incomplete'  => $this->incomplete,
                    'tasks' => Task::orderBy('tanggal_deadline','asc')->get(),
                    'title' => 'Halaman Task'
                ]);
            }
        }

    }

    public function orderByStatus($status){
        $tasks  = Task::where('status',$status)->get();
        return view('task.index',[
            'complete'  => $this->complete,
            'incomplete'  => $this->incomplete,
            'tasks' => $tasks,
            'title' => 'Task Status' . $status
        ]);
    }
}
