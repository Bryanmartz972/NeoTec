<section class="container-m row depth-1 px-4 py-4">
  <h1>{{ModalTitle}}</h1>
</section>
<section class="container-md d-flex justify-content-center"  style="width:100vh;">
  <form action="index.php?page=mnt_categoria" method="POST" class="border  w-75 p-3">
    <div class="m-5">
      <label class="form-label" for="codigo_categoria">Código</label>
      <input class="form-control" readonly disabled type="text" name="codigo_categoria" id="codigo_categoria" placehoder="Código" value="{{codigo_categoria}}" />
      <input type="hidden" name="mode" value="{{mode}}" />
      <input type="hidden" name="codigo_categoria" value="{{codigo_categoria}}" />
      <input type="hidden" name="token" value="{{categorias_xss_token}}" />
    </div>
    <div class="m-5">
      <label class="form-label" for="nombre_categoria">Categoria</label>
      <input class="form-control" {{readonly}} type="text" name="nombre_categoria" id="nombre_categoria" placehoder="Nombre" value="{{nombre_categoria}}" />
    </div>
    <div class="m-5">
      <label class="form-label" for="descripcion_categoria">Descripción</label>
      <input class="form-control" {{readonly}} type="text" name="descripcion_categoria" id="descripcion_categoria" placehoder="Descripcion" value="{{descripcion_categoria}}" />
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
    </div>
  </form>
</section>


<script>
  document.addEventListener("DOMContentLoaded", ()=>{
    const btnCancelar = document.getElementById("btnCancelar");
    btnCancelar.addEventListener("click", (e)=>{
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=mnt_categorias");
    });
  });
</script>