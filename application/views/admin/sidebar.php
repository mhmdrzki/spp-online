<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a href="<?php echo site_url('admin') ?>"><i class="fa fa-home"></i> Dashboard</a></li>

            
            <li><a><i class="fa fa-users"></i> Data Master<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/siswa') ?>">Data Siswa</a>
                    </li>
                </ul>
            </li>

            <li><a><i class="fa fa-money"></i> Pembayaran <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/Spp') ?>">SPP</a>
                    </li>
                    <li><a href="<?php echo site_url('admin/Pembangunan') ?>">Pembangunan</a>
                    </li>
                    
                </ul>
            </li>

            <li><a href="<?php echo site_url('admin/Pengeluaran') ?>"><i class="fa fa-money"></i> Pengeluaran</a></li>

            <li><a href="<?php echo site_url('admin/Tunggakan') ?>"><i class="fa fa-money"></i> Daftar Tunggakan SPP</a></li>

                

            

            <!-- <li><a><i class="fa fa-user-md"></i> User Management <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/user') ?>">List User</a>
                    </li>
                </ul>
            </li> -->

            <li><a href="<?php echo site_url('admin/Laporanpdf') ?>"><i class="fa fa-print"></i> Laporan</a></li>
        </ul>
    </div>

</div>
<!-- /sidebar menu -->