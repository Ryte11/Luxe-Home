document.addEventListener('DOMContentLoaded', function() {
    // Elementos del modal
    const modal = document.getElementById('mensajeModal');
    const modalContenido = document.getElementById('mensajeContenido');
    const closeModal = document.querySelector('.close-modal');
    
    // Botones "Ver más"
    const verMasBtns = document.querySelectorAll('.ver-mas-btn');
    
    // Añadir event listeners a los botones "Ver más"
    verMasBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const mensajeCompleto = this.parentElement.querySelector('.mensaje-completo .mensaje-contenido').innerHTML;
            modalContenido.innerHTML = mensajeCompleto;
            modal.style.display = 'block';
        });
    });
    
    // Cerrar modal al hacer clic en X
    if (closeModal) {
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    }
    
    // Cerrar modal al hacer clic fuera del contenido
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    
    // Manejar las acciones de los botones de la tabla
    const actionBtns = document.querySelectorAll('.action-btn button');
    
    actionBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const action = this.getAttribute('data-action');
            
            if (action === 'marcar') {
                marcarMensajeComoLeido(id);
            } else if (action === 'eliminar') {
                eliminarMensaje(id);
            }
        });
    });
    
    // Función para marcar mensaje como leído
    function marcarMensajeComoLeido(id) {
        if (confirm('¿Marcar este mensaje como leído?')) {
            // Enviar solicitud AJAX para actualizar estado
            fetch('./php/update_message_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id + '&action=marcar'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar la interfaz
                    const row = document.querySelector(`button[data-id="${id}"]`).closest('tr');
                    const statusBadge = row.querySelector('.status-badge');
                    
                    statusBadge.className = 'status-badge completed';
                    statusBadge.textContent = 'Leído';
                    
                    alert('El mensaje ha sido marcado como leído.');
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al conectar con el servidor.');
            });
        }
    }
    
    // Función para eliminar mensaje
    function eliminarMensaje(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este mensaje? Esta acción no se puede deshacer.')) {
            // Enviar solicitud AJAX para eliminar
            fetch('./php/update_message_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id + '&action=eliminar'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Eliminar la fila de la tabla
                    const row = document.querySelector(`button[data-id="${id}"]`).closest('tr');
                    row.remove();
                    
                    alert('El mensaje ha sido eliminado correctamente.');
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al conectar con el servidor.');
            });
        }
    }
    
    
});

// reportes donwload contactos

document.addEventListener('DOMContentLoaded', function () {
    // Add the download button listener
    const downloadBtn = document.getElementById('downloadBtn') || 
                        document.getElementById('downloadContactReport');
    
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function () {
            exportTableToExcel();
        });
    }
    
    function exportTableToExcel() {
        // Get the table element
        const table = document.querySelector('table');
        
        // Create a workbook
        const wb = XLSX.utils.book_new();
        
        // Get all the header cells
        const headerCells = Array.from(table.querySelectorAll('thead th'));
        const headers = headerCells.map(cell => cell.textContent.trim());
        
        // Get all the data rows, excluding SVG icons and buttons
        const dataRows = [];
        const rows = table.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const rowData = [];
            
            // Process each cell in the row
            const cells = row.querySelectorAll('td');
            cells.forEach((cell, index) => {
                // Skip action buttons columns (last two columns)
                if (index === cells.length - 1 || index === cells.length - 2) {
                    rowData.push(''); // Empty content for action columns
                    return;
                }
                
                // Special handling for comments column with SVG
                if (cell.querySelector('svg') && cell.querySelector('#comentarios')) {
                    rowData.push(cell.querySelector('#comentarios').textContent.trim());
                    return;
                }
                
                // For all other cells, get the text content
                rowData.push(cell.textContent.trim());
            });
            
            dataRows.push(rowData);
        });
        
        // Create worksheet from the extracted data
        const ws = XLSX.utils.aoa_to_sheet([headers, ...dataRows]);
        
        // Set column widths (in characters)
        const columnWidths = [
            { wch: 20 },  // Cliente
            { wch: 25 },  // Propiedad
            { wch: 15 },  // Telefono
            { wch: 15 },  // Tipo
            { wch: 15 },  // Fecha entrada
            { wch: 15 },  // Fecha Salida
            { wch: 15 },  // Num. Huespedes
            { wch: 40 },  // Comentarios
            { wch: 15 },  // Total a pagar
            { wch: 15 },  // Estado
            { wch: 10 },  // Aceptar/Denegar (blank in export)
            { wch: 10 }   // Acciones (blank in export)
        ];
        
        ws['!cols'] = columnWidths;
        
        // Add styling for header row
        const range = XLSX.utils.decode_range(ws['!ref']);
        for (let C = range.s.c; C <= range.e.c; ++C) {
            const address = XLSX.utils.encode_cell({ r: 0, c: C });
            if (!ws[address]) continue;
            ws[address].s = {
                font: { bold: true },
                alignment: { horizontal: 'center' }
            };
        }
        
        // Add worksheet to workbook
        XLSX.utils.book_append_sheet(wb, ws, "Reservaciones");
        
        // Generate Excel file and trigger download
        XLSX.writeFile(wb, "reservaciones.xlsx");
    }
});


// reportes paginacion

document.addEventListener('DOMContentLoaded', function() {
    const rowsPerPage = 15;
    const rows = document.querySelectorAll('.users-table tbody tr');
    const totalPages = Math.ceil(rows.length / rowsPerPage);
    const paginationContainer = document.querySelector('.pagination .page-numbers');

    let currentPage = 1;

    function displayRows(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach((row, index) => {
            row.style.display = (index >= start && index < end) ? '' : 'none';
        });
    }

    function updatePagination() {
        paginationContainer.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.className = 'page-number';
            pageButton.textContent = i;
            if (i === currentPage) {
                pageButton.classList.add('active');
            }
            pageButton.addEventListener('click', function() {
                currentPage = i;
                displayRows(currentPage);
                updatePagination();
            });
            paginationContainer.appendChild(pageButton);
        }
    }

    document.querySelector('.pagination .prev').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            displayRows(currentPage);
            updatePagination();
        }
    });

    document.querySelector('.pagination .next').addEventListener('click', function() {
        if (currentPage < totalPages) {
            currentPage++;
            displayRows(currentPage);
            updatePagination();
        }
    });

    // Initialize the table with the first page
    displayRows(currentPage);
    updatePagination();
});