<?php 
$page_title = "Comercio - Alta";
$current_page = "comercios";
?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<style>
    .form-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid var(--primary-color);
    }
    .form-section h6 {
        color: var(--primary-color);
        margin-bottom: 1rem;
    }
    .required-label::after {
        content: " *";
        color: #dc3545;
    }
</style>

<div id="content">
    <header id="header">
        <button class="toggle-sidebar">
            <i class="bi bi-list"></i>
        </button>
        <div class="user-info">
            <span class="me-2">Admin User</span>
            <img src="https://via.placeholder.com/40" class="rounded-circle" alt="User">
        </div>
    </header>
    
    <div class="dashboard-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><i class="bi bi-shop me-2"></i>Gestión de Comercios</h4>
            <div>
                <a href="comercioIndexController.php" class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-list-ul"></i> Ver Lista
                </a>
                <button class="btn btn-sm btn-primary" onclick="resetForm()">
                    <i class="bi bi-plus-circle"></i> Nuevo Comercio
                </button>
            </div>
        </div>

        <!-- Alertas -->
        <div id="alertContainer"></div>

        <!-- Formulario de Comercio -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Alta de Comercio</h5>
            </div>
            <div class="card-body">
                <form id="comercioForm" novalidate>
                    <!-- Asociación con Razón Social -->
                    <div class="form-section">
                        <h6><i class="bi bi-building me-1"></i>Asociación con Razón Social</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="razonSocialId" class="form-label required-label">Razón Social</label>
                                <select class="form-select" id="razonSocialId" name="razonSocialId" required>
                                    <option value="">Seleccionar razón social...</option>
                                    <?php
                                    foreach ($razonesSociales as $razon): 
                                    ?>
                                    <option value="<?php echo $razon->id; ?>">
                                        <?php echo htmlspecialchars($razon->nombre); ?> (<?php echo $razon->cuit; ?>)
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">Por favor selecciona una razón social.</div>
                            </div>
                        
                        </div>
                    </div>

                    <!-- Datos del Comercio -->
                    <div class="form-section">
                        <h6><i class="bi bi-shop me-1"></i>Datos del Comercio</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombreComercio" class="form-label required-label">Nombre del Comercio</label>
                                <input type="text" class="form-control" id="nombreComercio" name="nombreComercio" placeholder="Ej: Sucursal Centro" required>
                                <div class="invalid-feedback">Por favor ingresa el nombre del comercio.</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="nombreFantasia" class="form-label">Nombre de Fantasía</label>
                                <input type="text" class="form-control" id="nombreFantasia" name="nombreFantasia" placeholder="Ej: Mi Tienda Online">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="rubroId" class="form-label required-label">Rubro</label>
                                <select class="form-select" id="rubroId" name="rubroId" required>
                                    <option value="">Seleccionar rubro...</option>
                                    <?php
                                    foreach ($rubros as $rubro) {
                                    ?>
                                    <option value="<?php echo $rubro->id; ?>">
                                        <?php echo htmlspecialchars($rubro->nombre) ?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">Por favor selecciona un rubro.</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="subrubro" class="form-label">Subrubro</label>
                                <input type="text" class="form-control" id="subrubro" name="subrubro" placeholder="Especificación del rubro">
                            </div>
                        </div>
                    </div>

                    <!-- Contacto del Comercio -->
                    <div class="form-section">
                        <h6><i class="bi bi-telephone me-1"></i>Contacto del Comercio</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telefonoComercio" class="form-label required-label">Teléfono del Comercio</label>
                                <input type="tel" class="form-control" id="telefonoComercio" name="telefonoComercio" placeholder="+54 11 1234-5678" required>
                                <div class="invalid-feedback">Por favor ingresa un teléfono válido.</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="emailComercio" class="form-label">Email del Comercio</label>
                                <input type="email" class="form-control" id="emailComercio" name="emailComercio" placeholder="comercio@ejemplo.com">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="sitioWeb" class="form-label">Sitio Web</label>
                                <input type="url" class="form-control" id="sitioWeb" name="sitioWeb" placeholder="https://www.mitienda.com">
                            </div>
                        </div>
                    </div>

                    <!-- Dirección del Comercio -->
                    <div class="form-section">
                        <h6><i class="bi bi-geo-alt me-1"></i>Dirección del Comercio</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="direccion" class="form-label required-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Calle y número" required>
                                <div class="invalid-feedback">Por favor ingresa la dirección.</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="localidadComercio" class="form-label required-label">Localidad</label>
                                <input type="text" class="form-control" id="localidadComercio" name="localidadComercio" placeholder="Localidad" required>
                                <div class="invalid-feedback">Por favor ingresa la localidad.</div>
                            </div>
                            
                            <div class="col-md-4 mb-3">
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
                                <div class="invalid-feedback">Por favor selecciona una provincia.</div>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="codigoPostalComercio" class="form-label">Código Postal</label>
                                <input type="text" class="form-control" id="codigoPostalComercio" name="codigoPostalComercio" placeholder="Código postal">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="barrio" class="form-label">Zona/Barrio</label>
                                <input type="text" class="form-control" id="barrio" name="barrio" placeholder="Barrio o zona">
                            </div>
                        </div>
                    </div>


                    <!-- Estado -->
                    <div class="form-section">
                        <h6><i class="bi bi-circle-fill me-1"></i>Estado del Comercio</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="estadoComercio" class="form-label required-label">Estado</label>
                                <select class="form-select" id="estadoComercio" name="estadoComercio" required>
                                    <option value="activo" selected>Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                    <option value="en construccion">En Construcción</option>
                                    <option value="pendiente">pendiente</option>
                                </select>
                            </div>
                            
                            
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                    <i class="bi bi-arrow-clockwise"></i> Limpiar Formulario
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg"></i> Guardar Comercio
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Mostrar información de la razón social seleccionada
    // document.getElementById('razonSocialId').addEventListener('change', function() {
    //     const razonSocialInfo = document.getElementById('razonSocialInfo');
    //     const selectedId = this.value;
        
    //     if (selectedId && razonesSocialesInfo[selectedId]) {
    //         const info = razonesSocialesInfo[selectedId];
    //         razonSocialInfo.innerHTML = `
    //             <div class="small">
    //                 <strong>CUIT:</strong> ${info.cuit}<br>
    //                 <strong>Condición IVA:</strong> ${info.condicionIva}<br>
    //                 <strong>Estado:</strong> <span class="badge ${info.estado === 'Activo' ? 'bg-success' : 'bg-warning'}">${info.estado}</span>
    //             </div>
    //         `;
    //     } else {
    //         razonSocialInfo.innerHTML = '<small class="text-muted">Selecciona una razón social para ver su información</small>';
    //     }
    // });

    // Validación del formulario
    document.getElementById('comercioForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            showAlert('Por favor, completa todos los campos obligatorios.', 'warning');
            return;
        }

        const formData = new FormData(this);
        fetch('comercioGuardarController.php', {
            method: 'POST',
            body: formData
            })
            .then(response => {
                return response.json();
            })
            .then(data => {
            if (data.success) {
                showAlert('Comercio guardado correctamente.', 'success');
                window.location.href = 'comercioIndexController.php?success=created';
            } else {
                showAlert('Error al guardar: ', 'warning');
            }
        });
    });

    // Función para mostrar alertas
    function showAlert(message, type) {
        const alertContainer = document.getElementById('alertContainer');
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show`;
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        alertContainer.appendChild(alert);
        
        setTimeout(() => {
            if (alert.parentNode) {
                alert.remove();
            }
        }, 5000);
    }

    // Función para resetear el formulario
    function resetForm() {
        document.getElementById('comercioForm').reset();
        document.getElementById('comercioForm').classList.remove('was-validated');
        document.getElementById('razonSocialInfo').innerHTML = '<small class="text-muted">Selecciona una razón social para ver su información</small>';
        document.getElementById('alertContainer').innerHTML = '';
    }

    // Validación en tiempo real
    const inputs = document.querySelectorAll('#comercioForm input, #comercioForm select');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.checkValidity()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
            }
        });
    });
</script>

<?php include 'footer.php'; ?>