<?php require_once RUTA_APP . '/views/inc/header-nosotros.php'; ?>
<!-- encabezado de la pagina -->
<header>
    <div class="container">
        <h1><span class="translatable">Control de</span> <b class="translatable">Acceso</b></h1>
        <nav>
            <a class="menu__lista-a translatable" href="<?php echo RUTA_URL; ?>/HomeController/index">Inicio</a>
            <a class="menu__lista-a translatable" href="<?php echo RUTA_URL; ?>/HomeController/informacion">Información</a>
            <a class="menu__lista-a translatable" href="<?php echo RUTA_URL; ?>/HomeController/nosotros">Nosotros</a>
        </nav>
    </div>
</header>
<!-- cuerpo de la pagina -->
<section>
    <div class="content">
        <div class="content__primero">
            <div class="texto">
                <h2 class="mision"><span class="translatable">Nuestra</span> <b class="translatable">Misión</b></h2>
                <p class="translatable">
                    Fomentar el desarrollo de proyectos de viviendas e infraestructura con calidad y diseños innovadores, transformando el entorno para contribuir al progreso y generar beneficios para la comunidad. Estos proyectos también buscan integrar tecnologías sostenibles
                    y soluciones accesibles, mejorando la calidad de vida de los residentes y promoviendo un desarrollo inclusivo y equilibrado.
                </p>
            </div>
            <img src="<?php echo RUTA_URL; ?>/img/mision-img.webp" alt="Mision-img" class="Mision-img">
        </div>
        <div class="content__segundo">
            <div class="texto">
                <h2 class="vision"><span class="translatable">Nuestra</span> <b class="translatable">Visión</b></h2>
                <p class="translatable">
                    Para 2025, ser líderes en construcción y comercialización de sistemas habitacionales innovadores y de calidad, destacando en obras civiles e infraestructuras, con un equipo ético y comprometido, garantizando solidez y reconocimiento empresarial.
                </p>
            </div>
            <img src="<?php echo RUTA_URL; ?>/img/vision-img.jpg" alt="Vision-img" class="Mision-img">
        </div>
        <div class="tablas">
            <table>
                <tr>
                    <th class="titulo translatable">Valores</th>
                    <th class="titulo translatable">Convenios</th>
                </tr>
                <tr>
                    <td>
                        <li class="translatable">Perseverancia</li>
                    </td>
                    <td>
                        <li class="translatable">Bancolombia</li>
                    </td>
                </tr>
                <tr>
                    <td>
                        <li class="translatable">Responsabilidad</li>
                    </td>
                    <td>
                        <li class="translatable">Camacol</li>
                    </td>
                </tr>
                <tr>
                    <td>
                        <li class="translatable">Dedicación</li>
                    </td>
                    <td>
                        <li class="translatable">Mi casa Ya</li>
                    </td>
                </tr>
                <tr>
                    <td>
                        <li class="translatable">Innovación</li>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</section>
<?php require_once RUTA_APP . '/views/inc/footer-home.php'; ?>