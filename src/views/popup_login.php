<!-- Popup login -->  
<div class="popup" id="popup">
    <div class="popup-emergente">
        <span class="cerrar" id="cerrarPopup">&times;</span>
        <form action="../php/controllers/auth.php" method="POST" class="form-login">
            <div class="form-group">
                <label for="login_email">Email</label>
                <input type="text" id="login_email" name="login_email" required/>
            </div>

            <div class="form-group">
                <label for="login_password">Password</label>
                <input type="password" id="login_password" name="login_password" required/>
            </div>

            <div class="button-group">
                <a href='../public/signup.php'  id="singup">SignUp</a>
                <button type="submit" id="login">Login</button>
            </div>
        </form>
    </div>
</div>
<script type="module" src="../public/JS/login.js"></script>