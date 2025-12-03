<?php 
$page_title = "Dashboard Principal";
$current_page = "index";
?>
<?php include 'header.php'; ?>

<!-- Sidebar -->
<?php include 'sidebar.php'; ?>

<!-- Content -->
<div id="content">
    <!-- Header -->
    <header id="header">
        <button class="toggle-sidebar">
            <i class="bi bi-list"></i>
        </button>
        <div class="user-info">
            <span class="me-2">Admin User</span>
            <img src="https://via.placeholder.com/40" class="rounded-circle" alt="User">
        </div>
    </header>
    
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Dashboard Principal</h4>
        </div>
        
        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-4">
                <div class="card stat-card">
                    <i class="bi bi-tags"></i>
                    <h2><?= $cantidadRubros ?></h2>
                    <p>Rubros</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card">
                    <i class="bi bi-shop"></i>
                    <h2><?= $cantidadComercios ?></h2>
                    <p>Comercios</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card">
                    <i class="bi bi-pencil-square"></i>
                    <h2><?= $cantidadRazones ?></h2>
                    <p>Razones Sociales</p>
                </div>
            </div>
        </div>
        
        <!-- Charts and Tables -->
        <div class="row">
            
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>