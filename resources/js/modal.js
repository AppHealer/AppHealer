const confirmationModal = document.getElementById('confirmationModal')
if (confirmationModal) {
    confirmationModal.addEventListener('show.bs.modal', event => {
        document.getElementById('confirmationModalBody').innerHTML = event.explicitOriginalTarget.getAttribute('data-modal-text')
        if (event.explicitOriginalTarget.getAttribute('data-confirm-text')) {
            document.getElementById('dialogConfirm').innerHTML = event.explicitOriginalTarget.getAttribute('data-confirm-text');
        }
        document.getElementById('dialogConfirm').setAttribute(
            'href',
            event.explicitOriginalTarget.getAttribute('href')
        );
    })
}