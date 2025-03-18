document.addEventListener('DOMContentLoaded', function () {
    // Modal elements
    const addUserModal = document.getElementById('addUserModal');
    const editUserModal = document.getElementById('editUserModal');
    const deleteUserModal = document.getElementById('deleteUserModal');
    
    const addUserBtn = document.getElementById('addUserBtn');
    const editButtons = document.querySelectorAll('.btn-edit');
    const deleteButtons = document.querySelectorAll('.btn-delete');
    
    const closeButtons = document.querySelectorAll('.close');
    const cancelButtons = document.querySelectorAll('.close-modal');
    
    const addUserForm = document.getElementById('addUserForm');
    const editUserForm = document.getElementById('editUserForm');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    
    const roleFilter = document.getElementById('roleFilter');
    
    let currentUserId = null;
    
    // Open modals
    addUserBtn.addEventListener('click', function () {
        openModal(addUserModal);
    });
    
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            openEditModal(userId);
        });
    });
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            openDeleteModal(userId);
        });
    });
    
    // Close modals with X button
    closeButtons.forEach(button => {
        button.addEventListener('click', function () {
            closeAllModals();
        });
    });
    
    // Close modals with Cancel button
    cancelButtons.forEach(button => {
        button.addEventListener('click', function () {
            closeAllModals();
        });
    });
    
    // Close modal if clicking outside
    window.addEventListener('click', function (event) {
        if (event.target === addUserModal ||
            event.target === editUserModal ||
            event.target === deleteUserModal) {
            closeAllModals();
        }
    });
        
    // Role filtering
    roleFilter.addEventListener('change', function () {
        filterUsersByRole(this.value);
    });
    
    // Updated filtering function
    function filterUsersByRole(role) {
        const rows = document.querySelectorAll('.users-table tbody tr');
        
        rows.forEach(row => {
            // Get the role directly from the badge element
            const roleBadge = row.querySelector('.role-badge');
            const rowRole = roleBadge ? roleBadge.classList[1] : ''; // The second class should be the role
            
            if (role === 'all' || rowRole === role) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    // Form submissions
    addUserForm.addEventListener('submit', function (event) {
        event.preventDefault();
        if (validateForm(this)) {
            const name = document.getElementById('userName').value;
            const email = document.getElementById('userEmail').value;
            const password = document.getElementById('userPassword').value;
            const role = document.getElementById('userRole').value;
            const phone = document.getElementById('userPhone').value;

            // Send data to the backend
            const dataToSend = { name, email, password, role, phone };
            console.log("Enviando datos:", dataToSend);
            fetch('php/add_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name, email, password, role, phone })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add user to the table (for demonstration)
                    addUserToTable(name, email, role);
                    // Close the modal and reset form
                    closeAllModals();
                    this.reset();
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
    
    editUserForm.addEventListener('submit', function (event) {
        event.preventDefault();
        if (validateForm(this)) {
            // Get form values
            const userId = document.getElementById('editUserId').value;
            const name = document.getElementById('editUserName').value;
            const email = document.getElementById('editUserEmail').value;
            const role = document.getElementById('editUserRole').value;
            const phone = document.getElementById('editUserPhone').value;

            // Send data to the backend
            fetch('php/edit_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ userId, name, email, role, phone })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update user in the table (for demonstration)
                    updateUserInTable(userId, name, email, role);
                    // Close the modal
                    closeAllModals();
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
    
    confirmDeleteBtn.addEventListener('click', function () {
        if (currentUserId) {
            // Send delete request to the backend
            fetch('php/delete_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ userId: currentUserId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove user from the table (for demonstration)
                    deleteUserFromTable(currentUserId);
                    closeAllModals();
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
    
    // Helper functions
    function openModal(modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
    
    function closeAllModals() {
        addUserModal.style.display = 'none';
        editUserModal.style.display = 'none';
        deleteUserModal.style.display = 'none';
        document.body.style.overflow = ''; // Restore scrolling
        
        // Reset forms and error messages
        resetForm(addUserForm);
        resetForm(editUserForm);
    }
    
    function openEditModal(userId) {
        currentUserId = userId;
        fetch(`php/get_user.php?id=${userId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const user = data.user;
                    // Populate form fields
                    document.getElementById('editUserId').value = user.id;
                    document.getElementById('editUserName').value = user.nombre;
                    document.getElementById('editUserEmail').value = user.email;
                    document.getElementById('editUserRole').value = user.rol;
                    document.getElementById('editUserPhone').value = user.telefono || '';
                    
                    openModal(editUserModal);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }
    
    function openDeleteModal(userId) {
        currentUserId = userId;
        fetch(`php/get_user.php?id=${userId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const user = data.user;
                    document.getElementById('deleteUserName').textContent = user.nombre;
                    openModal(deleteUserModal);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function validateForm(form) {
        let isValid = true;

        const name = form.querySelector('[name="userName"]') || form.querySelector('[name="editUserName"]');
        const email = form.querySelector('[name="userEmail"]') || form.querySelector('[name="editUserEmail"]');
        const password = form.querySelector('[name="userPassword"]'); // Solo buscará en el formulario de agregar
        const role = form.querySelector('[name="userRole"]') || form.querySelector('[name="editUserRole"]');

        console.log("Validando formulario...");
        console.log("Nombre:", name?.value);
        console.log("Email:", email?.value);
        console.log("Password:", password?.value);
        console.log("Rol:", role?.value);

        if (name && name.value.trim() === '') {
            isValid = false;
            name.nextElementSibling.textContent = 'El nombre es obligatorio';
        } else {
            name?.nextElementSibling && (name.nextElementSibling.textContent = '');
        }

        if (email && email.value.trim() === '') {
            isValid = false;
            email.nextElementSibling.textContent = 'El email es obligatorio';
        } else {
            email?.nextElementSibling && (email.nextElementSibling.textContent = '');
        }

        if (password && password.value.trim() === '') {
            isValid = false;
            password.nextElementSibling.textContent = 'La contraseña es obligatoria';
        } else if (password) {
            password.nextElementSibling.textContent = '';
        }

        if (role && role.value.trim() === '') {
            isValid = false;
            role.nextElementSibling.textContent = 'El rol es obligatorio';
        } else {
            role?.nextElementSibling && (role.nextElementSibling.textContent = '');

        }

            return isValid;
    }


    function resetForm(form) {
        form.reset();
        const errorMessages = form.querySelectorAll('.error-message');
        errorMessages.forEach(error => error.textContent = '');
    }

    function addUserToTable(name, email, role) {
        const tableBody = document.querySelector('.users-table tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${name}</td>
            <td>${email}</td>
            <td><span class="role-badge ${role}">${role.charAt(0).toUpperCase() + role.slice(1)}</span></td>
            <td class="actions">
                <button class="btn-edit" data-id="${Date.now()}">Edit</button>
                <button class="btn-delete" data-id="${Date.now()}">Delete</button>
            </td>
        `;
        tableBody.appendChild(newRow);
    }

    function updateUserInTable(userId, name, email, role) {
        const row = document.querySelector(`tr[data-id="${userId}"]`);
        if (row) {
            row.querySelector('td:nth-child(1)').textContent = name;
            row.querySelector('td:nth-child(2)').textContent = email;
            row.querySelector('td:nth-child(3) .role-badge').textContent = role.charAt(0).toUpperCase() + role.slice(1);
            row.querySelector('td:nth-child(3) .role-badge').className = `role-badge ${role}`;
        }
    }

    function deleteUserFromTable(userId) {
        const row = document.querySelector(`tr[data-id="${userId}"]`);
        if (row) {
            row.remove();
        }
    }

    




    // buscador js

    
});

// Add this code to your existing user.js file or create a new function
document.addEventListener('DOMContentLoaded', function () {
    // Get the existing elements
    const cardHeader = document.querySelector('.card-header');
    const cardTitle = document.querySelector('.card-title');
    
    // Create search input
    const searchContainer = document.createElement('div');
    searchContainer.className = 'search-container';
    
    const searchInput = document.createElement('input');
    searchInput.type = 'text';
    searchInput.id = 'userSearch';
    searchInput.className = 'user-search';
    searchInput.placeholder = 'Search users...';
    
    const searchIcon = document.createElement('span');
    searchIcon.className = 'search-icon';
    searchIcon.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
    `;
    
    // Add the search elements to the container
    searchContainer.appendChild(searchIcon);
    searchContainer.appendChild(searchInput);
    
    // Insert search container after the card title
    cardTitle.parentNode.insertBefore(searchContainer, cardTitle.nextSibling);
    
    // Add the search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('.users-table tbody tr');
        
        rows.forEach(row => {
            // Get all text content from the row (name, email, role)
            const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const role = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            
            // Check if any column contains the search term
            const matchFound = 
                name.includes(searchTerm) || 
                email.includes(searchTerm) || 
                role.includes(searchTerm);
                
            row.style.display = matchFound ? '' : 'none';
        });
    });
    
    
});


// paginacion

document.addEventListener('DOMContentLoaded', function() {
    const rowsPerPage = 10;
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