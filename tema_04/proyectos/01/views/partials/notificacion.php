<!-- ALERTA DE NOTIFICACIONES -->
<?php
    if (isset($notificacion)) :?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <!-- Mensaje Notificación -->
        <strong>MENSAJE</strong> <?=$notificacion?>
        <!-- Cerrar Pestaña -->
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>    
    </div>    
<?php endif; unset($notificacion)?>