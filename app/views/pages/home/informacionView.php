<?php require_once RUTA_APP . '/views/inc/header-informacion.php'; ?>
<!-- encabezado de la pagina -->
<header class="cabeza">
    <h1 class="title">Control de <b>Acceso</b></h1>

    <nav class="menu">
        <ul>
            <li class="menu__lista">
                <a class="menu__lista-a" href="<?php echo RUTA_URL; ?>/HomeController/index">Inicio</a>
            </li>
            <li class="menu__lista">
                <a class="menu__lista-a" href="<?php echo RUTA_URL; ?>/HomeController/informacion">Información</a>
            </li>
            <li class="menu__lista">
                <a class="menu__lista-a" href="<?php echo RUTA_URL; ?>/HomeController/nosotros">Nosotros</a>
            </li>
        </ul>
    </nav>
</header>
<section>
        <div class="contenido">
            <div class="contenido-texto">
                <h1 class="contenido__titulo">
                    Conjunto Residencial LA RIBERA VILLA RICA - Tu Nuevo Hogar en Malambo, Atlántico
                </h1>
                <p>
                    Bienvenido a LA RIBERA VILLA RICA, un conjunto residencial de viviendas de interés social ubicado en el corazón del barrio Villa Rica, en Malambo, Atlántico. Este moderno conjunto cuenta con 268 apartamentos diseñados para ofrecer comodidad y seguridad
                    a sus residentes.
                </p>
                <h4 class="caracteristicas">Características del Conjunto:</h4>
                <p>
                    Ubicación Estratégica: LA RIBERA VILLA RICA se encuentra cerca del Parque de la Cultura y la Casa de la Cultura, rodeado de un entorno que fomenta la vida familiar y comunitaria.
                </p>
                <br />
                <p>
                    Apartamentos Familiares: El conjunto ofrece opciones de apartamentos de 40, 44 y 46 m², con distribuciones de 2 y 3 alcobas, perfectas para adaptarse a las necesidades de cada familia.
                </p>
                <br />
                <p>
                    Seguridad y Tranquilidad: Con un cerramiento perimetral que rodea todo el conjunto, LA RIBERA VILLA RICA garantiza un ambiente seguro y tranquilo para sus habitantes.
                </p>
                <h4 class="Amenidades">Amenidades:</h4>
                <p>
                    Plaza Comercial: Dentro del conjunto, encontrarás una plaza comercial que brinda conveniencia al tener tiendas y servicios al alcance de tu hogar.
                </p>
                <br />
                <p>
                    Zona Infantil: Los niños podrán disfrutar de un parque diseñado especialmente para ellos, un lugar ideal para jugar y hacer amigos en un entorno seguro.
                </p>
                <br />
                <p>
                    Cancha de Básquet: Una cancha de básquet está disponible para todos los residentes, ofreciendo un espacio para el deporte y la recreación en familia.
                </p>
            </div>
            <div class="contenido__imagenes">
                <div class="cuerpo__informacion-content-fotos">
                    <img src="<?php echo RUTA_URL; ?>/img/atras.png" alt="atras" class="atras">
                    <img src="<?php echo RUTA_URL; ?>/img/rivera1.jpg" alt="foto1" class="contenido__imagenes-1">
                    <img src="<?php echo RUTA_URL; ?>/img/adelante.png" alt="adelante" class="adelante">
                    <script src="main/informacion.js"></script>
                </div>
                <img src="<?php echo RUTA_URL; ?>/img/informacion-img2.jpg" alt="imagenen2" class="contenido__imagenes-2" />
            </div>

        </div>
    </section>
    <script src="<?php echo RUTA_URL; ?>/js/informacion.js"></script>
<?php require_once RUTA_APP . '/views/inc/footer-home.php'; ?>