<section class="d-flex justify-content-center   " style="background-color: #2DA89C; height:100vh;" >
  <form style="background-color: rgba(255, 255, 255, 0.5);box-shadow: 10px 10px 8px #323232;margin: 110px; border-style: hidden; border-radius: 90px; width:400px; height:400px;" method="post" action="index.php?page=sec_login{{if redirto}}&redirto={{redirto}}{{endif redirto}}">
    
      <h1 class="text-center mt-4" style="font-family:Times New Roman; font-weight:bold;">Iniciar Sesión</h1>
   
    <section class="d-flex justify-content-center flex-column m-4">
      <div class="d-flex justify-content-center flex-column">
        <label class="text-left mt-2" for="txtEmail">Correo Electrónico</label>
        <div class="d-flex justify-content-center">
          <input class="form-control" type="email" id="txtEmail" name="txtEmail" value="{{txtEmail}}" />
        </div>
        {{if errorEmail}}
          <div style="color:#FF0000;">{{errorEmail}}</div>
        {{endif errorEmail}}
      </div>
      <div class="row">
        <label class="text-left mt-2" for="txtPswd">Contraseña</label>
        <div class="d-flex justify-content-center">
         <input class="form-control" type="password" id="txtPswd" name="txtPswd" value="{{txtPswd}}" />
        </div>
        {{if errorPswd}}
        <div style="color:#FF0000;">{{errorPswd}}</div>
        {{endif errorPswd}}
      </div>
    {{if generalError}}
      <div class="row">
        {{generalError}}
      </div>
    {{endif generalError}}
      </section>
    <div class="d-flex justify-content-center mt-3 ">
      <button class="btn btn-primary col-md-6" style=" border-style:hidden; border-radius:50px; " id="btnLogin" type="submit">Iniciar Sesión</button>
    </div>
  
  </form>
</section>
