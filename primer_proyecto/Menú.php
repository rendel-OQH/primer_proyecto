<html>
<head>
    <title>Formulario de Encuesta</title>
    <link rel="stylesheet" href="menu_complemento.css">
</head>
<body style="background-color:#C2996B; margin:0px; padding:0px;">
    <?php include("plantilla.phtml"); ?>
    <?php CabeceraPagina(); ?>
	<br><br><br>
	<hr style="margin-top:20px;">
	<div class="filtros">
        <select id="filtro-categoria">
            <option value="todos">Todos</option>
            <option value="comidas">Comidas</option>
            <option value="postres">Postres</option>
            <option value="bebidas">Bebidas</option>
            <option value="productos-extra">Productos Extra</option>
        </select>
        <input type="text" id="buscador" placeholder="Buscar producto...">
    </div>
	<div  class="galeria" id="galeria">
		<div class="item comidas">
			<img src="con1.jpg" alt="Producto 1">
			<h3></h3>
			<p>$75.00 MXN</p>
		</div>
		<div class="item comidas">
			<img src="con2.jpg" alt="Producto 2">
			<h3>Tostada de Aguacate con Huevo</h3>
			<p>$45.00 MXN</p>
		</div>
		<div class="item comidas">
			<img src="con3.jpg" alt="Producto 3">
			<h3>chilaquiles divorciados</h3>
			<p>$70.00 MXN</p>
		</div>
		<div class="item postres">
			<img src="pos1.jpg" alt="Producto 1">
			<h3>ensalada de fresa y uvas</h3>
			<p>$70.00 MXN</p>
		</div>
		<div class="item comidas">
			<img src="con5.jpg" alt="Producto 2">
			<h3>enchiladas de adobo+aguja norteña</h3>
			<p>$85.00 MXN</p>
		</div>
		<div class="item comidas">
			<img src="con6.jpg" alt="Producto 3">
			<h3>chilaqiles</h3>
			<p>$60.00 MXN</p>
		</div>
		<div class="item comidas">
			<img src="con7.jpg" alt="Producto 1">
			<h3>burritos</h3>
			<p>$75.00 MXN</p>
		</div>
		<div class="item comidas">
			<img src="con8.jpg" alt="Producto 2">
			<h3>enchiladas</h3>
			<p>$85.00 MXN</p>
		</div>
		<div class="item comidas">
			<img src="con9.jpg" alt="Producto 3">
			<h3>omelette de bisteck y espinaca</h3>
			<p>$95.00 MXN</p>
		</div>
		<div class="item comidas">
			<img src="con10.jpg" alt="Producto 1">
			<h3>enchuladas con pechuga empanizada</h3>
			<p>$65.00 MXN</p>
		</div>
		<div class="item postres">
			<img src="pos2.jpg" alt="Producto 2">
			<h3>Pan frances</h3>
			<p>$45.00 MXN</p>
		</div>
		<div class="item comidas">
			<img src="con12.jpg" alt="Producto 3">
			<h3>sanwich de pollo y queso</h3>
			<p>$70.00 MXN</p>
		</div>
		<div class="item postres">
			<img src="pos3.jpg" alt="Producto 1">
			<h3>waffles</h3>
			<p>$60.00 MXN</p>
		</div>
		<div class="item comidas">
			<img src="con14.jpg" alt="Producto 2">
			<h3>sandwich de pollo hawaiano picoso</h3>
			<p>$70.00 MXN</p>
		</div>
		<div class="item comidas">
			<img src="con15.jpg" alt="Producto 3">
			<h3>tacos dorados con guacamole</h3>
			<p>$65.00 MXN</p>
		</div>
		<div class="item comidas">
			<img src="con16.jpg" alt="Producto 3">
			<h3>quesadilla de bistec y champiñones</h3>
			<p>$75.00 MXN</p>
		</div>
		<div class="item postres">
			<img src="pos4.jpg" alt="Producto 3">
			<h3>chocoflan</h3>
			<p>$75.00 MXN</p>
		</div>
		<div class="item postres">
			<img src="pos5.jpg" alt="Producto 3">
			<h3>helados</h3>
			<p>$35.00 MXN</p>
		</div>
		<div class="item postres">
			<img src="pos6.jpg" alt="Producto 3">
			<h3>pay de mora</h3>
			<p>$25.00 MXN</p>
		</div>
		<div class="item postres">
			<img src="pos7.jpg" alt="Producto 3">
			<h3>pay de mango</h3>
			<p>$30.00 MXN</p>
		</div>
		<div class="item postres">
			<img src="pos8.jpg" alt="Producto 3">
			<h3>dangos</h3>
			<p>$45.00 MXN</p>
		</div>
		<div class="item bebidas">
			<img src="ben1.jpg" alt="Producto 3">
			<h3>jugos naturales</h3>
			<p>$30.00 MXN</p>
		</div>
		<div class="item bebidas">
			<img src="ben2.jpg" alt="Producto 3">
			<h3>licuados</h3>
			<p>$35.00 MXN</p>
		</div>
		<div class="item bebidas">
			<img src="ben3.jpg" alt="Producto 3">
			<h3>cafes calientes</h3>
			<p>$30.00 MXN</p>
		</div>
		<div class="item bebidas">
			<img src="ben4.jpg" alt="Producto 3">
			<h3>cafes frios</h3>
			<p>$35.00 MXN</p>
		</div>
		<div class="item bebidas">
			<img src="ben5.jpg" alt="Producto 3">
			<h3>infucion de te de limon</h3>
			<p>$30.00 MXN</p>
		</div>
		<div class="item productos-extra">
			<img src="pro1.jpg" alt="Producto 3">
			<h3>granos de cafe</h3>
			<p>$40.00 MXN</p>
		</div>
		<div class="item productos-extra">
			<img src="pro2.jpg" alt="Producto 3">
			<h3>capsulas de cafe</h3>
			<p>$30.00 MXN</p>
		</div>
		<div class="item productos-extra">
			<img src="pro3.jpg" alt="Producto 3">
			<h3>bolsas de te</h3>
			<p>$20.00 MXN</p>
		</div>
		<!-- Agrega más items según lo necesites -->
	</div>
	<script src="filtros.js"></script>

    <?php PiePagina(); ?>
</body>
</html>
