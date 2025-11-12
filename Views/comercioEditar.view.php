<?php
$page_title = "Razón Social - Editar";
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
            <h4><i class="bi bi-shop me-2"></i>Editar Comercio</h4>
            <div>
                <a href="comercioIndexController.php" class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-list-ul"></i> Ver Lista
                </a>
                <a href="comercioAltaController.php" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle"></i> Nuevo Comercio
                </a>
            </div>    
        </div>
        <form action="comercioActualizarController.php" method="POST">
            <div class="row">
                <input type="hidden" class="form-control" id="idComercio" name="idComercio" value="<?= $comercio->id ?>">
            </div>
            <div class="mb-3">
                <label for="razonSocialId" class="form-label required-label">Razón Social</label>
                <select class="form-select" id="razonSocialId" name="razonSocialId" required>
                    <option value="">Seleccionar razón social...</option>
                    <?php
                    foreach ($razonesSociales as $razon):
                    ?>
                    <option value="<?= $razon->id ?>" <?php echo ($razon->id == $comercio->titular_id) ? "selected" : null;?>><?= $razon->nombre ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nombreComercio" class="form-label required-label">Nombre del Comercio</label>
                <input type="text" class="form-control" id="nombreComercio" name="nombreComercio" value="<?= $comercio->nombre ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombreFantasia" class="form-label">Nombre de Fantasía</label>
                <input type="text" class="form-control" id="nombreFantasia" name="nombreFantasia" value="<?= $comercio->nombre_fantasia ?>">
            </div>
            <div class="mb-3">
                <label for="rubroId" class="form-label required-label">Rubro</label>
                <select class="form-select" id="rubroId" name="rubroId" required>
                    <option value="">Seleccionar rubro...</option>
                    <?php
                    foreach ($rubros as $rubro) {
                    ?>
                        <option value="<?= $rubro->id ?>" <?php echo ($rubro->id == $comercio->rubro_id) ? "selected" : null;?>><?= $rubro->nombre ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="subrubro" class="form-label">Subrubro</label>
                <input type="text" class="form-control" id="subrubro" name="subrubro" value="<?= $comercio->subrubro ?>">
            </div>
            <div class="mb-3">
                <label for="telefonoComercio" class="form-label required-label">Teléfono del Comercio</label>
                <input type="tel" class="form-control" id="telefonoComercio" name="telefonoComercio" value="<?= $comercio->telefono ?>" required>
            </div>
            <div class="mb-3">
                <label for="emailComercio" class="form-label">Email del Comercio</label>
                <input type="email" class="form-control" id="emailComercio" name="emailComercio" value="<?= $comercio->email_contacto ?>">
            </div>
            <div class="mb-3">
                <label for="sitioWeb" class="form-label">Sitio Web</label>
                <input type="url" class="form-control" id="sitioWeb" name="sitioWeb" value="<?= $comercio->sitio_web ?>">
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label required-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $comercio->direccion ?>" required>
            </div>
            <div class="mb-3">
                <label for="localidadComercio" class="form-label required-label">Localidad</label>
                <input type="text" class="form-control" id="localidadComercio" name="localidadComercio" value="<?= $comercio->localidad ?>" required>
            </div>
            <div class="mb-3">
                <label for="provinciaComercio" class="form-label required-label">Provincia</label>
                <select class="form-select" id="provinciaComercio" name="provinciaComercio" required>
                    <option value="">Seleccionar provincia...</option>
                    <option value="CABA">Ciudad Autónoma de Buenos Aires</option>
                    <option value="BA">Buenos Aires</option>
                    <option value="CAT">Catamarca</option>
                    <option value="COR">Córdoba</option>
                    <option value="ERI">Corrientes</option>
                    <option value="SFE">Santa Fe</option>
                    <option value="MEN">Mendoza</option>
                    <option value="TUC">Tucumán</option>
                    <option value="SAL">Salta</option>
                    <option value="JUJ">Jujuy</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="codigoPostalComercio" class="form-label">Código Postal</label>
                <input type="text" class="form-control" id="codigoPostalComercio" name="codigoPostalComercio" value="<?= $comercio->codigo_postal ?>">
            </div>
            <div class="mb-3">
                <label for="barrio" class="form-label">Zona/Barrio</label>
                <input type="text" class="form-control" id="barrio" name="barrio" value="<?= $comercio->barrio ?>">
            </div>
            <div class="mb-3">
                <label for="estadoComercio" class="form-label required-label">Estado</label>
                <select class="form-select" id="estadoComercio" name="estadoComercio" required>
                    <option value="<?= $comercio->estado ?>"><?= $comercio->estado ?></option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="suspendido">Suspendido</option>
                    <option value="en_construccion">En Construcción</option>
                </select>
            </div>
            <div class="mb-3">
                <p>¿Estás seguro de que deseas editar el comercio <strong><?= $comercio->nombre ?></strong>?</p>
            </div>
            <div class="footer">
                <a href="comercioIndexController.php" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-info">Guardar Cambios</button>
            </div>
            
        </form>
    </div>
</div>