<html>
<head>
    <title>Formulario de Encuesta</title>
    <link rel="stylesheet" href="pedido_complemento.css">
</head>
<body style="background-color:#C2996B; margin:0px; padding:0px;">
    <?php include("plantilla.phtml"); ?>
    <?php CabeceraPagina(); ?>
	<br><br><br>
	<hr style="margin-top:20px;" style="background-color:#C2996B">
	<div class="filtros" style="background-color:#C2996B">
        <select id="filtro-categoria" >
            <option value="todos">Todos</option>
            <option value="comidas">Comidas</option>
            <option value="postres">Postres</option>
            <option value="bebidas">Bebidas</option>
            <option value="productos-extra">Productos Extra</option>
        </select>
        <input type="text" id="buscador" placeholder="Buscar producto...">
    </div>
	<div class="galeria-contenedor" style="background-color:#C2996B">
		<div  class="galeria" id="galeria">
			<div class="item comidas">
				<img src="con1.jpg" alt="Producto 1">
				<h3>Enchiladas con Aguja Norteña</h3>
				<p>$75.00 MXN</p>
				<button class="ver-detalles"  onclick="mostrarDetalles('enchiladas con aguja norteña', '75.00')">Ordenar</button>
			</div>
			<div class="item comidas">
				<img src="con2.jpg" alt="Producto 2">
				<h3>Tostada de Aguacate con Huevo</h3>
				<p>$45.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('tostada de aguacate con huevo', '45.00')">Ordenar</button>
			</div>
			<div class="item comidas">
				<img src="con3.jpg" alt="Producto 3">
				<h3>Chilaquiles Divorciados</h3>
				<p>$70.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('chilaquiles divorciados', '70.00')">Ordenar</button>
			</div>
			<div class="item postres">
				<img src="pos1.jpg" alt="Producto 1">
				<h3>Ensalada de Fresa y Uvas</h3>
				<p>$70.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('ensalada de fresa y uvas', '70.00')">Ordenar</button>
			</div>
			<div class="item comidas">
				<img src="con5.jpg" alt="Producto 2">
				<h3>Enchiladas de Adobo+Aguja Norteña</h3>
				<p>$85.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('enchiladas de adobo+aguja norteña', '85.00')">Ordenar</button>
			</div>
			<div class="item comidas">
				<img src="con6.jpg" alt="Producto 3">
				<h3>Chilaqiles</h3>
				<p>$60.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('chilaquiles', '60.00')">Ordenar</button>
			</div>
			<div class="item comidas">
				<img src="con7.jpg" alt="Producto 1">
				<h3>Burritos</h3>
				<p>$75.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('burritos', '75.00')">Ordenar</button>
			</div>
			<div class="item comidas">
				<img src="con8.jpg" alt="Producto 2">
				<h3>Enchiladas</h3>
				<p>$85.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('enchiladas', '85.00')">Ordenar</button>
			</div>
			<div class="item comidas">
				<img src="con9.jpg" alt="Producto 3">
				<h3>Omelette de Bisteck y Espinaca</h3>
				<p>$95.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('omelette de bisteck y espinaca', '95.00')">Ordenar</button>
			</div>
			<div class="item comidas">
				<img src="con10.jpg" alt="Producto 1">
				<h3>Enchuladas con Pechuga Empanizada</h3>
				<p>$65.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('enchuladas con pechuga empanizada', '65.00')">Ordenar</button>
			</div>
			<div class="item postres">
				<img src="pos2.jpg" alt="Producto 2">
				<h3>Pan Frances</h3>
				<p>$45.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('pan frances', '45.00')">Ordenar</button>
			</div>
			<div class="item comidas">
				<img src="con12.jpg" alt="Producto 3">
				<h3>Sanwich de Pollo y Queso</h3>
				<p>$70.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('sanwich de pollo y queso', '70.00')">Ordenar</button>
			</div>
			<div class="item postres">
				<img src="pos3.jpg" alt="Producto 1">
				<h3>Waffles</h3>
				<p>$60.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('waffles', '60.00')">Ordenar</button>
			</div>
			<div class="item comidas">
				<img src="con14.jpg" alt="Producto 2">
				<h3>Sandwich de Pollo Hawaiano Picoso</h3>
				<p>$70.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('sandwich de pollo hawaiano picoso', '70.00')">Ordenar</button>
			</div>
			<div class="item comidas">
				<img src="con15.jpg" alt="Producto 3">
				<h3>Tacos Dorados con Guacamole</h3>
				<p>$65.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('tacos dorados con guacamole', '65.00')">Ordenar</button>
			</div>
			<div class="item comidas">
				<img src="con16.jpg" alt="Producto 3">
				<h3>Quesadilla de Bistec y Champiñones</h3>
				<p>$75.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('quesadilla de bistec y champiñones', '75.00')">Ordenar</button>
			</div>
			<div class="item postres">
				<img src="pos4.jpg" alt="Producto 3">
				<h3>Chocoflan</h3>
				<p>$75.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('chocoflan', '75.00')">Ordenar</button>
			</div>
			<div class="item postres">
				<img src="pos5.jpg" alt="Producto 3">
				<h3>Helados</h3>
				<p>$35.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('helado', '35.00')">Ordenar</button>
			</div>
			<div class="item postres">
				<img src="pos6.jpg" alt="Producto 3">
				<h3>Pay de Mora</h3>
				<p>$25.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('pay de mora', '25.00')">Ordenar</button>
			</div>
			<div class="item postres">
				<img src="pos7.jpg" alt="Producto 3">
				<h3>Pay de Mango</h3>
				<p>$30.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('pay de mango', '30.00')">Ordenar</button>
			</div>
			<div class="item postres">
				<img src="pos8.jpg" alt="Producto 3">
				<h3>Dangos</h3>
				<p>$45.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('dango', '45.00')">Ordenar</button>
			</div>
			<div class="item bebidas">
				<img src="ben1.jpg" alt="Producto 3">
				<h3>Jugos Naturales</h3>
				<p>$30.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('jugos naturales', '30.00')">Ordenar</button>
			</div>
			<div class="item bebidas">
				<img src="ben2.jpg" alt="Producto 3">
				<h3>Licuados</h3>
				<p>$35.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('licuados', '35.00')">Ordenar</button>
			</div>
			<div class="item bebidas">
				<img src="ben3.jpg" alt="Producto 3">
				<h3>Cafes Calientes</h3>
				<p>$30.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('cafes calientes', '30.00')">Ordenar</button>
			</div>
			<div class="item bebidas">
				<img src="ben4.jpg" alt="Producto 3">
				<h3>Cafes Frios</h3>
				<p>$35.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('cafes frios', '35.00')">Ordenar</button>
			</div>
			<div class="item bebidas">
				<img src="ben5.jpg" alt="Producto 3">
				<h3>Infuciones de Te</h3>
				<p>$30.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('infucion de te de limon', '30.00')">Ordenar</button>
			</div>
			<div class="item productos-extra">
				<img src="pro1.jpg" alt="Producto 3">
				<h3>Granos de Cafe</h3>
				<p>$40.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('granos de cafe', '40.00')">Ordenar</button>
			</div>
			<div class="item productos-extra">
				<img src="pro2.jpg" alt="Producto 3">
				<h3>Capsulas de Cafe</h3>
				<p>$30.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('capsulas de cafe', '30.00')">Ordenar</button>
			</div>
			<div class="item productos-extra">
				<img src="pro3.jpg" alt="Producto 3">
				<h3>Bolsas de Te</h3>
				<p>$20.00 MXN</p>
				<button class="ver-detalles" onclick="mostrarDetalles('bolsas de te', '20.00')">Ordenar</button>
			</div>
			<!-- Agrega más items según lo necesites -->
		</div>
		
		<div class="detalle-producto" id="detalleProducto" style="color: black;background: rgba(255, 255, 255, 0.3);border: 2px solid #C2996B;border-radius: 25px;outline: none;">
			
				<h3 id="nombreProducto"></h3>
				<p id="precioProducto"></p>
				
				<div id="carrito">
					<h2>Carrito de Compras</h2>
					<div id="carritoList"></div>
					<p id="totalProducto">Total: $0.00 MXN</p>
					<div class="ui-btn-container">
						<button class="ui-btn" onclick="finalizarPedido()"> <span>Confirmar</span></button>
						<button class="ui-btn" onclick="cancelarProducto()"> <span>Cancelar</span></button>
					</div>
				</div>
			
		</div>
	</div>
	<script src="pedido_aj.js"></script>

    <?php PiePagina(); ?>
</body>
</html>