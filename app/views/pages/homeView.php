<?php require_once RUTA_APP . '/views/inc/header-home.php'; ?>

<!-- Contenedor principal -->

<!-- Encabezado de la página -->
<header>
    <div class="container">
        <h1>Control de <b>Acceso</b></h1>
        <!-- Menú de navegación -->
        <nav>
            <a class="menu__lista-a" href="<?php echo RUTA_URL; ?>/HomeController/index">Inicio</a>
            <a class="menu__lista-a" href="<?php echo RUTA_URL; ?>/HomeController/informacion">Información</a>
            <a class="menu__lista-a" href="<?php echo RUTA_URL; ?>/HomeController/nosotros">Nosotros</a>
        </nav>
    </div>
</header>

<!-- Contenido principal -->
<main>
    <!-- Información del proyecto -->
    <section id="hero">
        <article>
            <h2>
                ¡La Ribera Villa Rica <samp>Apartamentos!</samp>
            </h2>
            <p>
                LA RIBERA VILLA RICA es un proyecto de viviendas de interés social en Malambo - Atlántico,
                con 268 unidades diseñadas para mejorar la calidad de vida de sus residentes. Ubicado en
                el Barrio Villa Rica, ofrece fácil acceso a puntos clave como el Parque y la Casa de la Cultura,
                fomentando el desarrollo comunitario.
                <br><br>
                Los apartamentos, de 40, 44 y 46 m², cuentan con 2 o 3 alcobas, combinando comodidad y funcionalidad
                a precios accesibles. La seguridad es una prioridad, con cerramiento perimetral para mayor tranquilidad.
                <br><br>
                El proyecto incluye una plaza comercial, áreas recreativas, un parque infantil, creando un entorno ideal
                para la convivencia familiar. Más que un conjunto residencial, LA RIBERA VILLA RICA es una comunidad que
                promueve un estilo de vida seguro y accesible.
            </p>
            
        </article>

        <!-- Galería de imágenes -->
        <div class="carrusel">
            <img src="<?php echo RUTA_URL; ?>/img/atras.png" alt="atras" class="atras" />
            <img src="<?php echo RUTA_URL; ?>/img/departamento1-inicio.jpg" alt="foto1"  class="foto1" />
            <img src="<?php echo RUTA_URL; ?>/img/adelante.png" alt="adelante" class="adelante" />
        </div>

        <!-- Script de funcionalidad -->
        <script src="<?php echo RUTA_URL; ?>/js/main.js"></script>
    </section>

    

</main><!-- Sección de inicio de sesión -->
    <section class="inicia_seccion">
        <form action="<?php echo RUTA_URL; ?>/LoginController/index" method="post">
            <div class="formulario">
                <h1 class="Formulario__titulo">Iniciar Sesión</h1>
                <input class="titulo-input" name="usuario" type="text" placeholder="     Usuario" required />
                <input class="Formulario__titulo-input" name="password" type="password" placeholder="   Contraseña" required />
                <a href="<?php echo RUTA_URL; ?>/RecoveryController/index" style="margin-bottom: 10px; color:#f00;">¿Olvidaste tu contraseña?</a>
                <button type="submit" name="ingresar" class="Formulario__boton">Ingresar</button>
            </div>

            <!-- Imagen lateral -->
            <div class="imagen">
                <img src="<?php echo RUTA_URL; ?>/img/mapa.png" alt="mapa" class="imagen__mapa" />
            </div>
        </form>
    </section>
<!-- Pie de página -->
<?php require_once RUTA_APP . '/views/inc/footer-home.php'; ?>

<!-- Script de mensaje de error -->
<script>
    <?php if (isset($datos['messageError'])) { ?>
        error("<?php echo $datos['messageError']; ?>")
    <?php } ?>
</script>