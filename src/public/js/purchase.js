document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('payment-method-select');
    const view = document.getElementById('payment-method-view');

    select.addEventListener('change', function() {
        view.textContent = select.value;
    });
});