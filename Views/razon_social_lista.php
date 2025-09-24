<?php 
$page_title = "Razón Social - Lista";
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
            <img src="https://via.placeholder.com/40" class="rounded-circle" alt="User">
        </div>
    </header>
    
    <div class="dashboard-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><i class="bi bi-building me-2"></i>Lista de Razones Sociales</h4>
            <div>
                <button class="btn btn-sm btn-outline-secondary me-2" onclick="exportarLista()">
                    <i class="bi bi-download"></i> Exportar
                </button>
                <a href="razon_social.php" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle"></i> Nueva Razón Social
                </a>
            </div>
        </div>

        <!-- Alertas -->
        <div id="alertContainer"></div>

        <!-- Filtros y Búsqueda -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="searchInput" class="form-label">Búsqueda</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchInput" placeholder="Buscar por razón social, CUIT, email...">
                            <button class="btn btn-outline-secondary" type="button" onclick="buscarRazonesSociales()">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="filterEstado" class="form-label">Estado</label>
                        <select class="form-select" id="filterEstado" onchange="filtrarRazonesSociales()">
                            <option value="">Todos los estados</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                            <option value="suspendido">Suspendido</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="filterCondicionIva" class="form-label">Condición IVA</label>
                        <select class="form-select" id="filterCondicionIva" onchange="filtrarRazonesSociales()">
                            <option value="">Todas las condiciones</option>
                            <option value="responsableInscripto">Responsable Inscripto</option>
                            <option value="monotributista">Monotributista</option>
                            <option value="exento">Exento</option>
                            <option value="noResponsable">No Responsable</option>
                            <option value="consumidorFinal">Consumidor Final</option>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label for="itemsPerPage" class="form-label">Items por página</label>
                        <select class="form-select" id="itemsPerPage" onchange="cambiarItemsPorPagina()">
                            <option value="10">10</option>
                            <option value="25" selected>25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <span id="totalRegistros" class="text-muted">Mostrando 0 de 0 registros</span>
                            <button class="btn btn-sm btn-outline-secondary" onclick="limpiarFiltros()">
                                <i class="bi bi-arrow-clockwise"></i> Limpiar Filtros
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Razones Sociales -->
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Razones Sociales Registradas</h5>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="toggleInactivos" onchange="toggleRazonesInactivas()">
                    <label class="form-check-label" for="toggleInactivos">Mostrar inactivos</label>
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaRazonesSociales">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                                    </div>
                                </th>
                                <th>Razón Social</th>
                                <th>CUIT/CUIL</th>
                                <th>Contacto</th>
                                <th>Condición IVA</th>
                                <th>Localidad</th>
                                <th>Estado</th>
                                <th>Fecha Alta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyRazonesSociales">
                            <!-- Los datos se cargarán dinámicamente -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginación -->
                <nav aria-label="Paginación" class="mt-4">
                    <ul class="pagination justify-content-center" id="pagination">
                        <!-- La paginación se generará dinámicamente -->
                    </ul>
                </nav>
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
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Vista Rápida -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle de Razón Social</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <!-- Contenido cargado dinámicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="editFromViewBtn">Editar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Datos de ejemplo (simulando base de datos)
    let razonesSociales = [
        {
            id: 1,
            razonSocial: "Empresa Tech Solutions S.A.",
            cuit: "30-12345678-9",
            email: "contacto@techsolutions.com",
            telefono: "+54 11 4321-5678",
            condicionIva: "responsableInscripto",
            localidad: "CABA",
            provincia: "CABA",
            estado: "activo",
            fechaAlta: "2023-01-15",
            direccion: "Av. Corrientes 1234",
            actividadPrincipal: "Desarrollo de Software"
        },
        {
            id: 2,
            razonSocial: "Distribuidora Norte S.R.L.",
            cuit: "27-87654321-0",
            email: "ventas@distribuidoranorte.com",
            telefono: "+54 11 8765-4321",
            condicionIva: "monotributista",
            localidad: "San Isidro",
            provincia: "Buenos Aires",
            estado: "activo",
            fechaAlta: "2023-02-20",
            direccion: "Av. del Libertador 567",
            actividadPrincipal: "Distribución Mayorista"
        },
        {
            id: 3,
            razonSocial: "Consultora Estratégica Integral",
            cuit: "20-11223344-5",
            email: "info@consultoraei.com",
            telefono: "+54 11 5566-7788",
            condicionIva: "responsableInscripto",
            localidad: "CABA",
            provincia: "CABA",
            estado: "inactivo",
            fechaAlta: "2022-11-10",
            direccion: "Paraguay 890",
            actividadPrincipal: "Consultoría Empresarial"
        },
        {
            id: 4,
            razonSocial: "Almacén Don José",
            cuit: "23-44332211-6",
            email: "donjose@almacen.com",
            telefono: "+54 11 9988-7766",
            condicionIva: "monotributista",
            localidad: "Lomas de Zamora",
            provincia: "Buenos Aires",
            estado: "activo",
            fechaAlta: "2023-03-05",
            direccion: "Av. Hipólito Yrigoyen 2345",
            actividadPrincipal: "Venta Minorista"
        },
        {
            id: 5,
            razonSocial: "Constructora Edifica S.A.",
            cuit: "30-55667788-1",
            email: "obra@edifica.com",
            telefono: "+54 11 2233-4455",
            condicionIva: "responsableInscripto",
            localidad: "La Plata",
            provincia: "Buenos Aires",
            estado: "suspendido",
            fechaAlta: "2022-09-18",
            direccion: "Calle 7 1234",
            actividadPrincipal: "Construcción Civil"
        }
    ];

    let currentPage = 1;
    let itemsPerPage = 25;
    let filteredData = [...razonesSociales];

    // Inicializar la tabla
    document.addEventListener('DOMContentLoaded', function() {
        actualizarTabla();
        actualizarContador();
    });

    // Función para actualizar la tabla
    function actualizarTabla() {
        const tbody = document.getElementById('tbodyRazonesSociales');
        tbody.innerHTML = '';

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const paginatedData = filteredData.slice(startIndex, endIndex);

        if (paginatedData.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center py-4">
                        <i class="bi bi-search display-4 text-muted"></i>
                        <p class="mt-2">No se encontraron razones sociales</p>
                    </td>
                </tr>
            `;
            return;
        }

        paginatedData.forEach(razon => {
            const tr = document.createElement('tr');
            tr.className = razon.estado === 'inactivo' ? 'table-secondary' : '';
            
            tr.innerHTML = `
                <td>
                    <div class="form-check">
                        <input class="form-check-input row-checkbox" type="checkbox" value="${razon.id}">
                    </div>
                </td>
                <td>
                    <div class="fw-bold">${razon.razonSocial}</div>
                    <small class="text-muted">${razon.actividadPrincipal || 'Sin actividad definida'}</small>
                </td>
                <td>${razon.cuit}</td>
                <td>
                    <div>${razon.email}</div>
                    <small class="text-muted">${razon.telefono}</small>
                </td>
                <td>
                    <span class="badge bg-info">${obtenerLabelCondicionIva(razon.condicionIva)}</span>
                </td>
                <td>${razon.localidad}, ${razon.provincia}</td>
                <td>
                    <span class="badge ${obtenerClaseEstado(razon.estado)}">${obtenerLabelEstado(razon.estado)}</span>
                </td>
                <td>${formatearFecha(razon.fechaAlta)}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary" onclick="verRazonSocial(${razon.id})" title="Ver">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-outline-secondary" onclick="editarRazonSocial(${razon.id})" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-outline-danger" onclick="confirmarEliminar(${razon.id}, '${razon.razonSocial}')" title="Eliminar">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });

        generarPaginacion();
        actualizarContador();
    }

    // Funciones auxiliares
    function obtenerLabelCondicionIva(condicion) {
        const condiciones = {
            'responsableInscripto': 'Resp. Inscripto',
            'monotributista': 'Monotributista',
            'exento': 'Exento',
            'noResponsable': 'No Responsable',
            'consumidorFinal': 'Consumidor Final'
        };
        return condiciones[condicion] || condicion;
    }

    function obtenerLabelEstado(estado) {
        const estados = {
            'activo': 'Activo',
            'inactivo': 'Inactivo',
            'suspendido': 'Suspendido'
        };
        return estados[estado] || estado;
    }

    function obtenerClaseEstado(estado) {
        const clases = {
            'activo': 'bg-success',
            'inactivo': 'bg-secondary',
            'suspendido': 'bg-warning'
        };
        return clases[estado] || 'bg-secondary';
    }

    function formatearFecha(fecha) {
        return new Date(fecha).toLocaleDateString('es-AR');
    }

    // Funciones de búsqueda y filtrado
    function buscarRazonesSociales() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        
        filteredData = razonesSociales.filter(razon => 
            razon.razonSocial.toLowerCase().includes(searchTerm) ||
            razon.cuit.includes(searchTerm) ||
            razon.email.toLowerCase().includes(searchTerm) ||
            razon.localidad.toLowerCase().includes(searchTerm)
        );
        
        currentPage = 1;
        actualizarTabla();
    }

    function filtrarRazonesSociales() {
        const estado = document.getElementById('filterEstado').value;
        const condicionIva = document.getElementById('filterCondicionIva').value;
        
        filteredData = razonesSociales.filter(razon => {
            const matchEstado = !estado || razon.estado === estado;
            const matchCondicionIva = !condicionIva || razon.condicionIva === condicionIva;
            return matchEstado && matchCondicionIva;
        });
        
        currentPage = 1;
        actualizarTabla();
    }

    function toggleRazonesInactivas() {
        const showInactivos = document.getElementById('toggleInactivos').checked;
        
        if (!showInactivos) {
            filteredData = razonesSociales.filter(razon => razon.estado !== 'inactivo');
        } else {
            filteredData = [...razonesSociales];
        }
        
        currentPage = 1;
        actualizarTabla();
    }

    // Funciones de paginación
    function cambiarItemsPorPagina() {
        itemsPerPage = parseInt(document.getElementById('itemsPerPage').value);
        currentPage = 1;
        actualizarTabla();
    }

    function generarPaginacion() {
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        if (totalPages <= 1) return;

        // Botón Anterior
        const prevLi = document.createElement('li');
        prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
        prevLi.innerHTML = `<a class="page-link" href="#" onclick="cambiarPagina(${currentPage - 1})">Anterior</a>`;
        pagination.appendChild(prevLi);

        // Números de página
        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = `page-item ${i === currentPage ? 'active' : ''}`;
            li.innerHTML = `<a class="page-link" href="#" onclick="cambiarPagina(${i})">${i}</a>`;
            pagination.appendChild(li);
        }

        // Botón Siguiente
        const nextLi = document.createElement('li');
        nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
        nextLi.innerHTML = `<a class="page-link" href="#" onclick="cambiarPagina(${currentPage + 1})">Siguiente</a>`;
        pagination.appendChild(nextLi);
    }

    function cambiarPagina(page) {
        currentPage = page;
        actualizarTabla();
    }

    function actualizarContador() {
        const total = filteredData.length;
        const start = Math.min((currentPage - 1) * itemsPerPage + 1, total);
        const end = Math.min(currentPage * itemsPerPage, total);
        
        document.getElementById('totalRegistros').textContent = 
            `Mostrando ${start} - ${end} de ${total} registros`;
    }

    // Funciones de acciones
    function verRazonSocial(id) {
        const razon = razonesSociales.find(r => r.id === id);
        if (!razon) return;

        document.getElementById('viewModalBody').innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <h6>Información General</h6>
                    <p><strong>Razón Social:</strong> ${razon.razonSocial}</p>
                    <p><strong>CUIT/CUIL:</strong> ${razon.cuit}</p>
                    <p><strong>Actividad:</strong> ${razon.actividadPrincipal}</p>
                    <p><strong>Estado:</strong> <span class="badge ${obtenerClaseEstado(razon.estado)}">${obtenerLabelEstado(razon.estado)}</span></p>
                </div>
                <div class="col-md-6">
                    <h6>Contacto</h6>
                    <p><strong>Email:</strong> ${razon.email}</p>
                    <p><strong>Teléfono:</strong> ${razon.telefono}</p>
                    <p><strong>Dirección:</strong> ${razon.direccion}</p>
                    <p><strong>Localidad:</strong> ${razon.localidad}, ${razon.provincia}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <h6>Información Fiscal</h6>
                    <p><strong>Condición IVA:</strong> ${obtenerLabelCondicionIva(razon.condicionIva)}</p>
                    <p><strong>Fecha de Alta:</strong> ${formatearFecha(razon.fechaAlta)}</p>
                </div>
            </div>
        `;

        document.getElementById('editFromViewBtn').onclick = () => {
            $('#viewModal').modal('hide');
            editarRazonSocial(id);
        };

        $('#viewModal').modal('show');
    }

    function editarRazonSocial(id) {
        // Redirigir al formulario de edición
        window.location.href = `razon_social.php?editar=${id}`;
    }

    function confirmarEliminar(id, nombre) {
        document.getElementById('razonSocialDeleteName').textContent = nombre;
        
        document.getElementById('confirmDeleteBtn').onclick = () => {
            eliminarRazonSocial(id);
            $('#confirmDeleteModal').modal('hide');
        };
        
        $('#confirmDeleteModal').modal('show');
    }

    function eliminarRazonSocial(id) {
        // Simular eliminación
        razonesSociales = razonesSociales.filter(r => r.id !== id);
        filteredData = filteredData.filter(r => r.id !== id);
        
        showAlert('Razón social eliminada correctamente.', 'success');
        actualizarTabla();
    }

    // Funciones de selección múltiple
    function toggleSelectAll() {
        const selectAll = document.getElementById('selectAll').checked;
        document.querySelectorAll('.row-checkbox').forEach(checkbox => {
            checkbox.checked = selectAll;
        });
    }

    function exportarLista() {
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked'))
            .map(checkbox => parseInt(checkbox.value));
        
        const dataToExport = selectedIds.length > 0 ? 
            razonesSociales.filter(r => selectedIds.includes(r.id)) : 
            filteredData;
        
        // Simular exportación
        showAlert(`Exportando ${dataToExport.length} registros...`, 'info');
    }

    function limpiarFiltros() {
        document.getElementById('searchInput').value = '';
        document.getElementById('filterEstado').value = '';
        document.getElementById('filterCondicionIva').value = '';
        document.getElementById('toggleInactivos').checked = false;
        
        filteredData = [...razonesSociales];
        currentPage = 1;
        actualizarTabla();
    }

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
</script>

<?php include 'footer.php'; ?>