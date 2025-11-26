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

    <!-- Alertas -->
    <div id="alertContainer"></div>

    <div class="dashboard-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><i class="bi bi-tags me-2"></i>Gestión de Rubros</h4>
            <div>
                <a href="rubrosIndexController.php" class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-list-ul"></i> Ver Lista
                </a>
                <a href="rubrosAltaController.php" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle"></i> Nuevo Rubro
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Editar Rubro</h5>
            </div>
            <div class="card-body">
                <form id="rubroEditarForm">
                    <div class="row">
                        <input type="hidden" class="form-control" id="idRubro" name="idRubro" value="<?= $rubro->id ?>">
                    </div>

                    <div class="mb-3">
                        <label for="nombreRubro" class="form-label required-label">Nombre del Rubro</label>
                        <input type="text" class="form-control" id="nombreRubro" name="nombreRubro" value="<?= $rubro->nombre ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="codigoRubro" class="form-label">Código</label>
                        <input type="text" class="form-control" id="codigoRubro" name="codigoRubro" value="<?= $rubro->codigo ?>">
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción del Rubro</label>
                        <input type="text" class="form-control" id="descripcion" rows="3" maxlength="500" value="<?php $rubro->descripcion ?>">

                        <div class="form-text"><span id="descripcionCounter">0</span>/500 caracteres</div>
                    </div>

                    <div class="form-section">
                        <h6><i class="bi bi-eye me-1"></i>Configuración de Visibilidad</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="visible" value="0">
                                    <input class="form-check-input" type="checkbox" id="visible" value="1" <?= $rubro->visible_publico == 1 ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-bold" for="visible">
                                        Visible al Público
                                    </label>
                                </div>
                                <div class="form-text">
                                    Si está activado, el rubro será visible en el sitio público para que los comercios puedan seleccionarlo.
                                    Si está desactivado, solo será visible en el panel de administración.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="activo" value="0">
                                    <input class="form-check-input" type="checkbox" id="activo" value="1" <?= $rubro->activo == 1 ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-bold" for="activo">
                                        Rubro Activo
                                    </label>
                                </div>
                                <div class="form-text">
                                    Los rubros inactivos no podrán ser seleccionados por nuevos comercios,
                                    pero los comercios existentes mantendrán su asignación.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h6><i class="bi bi-files me-1"></i>Documentación Requerida</h6>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Información importante:</strong> Selecciona los documentos que serán requeridos para los comercios de este rubro.
                        </div>


                        <div class="documentacion-grid">
                            <?php foreach ($tiposDocumentacion as $tipo) { ?>
                                <div class="documentacion-item">
                                    <label class="custom-checkbox w-100">
                                        <input type="checkbox"
                                            name="documentacion[]"
                                            value="<?= $tipo->id ?>"
                                            <?= in_array($tipo->id, $documentacion) ? 'checked' : '' ?>>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1"><?= $tipo->nombre ?></h6>
                                                <p class="mb-0 text-muted small"><?= $tipo->descripcion ?></p>
                                            </div>
                                            <span class="checkmark"></span>
                                        </div>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>


                    </div>

                    <div class="footer">
                        <a href="comercioIndexController.php" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-info">Guardar Cambios</button>
                    </div>

                </form>
            </div>

        </div>


    </div>
</div>

<script>
    // Contador de caracteres para la descripción
    document.getElementById('descripcion').addEventListener('input', function() {
        document.getElementById('descripcionCounter').textContent = this.value.length;
    });

    // Auto-generar código basado en el nombre
    document.getElementById('nombreRubro').addEventListener('blur', function() {
        const codigoInput = document.getElementById('codigoRubro');
        if (!codigoInput.value && this.value) {
            // Generar código a partir de las primeras letras de cada palabra
            const palabras = this.value.toUpperCase().split(' ');
            let codigo = '';
            for (let palabra of palabras) {
                if (palabra.length > 0) {
                    codigo += palabra[0];
                }
                if (codigo.length >= 3) break;
            }
            codigoInput.value = codigo;
        }
    });

    document.querySelectorAll('.custom-checkbox input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const item = this.closest('.documentacion-item');
            if (this.checked) {
                item.classList.add('selected');
            } else {
                // item.classList.remove('selected');
            }
        });
    });


    document.getElementById('rubroEditarForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Validar campos básicos
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            showAlert('Por favor, completa todos los campos obligatorios.', 'warning');
            return;
        }

        const formData = new FormData(this);
        const rubroData = {
            id: document.getElementById('idRubro').value,
            nombre: document.getElementById('nombreRubro').value,
            codigo: document.getElementById('codigoRubro').value,
            descripcion: document.getElementById('descripcion').value,
            visible: document.getElementById('visible').checked,
            activo: document.getElementById('activo').checked,
            documentacion: []
        };

        // Recopilar documentos seleccionados
        const documentosSeleccionados = document.querySelectorAll('input[name="documentacion[]"]:checked');
        documentosSeleccionados.forEach(doc => {
            rubroData.documentacion.push(doc.value);
        });

        const response = fetch('/final-2025/Controllers/rubrosActualizarController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(rubroData)
        })
        .then(response => {
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showAlert('Rubro actualizado correctamente', 'success');
                window.location.href = 'rubrosIndexController.php?success=created';
            } else {
                showAlert('Ocurrió un error', 'danger')
            }
        })
        .catch(error => {
            showAlert('Error al procesar la solicitud', error)
        })
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
        document.getElementById('rubroEditarForm').reset();
        document.getElementById('rubroEditarForm').classList.remove('was-validated');
        document.getElementById('descripcionCounter').textContent = '0';
        document.getElementById('alertContainer').innerHTML = '';

        // Desmarcar todos los checkboxes de documentación
        document.querySelectorAll('input[name="documentacion[]"]').forEach(checkbox => {
            checkbox.checked = false;
            checkbox.closest('.documentacion-item').classList.remove('selected');
        });
    }

    // Validación en tiempo real
    const inputs = document.querySelectorAll('#rubroEditarForm input, #rubroEditarForm select');
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