@include('layouts.head')
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
<div class="hero-wrap hero-wrap-2" style="background-image: url('/content/images/bg_2.jpg'); background-attachment:fixed;">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
			<div class="col-md-8 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>My Loan</span></p>
				<h1 class="mb-3 bread">My Loan</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section bg-light">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section ftco-animate text-center">
				<h2 class="mb-4">Loan Data</h2>
			</div>
		</div>
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
									<th>Title</th>
									<th>Author</th>
									<th>Deadline</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@include('layouts.foot')
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
				url: "{{ route('konfirmasipinjam.data') }}",
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
				{ data: 'judul', name: 'judul' },
				{ data: 'pengarang', name: 'pengarang' },
				{ data: 'tanggal', name: 'tanggal' },
				
				{ 
					render: function ( data, type, row ) {

						if(row.status == 'konfirmasi'){

							return '<b style="color:red;">PENDING</b>';

						}else if(row.status == 'approved'){

							return '<b style="color:green;">APPROVED</b>';

						}else{

							return '<b style="color:orange;">END</b>';

						}
					}
				},
				
			]
		});
	});
</script>
