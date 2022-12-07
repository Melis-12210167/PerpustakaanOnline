  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=site_url('pustakawan')?>">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Sistem Perpustakaan <sup>Online</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?=site_url('pustakawan')?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->

<!-- Heading -->
<div class="sidebar-heading">
    Menu Aplikasi
</div>

<!-- Nav Item - Pages Collapse Menu -->

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="false" aria-controls="collapseUtilities">
        <i class="fas fa-user"></i>
        <span>Anggota Pustakawan</span>
    </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
            <div class="bg-gradient-success py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item" href="<?=site_url('pustakawan')?>">Pustakawan</a>
                <a class="collapse-item" href="<?=site_url('anggota')?>">Anggota</a>
            </div>
        </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fab fa-readme"></i>
        <span>Buku</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-gradient-success py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Buku:</h6>
            <a class="collapse-item" href="<?=site_url('bahasa')?>">Bahasa</a>
            <a class="collapse-item" href="<?=site_url('kategori')?>">Kategori</a>
            <a class="collapse-item" href="<?=site_url('klasifikasi')?>">Klasifikasi</a>
            <a class="collapse-item" href="<?=site_url('koleksi')?>">Koleksi</a>
            <a class="collapse-item" href="<?=site_url('penerbit')?>">Penerbit</a>
            <a class="collapse-item" href="<?=site_url('stokkoleksi')?>">Stok Koleksi</a>
        </div>
    </div>
</li>

<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <i class="fab fa-trello"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
                    <div class="bg-gradient-success py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu Transaksi:</h6>
                    <a class="collapse-item" href="<?=site_url('pemesanan')?>">Pemesanan</a>
                    <a class="collapse-item" href="<?=site_url('transaksi')?>">Transaksi</a>
                    </div>
                </div>
            </li>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - User Information -->
    <li class="nav-item">
        <!-- Dropdown - User Information -->
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-100"></i>
                <span>Logout</span>
            </a>
    </li>
   
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>



</ul>
<!-- End of Sidebar -->