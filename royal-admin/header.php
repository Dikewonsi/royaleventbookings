<header class="header">
		<div class="header-inner">		
			<nav class="navbar navbar-expand-lg bg-barren barren-head navbar fixed-top justify-content-sm-start pt-0 pb-0 ps-lg-0 pe-2">
				<div class="container-fluid ps-0">
					<button type="button" id="toggleMenu" class="toggle_menu">
						<i class="fa-solid fa-bars-staggered"></i>
					</button>
					<button id="collapse_menu" class="collapse_menu me-4">
						<i class="fa-solid fa-bars collapse_menu--icon "></i>
						<span class="collapse_menu--label"></span>
					</button>
					
					<a class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-2 me-auto" href="index.php">
						<div class="res-main-logo">
							<img src="images/fav.png" alt="">
						</div>
						<div class="main-logo" id="logo">
							<img src="images/fav.png" style="width:50px; height:50px;" alt="">
							<img class="logo-inverse" src="images/fav.png" style="width:50px; height:50px;" alt="">
						</div>
					</a>
					<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
						<div class="offcanvas-header">
							<div class="offcanvas-logo" id="offcanvasNavbarLabel">
								<img src="images/dark.png" alt="">
							</div>
							<button type="button" class="close-btn" data-bs-dismiss="offcanvas" aria-label="Close">
								<i class="fa-solid fa-xmark"></i>
							</button>
						</div>
					</div>
					<div class="right-header order-2">
						<ul class="align-self-stretch">							
							<li class="dropdown account-dropdown order-3">
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
											<h5><?= $_SESSION['admin_username'];?></h5>											
										</div>
									</li>
									<li class="profile-link">																	
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
	<!-- Header End-->
	<!-- Left Sidebar Start -->
	<nav class="vertical_nav">
		<div class="left_section menu_left" id="js-menu">
			<div class="left_section">
				<ul>
					<li class="menu--item">
						<a href="index.php" class="menu--link active" title="Dashboard" data-bs-toggle="tooltip" data-bs-placement="right">
							<i class="fa-solid fa-gauge menu--icon"></i>
							<span class="menu--label">Dashboard</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="users.php" class="menu--link" title="Users" data-bs-toggle="tooltip" data-bs-placement="right">
							<i class="fa-solid fa-user-group menu--icon"></i>
							<span class="menu--label">All Users</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="bookings.php" class="menu--link" title="Bookings" data-bs-toggle="tooltip" data-bs-placement="right">
							<i class="fa-solid fa-calendar-days menu--icon"></i>
							<span class="menu--label">All Bookings</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="search-booking.php" class="menu--link" title="Search" data-bs-toggle="tooltip" data-bs-placement="right">
							<i class="fa-solid fa-search menu--icon"></i>
							<span class="menu--label">Search For Booking</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="halls.php" class="menu--link" title="Halls" data-bs-toggle="tooltip" data-bs-placement="right">
							<i class="fa-solid fa-house menu--icon"></i>
							<span class="menu--label">Halls</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="event-category.php" class="menu--link" title="Event Category" data-bs-toggle="tooltip" data-bs-placement="right">
							<i class="fa-solid fa-spinner menu--icon"></i>
							<span class="menu--label">Event Categories</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="coupons.php" class="menu--link" title="Coupons" data-bs-toggle="tooltip" data-bs-placement="right">
							<i class="fa-solid fa-ticket menu--icon"></i>
							<span class="menu--label">Coupons</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="addons.php" class="menu--link" title="Addons" data-bs-toggle="tooltip" data-bs-placement="right">
							<i class="fa-solid fa-plus menu--icon"></i>
							<span class="menu--label">Addons</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="caution_fee.php" class="menu--link" title="Addons" data-bs-toggle="tooltip" data-bs-placement="right">
							<i class="fa-solid fa-recycle menu--icon"></i>
							<span class="menu--label">Caution Fee</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="profile.php" class="menu--link" title="Profile" data-bs-toggle="tooltip" data-bs-placement="right">
							<i class="fa-solid fa-user menu--icon"></i>
							<span class="menu--label">Profile</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>