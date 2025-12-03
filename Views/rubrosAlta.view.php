<?php 
$page_title = "Rubro - Alta";
$current_page = "rubros";
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
    .documentacion-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }
    .documentacion-item {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 1rem;
        background: white;
        transition: all 0.3s ease;
    }
    .documentacion-item:hover {
        border-color: var(--primary-color);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .documentacion-item.selected {
        border-color: var(--primary-color);
        background-color: rgba(67, 97, 238, 0.05);
    }
    .color-preview {
        width: 30px;
        height: 30px;
        border-radius: 4px;
        display: inline-block;
        margin-left: 10px;
        border: 1px solid #dee2e6;
    }
    .custom-checkbox {
        position: relative;
        cursor: pointer;
    }
    .custom-checkbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }
    .checkmark {
        position: absolute;
        top: 0;
        right: 0;
        height: 20px;
        width: 20px;
        background-color: #fff;
        border: 2px solid #dee2e6;
        border-radius: 4px;
        transition: all 0.3s;
    }
    .custom-checkbox input:checked ~ .checkmark {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        left: 6px;
        top: 2px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
    .custom-checkbox input:checked ~ .checkmark:after {
        display: block;
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
            <h4><i class="bi bi-tags me-2"></i>Gestión de Rubros</h4>
            <div>
                <a href="rubrosIndexController.php" class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-list-ul"></i> Ver Lista
                </a>
                <button class="btn btn-sm btn-primary" onclick="resetForm()">
                    <i class="bi bi-plus-circle"></i> Nuevo Rubro
                </button>
            </div>
        </div>

        <!-- Alertas -->
        <div id="alertContainer"></div>

        <!-- Formulario de Rubro -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Alta de Rubro</h5>
            </div>
            <div class="card-body">
                <form id="rubroForm" novalidate>
                    
                    <!-- Datos Básicos del Rubro -->
                    <div class="form-section">
                        <h6><i class="bi bi-info-circle me-1"></i>Datos Básicos del Rubro</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombreRubro" class="form-label required-label">Nombre del Rubro</label>
                                <input type="text" class="form-control" id="nombreRubro" 
                                       placeholder="Ej: Alimentos, Electrónica, Servicios..." required
                                       maxlength="100">
                                <div class="invalid-feedback">Por favor ingresa el nombre del rubro (máximo 100 caracteres).</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="codigoRubro" class="form-label required-label">Código del Rubro</label>
                                <input type="text" class="form-control" id="codigoRubro" 
                                       placeholder="Ej: ALI, ELE, SER..." required
                                       maxlength="10" style="text-transform: uppercase;">
                                <div class="invalid-feedback">Por favor ingresa un código único para el rubro (máximo 10 caracteres).</div>
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="descripcion" class="form-label">Descripción del Rubro</label>
                                <textarea class="form-control" id="descripcion" rows="3" 
                                          placeholder="Descripción detallada del rubro, su alcance y características principales..."
                                          maxlength="500"></textarea>
                                <div class="form-text"><span id="descripcionCounter">0</span>/500 caracteres</div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Configuración de Visibilidad -->
                    <div class="form-section">
                        <h6><i class="bi bi-eye me-1"></i>Configuración de Visibilidad</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="visible" checked>
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
                                    <input class="form-check-input" type="checkbox" id="activo" checked>
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

                    <!-- Documentación Requerida -->
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
                                        <input type="checkbox" name="documentacion[]" value="<?= $tipo->id ?>">
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

                    <!-- Botones de Acción -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                    <i class="bi bi-arrow-clockwise"></i> Limpiar Formulario
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg"></i> Guardar Rubro
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

    // Efecto visual para los items de documentación
    document.querySelectorAll('.custom-checkbox input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const item = this.closest('.documentacion-item');
            if (this.checked) {
                item.classList.add('selected');
            } else {
                item.classList.remove('selected');
            }
        });
    });

    // Validación del formulario
    document.getElementById('rubroForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validar campos básicos
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            showAlert('Por favor, completa todos los campos obligatorios.', 'warning');
            return;
        }
        
        // Simular envío exitoso
        const formData = new FormData(this);
        const rubroData = {
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
        
        const response = fetch('../Controllers/rubrosDarAltaController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(rubroData)
        })
        .then(response => {
            return response.json();
        })
        .then(data =>{
            if(data.success){
                showAlert('Rubro cargado correctamente', 'success');
                window.location.href = 'rubrosIndexController.php?success=created';
            } else {
                showAlert('Ocurrió un error', 'danger')
            }
        })
        .catch(error => {
            showAlert('Error al procesar la solicitud', error )
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
        document.getElementById('rubroForm').reset();
        document.getElementById('rubroForm').classList.remove('was-validated');
        document.getElementById('descripcionCounter').textContent = '0';
        document.getElementById('alertContainer').innerHTML = '';
        
        // Desmarcar todos los checkboxes de documentación
        document.querySelectorAll('input[name="documentacion[]"]').forEach(checkbox => {
            checkbox.checked = false;
            checkbox.closest('.documentacion-item').classList.remove('selected');
        });
    }

    // Validación en tiempo real
    const inputs = document.querySelectorAll('#rubroForm input, #rubroForm select, #rubroForm textarea');
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