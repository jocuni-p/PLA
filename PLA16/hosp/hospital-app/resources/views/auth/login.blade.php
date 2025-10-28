
	<h2>Login de usuario</h2>
	<form id='formulario' method='POST'>
        <div class="mb-3">
            <label class="form-label">NIF:</label>
            <input type="text" class="form-control" id="nif"  name="nif">
        </div>
       
        <div class="alert alert-danger" role="alert">
            
        </div>
       
        <div class="mb-3">
            <label class="form-label">Password:</label>
            <input type="password" class="form-control" id="password"  name="password">
        </div>
       
        <div class="alert alert-danger" role="alert">
           
        </div>
       
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="recordar">
                <label class="form-check-label" for="flexCheckDefault">
                    Recuérdame
                </label>
            </div>
        </div>
        
        <div class="alert alert-danger" role="alert">
            
        </div>
       
            <div class="alert alert-warning" role="alert">
                
            </div>
       

        <div class="d-flex justify-content-between">
            <button type="submit" id="login" name="login" class="btn btn-success">Login</button>

            <span><a href="" class="link-underline-primary fs-6">Olvidé la contraseña</a></span>

            <span><a href="" class="link-underline-primary">Registro</a></span>
        </div>
	</form>