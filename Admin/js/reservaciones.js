// reservations.js

document.addEventListener('DOMContentLoaded', function() {
    // Modal elements
    const modal = document.getElementById('reservationModal');
    const openBtn = document.getElementById('openFormBtn');
    const closeBtn = document.querySelector('.close');
    const cancelBtn = document.getElementById('cancelBtn');
    const form = document.getElementById('reservationForm');
    
    // Open modal
    openBtn.addEventListener('click', function() {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    });
    
    // Close modal with X button
    closeBtn.addEventListener('click', function() {
        closeModal();
    });
    
    // Close modal with Cancel button
    cancelBtn.addEventListener('click', function() {
        closeModal();
    });
    
    // Close modal if clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });
    
    // Function to close modal
    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = ''; // Restore scrolling
        form.reset(); // Clear form fields
    }
    
    // Form submission
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Get form values
        const clientName = document.getElementById('clientName').value;
        const property = document.getElementById('property').value;
        const type = document.getElementById('reservationType').value;
        const date = document.getElementById('reservationDate').value;
        const notes = document.getElementById('notes').value;
        
        // Here you would normally send this data to your backend
        console.log('New reservation:', { clientName, property, type, date, notes });
        
        // Create a new row in the table (for demonstration)
        addNewReservation(clientName, property, type, formatDate(date));
        
        // Close the modal
        closeModal();
    });
    
    // Accept/Deny buttons functionality
    const acceptButtons = document.querySelectorAll('.btn-accept');
    const denyButtons = document.querySelectorAll('.btn-deny');
    
    acceptButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const statusCell = row.querySelector('.status-actions');
            
            // Replace status actions with confirmed badge
            statusCell.innerHTML = '<span class="status-badge confirmed">Confirmed</span>';
        });
    });
    
    denyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const statusCell = row.querySelector('.status-actions');
            
            // Replace status actions with denied badge
            statusCell.innerHTML = '<span class="status-badge denied">Denied</span>';
        });
    });
    
    // Function to format date from YYYY-MM-DD to MM/DD/YYYY
    function formatDate(dateString) {
        const date = new Date(dateString);
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        const year = date.getFullYear();
        
        return `${month}/${day}/${year}`;
    }
    
    // Function to add a new reservation row to the table
    function addNewReservation(client, property, type, date) {
        const tbody = document.querySelector('tbody');
        const newRow = document.createElement('tr');
        
        newRow.innerHTML = `
            <td>${client}</td>
            <td>${property}</td>
            <td>${type}</td>
            <td>${date}</td>
            <td class="status-actions">
                <span class="status-badge pending">Pending</span>
                <div class="status-buttons">
                    <button class="btn-accept">Accept</button>
                    <button class="btn-deny">Deny</button>
                </div>
            </td>
            <td class="actions">
                <button class="btn-edit">Edit</button>
                <button class="btn-cancel">Cancel</button>
            </td>
        `;
        
        tbody.prepend(newRow);
        
        // Add event listeners to new buttons
        const newAcceptBtn = newRow.querySelector('.btn-accept');
        const newDenyBtn = newRow.querySelector('.btn-deny');
        
        newAcceptBtn.addEventListener('click', function() {
            const statusCell = this.closest('.status-actions');
            statusCell.innerHTML = '<span class="status-badge confirmed">Confirmed</span>';
        });
        
        newDenyBtn.addEventListener('click', function() {
            const statusCell = this.closest('.status-actions');
            statusCell.innerHTML = '<span class="status-badge denied">Denied</span>';
        });
    }
});