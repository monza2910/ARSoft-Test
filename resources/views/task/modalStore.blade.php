<div id="modal_aside_left" class="modal fixed-left fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-aside" role="document">
      <div class="modal-content">
        <div class="modal-header mt-2">
            <div class="modal-title">
                <h5 class=" font-weight-bold">Tambah tugas</h5>
                <p class="text-muted" style="font-size: 12px">Gunakan form dibawah untuk menambah data tugas</p>
            </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" style="color: red">&times;</span>
            </button>
            <br>
        </div>
        <div class="modal-body">
            <form action="{{route('task.store')}}" method="post" >
                @method('post')
                @csrf
                <div class="form-group">
                    <label for="tanggalDeadline">Tanggal Deadline</label>
                    <input type="date" name="tanggal_deadline" value="{{old('tanggal_deadline')}}" class="form-control">
                    @error('tanggal_deadline')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="color">Kategory Warna Tugas</label>
                    <input type="color" name="warna" value="{{old('warna')}}" class="form-control">
                    <small class="text-muted" style="font-size: 12px">Gunakan kode hanya untuk memberi warna</small>
                    @error('warna')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan Tugas</label>
                    <textarea name="keterangan" class="form-control" id="" cols="30" rows="10">{{old('keterangan')}}</textarea>
                    @error('keterangan')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="row">
                    <button class="btn ml-auto mx-3" type="submit" style="background-color: #4247FE; color:white;">Simpan</button>
                </div>
            </form>


        </div>
      </div>
    </div> <!-- modal-bialog .// -->
  </div> <!-- modal.// -->


</div>
