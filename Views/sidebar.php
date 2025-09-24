<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Panel de Administración</h3>
    </div>
    
    <div class="sidebar-menu">
        <ul>
            <li>
                <a href="index.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard Admin</span>
                </a>
            </li>
            <li>
                <a href="usuarios.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'usuarios.php') ? 'active' : ''; ?>">
                    <i class="bi bi-people"></i>
                    <span>Dashboard Usuarios</span>
                </a>
            </li>
            <li>
                <a href="razon_social.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'razon_social.php') ? 'active' : ''; ?>">
                    <i class="bi bi-building"></i>
                    <span>Razon Social</span>
                </a>
            </li>
            <li>
                <a href="comercios.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'comercios.php') ? 'active' : ''; ?>">
                    <i class="bi bi-shop"></i>
                    <span>Comercios</span>
                </a>
            </li>
            <li>
                <a href="rubros.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'rubros.php') ? 'active' : ''; ?>">
                    <i class="bi bi-tags"></i>
                    <span>Rubros</span>
                </a>
            </li>
            <li>
                <a href="reportes.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'reportes.php') ? 'active' : ''; ?>">
                    <i class="bi bi-bar-chart"></i>
                    <span>Reportes</span>
                </a>
            </li>
            <li>
                <a href="configuracion.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'configuracion.php') ? 'active' : ''; ?>">
                    <i class="bi bi-gear"></i>
                    <span>Configuración</span>
                </a>
            </li>
            <li>
                <a href="../login.html">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </div>
</nav>