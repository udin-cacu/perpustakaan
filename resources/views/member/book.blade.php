@include('layouts.head')
<style>
  .custom-pagination {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    list-style: none;
    padding: 8px 16px;
    background: #fff;
    border-radius: 50px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    margin: 0 auto;
  }

  .custom-pagination li {
    margin: 0 3px;
  }

  .custom-pagination a,
  .custom-pagination span {
    display: block;
    padding: 10px 16px;
    font-size: 15px;
    color: #444;
    text-decoration: none;
    border-radius: 50%;
    transition: all 0.3s ease;
  }

  .custom-pagination a:hover {
    background-color: #5e72e4;
    color: #fff;
    transform: translateY(-2px);
  }

  .custom-pagination .active span {
    background-color: #5e72e4;
    color: #fff;
    font-weight: 600;
    box-shadow: inset 0 0 10px rgba(94,114,228,0.4);
  }

  .custom-pagination .disabled span {
    background-color: #f1f1f1;
    color: #aaa;
    cursor: not-allowed;
  }


</style>


<div class="hero-wrap hero-wrap-2" style="background-image: url('/content/images/bg_2.jpg'); background-attachment:fixed;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
      <div class="col-md-8 ftco-animate text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="/home">Home</a></span> <span>Book</span></p>
        <h1 class="mb-3 bread">Books</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section">
 <div class="container">
  <div class="row">
    @foreach($book as $data)
    <div class="col-md-3 d-flex ftco-animate">
      <div class="course align-self-stretch">
        <a href="#" 
        class="img"
        style="
        background-image: url('/assets2/gambar/{{$data->img}}');
        display: block;
        width: 100%;
        min-height: 200px;     /* tinggi minimum */
        max-height: 200px;     /* tinggi maksimum agar seragam */
        background-size: 100% 100%;  /* isi penuh tanpa sisa */
        background-position: center;
        background-repeat: no-repeat;
        border-radius: 10px;
        overflow: hidden;
        ">
      </a>
      <div class="text p-4">
        <p class="category"><span>{{$data->judul}}</span> <span class="price"> Stock : {{$data->stock}}</span></p>
        <h3 class="mb-3"><a href="#">{{$data->pengarang}}</a></h3>
        <p>{{$data->ket}}</p>
        <p><a href="#" class="btn btn-primary" onclick="Pinjam({{$data->id}})">Pinjam</a></p>
      </div>
    </div>
  </div>
  @endforeach

</div>
@if ($book->hasPages())
<div class="row mt-5">
  <div class="col-12">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80px;">
      <ul class="custom-pagination">
        {{-- Tombol Sebelumnya --}}
        @if ($book->onFirstPage())
        <li class="disabled"><span>&laquo;</span></li>
        @else
        <li><a href="{{ $book->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($book->getUrlRange(1, $book->lastPage()) as $page => $url)
        @if ($page == $book->currentPage())
        <li class="active"><span>{{ $page }}</span></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach

        {{-- Tombol Berikutnya --}}
        @if ($book->hasMorePages())
        <li><a href="{{ $book->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
        <li class="disabled"><span>&raquo;</span></li>
        @endif
      </ul>
    </div>
  </div>
</div>
@endif


</div>
</section>
<!-- Modal Konfirmasi Pinjam -->
<div class="modal fade" id="modalPinjam" tabindex="-1" role="dialog" aria-labelledby="modalPinjamLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalPinjamLabel">Konfirmasi Peminjaman</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p>Apakah Anda yakin ingin meminjam buku ini?</p>
        <input type="hidden" id="id_buku">
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btnKonfirmasiPinjam">Ya, Pinjam</button>
      </div>
    </div>
  </div>
</div>

@include('layouts.foot')
<script>
  function Pinjam(id) {
    $('#id_buku').val(id);
    $('#modalPinjam').modal('show');
  }

  $('#btnKonfirmasiPinjam').on('click', function() {
    var id = $('#id_buku').val();

    $.ajax({
      url: "{{ route('pinjam.store') }}",
      type: "POST",
      data: {
        _token: "{{ csrf_token() }}",
        book_id: id
      },
      success: function(data) {
        $('#modalPinjam').modal('hide');

        if(data.status == '1'){



          swal({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Buku berhasil dipinjam.',
            showConfirmButton: false,
            timer: 1500
          });

        }else{


          swal({
            icon: 'error',
            title: 'Gagal Tersimpan!',
            text: 'Stok buku Habis.'
          });

        }

      },

      error: function(xhr) {
        $('#modalPinjam').modal('hide');
        swal({
          icon: 'error',
          title: 'Gagal!',
          text: 'Terjadi kesalahan saat meminjam buku.'
        });
      }
    });
  });
</script>
