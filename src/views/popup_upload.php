
<!-- Popup upload-->
<div class="popup-upload" id="popup-upload">
    <div class="popup-emergente">
        <span class="cerrar" id="cerrarPopupUpload">&times;</span> 
        <form class="form-login" action="../php/controllers/anuncio.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="ads_titulo">Titulo</label>
                <input type="Titulo" id="ads_titulo" name="ads_titulo" required/>
            </div>

            <div class="form-group">
                <label for="ads_Descripcion">Descripcion</label>
                <input type="Descripcion" id="ads_Descripcion" name="ads_Descripcion" required/>
            </div>

            <div class="form-group">
                <label for="ads_categoria">Categoria</label>
                <select id="categoria" name="ads_categoria" required>
                </select>
            </div>

            <div class="form-group">
                <label for="ads_precio">Precio</label>
                <input type="Descripcion" id="ads_precio" name="ads_precio" required/>
            </div>

            <div class="form-group">
                <input type="file" id="file" name="file" accept="image/*" required>
            </div>
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>
</div>
<script type="module" src="../public/JS/upload.js"></script>