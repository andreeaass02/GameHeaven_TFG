<?php
session_start();
require 'BBDD.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// Obtener el carrito del usuario
$query = "SELECT c.id, v.id_videojuego, v.precio, c.cantidad 
          FROM carrito c 
          JOIN videojuegos v ON c.id_videojuego = v.id_videojuego 
          WHERE c.id_usuario = ?";
$stmt = $conex1->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Calcular el total
$total = 0;
$items = [];
while ($row = $result->fetch_assoc()) {
    $total += $row['precio'] * $row['cantidad'];
    $items[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/checkout.css">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
        }
        .container {
            text-align: center;
        }
        #paypal-button-container {
            margin-top: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
            margin-bottom: 20px;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
    <script src="https://www.paypal.com/sdk/js?client-id=AW50Svb8QaZqpw0F9DhNd2YM4saaE6brjb5DYpIHK-yRMdTwA90SDkHtRL1jItUEpD6JDFrxJvLzmYmK&currency=EUR"></script>
    <script>
        function handlePayment() {
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '<?= $total ?>' // Usar el total calculado
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        // Llamar a la función para completar la compra en el servidor
                        fetch('finalizar_compra.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ orderID: data.orderID })
                        })
                        .then(response => {
                            if (response.ok) {
                                response.blob().then(blob => {
                                    let url = window.URL.createObjectURL(blob);
                                    let a = document.createElement('a');
                                    a.href = url;
                                    a.download = 'codigos_compra.pdf';
                                    document.body.appendChild(a); 
                                    a.click();
                                    a.remove();
                                    // Recargar la página después de la descarga
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);
                                });
                            } else {
                                response.json().then(data => {
                                    alert('Error al completar la compra: ' + data.message);
                                });
                            }
                        })
                        .catch(error => {
                            alert('Error en la comunicación con el servidor: ' + error);
                        });
                    });
                }
            }).render('#paypal-button-container');
        }
    </script>
</head>
<body onload="handlePayment()">
    <div class="container">
        <h1>Checkout</h1>
        <p>Total: $<?= number_format($total, 2) ?></p>
        <div id="paypal-button-container"></div>
        <a href="index.php" class="back-link">Volver al inicio</a>
    </div>
</body>
</html>
