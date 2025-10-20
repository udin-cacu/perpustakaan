@include('layouts.head')
<div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg'); background-attachment:fixed;">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
			<div class="col-md-8 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="teacher.html">My Profile</a></span> <span>My Profile Details</span></p>
				<h1 class="mb-3 bread">My Profile Details</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-12 mb-5">
						<div class="teacher-details d-flex flex-column flex-md-row align-items-start">
							<input type="hidden" id="idedit" value="{{$user->id}}">
							{{-- FOTO --}}
							<div class="text-center me-md-4 mb-4 mb-md-0 w-100" style="max-width: 400px;">

								@if($user->photo)
								<div class="photos"></div>
								<div class="img ftco-animate mx-auto"
								style="background-image: url('/content/images/{{$user->photo}}');
								width:100%; max-width:400px; height:400px;
								background-size:cover; background-position:center;
								border-radius:10px;">
							</div>
							@else
							<div class="photos"></div>
							<div class="img ftco-animate d-flex justify-content-center align-items-center mx-auto"
							style="width:100%; max-width:400px; height:400px;
							background-color:#f8f9fa; border-radius:10px;
							border:2px dashed #ccc;">
							<i class="fa fa-camera" style="font-size:60px; color:#bbb;"></i>
						</div>
						@endif

						{{-- Tombol Upload --}}
						<div class="form-group mt-3" id="upload">
							<input class="imgs" type="hidden">
							<button class="btn btn-warning w-100" onclick="$('#uploadfoto').click();">
								<i class="fa fa-upload"></i> Upload Foto
							</button>
							<input id="uploadfoto" name="file" type="file" style="display:none;"/>
						</div>

					</div>

					{{-- DETAIL TEKS --}}
					<div class="text ftco-animate flex-grow-1">
						<h3>{{ $user->name }}</h3>
						<span class="position text-muted">{{ $user->email }}</span>

						<p>
							When she reached the first hills of the Italic Mountains, she had a last view back on the skyline
							of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road,
							the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.
						</p>

						<p>
							When she reached the first hills of the Italic Mountains, she had a last view back on the skyline
							of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road,
							the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.
						</p>

						<div class="mt-4">
							<h4>Social Link</h4>
							<p class="ftco-social d-flex">
								<a href="#" class="d-flex justify-content-center align-items-center"><span class="icon-twitter"></span></a>
								<a href="#" class="d-flex justify-content-center align-items-center"><span class="icon-facebook"></span></a>
								<a href="#" class="d-flex justify-content-center align-items-center"><span class="icon-instagram"></span></a>
							</p>
						</div>
					</div>

				</div>
			</div>
			<div class="form-group simpanupload">
				<table width="100%">
					<tr>
						<td width="40%">
							<button type="button" onclick="Simpan();" class="btn btn-block btn-success ml-auto menusxx"><i class="fa fa-plus"></i> Update Photo</button> 
						</td>
						<td width="20%"></td>
						<td width="40%"></td>
					</tr>
				</table>
			</div>

			<button class="btn btn-primary w-100 tambah" onclick="Tambah();" style="display:block;">Update Data Profile</button>
			
			<div class="col-md-12 bg-light mt-3 p-5 ftco-animate updatedata" style="display:none;">
				<h4 class="mb-4">Update data</h4>
				<form action="#">
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Name</label>
						<input type="text" class="form-control" placeholder="Your Name" id="name" value="{{$user->name}}">
					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Email</label>
						<input type="text" class="form-control" placeholder="Your Email" id="email" value="{{$user->email}}">
					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Address</label>
						<input type="text" class="form-control" placeholder="Your Address" id="alamat" value="{{$user->alamat}}">
					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Phone Number</label>
						<input type="text" class="form-control" placeholder="Your Phone Number" id="no_hp" value="{{$user->no_hp}}">
					</div>
					<div class="form-group">
						<table width="100%">
							<tr>
								<td width="40%">
									<button type="button" onclick="Simpan();" class="btn btn-block btn-success ml-auto menusxx"><i class="fa fa-plus"></i> Update</button> 
								</td>
								<td width="5%"></td>
								<td width="40%">
									<button type="button" onclick="Close();" class="btn btn-block btn-danger ml-auto menusxx" style="color:white;"><i class="fa fa-minus"></i> Close</button>
								</td>
							</tr>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</section>
@include('layouts.foot')
<script>
	function Tambah(){

		$('.updatedata').show();
		$('.tambah').hide();
		$('.close').show();
		$('.simpanupload').hide();
	}

	function Close(){

		$('.updatedata').hide();
		$('.tambah').show();
		$('.close').hide();
		$('.simpanupload').show();
	}


	$("#uploadfoto").on("change", function() {

		$('.loading').attr('style','display: block');

		var formData = new FormData();
		formData.append('file', $('#uploadfoto')[0].files[0]);

		$.ajax({
			url: "{{ route('profile.upload') }}",
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
					$('.img').attr('style','display: none');
					$('.photos').html("<img width='100%' src='/content/images/"+data.name+"'><hr>"); 
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
			url: "{{ route('profile.storeprofile') }}",
			data: {
				'_token': $('input[name=_token]').val(),
				'id': $('#idedit').val(),
				'name': $('#name').val(),
				'email': $('#email').val(),
				'alamat': $('#alamat').val(),
				'no_hp': $('#no_hp').val(),
				'gambar': $('.imgs').val(),
			},
			success: function(data) {



				$('#new').modal('hide');

				swal({
					title: "Success",
					text: "Profile Berhasil Tersimpan",
					icon: "success",
					buttons: false,
					timer: 2000,
				});

				setTimeout(function(){ window.location.href = '/profile'; }, 2000);


			}

		});



	}

</script>