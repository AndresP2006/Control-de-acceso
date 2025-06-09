<!-- <script type="text/javascript" src="<?php //echo RUTA_URL; 
                                            ?>/js/main.js"></script> -->

<footer class="pie">
    <h3 class="pie__titulo translatable">Comunícate con Nosotros</h3>
    <hr>
    <div class="icons_footer">
        <div class="icon_item">
            <img src="<?php echo RUTA_URL; ?>/img/Gmail.png" alt="Gmail" width="30">
            <span class="translatable">VillarRicaMalambo@gmail.com</span>
        </div>
        <div class="icon_item">
            <img src="<?php echo RUTA_URL; ?>/img/whatsapp.png" alt="WhatsApp" width="30">
            <span class="translatable">+57 3003243242</span>
        </div>
        <div class="icon_item">
            <img src="<?php echo RUTA_URL; ?>/img/instagram.png" alt="Instagram" width="30">
            <span class="translatable">@villaricaMalambo</span>
        </div>
    </div>
    <hr style="width: 90%; margin-left: 5%;">
    <div class="pie__copy">
        <p class="translatable">&copy;</p>
    </div>
</footer>

<script>
    let año = new Date().getFullYear(); 
    document.querySelector('.pie__copy p').innerHTML = `&copy; ${año} Villarica Malambo Todos los derechos reservados.`; 
</script>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo RUTA_URL; ?>/js/alert.js"></script>
<script src="<?php echo RUTA_URL; ?>/js/Validaciones.js"></script>
<script src="<?php echo RUTA_URL; ?>/js/translate.js"></script>

</html>