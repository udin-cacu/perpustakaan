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
						<div class="teacher-details d-md-flex">
							<div class="img ftco-animate" style="background-image: url(/content/images/{{$user->photo}});"></div>
							<div class="text ftco-animate">
								<h3>{{$user->name}}</h3>
								<span class="position">{{$user->email}}</span>
								<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>

								<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
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
					<div class="col-md-12 bg-light mt-3 p-5 ftco-animate">
						<h4 class="mb-4">Send a Message</h4>
						<form action="#">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Your Name">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Your Email">
							</div>
							<div class="form-group">
								<textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
							</div>
							<div class="form-group">
								<input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@include('layouts.foot')