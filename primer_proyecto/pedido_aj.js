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

// Variables para el carrito
let totalCarrito = 0;
const carrito = [];

// Mostrar detalles del producto en el cuadro derecho y confirmar el producto
function mostrarDetalles(nombre, precio) {
    // Establecer el nombre y precio del producto
    document.getElementById('nombreProducto').innerText = nombre;
    document.getElementById('precioProducto').innerText = `Precio: $${precio} MXN`;

    // Agregar producto al carrito automáticamente
    confirmarProducto(nombre, precio);

    // Mostrar el cuadro de detalles
    document.getElementById('detalleProducto').style.display = 'block';
}

function confirmarProducto(nombre, precio) {
    const carritoList = document.getElementById('carritoList');

    // Asegúrate de que el precio es un número
    const producto = {
        nombre: nombre,
        precio: Number(precio) // Convierte a número
    };

    // Crear un elemento de lista para el carrito
    const itemCarrito = document.createElement('div');
    itemCarrito.innerHTML = `
        ${producto.nombre} - $${producto.precio.toFixed(2)} 
        <button onclick="eliminarProducto(this)">x</button>
    `;
    carritoList.appendChild(itemCarrito);
    
    // Actualiza el total
    actualizarCarrito();
}

function actualizarCarrito() {
    const items = document.querySelectorAll('#carritoList div');
    let total = 0;

    items.forEach(item => {
        const precioTexto = item.innerText.match(/\$([0-9,.]+)/); // Extrae el precio
        if (precioTexto) {
            const precio = parseFloat(precioTexto[1].replace(',', ''));
            total += precio; // Suma al total
        }
    });

    document.getElementById('totalProducto').innerText = `Total: $${total.toFixed(2)} MXN`;
}

function cancelarProducto() {
    // Limpia la lista del carrito
    const carritoList = document.getElementById('carritoList');
    carritoList.innerHTML = ''; // Elimina todos los elementos del carrito

    // Actualiza el total a cero
    document.getElementById('totalProducto').innerText = 'Total: $0.00 MXN';
	document.getElementById('detalleProducto').style.display = 'none';

}

function eliminarProducto(button) {
    const itemCarrito = button.parentElement; // Obtener el elemento padre (div)
    itemCarrito.remove(); // Eliminar el producto del carrito
    actualizarCarrito(); // Actualizar el total
}


function finalizarPedido() {
    const carritoItems = document.querySelectorAll('#carritoList div');
    const productos = [];

    carritoItems.forEach(item => {
        const nombre = item.innerText.split(' - $')[0];
        const precioTexto = item.innerText.match(/\$([0-9,.]+)/);
        const precio = precioTexto ? parseFloat(precioTexto[1].replace(',', '')) : 0;

        productos.push({ nombre, precio, cantidad: 1 }); // Cambia cantidad si es necesario
    });

    // Enviar datos al servidor
    fetch('guardar_compra.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ productos })
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Mensaje de confirmación
        cancelarProducto(); // Limpiar carrito
    })
    .catch(error => {
        console.error('Error al guardar la compra:', error);
    });
}


// Ocultar cuadro de detalles
function cerrarDetalle() {
    document.getElementById('detalleProducto').style.display = 'none';
}
