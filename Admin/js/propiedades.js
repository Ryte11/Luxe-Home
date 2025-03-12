  // Open Add Property Modal
        document.getElementById('openAddModal').addEventListener('click', function() {
            document.getElementById('addPropertyModal').style.display = 'block';
        });

        // Open Edit Property Modal
        function openEditModal(id, nombre, descripcion, imagen, categoria, habitaciones, banos, precio, operacion, ubicacion) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_descripcion').value = descripcion;
            document.getElementById('current_image').value = imagen;
            document.getElementById('current_image_preview').src = imagen;
            document.getElementById('edit_categoria').value = categoria;
            document.getElementById('edit_habitaciones').value = habitaciones;
            document.getElementById('edit_banos').value = banos;
            document.getElementById('edit_precio').value = precio;
            document.getElementById('edit_operacion').value = operacion;
            document.getElementById('edit_ubicacion').value = ubicacion || '';
            
            document.getElementById('editPropertyModal').style.display = 'block';
        }

        // Open Delete Confirmation Modal
        function confirmDelete(id) {
            document.getElementById('delete_id').value = id;
            document.getElementById('deleteConfirmModal').style.display = 'block';
        }

        // Close Modals
        var closeButtons = document.getElementsByClassName('close-modal');
        for (var i = 0; i < closeButtons.length; i++) {
            closeButtons[i].addEventListener('click', function() {
                this.closest('.modal').style.display = 'none';
            });
        }

        var closeModalButtons = document.getElementsByClassName('close-modal-btn');
        for (var i = 0; i < closeModalButtons.length; i++) {
            closeModalButtons[i].addEventListener('click', function() {
                this.closest('.modal').style.display = 'none';
            });
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            var modals = document.getElementsByClassName('modal');
            for (var i = 0; i < modals.length; i++) {
                if (event.target == modals[i]) {
                    modals[i].style.display = 'none';
                }
            }
        });