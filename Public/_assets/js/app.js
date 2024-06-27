//función para el botón volver
function goBack() {
    window.history.back();
}

//función para visualizar la imagen
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('image-preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}

// input para buscar producto
function toggleSearchForm() {
    var searchForm = document.getElementById('searchForm');
    if (searchForm.style.display === 'none') {
        searchForm.style.display = 'block';
    } else {
        searchForm.style.display = 'none';
    }
}
