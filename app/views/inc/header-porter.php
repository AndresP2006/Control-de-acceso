<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/Visitas.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/adminStyle.css">
    <!-- <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/administracion.css"> -->
    

    <title>Guardia</title>
    <style>
        * {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif !important;
        }

        .encabezado {
            width: 100%;
            height: 150px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #6c7471;
            margin-bottom: 90px;
        }

        .titulo {
            margin-left: 70px;
            width: 350px;
            text-align: center;
            color: #fff;

        }

        .Buscar {
            width: 200px;
            height: 40px;
            border-radius: 5px;
            font-weight: 700;
            background-color: darkgray;
            font-size: 20px;
        }

        .titulo_1 {
            font-family: cursive;
        }

        b {
            color: red;
        }

        .ventana-emergente {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .ventana-emergente__caja {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border-radius: 30px;
            display: flex;
            flex-direction: column;
            border: 5px solid #010000;
            width: 100%;
            max-width: 800px;
        }



        .boton {
            padding: 5px;
            width: 150px;
            height: 60px;
            font-size: 20px;
            margin-right: 100px;
            font-weight: 700;
            cursor: pointer;
            border-radius: 20px;
            color: #fff;
            background-color: #65857a;
            box-shadow: 0px 0px 20px 0px black;
            transition: all 1s;
        }

        .boton:hover {
            background-color: red;

        }

        .cerrar-sescion {
            margin-right: 20px;
        }

        /* motrar datos de los farmularios */
        #overlay {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(86, 89, 91, 0.4);
        }

        .formulario {
            background-color: #ffffff;
            padding: 20px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .formulario h2 {
            margin-top: 0;
            font-size: 1.5em;
            color: #333333;
            text-align: center;
        }

        .formulario label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555555;
        }

        .formulario input[type="text"],
        .formulario input[type="email"],
        .formulario input[type="password"],
        .formulario input[type="number"],
        .formulario input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        .formulario input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .formulario input[type="submit"]:hover {
            background-color: #45a049;
        }

        .x {
            color: black;
            float: right;
            font-size: 40px;
            position: relative;
            align-items: end;
            padding-left: 50%;
            padding-top: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>