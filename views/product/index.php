<ul class="products">
<?php
foreach ($productos as $key => $producto) {
		$img_url = 'application/public/images/products/'.$producto['img'];
		$name = $producto['name'];
		$price = $producto['price'];
?>	
		<li>
			<a href="#" class="item">
				<img src="<? echo $img_url; ?>"/>
				<div>
					<p>Name:<?php echo $name; ?></p>
					<p>Price:<span><?php echo $price; ?></span></p>
				</div>
			</a>
		</li>


<?php
}
?>
</ul>


<div class="cart">
		<h1>Shopping Cart</h1>
		<div style="background:#fff">
		<table id="cartcontent" fitColumns="true" style="width:300px;height:auto;">
			<thead>
				<tr>
					<th field="name" width=140>Name</th>
					<th field="quantity" width=60 align="right">Quantity</th>
					<th field="price" width=60 align="right">Price</th>
				</tr>
			</thead>
		</table>
		</div>
		<p class="total">Total: $0</p>
		<h2>Drop here to add to cart</h2>
<input type="button" name='EnviarPedido' class='enviarPedido' value='Comprar'></input>
</div>

