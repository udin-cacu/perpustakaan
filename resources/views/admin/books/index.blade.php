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
      Data Buku
    </i></h2>
    <div class="header-body">
      <div class="row">
        <div class="col-12">

          <div style="font-size: 12px;color: white;">
            List data Buku berisi data lengkap dari data-data Buku, dan mengubah data Buku.
          </div>
        </div>
        <div class="col-12">
          <button onclick="Tambah();" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Buku</button>
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
                <th>Gambar</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Tgl Terbit</th>
                <th>Stok</th>
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
  @include('admin.books.modal')
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
         url: "{{ route('book.data') }}",
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
        { data: 'kode', name: 'kode' },
        { data: 'judul', name: 'judul' },
        { data: 'pengarang', name: 'pengarang' },
        { data: 'tanggal', name: 'tanggal' },
        { data: 'stock', name: 'stock' },
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

    $("#uploadfoto").on("change", function() {

     $('.loading').attr('style','display: block');

     var formData = new FormData();
     formData.append('file', $('#uploadfoto')[0].files[0]);

     $.ajax({
      url: "{{ route('book.upload') }}",
      method:"POST",
      data: formData,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,

      success:function(data) {

       $('.loading').attr('style','display: none');

       if(data.status == '1'){

        $('.photos').html("<img width='100%' src='/assets2/gambar/"+data.name+"'><hr>"); 
        $('.imgs').val(data.name);         

      } else {

        swal({
          title: "Gagal!",
          text: "Pastikan File yang Anda Upload Benar!",
          icon: "error",
          buttons: false,
          timer: 2000,
        });


      }
    }
  });

   });

    function Simpan(){



      $.ajax({
        type: 'POST',
        url: "{{ route('book.store') }}",
        data: {
          '_token': $('input[name=_token]').val(),
          'kode': $('#kode').val(),
          'judul': $('#judul').val(),
          'pengarang': $('#pengarang').val(),
          'penerbit': $('#penerbit').val(),
          'tgl_terbit': $('#tgl_terbit').val(),
          'stock': $('#stock').val(),
          'cetakan_ke': $('#cetakan_ke').val(),
          'gambar': $('.imgs').val(),
        },
        success: function(data) {



          $('#new').modal('hide');

          swal({
            title: "Success",
            text: "Books Berhasil Tersimpan",
            icon: "success",
            buttons: false,
            timer: 2000,
          });

          setTimeout(function(){ window.location.href = '/book'; }, 2000);

          
        }

      });

      

    }

    function Edit(id){

      $.ajax({
        type: 'POST',
        url: "{{ route('book.edit') }}",
        data: {
          '_token': $('input[name=_token]').val(),
          'id': id,
        },
        success: function(data) {

          $('#kodeedit').val(data.kode);
          $('#juduledit').val(data.judul);
          $('#pengarangedit').val(data.pengarang);
          $('#penerbitedit').val(data.penerbit);
          $('#tgl_terbitedit').val(data.tgl_terbit);
          $('#stockedit').val(data.stock);
          $('#cetakan_keedit').val(data.cetakan_ke);
          $('#gambaredit').val(data.img);
          $('#idedit').val(data.id);
          $('.photos2').html("<img width='100%' src='/assets2/gambar/"+data.img+"'><hr>"); 
          $('.imgsedit').val(data.name); 

        }

      });

      $('#edit').modal('show');

    }

    $("#uploadfoto2").on("change", function() {

     $('.loading').attr('style','display: block');

     var formData = new FormData();
     formData.append('file', $('#uploadfoto2')[0].files[0]);

     $.ajax({
      url: "{{ route('book.upload2') }}",
      method:"POST",
      data: formData,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,

      success:function(data) {

       $('.loading').attr('style','display: none');

       if(data.status == '1'){

        $('.photos2').html("<img width='100%' src='/assets2/gambar/"+data.name+"'><hr>"); 
        $('.imgsedit').val(data.name);         

      } else {

        swal({
          title: "Gagal!",
          text: "Pastikan File yang Anda Upload Benar!",
          icon: "error",
          buttons: false,
          timer: 2000,
        });


      }
    }
  });

   });


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
          url: "{{ route('book.update') }}",
          data: {
            '_token': $('input[name=_token]').val(),
            'kode': $('#kodeedit').val(),
            'judul': $('#juduledit').val(),
            'pengarang': $('#pengarangedit').val(),
            'penerbit': $('#penerbitedit').val(),
            'tgl_terbit': $('#tgl_terbitedit').val(),
            'stock': $('#stockedit').val(),
            'cetakan_ke': $('#cetakan_keedit').val(),
            'gambar': $('.imgsedit').val(),
            'gambaredit': $('#gambaredit').val(),
            'id': $('#idedit').val(),
          },
          success: function(data) {


            $('#edit').modal('hide');

            swal({
              title: "Success",
              text: "Book Berhasil Di Update",
              icon: "success",
              buttons: false,
              timer: 2000,
            });

            setTimeout(function(){ window.location.href = '/book'; }, 2000);

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
        url: "{{ route('book.delete') }}",
        data: {
          '_token': $('input[name=_token]').val(),
          'id': ids,
        },
        success: function(data) {

          swal({
            title: "Success",
            text: "Book Berhasil di Delete!",
            icon: "success",
            buttons: false,
            timer: 2000,
          });

          setTimeout(function(){ window.location.href = '/book'; }, 2000);

        }

      });

    }

  </script>


