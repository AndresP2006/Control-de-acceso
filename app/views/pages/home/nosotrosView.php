<?php require_once RUTA_APP . '/views/inc/header-nosotros.php'; ?>
<!-- encabezado de la pagina -->
<header class="cabeza">
    <h1 class="title">Control de <b>Acceso</b></h1>

    <nav class="menu">
        <ul>
            <li class="menu__lista">
                <a class="menu__lista-a" href="<?php echo RUTA_URL;?>/HomeController/index">Inicio</a>
            </li>
            <li class="menu__lista">
                <a class="menu__lista-a" href="<?php echo RUTA_URL;?>/HomeController/informacion">Información</a>
            </li>
            <li class="menu__lista">
                <a class="menu__lista-a" href="<?php echo RUTA_URL;?>/HomeController/nosotros">Nosotros</a>
            </li>
        </ul>
    </nav>
</header>
 <!-- cuerpo de la pagina -->
 <section>
        <div class="content">
            <div class="content__primero">
                <div class="texto">
                    <h2 class="mision">Nuestra <b>Mision</b></h2>
                    <p>
                        Fomentar el desarrollo de proyectos de viviendas e infraestructura con calidad y diseños innovadores, transformando el entorno para contribuir al progreso y generar beneficios para la comunidad. Estos proyectos también buscan integrar tecnologías sostenibles
                        y soluciones accesibles, mejorando la calidad de vida de los residentes y promoviendo un desarrollo inclusivo y equilibrado.
                    </p>
                </div>
                <img src="<?php echo RUTA_URL; ?>/img/mision-img.webp" alt="Mision-img" class="Mision-img">
            </div>
            <div class="content__segundo">
                <div class="texto">
                    <h2 class="vision">Nuestra <b>Vision</b></h2>
                    <p>
                        Para 2025, ser líderes en construcción y comercialización de sistemas habitacionales innovadores y de calidad, destacando en obras civiles e infraestructuras, con un equipo ético y comprometido, garantizando solidez y reconocimiento empresarial.
                    </p>
                </div>
                <img src="<?php echo RUTA_URL; ?>/img/vision-img.jpg" alt="Vision-img" class="Mision-img">
            </div>
            <div class="tablas">
                <table>
                    <tr>
                        <th class="titulo">Valores</th>
                        <th class="titulo">Convenios</th>
                    </tr>
                    <tr>
                        <td>
                            <li>Perseverancia</li>
                        </td>
                        <td>
                            <li>Bancolombia</li>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <li>Responsabilidad</li>
                        </td>
                        <td>
                            <li>Camacol</li>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <li>Dedicacion</li>
                        </td>
                        <td>
                            <li>Mi casa Ya</li>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <li>Innovacion</li>
                        </td>

                    </tr>
                </table>
            </div>
        </div>
    </section>
<?php require_once RUTA_APP . '/views/inc/footer-home.php'; ?>