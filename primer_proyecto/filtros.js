// Filtro de categoría
document.getElementById('filtro-categoria').addEventListener('change', function() {
    const categoria = this.value;
    filtrarProductos(categoria);
});

// Buscador de productos
document.getElementById('buscador').addEventListener('input', function() {
    const query = this.value.toLowerCase();
    buscarProducto(query);
});

function filtrarProductos(categoria) {
    const items = document.querySelectorAll('.galeria .item');
    items.forEach(item => {
        item.style.display = 'block';
        if (categoria !== 'todos' && !item.classList.contains(categoria)) {
            item.style.display = 'none';
        }
    });
}

function buscarProducto(query) {
    const items = document.querySelectorAll('.galeria .item');
    items.forEach(item => {
        const nombreProducto = item.querySelector('h3').innerText.toLowerCase();
        item.style.display = nombreProducto.includes(query) ? 'block' : 'none';
    });
}
