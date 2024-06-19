<?php
if (isset($GLOBALS['current_route'])) {
    $current_route = $GLOBALS['current_route'];
} else {
    $current_route = '';
}
?>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_route == '/kantinku/dashboard_pegawai') ? 'active' : ''; ?>" href="/kantinku/dashboard_pegawai">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_route == '/kantinku/profil_pegawai') ? 'active' : ''; ?>" href="/kantinku/profil_pegawai">Profil</a>
    </li>
</ul>
