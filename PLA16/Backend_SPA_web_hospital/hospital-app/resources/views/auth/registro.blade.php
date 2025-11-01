
	<h2>Registro de usuario</h2>
	<form id='formulario' method='POST' action="" enctype="multipart/form-data">
       
        <div class="mb-3">
            <label class="form-label">NIF:</label>
            <input type="text" class="form-control" id="nif"  name="nif">
        </div>
       
        <div class="alert alert-danger" role="alert">
           
        </div>
        
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre"  name="nombre">
        </div>
        
        <div class="alert alert-danger" role="alert">
           
        </div>
       
        <div class="mb-3">
            <label class="form-label">Apellidos:</label>
            <input type="text" class="form-control" id="apellidos"  name="apellidos">
        </div>
       
        <div class="alert alert-danger" role="alert">
            
        </div>
       
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" id="email"  name="email">
        </div>
       
        <div class="alert alert-danger" role="alert">
           
        </div>
        
        <div class="mb-3">
            <label class="form-label">Foto:</label>
            <input type="file" class="form-control" id="foto"  name="foto" accept="image/*">
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
            <label class="form-label">Confirmar Password:</label>
            <input type="password" class="form-control" id="password_confirmation"  name="password_confirmation">
        </div>
       
        <div class="alert alert-danger" role="alert">
           
        </div>
        
        <br>
        <button type="submit" id="registro" name="registro" class="btn btn-success">Registrar</button>
	</form>