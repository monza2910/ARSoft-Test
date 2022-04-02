@extends('partials.layout')

@section('title')
    {{$title}}
@endsection


@section('content')
<div class="container-md mt-5">
        <h4 class="font-weight-bolder">List Tugas Harian</h4>
        <div class="row mt-3">
            <div class="col-md-6 mt-1">
                <p class="text-muted">Klik tombol <a class="btn btn-tugas-baru" type="button" data-toggle="modal" data-target="#modal_aside_left"><i class='fas fa-plus'></i> Tugas Baru</a> untuk membuat tugas harian baru
                 jangan lupa untuk memeriksa tgas anda yang sudah terselsaikan</p>
            </div>
            <div class="col-md-3 ml-auto">
                    <p class="font-weight-bolder">Tampilkan Tugas Yang</p>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('task.count','incomplete')}}" class="btn shadow tampilan-tugas uncompleted">Belum selesai <span class="ml-2 font-weight-bold">{{$incomplete}}</span></a>
                        <a href="{{route('task.count','complete')}}" class="btn shadow tampilan-tugas">Selesai <span class="ml-2 font-weight-bold">{{$complete}}</span></a>
                    </div>
            </div>
            <div class="col-md-3 ">
                    <p class="font-weight-bolder">Urut Berdasarkan</p>
                    <button class="btn shadow btn-block uncompleted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort By</button>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('task.sort',['by' => 'created_at','sort'=> 'desc'])}}">Tanggal Dibuat(Terbaru)</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('task.sort',['by' => 'created_at','sort'=> 'asc'])}}">Tanggal Dibuat(Terlama)</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('task.sort',['by' => 'tanggal_deadline','sort'=> 'desc'])}}">Deadline Tugas(Terbaru)</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('task.sort',['by' => 'tanggal_deadline','sort'=> 'desc'])}}">Deadline Tugas(Terlama)</a>
                    </div>
            </div>
        </div>

        {{-- Section task --}}
        <div class="row mt-5">
            <div class="col-md-3 mb-2">
                <div class="card shadow">
                    <div class=" card-task-add">
                        <a type="button" data-toggle="modal" data-target="#modal_aside_left" style="text-decoration: none;" class=" d-flex justify-content-center my-4"><i class='fas fa-plus-circle fa-9x button-add-task'></i></a>
                    </div>
                </div>
            </div>

            @foreach ($tasks as $task)

            {{-- ccard body content --}}
            <div class="col-md-3 mb-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <a class="ml-2 bunderan" style="background-color:{{$task->warna}}" ></a>
                            {{-- <button class="btn btn-primary rounded-circle"></button> --}}
                            <div class="mr-2 ml-auto">
                                <ul class="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class='fas fa-align-justify'></i>
                                </ul>
                                <div class="dropdown-menu">
                                    <a  class="dropdown-item edit" data-toggle="modal" data-target="#modal_aside_left_edit" data-id="{{$task->id}}">Edit</a>
                                    @if ($task->status == 'incomplete')
                                    <div class="dropdown-divider"></div>
                                    <form action="{{route('task.status',$task->id)}}" method="post">
                                        @method('put')
                                        @csrf
                                        <button class="dropdown-item" type="submit">Selesai</button>
                                    </form>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('task.destroy',$task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <p class="ml-2 btn btn-tanggal">{{$task->tanggal_deadline}}</p>
                        </div>
                        <div class="row">
                            <p class="font-weigt-bold mx-2 my-3">
                                {{$task->keterangan}}
                            </p>
                        </div>
                        <div class="row ">
                            @if ($task->status == "complete")
                            <small class="text-success ml-1"><i class='fas fa-check-circle'></i> Complete</small>
                            @else
                            <small class="text-danger"><i class='fas fa-window-close'></i> Incomplete</small>
                            @endif

                            <small class="text-muted ml-auto mr-1">3 jam yang lalu</small>
                        </div>

                    </div>
                </div>
            </div>

            @endforeach
        </div>





        {{-- MODAL LEFT--}}
        @include('task.modalStore')
        @include('task.modalUpdate')
@endsection
