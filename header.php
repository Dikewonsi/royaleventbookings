<header class="header">
		<div class="header-inner">
			<nav class="navbar navbar-expand-lg bg-barren barren-head navbar fixed-top justify-content-sm-start pt-0 pb-0">
				<div class="container">	
					<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
						<span class="navbar-toggler-icon">
							<i class="fa-solid fa-bars"></i>
						</span>
					</button>
					<a class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-2 me-auto" href="index.php">
						<div class="res-main-logo">
							<img src="images/fav.png" alt="">
						</div>
						<div class="main-logo" id="logo">
							<img src="images/royal.jpg" alt="">
							<img class="logo-inverse" src="images/royal.jpg" alt="">
						</div>
					</a>
					<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
						<div class="offcanvas-header">
							<div class="offcanvas-logo" id="offcanvasNavbarLabel">
								<img src="images/fav.png" alt="">
							</div>
							<button type="button" class="close-btn" data-bs-dismiss="offcanvas" aria-label="Close">
								<i class="fa-solid fa-xmark"></i>
							</button>
						</div>
						<div class="offcanvas-body">
							<div class="offcanvas-top-area">
								<div class="create-bg">
									<a href="check_date.php" class="offcanvas-create-btn">
										<i class="fa-solid fa-calendar-days"></i>
										<span>Book Event</span>
									</a>
								</div>
							</div>							
							<ul class="navbar-nav justify-content-end flex-grow-1 pe_5">
								<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="index.php">Home</a>
								</li>																
								<li class="nav-item">
									<a class="nav-link" href="livechat.php">Live Support</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="profile.php">My Profile</a>
								</li>
							</ul>
						</div>						
					</div>
					<div class="right-header order-2">
						<ul class="align-self-stretch">
							<li>
								<a href="check_date.php" class="create-btn btn-hover">
									<i class="fa-solid fa-calendar-days"></i>
									<span>Book Event</span>
								</a>
							</li>
							<li class="dropdown account-dropdown">
								<a href="#" class="account-link" role="button" id="accountClick" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
									<img src="images/profile-imgs/user.png" alt="">
									<i class="fas fa-caret-down arrow-icon"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-account dropdown-menu-end" aria-labelledby="accountClick">
									<li>
										<div class="dropdown-account-header">
											<div class="account-holder-avatar">
												<img src="images/profile-imgs/user.png" alt="">
											</div>
											<h5><?php echo $_SESSION['fname'] ?> <?php echo $_SESSION['lname'] ?></h5>
											<p><?php echo $_SESSION['email'] ?></p>
										</div>
									</li>
									<li class="profile-link">
										<a href="profile.php" class="link-item">My Profile</a>									
										<a href="sign_out.php" class="link-item">Sign Out</a>									
									</li>
								</ul>
							</li>
							<li>
								<div class="night_mode_switch__btn">
									<div id="night-mode" class="fas fa-moon fa-sun"></div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="overlay"></div>
		</div>
	</header>