<?php 
$page_title = "Razón Social - Ver";
$current_page = "razon_social";
?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div id="content">
    <header id="header">
        <button class="toggle-sidebar">
            <i class="bi bi-list"></i>
        </button>
        <div class="user-info">
            <span class="me-2">Admin User</span>
            <!-- <img src="https://via.placeholder.com/40" class="rounded-circle" alt="User"> -->
        </div>
    </header>
    
    <div class="dashboard-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><i class="bi bi-building me-2"></i>Ver Razones Sociales</h4>
            <div>
                <a href="titularesIndexController.php" class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-list-ul"></i> Ver Lista
                </a>
                <a href="titularesAltaController.php" class="btn btn-sm btn-primary" onclick="resetForm()">
                    <i class="bi bi-plus-circle"></i> Nueva Razón Social
                </a>
            </div>
        </div>

        <div class="card text-bg-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">Razón Social</div>
            <div class="card-body">
                <h5 class="card-title"><?= $razon->nombre ?></h5>
                <p class="card-text">Tipo de persona: <?= $razon->tipo ?></p>
                <p class="card-text">Email: <?= $razon->email ?></p>
                <p class="card-text">CUIT/CUIL: <?= $razon->cuit ?></p>
                <p class="card-text">Teléfono: <?= $razon->telefono ?></p>
                <p class="card-text">Sitio Web: <?= $razon->web ?></p>
                <p class="card-text">Celular: <?= $razon->celular ?></p>
                <p class="card-text">Localidad: <?= $razon->localidad ?></p>
                <p class="card-text">Provincia: <?= $razon->provincia ?></p>
                <p class="card-text">Estado: <?= $razon->estado ?></p>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>