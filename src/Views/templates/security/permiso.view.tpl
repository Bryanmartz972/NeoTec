<h1>{{ModalTitle}}</h1>
<section class="container-md d-flex justify-content-center"  style="width:100vh;">
    
        <form action="index.php?page=sec_funcionesroles" method="POST" class="border ">
        <div class="m-5">
            <label for="codigorol" class="form-label">Código Rol</label>
            <select name="codigorol" id="codigorol" class="form-select">
                {{foreach roles}}
                <option value="{{codigo_rol}}" >{{codigo_rol}}</option>
                {{endfor roles}}
            </select>
            <input type="hidden" value="{{permisos_xss_token}}" name="token">
            <input type="hidden" value="{{mode}}" name="mode">
        </div>
         <div class="m-5">
           <label for="codigo_funcion" class="form-label">Código Rol</label>
            <select name="codigo_funcion" id="codigo_funcion" class="form-select">
                {{foreach funciones}}
                <option value="{{codigo_funcion}}" >{{codigo_funcion}}</option>
                {{endfor funciones}}
            </select>
            </div>
        <div class="m-5" >
            <label for="funcion_rol_estado" class="form-label">Estado</label>
            <select name="funcion_rol_estado" class="form-select" id="funcion_rol_estado">
                <option value="ACT" {{if funcion_rol_estado_act}}selected{{endif funcion_rol_estado_act}}>Activo</option>
                 <option value="INA" {{if funcion_rol_estado_ina}}selected{{endif funcion_rol_estado_ina}}>InActivo</option>
            </select>
        </div>
        <div class="m-5" >
            <label for="fecha_exp" class="form-label">Fecha Expira</label>
            <input type="date" name="fecha_exp" class="form-control" id="fecha_exp" value="{{fecha_exp}}">
        </div>

        <div class="m-5">
             {{if showCommitBtn}}
                <button class="btn btn-primary" style="background-color: #F8485E; border: none; " type="submit" name="btnConfirmar">Confirmar</button>
                &nbsp;
                {{endif showCommitBtn}}
                <button class="btn btn-danger"type="button" id="btnCancelar">
                    {{if showCommitBtn}}
                    Cancelar
                    {{endif showCommitBtn}}
                    {{ifnot showCommitBtn}}
                    Regresar
                    {{endifnot showCommitBtn}}
                </button>
        </div>
        </form>
    

</section>


<script>
  document.addEventListener("DOMContentLoaded", ()=>{
    const btnCancelar = document.getElementById("btnCancelar");
    btnCancelar.addEventListener("click", (e)=>{
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=sec_permisos");
    });
  });
</script>