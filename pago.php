<?php
	
    include 'global/config.php';
    include 'global/conexion.php';
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reyzoni Online Shop</title>

    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
rel="stylesheet" 
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
crossorigin="anonymous">

<link href="css/estilos.css" rel="stylesheet">

</head>
<body>

<header>
  <div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="index.php" class="navbar-brand d-flex align-items-center">
        <strong>Reyzoni Online Shop</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class= "collapse navbar-collapse" id= "navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a href="index.php" class="nav-link active">Catalogo</a>
            </li>

            <li class="nav-item">
                <a href="contacto.php" class="nav-link">Contacto</a>
            </li>

          </ul>
          <a href="checkout.php" class="btn btn-primary">
              Carrito <span id="num_cart" class="badge bg-secondary" ><?php echo $num_cart; ?></span>
            </a>
      </div>
    </div>
  </div>
</header>

<main>

    
<?php

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null; 
//print_r($_SESSION);

$lista_carrito = array();

if($productos != null){
    foreach($productos as $clave => $cantidad){

        $sentencia= $pdo->prepare("SELECT id, nombre, descripcion, precio, descuento, $cantidad AS cantidad FROM `productos` WHERE id=?");
        $sentencia->execute([$clave]);
        $lista_carrito[] = $sentencia->fetch(PDO::FETCH_ASSOC);
    }

}else{
    header("Location: index.php");
    exit;
}

?>
<div class="container">
    <div class="row">
    <div class="col-6">
    <h4> Detalles de pago</h4>
    <div id="paypal-button-container"></div>
    </div>

    <div class="col-6">
   <div class = "table-response"> 
       <table class="table"> 
           <thead>
               <tr>
                   <th> Producto </th>
                   <th> Subtotal </th>
                   <th> </th>
               </tr>
           </thead>
           
           <tbody> 
               
           <?php if($lista_carrito == null){
               echo '<tr> <td colspan="5" class="text-center"> <b>Lista vacia </b></td> </tr>'; 
           }else{
               $total =0;
               foreach($lista_carrito as $producto){
                   $_id = $producto['id'];
                   $nombre = $producto['nombre'];
                   $precio = $producto['precio'];
                   $descuento = $producto['descuento'];
                   $cantidad = $producto['cantidad'];
                   $precio_desc = $precio -(($precio * $descuento / 100));
                   $subtotal = $cantidad * $precio_desc;
                   $total += $subtotal; 
                   ?>

               <tr>
                   <td> <?php echo $nombre; ?> </td>
                   <td> 
                   <div id="subtotal_ <?php echo $_id; ?> " name ="subtotal[]"> <?php echo MONEDA . number_format ($subtotal,2, '.', ','); ?> </div>
                   </td>
               </tr>
               <?php } ?>

                <tr> 
                    <td colspan="2"> 
                        <p class="h3 text-end" id="total">  <?php echo MONEDA . number_format ($total,2, '.', ','); ?> </p>
                    </td>
                </tr>

           </tbody>
           <?php } ?>
       </table>
    </div>
    </div>

   </div>
   
    </div>
    </div>
    </div>
</main>
<!-- Button trigger modal -->


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>

<script src="https://www.paypal.com/sdk/js?client-id=AQi5A0fTy4BitMf7Gfhq1-tbP6W9bY26ViINxXCF844EeRbox80zzzCqq1j2NptU5XFheCkJOM1Rdxg8&currency=MXN"></script>

<script>
      paypal.Buttons({

        // Sets up the transaction when a payment button is clicked
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: <?php echo $total; ?> 
              }
            }]
          });
        },


        onCancel: function (data){

            alert("Pago Cancelado");
            console.log(data);
        },
        // Finalize the transaction after payer approval
        onApprove: function(data, actions) {
            let URL = 'clases/captura.php'
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                window.location.href= "completado.html";
                return fetch(url, {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        detalles: orderData
                    })
                })
                
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // var element = document.getElementById('paypal-button-container');
            // element.innerHTML = '';
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
        }
      }).render('#paypal-button-container');

    </script>
</body>
</html>
