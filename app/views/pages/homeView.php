<?php require_once RUTA_APP . '/views/inc/header-home.php'; ?>

<!-- Contenedor principal -->

<header>
    <div class="container">
        <h1>
            <span class="translatable">Control de</span> <samp style="color:#f00;" class="translatable">Acceso</samp>
        </h1>
        <!-- Menú de navegación -->
        <nav>
            <a class="menu__lista-a translatable" href="<?php echo RUTA_URL; ?>/HomeController/index">Inicio</a>
            <a class="menu__lista-a translatable" href="<?php echo RUTA_URL; ?>/HomeController/informacion">Información</a>
            <a class="menu__lista-a translatable" href="<?php echo RUTA_URL; ?>/HomeController/nosotros">Nosotros</a>
        </nav>
    </div>
</header>

<!-- Contenido principal -->
<main>
    <!-- Información del proyecto -->
    <section id="hero">
        <article>
            <h2 class="translatable">
                ¡La Ribera Villa Rica Apartamentos! 
            </h2>
            <p class="translatable">
                LA RIBERA VILLA RICA es un proyecto de viviendas de interés social en Malambo - Atlántico,
                con 268 unidades diseñadas para mejorar la calidad de vida de sus residentes.
            </p>
            <p class="translatable">
                Ubicado en el Barrio Villa Rica, ofrece fácil acceso a puntos clave como el Parque y la Casa de la Cultura, fomentando el desarrollo comunitario.
            </p>
            <p class="translatable">
                Los apartamentos, de 40, 44 y 46 m², cuentan con 2 o 3 alcobas, combinando comodidad y funcionalidad a precios accesibles. La seguridad es una prioridad, con cerramiento perimetral para mayor tranquilidad.
            </p>
            <p class="translatable">
                El proyecto incluye una plaza comercial, áreas recreativas, un parque infantil, creando un entorno ideal para la convivencia familiar. Más que un conjunto residencial, LA RIBERA VILLA RICA es una comunidad que promueve un estilo de vida seguro y accesible.
            </p>
        </article>

        <!-- Galería de imágenes -->
        <div class="carrusel">
            <img src="<?php echo RUTA_URL; ?>/img/atras.png" alt="atras" class="atras" />
            <img id="img2" src="<?php echo RUTA_URL; ?>/img/departamento1-inicio.jpg" alt="foto1" class="foto1" />
            <img src="<?php echo RUTA_URL; ?>/img/adelante.png" alt="adelante" class="adelante" />
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const conRivera = document.getElementById("img2");

                // Array con las imágenes del carrusel
                let fotosArray = [
                    "<?php echo RUTA_URL; ?>/img/departamento1-inicio.jpg",
                    "<?php echo RUTA_URL; ?>/img/departamento2-inicio.jpg",
                    "<?php echo RUTA_URL; ?>/img/departamento3-inicio.jpg"
                ];

                let fotosPos = 0;

                // Función para cambiar la imagen
                function cambiarFoto(direccion) {
                    // Actualiza la posición de la foto
                    fotosPos = (fotosPos + direccion + fotosArray.length) % fotosArray.length;

                    if (conRivera) {
                        // Cambia la imagen mostrada
                        conRivera.setAttribute("src", fotosArray[fotosPos]);
                    }
                }

                const btnAtras = document.querySelector("img.atras");
                const btnAdelante = document.querySelector("img.adelante");

                // Asignar los eventos de clic para los botones
                if (btnAtras) {
                    btnAtras.onclick = () => cambiarFoto(-1);
                }

                if (btnAdelante) {
                    btnAdelante.onclick = () => cambiarFoto(1);
                }
            });
        </script>
    </section>
</main><!-- Sección de inicio de sesión -->
<section class="inicia_seccion">
    <form action="<?php echo RUTA_URL; ?>/LoginController/index" method="post">
        <div class="formulario">
            <h1 class="Formulario__titulo translatable">Iniciar Sesión</h1>
            <input class="titulo-input translatable" name="usuario" type="text" placeholder="Identificacion o Correo" required data-original="Identificacion o Correo" />
            <input class="Formulario__titulo-input translatable" name="password" type="password" placeholder="Contraseña" required data-original="Contraseña" />
            <a href="<?php echo RUTA_URL; ?>/RecoveryController/index" style="margin-bottom: 10px; color:#f00;" class="translatable">¿Olvidaste tu contraseña?</a>
            <button type="submit" name="ingresar" class="Formulario__boton translatable">Ingresar</button>
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