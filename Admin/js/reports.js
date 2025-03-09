// reports.js - JavaScript for Reports functionality

document.addEventListener('DOMContentLoaded', function() {
    // References to DOM elements
    const downloadBtn = document.getElementById('downloadBtn');
    const dateRange = document.getElementById('dateRange');
    
    // Add event listener to download button
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function() {
            downloadExcelReport();
        });
    }
    
    // Add event listener to date range selector
    if (dateRange) {
        dateRange.addEventListener('change', function() {
            updateReportData(this.value);
        });
    }
    
    // Initialize pagination buttons
    initPagination();
});

/**
 * Function to handle Excel report download
 */
function downloadExcelReport() {
    // In a real implementation, this would make an AJAX request to a PHP endpoint
    // that generates and returns an Excel file
    
    console.log('Downloading Excel report...');
    
    // Example of how this would work with a real backend
    // Create a form to submit to the server
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'generate_excel.php';
    
    // Add any needed parameters
    const dateRangeInput = document.createElement('input');
    dateRangeInput.type = 'hidden';
    dateRangeInput.name = 'dateRange';
    dateRangeInput.value = document.getElementById('dateRange').value;
    form.appendChild(dateRangeInput);
    
    // Submit the form to trigger the download
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}

/**
 * Function to update report data based on selected date range
 */
function updateReportData(days) {
    console.log(`Updating report data for last ${days} days...`);
    
    // In a real implementation, this would make an AJAX request to fetch new data
    // Example:
    fetch(`get_report_data.php?days=${days}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Update the table with the new data
        updateTableWithData(data);
        // Update summary stats
        updateSummaryStats(data.summary);
    })
    .catch(error => {
        console.error('Error fetching report data:', error);
    });
}

/**
 * Function to update the table with new data
 * This is a placeholder - in a real implementation, you would replace the table content
 */
function updateTableWithData(data) {
    // This is a placeholder function
    // In a real implementation, you would clear the table and add new rows
    console.log('Table data would be updated with:', data);
}

/**
 * Function to update summary statistics
 * This is a placeholder - in a real implementation, you would update the stat cards
 */
function updateSummaryStats(summary) {
    // This is a placeholder function
    // In a real implementation, you would update the summary statistics
    console.log('Summary stats would be updated with:', summary);
}

/**
 * Initialize pagination functionality
 */
function initPagination() {
    const pageNumbers = document.querySelectorAll('.page-number');
    const prevBtn = document.querySelector('.pagination-btn.prev');
    const nextBtn = document.querySelector('.pagination-btn.next');
    
    // Current page
    let currentPage = 1;
    
    // Add click event to page numbers
    pageNumbers.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            pageNumbers.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            // Get the page number
            currentPage = parseInt(this.textContent);
            
            // Fetch and display data for the selected page
            fetchPageData(currentPage);
        });
    });
    
    // Add click event to previous button
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                // Update active button
                pageNumbers.forEach(btn => {
                    if (parseInt(btn.textContent) === currentPage) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
                
                // Fetch and display data for the selected page
                fetchPageData(currentPage);
            }
        });
    }
    
    // Add click event to next button
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            const maxPage = pageNumbers.length;
            if (currentPage < maxPage) {
                currentPage++;
                // Update active button
                pageNumbers.forEach(btn => {
                    if (parseInt(btn.textContent) === currentPage) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
                
                // Fetch and display data for the selected page
                fetchPageData(currentPage);
            }
        });
    }
}

/**
 * Fetch data for a specific page
 * This is a placeholder - in a real implementation, you would make an AJAX request
 */
function fetchPageData(page) {
    console.log(`Fetching data for page ${page}...`);
    
    // In a real implementation, this would make an AJAX request
    // Example:
    fetch(`get_report_data.php?page=${page}&days=${document.getElementById('dateRange').value}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Update the table with the new data
        updateTableWithData(data);
    })
    .catch(error => {
        console.error('Error fetching page data:', error);
    });
}