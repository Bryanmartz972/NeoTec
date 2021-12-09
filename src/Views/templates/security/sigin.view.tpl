<section class="d-flex justify-content-center" style="background-color: #2DA89C; height:100vh;" >
  <form style="background-color: #FFFF;box-shadow: 10px 10px 8px #323232;margin: 75px; border-style: hidden; border-radius: 90px; width:400px; height:500px;" method="post" action="index.php?page=sec_register">

      <h1 class="text-center mt-4" style="font-family:Times New Roman; font-weight:bold;">Crear Cuenta</h1>  
      <div class="d-flex justify-content-center flex-column m-4">

      <div class="d-flex justify-content-center flex-column ">
          <label class="text-left mt-2" for="txtUser">Nombre de Usuario</label>
          <div class="d-flex justify-content-center">
            <input class="form-control" type="text" id="txtUser" name="txtUser" value="{{txtUser}}" />
          </div>
        {{if errorUser}}
        <div style="color:#FF0000;">{{errorUser}}</div>
        {{endif errorUser}}
      </div>

      <div class="  d-flex justify-content-center flex-column">
        <label class="text-left mt-2" for="txtEmail">Correo Electrónico</label>
        <div class="d-flex justify-content-center">
          <input class="form-control " type="email" id="txtEmail" name="txtEmail" value="{{txtEmail}}" />
        </div>
        {{if errorEmail}}
        <div style="color:#FF0000;">{{errorEmail}}</div>
        {{endif errorEmail}}
      </div>

      <div class="d-flex justify-content-center flex-column ">
        <label class="text-left mt-2" for="txtPswd">Contraseña</label>
        <div class="d-flex justify-content-center">
          <input class="form-control" type="password" id="txtPswd" name="txtPswd" value="{{txtPswd}}" />
        </div>
        {{if errorPswd}}
        <div style="color:#FF0000;">{{errorPswd}}</div>
        {{endif errorPswd}}
      </div>

      </div>
      <div class="d-flex justify-content-center mt-3 ">
        <button class="btn btn-primary col-md-6" style=" border-style:hidden; border-radius:50px; " id="btnSignin" type="submit">Registrar</button>
      </div>
    
  </form>
</section>
