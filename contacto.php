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
<style type="text/css">
body{
    background-image: linear-gradient(green, pink, yellow, red,blue);    
}
.contacto{
    font-family:'Courier New';
    font-size:30px;
    padding: 30px;
}
.mex{
    font-family:'Monaco';
    font-size:30px;
    padding: 50px;
    text-align: center;
}
 
</style>

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
              Carrito <span id="num_cart" class="badge bg-secondary" ></span>
            </a>
      </div>
    </div>
  </div>
</header>
<main>
<div class="contacto">
             <b> Como contactarme:</b>
            <li> Telefono: 83 41 12 39<br></li>
            <li> Celular: 81 23 44 23 21<br></li>
            <li> Email: reynol@hotmail.com <br></li>
            <h1 class="mex">La tienda mas rapida de MEXICO</h1>

    </div>

  </div>
</main>
</body>
</html>
