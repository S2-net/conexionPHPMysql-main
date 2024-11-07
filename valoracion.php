<div class="valoracion-form">
    <h3>Deja tu valoración</h3>
    <form method="POST" action="procesar_valoracion.php">
        <input type="hidden" name="id_residencia" value="<?php echo $id_residencia; ?>"> <!-- id_residencia -->
        
        <label for="puntuacion">Puntuación (1-5):</label>
        <select name="puntuacion" id="puntuacion" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="comentario">Comentario (opcional):</label>
        <textarea name="comentario" id="comentario" rows="4" placeholder="Escribe tu comentario..."></textarea>

        <button type="submit" name="enviar_valoracion">Enviar Valoración</button>
    </form>
</div>
