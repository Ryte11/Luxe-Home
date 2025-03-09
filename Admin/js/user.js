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
                    // Close the modal
                    closeAllModals();
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
        const password = form.querySelector('[name="userPassword"]') || form.querySelector('[name="editUserPassword"]');
        const role = form.querySelector('[name="userRole"]') || form.querySelector('[name="editUserRole"]');

        if (name && name.value.trim() === '') {
            isValid = false;
            name.nextElementSibling.textContent = 'Name is required';
        } else {
            name.nextElementSibling.textContent = '';
        }

        if (email && email.value.trim() === '') {
            isValid = false;
            email.nextElementSibling.textContent = 'Email is required';
        } else {
            email.nextElementSibling.textContent = '';
        }

        if (password && password.value.trim() === '') {
            isValid = false;
            password.nextElementSibling.textContent = 'Password is required';
        } else {
            password.nextElementSibling.textContent = '';
        }

        if (role && role.value.trim() === '') {
            isValid = false;
            role.nextElementSibling.textContent = 'Role is required';
        } else {
            role.nextElementSibling.textContent = '';
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

    function filterUsersByRole(role) {
        const rows = document.querySelectorAll('.users-table tbody tr');
        rows.forEach(row => {
            if (role === 'all' || row.getAttribute('data-role') === role) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
});