<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) === 'Rental' && $this->uri->segment(2) === null) ? 'active' : 'collapsed'; ?>" href="<?= base_url('Rental'); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard Rental</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) === 'HistoryRental' && $this->uri->segment(2) === 'HistoryRental') ? 'active' : 'collapsed'; ?>" href="<?= base_url('HistoryRental'); ?>">
                <i class="ri-calendar-schedule-line"></i>
                <span>History Rental</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) === 'Playstation') ? 'active' : 'collapsed'; ?>" href="<?= base_url('Playstation'); ?>">
                <i class="ri-discord-line"></i>
                <span>Playstation</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) === 'User') ? 'active' : 'collapsed'; ?>" href="<?= base_url("User");?>">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

    </ul>
</aside><!-- End Sidebar-->
