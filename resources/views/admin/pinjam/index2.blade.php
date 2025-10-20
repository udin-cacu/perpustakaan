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
      Data DeadLine Pinjam
    </i></h2>
    <div class="header-body">
      <div class="row">
        <div class="col-12">

          <div style="font-size: 12px;color: white;">
            List data DeadLine Pinjam berisi data lengkap dari data-data DeadLine Pinjam, dan mengubah data DeadLine Pinjam.
          </div>
        </div>
        <!-- <div class="col-12">
          <button onclick="Tambah();" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah DeadLine Pinjam</button>
        </div> -->
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
                <th>Images</th>
                <th>Member</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date Loan</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Petugas Cek</th>
                <th>Denda</th>
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
  @include('admin.pinjam.modal')
  @include('layouts.footer') 
  <script type="text/javascript">

    var table = "";
    $(function() {

      table = $('.datatables').DataTable({
        pageLength: 20,
        processing: true,
        serverSide: true,
        columnDefs: [
          {
            // "targets": [ 0 ],
            "visible": false
          },
          {
            "targets": [ 9 ],
            "render": $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ' )
          },
        ],
        order: [[ 0, 'desc' ]],
        ajax:{
          url: "{{ route('deadline.data3') }}",
          dataType: "json",
          type: "GET",
        },
        columns: [
          { data: 'no', name:'id', render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }},
          { 
            render: function ( data, type, row ) {

              return '<img class="file" width="50%" src="/assets2/gambar/'+row.img+'">';

            }
          },
          { data: 'namamember', name: 'namamember' },
          { data: 'judul', name: 'judul' },
          { data: 'pengarang', name: 'pengarang' },
          { data: 'tanggal2', name: 'tanggal2' },
          { data: 'tanggal', name: 'tanggal' },
          {
            render: function (data, type, row) {
              if (row.status == 'konfirmasi') {
                return '<span class="badge bg-warning text-dark" style="color: white; font-weight: bold;">PENDING</span>';
              } else if (row.status == 'approved') {
                return '<span class="badge bg-success" style="color: white; font-weight: bold;">APPROVED</span>';
              } else {
                return '<span class="badge bg-yellow" style="color: white; font-weight: bold;">END</span>';
              }
            }
          },
          {
            render: function (data, type, row) {
              if (row.namapetugas && row.namapetugas.trim() !== '') {
                return '<span class="badge" style="background-color: purple; color: white; font-weight: bold;">' + row.namapetugas + '</span>';
              } else {
                return '<span class="badge bg-danger" style="color: white; font-weight: bold;">Belum ACC</span>';
              }
            }
          },
          { data: 'denda', name: 'denda' },
          { 
            render: function ( data, type, row ) {

              return '<button class="btn btn-sm btn-outline-danger" onclick="Delete('+row.idpinjam+')"><i class="fa fa-trash text-danger"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-outline-info" onclick="Edit('+row.idpinjam+')"><i class="fa fa-edit text-info"></i></button>';

            }
          }
        ]
      });
    });



    function Edit(id){

      $.ajax({
        type: 'POST',
        url: "{{ route('pinjam.edit') }}",
        data: {
          '_token': $('input[name=_token]').val(),
          'id': id,
        },
        success: function(data) {

          $('#statusedit').val(data.status);
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
          url: "{{ route('pinjam.update') }}",
          data: {
            '_token': $('input[name=_token]').val(),
            'status': $('#statusedit').val(),
            'id': $('#idedit').val(),
          },
          success: function(data) {


            $('#edit').modal('hide');

            swal({
              title: "Success",
              text: "Status Pinjam Berhasil Di Update",
              icon: "success",
              buttons: false,
              timer: 2000,
            });

            setTimeout(function(){ window.location.href = '/deadline'; }, 2000);

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
        url: "{{ route('pinjam.delete') }}",
        data: {
          '_token': $('input[name=_token]').val(),
          'id': ids,
        },
        success: function(data) {

          swal({
            title: "Success",
            text: "Pinjam Berhasil di Delete!",
            icon: "success",
            buttons: false,
            timer: 2000,
          });

          setTimeout(function(){ window.location.href = '/deadline'; }, 2000);

        }

      });

    }

  </script>


