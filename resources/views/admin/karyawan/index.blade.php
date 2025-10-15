<!-- INDEX ADMIN -->

@include('layouts.header')
<!-- Header -->
<style>
  #customers {
    border-collapse: collapse;
    width: 100%;
  }

  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 12px 8px 12px 8px;
    font-size: 12px;
  }

  #customers tr:nth-child(even){background-color: #f2f2f2;}

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #dd3343;
    color: white;
  }

  .btn:not(:last-child) {
    margin-right: .2rem;
  }

  td {
    white-space: nowrap;
  }
</style>
<div class="header pb-8 pt-5 pt-md-8" style="background-image: url('{{ asset('assets/gambar.jpg') }}'); background-size: cover;">
  <div class="container-fluid">
    <h2 class="fw-bold py-1 mb-1"><span class="text-muted fw-light">Master /</span> <i style="font-size: 24px;font-weight: bold;color: white;">
      Data Karyawan
    </i></h2>
    <div class="header-body">
      <div class="row">
        <div class="col-12">
          <div style="font-size: 12px;color: white;">
            List data Karyawan berisi data lengkap dari data-data Karyawan, dan mengubah data Karyawan.
          </div>
        </div>
        <div class="col-12">
          <button onclick="Tambah();" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Karyawan</button>
        </div>
      </div>
      <hr>
    </div>
  </div>
</div>
<div class="container-fluid mt--9">
  <div class="row">
    <div class="col-xl-12">
      <div class="card shadow" style="padding: 1.5rem;">
        <div class="table-responsive">
          <!-- Projects table -->
          <table id="customers" class="datatables" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th width="14%">Opsi</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @include('admin.karyawan.modal')
  @include('layouts.footer')
  <script type="text/javascript">

    var table = "";
    $(function() {

      table = $('.datatables').DataTable({
        pageLength: 20,
        processing: true,
        serverSide: true,
      /*columnDefs: [
        {
          "targets": [ 0 ],
          "visible": false
        }
      ],*/
        order: [[ 0, 'desc' ]],
        ajax:{
          url: "{{ route('karyawan.data2') }}",
          dataType: "json",
          type: "GET",
        },
        columns: [
          { data: 'no', name:'id', render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }},
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { 
            render: function ( data, type, row ) {


              return '<button class="btn btn-sm btn-outline-danger" onclick="Delete('+row.id+')"><i class="fa fa-trash text-danger"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-outline-info" onclick="Edit('+row.id+')"><i class="fa fa-edit text-info"></i></button>';



            }
          }

        ]
      });
    });

    function Tambah(){

      $('#new').modal('show');

    }

    function Simpan(){



      $.ajax({
        type: 'POST',
        url: "{{ route('karyawan.store2') }}",
        data: {
          '_token': $('input[name=_token]').val(),
          'name': $('#name').val(),
          'email': $('#email').val(),
          'role_id': $('#role_id').val(),
          
        },
        success: function(data) {



          $('#new').modal('hide');

          swal({
            title: "Success",
            text: "Karyawan Berhasil Tersimpan",
            icon: "success",
            buttons: false,
            timer: 2000,
          });

          setTimeout(function(){ window.location.href = '/karyawan'; }, 2000);

          
        }

      });

      

    }

    function Edit(id){

      $.ajax({
        type: 'POST',
        url: "{{ route('karyawan.edit2') }}",
        data: {
          '_token': $('input[name=_token]').val(),
          'id': id,
        },
        success: function(data) {

          $('#nameedit').val(data.name);
          $('#emailedit').val(data.email);
          $('#role_idedit').val(data.role_id);
          $('#idedit').val(data.id);

        }

      });

      $('#edit').modal('show');

    }

    function Update(){

      var empty = false;
      $('input.isiedit, textarea.isiedit').each(function() {
        if ($(this).val() == '') {
          empty = true;
        }
      });
      if (empty) { 
        swal({
          text: "Isian Tidak Boleh Kosong!",
          icon: "error",
          buttons: false,
          timer: 2000,
        });

      } else {

        $.ajax({
          type: 'POST',
          url: "{{ route('karyawan.update2') }}",
          data: {
            '_token': $('input[name=_token]').val(),
            'name': $('#nameedit').val(),
            'email': $('#emailedit').val(),
            'role_id': $('#role_idedit').val(),
            'id': $('#idedit').val(),
          },
          success: function(data) {


            $('#edit').modal('hide');

            swal({
              title: "Success",
              text: "Karyawan Berhasil Di Update",
              icon: "success",
              buttons: false,
              timer: 2000,
            });

            setTimeout(function(){ window.location.href = '/karyawan'; }, 2000);

          }

        });

      }

    }


    function Delete(id){

      $('#iddel').val(id);

      $('#delete').modal('show');

    }

    function YakinDelete(){

      $('#delete').modal('hide');

      var ids = $('#iddel').val();

      $.ajax({
        type: 'POST',
        url: "{{ route('karyawan.delete2') }}",
        data: {
          '_token': $('input[name=_token]').val(),
          'id': ids,
        },
        success: function(data) {

          swal({
            title: "Success",
            text: "Karyawan Berhasil di Delete!",
            icon: "success",
            buttons: false,
            timer: 2000,
          });

          setTimeout(function(){ window.location.href = '/karyawan'; }, 2000);

        }

      });

    }
  </script>   