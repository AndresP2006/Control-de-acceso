<?php require_once RUTA_APP . '/views/inc/header-home.php'; ?>

<!-- encabezado de la pagina -->
<header class="cabeza">
    <h1 class="title">Control de <b>Acceso</b></h1>

    <nav class="menu">
        <ul>
            <li class="menu__lista">
                <a class="menu__lista-a" href="index.html">Inicio</a>
            </li>
            <li class="menu__lista">
                <a class="menu__lista-a" href="paginas/Informacion.html">Información</a>
            </li>
            <li class="menu__lista">
                <a class="menu__lista-a" href="paginas/Nosotros.html">Nosotros</a>
            </li>
        </ul>
    </nav>
    <!-- <script src="./main/"></script> -->
</header>
<!-- informacion de la pagina -->
<article class="cuerpo">
    <div class="cuerpo__informacion-content">
        <h2 class="cuerpo__informacion-content-titulo">
            ¡La Ribera Villa Rica <samp>Apartamentos!</samp>
        </h2>
        <p class="cuerpo__informacion-content-titulo-parrafo">
            LA RIBERA VILLA RICA es un ambicioso proyecto de viviendas de interés social, compuesto por un total de 268
            unidades residenciales, diseñado con el objetivo de mejorar la calidad de vida de las familias del municipio
            de Malambo, en el departamento del
            Atlántico. Este proyecto se encuentra estratégicamente ubicado en el Barrio Villa Rica, una zona que ofrece
            fácil acceso a importantes puntos de referencia locales como el Parque de la Cultura y la Casa de la
            Cultura, lo que garantiza
            que los futuros residentes estarán rodeados de un entorno que promueve el desarrollo comunitario y cultural.
            <br /><br /> Los apartamentos de LA RIBERA VILLA RICA están pensados para familias que buscan comodidad y
            funcionalidad
            a un precio accesible. El proyecto ofrece tres tipos de apartamentos con áreas de 40, 44 y 46 metros
            cuadrados, brindando opciones que se ajustan a las diferentes necesidades familiares. Además, estos
            apartamentos cuentan con configuraciones
            de 2 y 3 alcobas, proporcionando espacios versátiles para las familias de diferentes tamaños. <br /><br />
            Uno de los principales atractivos de este proyecto es el enfoque en la seguridad y tranquilidad de sus
            habitantes, razón por la
            cual cuenta con un cerramiento perimetral que brinda un entorno más seguro. Los residentes podrán disfrutar
            de la tranquilidad de vivir en un entorno protegido, donde la privacidad y el bienestar de sus familias
            estarán garantizados. <br /><br /> Además de los apartamentos, el proyecto incluirá una plaza comercial, la
            cual será un punto central para las compras y servicios básicos, facilitando la vida diaria de los
            habitantes sin necesidad de desplazamientos largos. También
            se construirán áreas recreativas como un parque para niños y una cancha de baloncesto, donde tanto los más
            pequeños como los adultos podrán disfrutar de actividades al aire libre y fomentar la convivencia familiar.
            <br /><br /> En resumen,
            LA RIBERA VILLA RICA no es solo un conjunto de viviendas, sino una comunidad pensada para ofrecer un estilo
            de vida cómodo, seguro y accesible, en una ubicación estratégica que favorece el desarrollo social y
            cultural de sus habitantes.
        </p>
    </div>
    <div class="cuerpo__informacion-content-fotos">
        <img src="<?php echo RUTA_URL; ?>/img/atras.png" alt="atras" class="atras" />
        <img src="<?php echo RUTA_URL; ?>/img/departamento1-inicio.jpg" alt="foto1" width="600" height="600"
            class="foto1" />
        <img src="<?php echo RUTA_URL; ?>/img/adelante.png" alt="adelante" class="adelante" />
        <script src="<?php echo RUTA_URL; ?>/js/main-home.js"></script>
    </div>
</article>
<!-- formulario -->
<div class="inicia_seccion">
    <form action="<?php echo RUTA_URL; ?>/LoginController/index" method="post">
        <div class="Formulario">
            <h1 class="Formulario__titulo">Iniciar Sesion</h1>
            <input class="Formulario__titulo-input" name="usuario" type="text" placeholder="     Usuario" required />
            <input class="Formulario__titulo-input" name="password" type="password" placeholder="   Contraseña"
                required />
            <button type="submit" name="ingresar" class="Formulario__boton">
                Ingresar
            </button>
            <a href="" class="Contraseña"></a>
        </div>
        <div class="imagen">
            <img src="<?php echo RUTA_URL; ?>/img/mapa.png" alt="mapa" class="imagen__mapa" />
        </div>

    </form>
</div>

<?php require_once RUTA_APP . '/views/inc/footer-home.php'; ?>
<script>
    error("<?php echo $datos['messageError']; ?>")

</script>