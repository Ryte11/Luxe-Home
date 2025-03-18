document.addEventListener('DOMContentLoaded', function() {
    // Modal elements
    const modal = document.getElementById('reservationModal');
    const openBtn = document.getElementById('openFormBtn');
    const closeBtn = document.querySelector('.close');
    const cancelBtn = document.getElementById('cancelBtn');
    const form = document.getElementById('reservationForm');
    const modalTitle = document.getElementById('modalTitle');

      // Open modal for new reservation
    openBtn.addEventListener('click', function() {
        modalTitle.textContent = 'Nueva Reservación';
        form.reset();
        document.getElementById('reservationId').value = ''; // Clear the hidden ID field
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    });

    closeBtn.addEventListener('click', function() {
        closeModal();
    });

    cancelBtn.addEventListener('click', function() {
        closeModal();
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Function to close modal
    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = ''; 
        form.reset(); 
    }

// Form submission
form.addEventListener('submit', function(event) {
    event.preventDefault();

    // Get form values
    const reservationId = document.getElementById('reservationId').value;
    const clientName = document.getElementById('clientName').value;
    const property = document.getElementById('property').value;
    const phone = document.getElementById('phone').value;
    const reservationType = document.getElementById('reservationType').value;
    const checkInDate = document.getElementById('checkInDate').value;
    const checkOutDate = document.getElementById('checkOutDate').value;
    const guestCount = document.getElementById('guestCount').value;
    const comments = document.getElementById('comments').value;
    const total = document.getElementById('total').value;
    const status = document.getElementById('status').value;

    console.log("Sending data:", {
        reservationId,
        clientName,
        phone,
        checkInDate,
        checkOutDate,
        guestCount,
        comments,
        status
    });

    // Prepare formData
    const formData = new FormData();
        formData.append('reservationId', reservationId);
        formData.append('clientName', clientName);
        formData.append('property', property);
        formData.append('phone', phone);
        formData.append('reservationType', reservationType);
        formData.append('checkInDate', checkInDate);
        formData.append('checkOutDate', checkOutDate);
        formData.append('guestCount', guestCount);
        formData.append('comments', comments);
        formData.append('total', total);
        formData.append('status', status);

    // Updated path to match the correct location
    fetch('./php/update_reservation.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log("Server response:", response);
        if (!response.ok) {
            throw new Error(`Server error: ${response.status}`);
        }
        return response.text();
    })
    .then(text => {
        console.log("Response text:", text);
        try {
            return text ? JSON.parse(text) : {success: false, message: 'Respuestas vacías'};
        } catch (e) {
            console.error("Error parsing JSON:", e);
            console.error("Received text:", text);
            throw new Error("Respuesta inválida del servidor");
        }
    })
   .then(data => {
            if (data.success) {
                // Update the row in the table (if it exists)
                if (reservationId) {
                    const row = document.querySelector(`button[data-id="${reservationId}"]`).closest('tr');
                    if (row) {
                        row.cells[0].textContent = clientName;
                        row.cells[1].textContent = property;
                        row.cells[2].textContent = phone;
                        row.cells[3].textContent = reservationType;
                        row.cells[4].textContent = formatDate(checkInDate);
                        row.cells[5].textContent = formatDate(checkOutDate);
                        row.cells[6].textContent = guestCount;
                        row.cells[7].querySelector('#comentarios').textContent = comments;
                        row.cells[8].textContent = `${total}$`;
                        row.cells[9].querySelector('.status-badge').textContent = status;
                    }
                } else {
                    // Add new row to the table
                    const table = document.querySelector('.reservations-table tbody');
                    const newRow = table.insertRow();
                    newRow.innerHTML = `
                        <td>${clientName}</td>
                        <td>${property}</td>
                        <td>${phone}</td>
                        <td>${reservationType}</td>
                        <td>${formatDate(checkInDate)}</td>
                        <td>${formatDate(checkOutDate)}</td>
                        <td>${guestCount}</td>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                            <div style="display: none;" id="comentarios">${comments}</div>
                        </td>
                        <td>${total}$</td>
                        <td><span class="status-badge ${status.toLowerCase()}">${status}</span></td>
                        <td class="status-actions">
                            ${status === 'Pending' ? `
                            <div class="status-buttons">
                                <button class="btn-accept" data-id="${data.id}">Accept</button>
                                <button class="btn-deny" data-id="${data.id}">Deny</button>
                            </div>` : ''}
                        </td>
                        <td class="actions">
                            <button class="btn-edit" data-id="${data.id}">Edit</button>
                            <button class="btn-cancel" data-id="${data.id}">Cancel</button>
                        </td>
                    `;
                }

                // Close the modal
                closeModal();

                // Show success message
                alert('Reservación guardada correctamente!');
            } else {
                console.error('Error updating reservation:', data.message);
                alert('Error actualizando la reservación: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al actualizar la reservación. Por favor, revise la consola para obtener más detalles.');
        });
    
});
     function formatDate(dateString) {
        const date = new Date(dateString);
        return `${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getDate().toString().padStart(2, '0')}/${date.getFullYear()}`;
    }

    // Function to format date for input (YYYY-MM-DD)
    function formatDateForInput(dateString) {
        const parts = dateString.split('/');
        return `${parts[2]}-${parts[0].padStart(2, '0')}-${parts[1].padStart(2, '0')}`;
    }

// Edit button functionality
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const reservationId = this.getAttribute('data-id');
            const row = this.closest('tr');

            // Get data from row
            const clientName = row.cells[0].textContent.trim();
            const property = row.cells[1].textContent.trim();
            const phone = row.cells[2].textContent.trim();
            const reservationType = row.cells[3].textContent.trim();
            const checkInDate = row.cells[4].textContent.trim();
            const checkOutDate = row.cells[5].textContent.trim();
            const guestCount = row.cells[6].textContent.trim();
            const comments = row.querySelector('#comentarios').textContent.trim();
            const total = row.cells[8].textContent.trim().replace('$', '');
            const status = row.querySelector('.status-badge').textContent.trim();

            // Populate the form
            document.getElementById('reservationId').value = reservationId;
            document.getElementById('clientName').value = clientName;
            document.getElementById('property').value = property;
            document.getElementById('phone').value = phone;
            document.getElementById('reservationType').value = reservationType;
            document.getElementById('checkInDate').value = formatDateForInput(checkInDate);
            document.getElementById('checkOutDate').value = formatDateForInput(checkOutDate);
            document.getElementById('guestCount').value = guestCount;
            document.getElementById('comments').value = comments;
            document.getElementById('total').value = total;
            document.getElementById('status').value = status;

            // Set modal title to "Edit Reservation"
            modalTitle.textContent = 'Edit Reservation';

            // Show the modal
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    });
// Accept/Deny buttons functionality
document.querySelectorAll('.btn-accept').forEach(button => {
    button.addEventListener('click', function() {
        const reservationId = this.getAttribute('data-id');
        updateReservationStatus(reservationId, 'Confirmed');
    });
});

document.querySelectorAll('.btn-deny').forEach(button => {
    button.addEventListener('click', function() {
        const reservationId = this.getAttribute('data-id');
        updateReservationStatus(reservationId, 'Denied');
    });
});

// Cancel reservation button functionality
// Cancel reservation button functionality
document.querySelectorAll('.btn-cancel').forEach(button => {
    button.addEventListener('click', function() {
        if (confirm('¿Seguro que desea cancelar esta reservación?')) {
            const reservationId = this.getAttribute('data-id');
            
            // For debugging purposes, let's log what we're sending
            console.log('Cancelando reservación:', reservationId);
            
            // Updated path to match the correct location
            fetch('./php/delete_reservation.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${reservationId}`
            })
            .then(response => {
                if (!response.ok) {
                    console.error('El servidor devolvió el estado:', response.status);
                    throw new Error('La respuesta de la red no está bien');
                }
                return response.text();
            })
            .then(text => {
                console.log("Lista de respuestas:", text);
                try {
                    // Try to parse as JSON
                    return JSON.parse(text);
                } catch (e) {
                    console.error('Respuesta JSON inválida:', text);
                    throw new Error('JSON inválido del servidor');
                }
            })
            .then(data => {
                if (data.success) {
                    const row = this.closest('tr');
                    row.remove();
                    alert('¡Reservación cancelada correctamente!');
                } else {
                    console.error('Error actualizando la cancelación:', data.message);
                    alert('Error al cancelar la reservación: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cancelar la reservación. Por favor, revise la consola para obtener más detalles.');
            });
        }
    });
});

// Function to update reservation status
function updateReservationStatus(reservationId, status) {
    fetch(`./php/update_reservation_status.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${reservationId}&status=${status}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const row = document.querySelector(`button[data-id="${reservationId}"]`).closest('tr');
            const statusBadge = row.querySelector('.status-badge');
            statusBadge.className = `status-badge ${status.toLowerCase()}`;
            statusBadge.textContent = status;
            
            // Remove the accept/deny buttons if they exist
            const actionCell = row.querySelector('.status-actions');
            if (actionCell && actionCell.querySelector('.status-buttons')) {
                actionCell.querySelector('.status-buttons').remove();
            }
            
            alert(`Reservation ${status.toLowerCase()} successfully!`);
        } else {
            console.error('Error actualizando el status de la reservación:', data.message);
            alert('Error actualizando la resrvación: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error actualizando la reservación. Por favor, revise la consola para obtener más detalles.');
    });
}
    // // Fix for the cancel reservation functionality
    //     document.querySelectorAll('.btn-cancel').forEach(button => {
    //         button.addEventListener('click', function() {
    //             if (confirm('Are you sure you want to cancel this reservation?')) {
    //                 const reservationId = this.getAttribute('data-id');
                    
    //                 // For debugging purposes, let's log what we're sending
    //                 console.log('Canceling reservation:', reservationId);
                    
    //                 // Updated path to match the correct location
    //                 fetch('./php/update_reservation_status.php', {
    //                     method: 'POST',
    //                     headers: {
    //                         'Content-Type': 'application/x-www-form-urlencoded',
    //                     },
    //                     body: `id=${reservationId}&status=Cancelado`
    //                 })
    //                 .then(response => {
    //                     if (!response.ok) {
    //                         console.error('Server returned status:', response.status);
    //                         throw new Error('Network response was not ok');
    //                     }
    //                     return response.text();
    //                 })
    //                 .then(text => {
    //                     console.log("Raw response:", text);
    //                     try {
    //                         // Try to parse as JSON
    //                         return JSON.parse(text);
    //                     } catch (e) {
    //                         console.error('Invalid JSON response:', text);
    //                         throw new Error('Invalid JSON response from server');
    //                     }
    //                 })
    //                 .then(data => {
    //                     if (data.success) {
    //                         const row = this.closest('tr');
    //                         const statusBadge = row.querySelector('.status-badge');
    //                         statusBadge.className = 'status-badge cancelado';
    //                         statusBadge.textContent = 'Cancelado';
                            
    //                         // Remove the accept/deny buttons if they exist
    //                         const actionCell = row.querySelector('.status-actions');
    //                         if (actionCell && actionCell.querySelector('.status-buttons')) {
    //                             actionCell.querySelector('.status-buttons').remove();
    //                         }
                            
    //                         alert('Reservation cancelled successfully!');
    //                     } else {
    //                         console.error('Error updating reservation status:', data.message);
    //                         alert('Error cancelando la reservaón ' + data.message);
    //                     }
    //                 })
    //                 .catch(error => {
    //                     console.error('Error:', error);
    //                     alert('ERROR cancelando la reservación. Por favor, revise la consola para obtener más detalles.');
    //                 });
    //             }
    //         });
    //     });
    // Function to handle edit button click
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('reservationModal');
            const row = this.closest('tr');
            
            const clientName = row.cells[0].textContent.trim();
            const property = row.cells[1].textContent.trim();
            const telephone = row.cells[2].textContent.trim();
            const type = row.cells[3].textContent.trim();
            
            const dateText = row.cells[4].textContent.trim();
            const dateParts = dateText.split('/');
            const formattedDate = `${dateParts[2]}-${dateParts[0].padStart(2, '0')}-${dateParts[1].padStart(2, '0')}`;
            
            // Get total payment
            const total = row.cells[5].textContent.trim().replace('$', '');
            
            // Get status
            const status = row.querySelector('.status-badge').textContent.trim();
            
            // Set form title to "Edit Reservation"
            document.querySelector('.modal-header h3').textContent = 'Edit Reservation';
            
            // Populate the form
            document.getElementById('reservationId').value = this.getAttribute('data-id');
            document.getElementById('clientName').value = clientName;
            document.getElementById('property').value = property;
            document.getElementById('reservationType').value = type;
            document.getElementById('reservationDate').value = formattedDate;
            document.getElementById('status').value = status;
            
            // Display the modal
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Modal elements for comments
    const commentModal = document.getElementById('commentModal');
    const closeCommentModalBtn = document.querySelector('.close-comment-modal');
    const commentClientName = document.getElementById('commentClientName');
    const commentText = document.getElementById('commentText');
    const comentarios = document.getElementById('comentarios');

    // Function to open comment modal
    function openCommentModal(clientName, comment) {
        commentClientName.textContent = clientName;
        commentText.textContent = comment;
        commentModal.style.display = 'block';
        comentarios.style.display = 'block';
        document.body.style.overflow = 'hidden'; 
    }

    // Close comment modal with X button
    closeCommentModalBtn.addEventListener('click', function () {
        comentarios.style.display = 'none';
        closeCommentModal();
    });

    // Close comment modal if clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === commentModal) {
            comentarios.style.display = 'none';
            closeCommentModal();
        }
    });

    // Function to close comment modal
    function closeCommentModal() {
        commentModal.style.display = 'none';
        comentarios.style.display = 'none';
        document.body.style.overflow = '';
    }

    // Add event listeners to comment icons
    document.querySelectorAll('.icon-tabler-eye').forEach(icon => {
        icon.addEventListener('click', function() {
            const row = this.closest('tr');
            const clientName = row.cells[0].textContent.trim();
            const comment = row.cells[7].textContent.trim();
            openCommentModal(clientName, comment);
        });
    });
});

// excel export reservaciones tabla
document.addEventListener('DOMContentLoaded', function () {
    // Add the download button listener
    const downloadBtn = document.getElementById('downloadContactReport');
    
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function () {
            exportReservationsToExcel();
        });
    }
    
    function exportReservationsToExcel() {
        // Get the reservations table element
        const table = document.querySelector('.reservations-table table');
        
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
                // For comments column (index 7)
                if (index === 7 && cell.querySelector('#comentarios')) {
                    rowData.push(cell.querySelector('#comentarios').textContent.trim());
                    return;
                }
                
                // For status column (index 9), just get the text without the styling
                if (index === 9 && cell.querySelector('.status-badge')) {
                    rowData.push(cell.querySelector('.status-badge').textContent.trim());
                    return;
                }
                
                // Skip action buttons columns (last two columns)
                if (index === 10 || index === 11) {
                    rowData.push(''); // Empty content for action columns
                    return;
                }
                
                // For all other cells, get the text content
                // Remove any $ sign from the total column
                if (index === 8) {
                    rowData.push(cell.textContent.trim().replace('$', ''));
                } else {
                    rowData.push(cell.textContent.trim());
                }
            });
            
            dataRows.push(rowData);
        });
        
        // Create worksheet from the extracted data
        const ws = XLSX.utils.aoa_to_sheet([headers, ...dataRows]);
        
        // Set column widths (in characters) - adjusted for more space
        const columnWidths = [
            { wch: 25 },  // Cliente
            { wch: 30 },  // Propiedad
            { wch: 15 },  // Telefono
            { wch: 15 },  // Tipo
            { wch: 15 },  // Fecha entrada
            { wch: 15 },  // Fecha Salida
            { wch: 15 },  // Num. Huespedes
            { wch: 50 },  // Comentarios - extra wide for comments
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
                fill: { fgColor: { rgb: "EEEEEE" } },
                alignment: { horizontal: 'center' }
            };
        }
        
        // Format date columns (4 and 5) - Excel date format
        for (let R = 1; R <= range.e.r; ++R) {
            for (let C = 4; C <= 5; ++C) {
                const address = XLSX.utils.encode_cell({ r: R, c: C });
                if (!ws[address] || !ws[address].v) continue;
                
                // Format date cells
                ws[address].z = 'mm/dd/yyyy';
            }
        }
        
        // Add worksheet to workbook
        XLSX.utils.book_append_sheet(wb, ws, "Reservaciones");
        
        // Generate Excel file and trigger download
        XLSX.writeFile(wb, "reporte_reservaciones.xlsx");
    }
}); 


// paginacion

document.addEventListener('DOMContentLoaded', function() {
    const rowsPerPage = 15;
    const rows = document.querySelectorAll('.reservaciones-table tbody tr');
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