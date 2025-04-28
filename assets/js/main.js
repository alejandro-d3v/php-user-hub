document.addEventListener('DOMContentLoaded', function() {
    // Funciones para manejar modales
    function openModal(modalId) {
        document.getElementById(modalId).style.display = 'block';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Cerrar modales cuando se hace clic fuera de ellos
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    }

    // Crear usuario
    document.getElementById('createUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('actions/create_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal('createModal');
                location.reload();
            } else {
                alert('Error al crear usuario: ' + data.error);
            }
        });
    });

    // Editar usuario
    document.querySelectorAll('.edit-user').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.id;
            const nombre = this.dataset.nombre;
            const email = this.dataset.email;

            document.getElementById('editId').value = userId;
            document.getElementById('editNombre').value = nombre;
            document.getElementById('editEmail').value = email;
            openModal('editModal');
        });
    });

    document.getElementById('editUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('actions/update_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal('editModal');
                location.reload();
            } else {
                alert('Error al actualizar usuario: ' + data.error);
            }
        });
    });

    // Eliminar usuario
    document.querySelectorAll('.delete-user').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.id;
            if (confirm('¿Está seguro de que desea eliminar este usuario?')) {
                const formData = new FormData();
                formData.append('id', userId);

                fetch('actions/delete_user.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al eliminar usuario: ' + data.error);
                    }
                });
            }
        });
    });

    // Botones para cerrar modales
    document.querySelectorAll('.close').forEach(button => {
        button.addEventListener('click', function() {
            const modalId = this.closest('.modal').id;
            closeModal(modalId);
        });
    });

    // Botón para abrir modal de crear usuario
    document.getElementById('openCreateModal').addEventListener('click', function() {
        openModal('createModal');
    });
});