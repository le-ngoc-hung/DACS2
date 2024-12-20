function showConfirmForm(jobId) {
    const overlay = document.getElementById('overlay');
    const confirmForm = document.getElementById('confirmDeleteForm');

    overlay.style.display = 'block';
    confirmForm.style.display = 'block';
    
    document.getElementById('jobId').value = jobId;
}

function hideConfirmForm() {
    const overlay = document.getElementById('overlay');
    const confirmForm = document.getElementById('confirmDeleteForm');

    overlay.style.display = 'none';
    confirmForm.style.display = 'none';
}