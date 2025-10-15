   <!-- Modal Tambah Data -->
   <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>

        </button>
    </div>
    <div class="modal-body">

        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama</label>
            <input type="text" class="form-control" id="name">
        </div>

        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email</label>
            <input type="text" class="form-control" id="email">
        </div>      

        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Role</label>
            <select class="form-control" id="role_id">
                @foreach($role as $data)
                <option value="{{$data->id}}">{{$data->name}}</option>
                @endforeach
            </select>
        </div>    

    </div>
    <div class="modal-footer tombol">
        <table width="100%">
          <tr>
            <td>
              <button type="button" class="btn btn-absen btn-block ml-auto" data-dismiss="modal">Batal</button> 
          </td>
          <td width="5%">
              &nbsp;
          </td>
          <td>
              <button type="button" onclick="Simpan();" class="btn btn-block btn-success ml-auto menusxx">Tambah</button> 
          </td>
      </tr> 
  </table>
</div>
</div>
</div>
</div>
</div>


<!-- Modal Edit Data -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Karyawan</h5>
    </button>
</div>
<div class="modal-body">
  <input type="hidden" id="idedit">
  <div class="form-group">
    <label for="recipient-name" class="col-form-label">Nama</label>
    <input type="text" class="form-control" id="nameedit">
</div>

<div class="form-group">
    <label for="recipient-name" class="col-form-label">Email</label>
    <input type="text" class="form-control" id="emailedit">
</div>

<div class="form-group">
    <label for="recipient-name" class="col-form-label">Role</label>
    <select class="form-control" id="role_idedit">
        @foreach($role as $data)
        <option value="{{$data->id}}">{{$data->name}}</option>
        @endforeach
    </select>
</div> 


</div>
<div class="modal-footer tombol">
    <table width="100%">
      <tr>
        <td>
          <button type="button" class="btn btn-absen btn-block ml-auto" data-dismiss="modal">Batal</button> 
      </td>
      <td width="5%">
          &nbsp;
      </td>
      <td>
          <button type="button" onclick="Update();" class="btn btn-block btn-success ml-auto menusxx">Update</button> 
      </td>
  </tr> 
</table>
</div>
</div>
</div>
</div>
</div>


<!-- Delete -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-default"> </h3>
                
            </div>
            
            <div class="modal-body"  style="padding-bottom: 0px;padding-top: 0px;">
                <div class="row content">
                    <div class="col-12">
                        <table width="100%">
                            <tr>
                                <td align="center">
                                    <img width="50%" src="/assets/content/img/theme/info.png">
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                    <hr>
                    <div class="col-12">
                        <div style="font-size: 18px; color: #dd3343;">
                            <b>DELETE KARYAWAN</b>
                        </div>
                        <div style="font-size: 12px;" >
                            Anda Yakin akan Delete Karyawan ini?
                        </div>
                        <input type="hidden" id="iddel">
                    </div>
                </div>
            </div>
            
            <div class="modal-footer tombol">
                <table width="100%">
                    <tr>
                        <td>
                            <button type="button" class="btn btn-secondary btn-block ml-auto" data-dismiss="modal">Tidak</button> 
                        </td>
                        <td width="5%">
                            &nbsp;
                        </td>
                        <td>
                            <button type="button" onclick="YakinDelete()" class="btn btn-block btn-absen ml-auto menusxx">Yakin</button> 
                        </td>
                    </tr> 
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="lihatnya" tabindex="-1" role="dialog" aria-labelledby="modal-default"
aria-hidden="true">
<div class="modal-dialog modal-md modal-dialog-centered modal-" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <div class="col-6">
                <h3 class="modal-title" id="modal-title-default">Detail Data Perusahaan</h3>
            </div>
            <div class="col-6" align="right">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>

        <div class="modal-body" style="padding-bottom: 0px;padding-top: 0px;">
            <div class="row">
                <div class="col-12">
                    <label>Nama Loker</label>
                    <br>
                    <div style="font-size: 17px;font-weight: bold;" id="namalokerview"></div>
                    <hr> 

                    <label>Nama Perusahaan</label>
                    <br>
                    <div style="font-size: 17px;font-weight: bold;" id="perusahaanview"></div>
                    <hr>

                    <label>Jenis Loker</label>
                    <br>
                    <div style="font-size: 17px;font-weight: bold;" id="jenisview"></div>
                    <hr> 

                    <label>Gaji</label>
                    <br>
                    <div style="font-size: 17px;font-weight: bold;" id="gajiview"></div>
                    <hr> 

                    <label>Kota</label>
                    <br>
                    <div style="font-size: 17px;font-weight: bold;" id="kotaview"></div>
                    <hr> 

                    <label>Alamat</label>
                    <br>
                    <div style="font-size: 17px;font-weight: bold;" id="alamatview"></div>
                    <hr>

                    <label>Deskripsi</label>
                    <br>
                    <div style="font-size: 17px;font-weight: bold;" id="deskripsiview"></div>
                    <hr>

                    <label>Kualifikasi</label>
                    <br>
                    <div style="font-size: 17px;font-weight: bold;" id="kualifikasiview"></div>
                    <hr> 

                    <label>DateLine</label>
                    <br>
                    <div style="font-size: 17px;font-weight: bold;" id="datelineview"></div>
                    <hr>                          

                </div>

            </div>
        </div>

        <div class="modal-footer tombolnya2" style="display:none;">
            <table width="100%">
                <tr>
                    <td>
                        <button type="button" class="btn btn-secondary btn-block ml-auto"
                        data-dismiss="modal">Tutup</button>
                    </td>
                    <td width="5%">
                        &nbsp;
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>