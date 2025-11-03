<?php 
$page_title = "Comercio - Lista";
$current_page = "comercios";
?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<style>
    .badge-aprobado { background-color: #28a745; }
    .badge-pendiente { background-color: #6c757d; }
    .badge-rechazado { background-color: #e32d00ff; }
    .badge-suspendido { background-color: #fe2bd0ff; }
    .badge-en_revision { background-color: #ffc107; color: #212529; }
    .badge-construccion { background-color: #17a2b8; }
    .table-responsive { border-radius: 8px; overflow: hidden; }
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
            <h4><i class="bi bi-shop me-2"></i>Lista de Comercios</h4>
            <a href="comercioAltaController.php" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i> Nuevo Comercio
            </a>
        </div>

        <!-- Alertas -->
        <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php 
            $messages = [
                'created' => 'Comercio creado correctamente.',
                'updated' => 'Comercio actualizado correctamente.',
                'deleted' => 'Comercio eliminado correctamente.'
            ];
            echo $messages[$_GET['success']] ?? 'Operación realizada correctamente.';
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <!-- Tabla de Comercios -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Comercios Registrados</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablaComercios" class="table table-hover table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Comercio</th>
                                <th>Razón Social</th>
                                <th>Rubro</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th>Fecha Alta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php foreach($comercios as $comercio) {
                            $badge_class = 'badge-' . $comercio->estado;
                            $estado_label = ucfirst($comercio->estado);?>
                                <tr>
                                    <td><?php echo $comercio->id; ?></td>
                                    <td>
                                        <div class="fw-bold"><?php echo htmlspecialchars($comercio->nombre); ?></div>
                                        <?php if($comercio->nombre_fantasia): ?>
                                        <small class="text-muted">"<?php echo htmlspecialchars($comercio->nombre_fantasia); ?>"</small>
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                        <div class="small"><?php echo htmlspecialchars($comercio->titular()->nombre); ?></div>
                                        <small class="text-muted">ID: <?php echo $comercio->titular_id; ?></small>
                                    </td>
                                    <td><?php echo $comercio->rubro()->nombre; ?></td>
                                    <td>
                                        <div><?php echo htmlspecialchars($comercio->direccion); ?></div>
                                        <small class="text-muted"><?php echo $comercio->localidad; ?></small>
                                    </td>
                                    <td><?php echo $comercio->telefono; ?></td>
                                    <td>
                                        <span class="badge <?php echo $badge_class; ?>">
                                            <?php echo $estado_label; ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('d/m/Y', strtotime($comercio->fecha_alta)); ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="comercio_ver.php?id=<?php echo $comercio->id; ?>" 
                                            class="btn btn-outline-primary" title="Ver">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="comercio.php?editar=<?php echo $comercio->id; ?>" 
                                            class="btn btn-outline-secondary" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button class="btn btn-outline-danger" 
                                                    title="Eliminar"
                                                    onclick="confirmarEliminar(<?php echo $comercio->id; ?>, '<?php echo htmlspecialchars($comercio->nombre); ?>')">
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
                <p>¿Estás seguro de que deseas eliminar el comercio <strong id="comercioDeleteName"></strong>?</p>
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
        $('#tablaComercios').DataTable({
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
                { responsivePriority: 1, targets: 1 }, // Comercio
                { responsivePriority: 2, targets: 8 }, // Acciones
                { responsivePriority: 3, targets: 2 }, // Razón Social
                { responsivePriority: 4, targets: 4 }, // Dirección
                { 
                    targets: [0], // Columna ID
                    visible: false,
                    searchable: false
                }
            ],
            order: [[1, 'asc']], // Ordenar por Nombre del Comercio
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]]
        });
    });

    // Función para confirmar eliminación
    function confirmarEliminar(id, nombre) {
        document.getElementById('comercioDeleteName').textContent = nombre;
        document.getElementById('confirmDeleteBtn').href = `comercio_eliminar.php?id=${id}`;
        $('#confirmDeleteModal').modal('show');
    }
</script>

<?php include 'footer.php'; ?>