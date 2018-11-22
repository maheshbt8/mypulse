<style type="text/css">
	header{
		background: -webkit-linear-gradient(bottom, #005bea, #00c6fb);
	}
</style>
<!-- header -->
	<header>
	<div class="top">
			<div class="container">
				<div class="t-op row">
					<div class="col-sm-6 top-middle">
						<ul>
							<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
							<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
						</ul>
					</div>
					<div class="col-sm-6 top-left">
						<ul>
							<li><i class="fas fa-phone"></i> +021 365 777</li>
							<li><a href="<?=base_url('login');?>"><button type="button" class="btn btn-sm btn-info">Sign In</button></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container"  style="background-color: -webkit-linear-gradient(bottom, #005bea, #00c6fb);">
			<nav class="navbar navbar-expand-lg navbar-light">
				<h1>
					<a class="navbar-brand text-capitalize" href="index.html">
						<img src="<?=base_url('assets/logo.png')?>"  style="max-height:60px; margin: -35px;"/>
					</a>
				</h1>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				    aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav text-center  ml-lg-auto">
						<li class="nav-item <?php if($page_name=='home'){echo 'active';}?>  mr-3">
							<a class="nav-link" href="<?=base_url()?>">Home
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item <?php if($page_name=='about'){echo 'active';}?> mr-3">
							<a class="nav-link" href="<?=base_url('About-Us')?>">About</a>
						</li>
						<li class="nav-item <?php if($page_name=='services'){echo 'active';}?> mr-3">
							<a class="nav-link" href="<?=base_url('Services')?>">Services</a>
						</li>
						<li class="nav-item dropdown mr-3">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
							    aria-expanded="false">
								Dropdown
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="typography.html">Typography</a>
								<a class="dropdown-item" href="gallery.html">Gallery</a>
							</div>
						</li>
						<li class="nav-item <?php if($page_name=='contact'){echo 'active';}?>">
							<a class="nav-link" href="<?=base_url('Contact-Us')?>">contact</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</header>