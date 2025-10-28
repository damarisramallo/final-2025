<?php 
$page_title = "Razón Social - Lista";
$current_page = "razon_social";
?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<style>
    .table-responsive { 
        border-radius: 8px; 
        overflow: hidden; 
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 4px 8px;
    }
    .badge-activo { background-color: #28a745; }
    .badge-inactivo { background-color: #6c757d; }
    .badge-suspendido { background-color: #ffc107; color: #212529; }
    .btn-group-sm > .btn { padding: 0.25rem 0.5rem; }
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
            <h4><i class="bi bi-building me-2"></i>Lista de Razones Sociales</h4>
            <a href="titularesAltaController.php" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i> Nueva Razón Social
            </a>
        </div>

        <!-- Alertas -->
        <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php 
            $messages = [
                'created' => 'Razón social creada correctamente.',
                'updated' => 'Razón social actualizada correctamente.',
                'deleted' => 'Razón social eliminada correctamente.'
            ];
            echo $messages[$_GET['success']] ?? 'Operación realizada correctamente.';
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <!-- Tabla con DataTable -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Razones Sociales Registradas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablaRazonesSociales" class="table table-hover table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Razón Social</th>
                                <th>CUIT/CUIL</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Condición IVA</th>
                                <th>Localidad</th>
                                <th>Estado</th>
                                <th>Fecha Alta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($razonesSociales as $razon) { ?>
                                <tr>
                                    <td><?= $razon->id ?></td>
                                    <td>
                                        <div class="fw-bold"><?php echo htmlspecialchars($razon->nombre); ?></div>
                                        <small class="text-muted">ID: <?php echo $razon->id; ?></small>
                                    </td>
                                    <td><?= $razon->cuit ?></td>
                                    <td><?php echo htmlspecialchars($razon->email); ?></td>
                                    <td><?= $razon->telefono ?></td>
                                    <td>
                                        <span class="badge bg-info"><?php echo $razon->condicion_iva; ?></span>
                                    </td>
                                    <td><?= $razon->localidad ?></td>
                                    <td>
                                        <?php 
                                        $badge_class = '';
                                        switch($razon->estado) {
                                            case 'activo': $badge_class = 'badge-activo'; break;
                                            case 'inactivo': $badge_class = 'badge-inactivo'; break;
                                            case 'suspendido': $badge_class = 'badge-suspendido'; break;
                                        }
                                        ?>
                                        <span class="badge <?php echo $badge_class; ?>">
                                            <?php echo ucfirst($razon->estado); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('d/m/Y', strtotime($razon->fecha_creacion)); ?></td>
                                    <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="razon_social_ver.php?id=<?php echo $razon->id; ?>" 
                                           class="btn btn-outline-primary" title="Ver">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="razon_social.php?editar=<?php echo $razon->id; ?>" 
                                           class="btn btn-outline-secondary" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn btn-outline-danger" 
                                                title="Eliminar"
                                                onclick="confirmarEliminar(<?php echo $razon->id; ?>, '<?php echo htmlspecialchars($razon->nombre); ?>')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                </tr>
                            <?php } ?>

                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmación Eliminar -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar la razón social <strong id="razonSocialDeleteName"></strong>?</p>
                <p class="text-danger"><small>Esta acción no se puede deshacer.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- DataTables JavaScript -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    // Inicializar DataTable
    $(document).ready(function() {
        $('#tablaRazonesSociales').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-AR.json'
            },
            responsive: true,
            dom: '<"row"<"col-md-6"B><"col-md-6"f>>rt<"row"<"col-md-6"l><"col-md-6"p>>',
            buttons: [
                {
                    extend: 'copy',
                    text: '<i class="bi bi-clipboard"></i> Copiar',
                    className: 'btn btn-sm btn-outline-secondary'
                },
                {
                    extend: 'excel',
                    text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                    className: 'btn btn-sm btn-outline-success'
                },
                {
                    extend: 'pdf',
                    text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                    className: 'btn btn-sm btn-outline-danger'
                },
                {
                    extend: 'print',
                    text: '<i class="bi bi-printer"></i> Imprimir',
                    className: 'btn btn-sm btn-outline-dark'
                }
            ],
            columnDefs: [
                { responsivePriority: 1, targets: 1 }, // Razón Social
                { responsivePriority: 2, targets: 9 }, // Acciones
                { responsivePriority: 3, targets: 2 }, // CUIT
                { responsivePriority: 4, targets: 6 }, // Localidad
                { 
                    targets: [0], // Columna ID
                    visible: false,
                    searchable: false
                },
                {
                    targets: [3, 4], // Email y Teléfono
                    responsivePriority: 5
                }
            ],
            order: [[1, 'asc']], // Ordenar por Razón Social
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]]
        });
    });

    // Función para confirmar eliminación
    function confirmarEliminar(id, nombre) {
        document.getElementById('razonSocialDeleteName').textContent = nombre;
        document.getElementById('confirmDeleteBtn').href = `razon_social_eliminar.php?id=${id}`;
        $('#confirmDeleteModal').modal('show');
    }

    // Función para exportar datos
    function exportarDatos(tipo) {
        alert(`Exportando datos en formato ${tipo.toUpperCase()}...`);
        // En un caso real, aquí iría la lógica de exportación
    }
</script>

<?php include 'footer.php'; ?>