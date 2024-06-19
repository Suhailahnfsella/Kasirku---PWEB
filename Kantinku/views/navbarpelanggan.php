<?php
if (isset($GLOBALS['current_route'])) {
    $current_route = $GLOBALS['current_route'];
} else {
    $current_route = '';
}
?>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_route == '/kantinku/dashboard_pelanggan') ? 'active' : ''; ?>" href="/kantinku/dashboard_pelanggan">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_route == '/kantinku/pesan') ? 'active' : ''; ?>" href="/kantinku/pesan">Pesan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_route == '/kantinku/keluarpelanggan') ? 'active' : ''; ?>" href="/kantinku/keluarpelanggan">Keluar</a>
    </li>
</ul>
