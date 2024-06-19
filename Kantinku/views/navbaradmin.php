<?php
if (isset($GLOBALS['current_route'])) {
    $current_route = $GLOBALS['current_route'];
} else {
    $current_route = '';
}
?>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_route == '/kantinku/dashboard_admin') ? 'active' : ''; ?>" href="/kantinku/dashboard_admin">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_route == '/kantinku/kelola_produk') ? 'active' : ''; ?>" href="/kantinku/kelola_produk">Produk</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_route == '/kantinku/kelola_pegawai') ? 'active' : ''; ?>" href="/kantinku/kelola_pegawai">Pegawai</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_route == '/kantinku/profil_admin') ? 'active' : ''; ?>" href="/kantinku/profil_admin">Profil</a>
    </li>
</ul>
