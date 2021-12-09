<h1>{{mode_dsc}}</h1>
<section>
  <form action="index.php?page=mnt_crudproducto&mode={{mode}}&codigo_producto={{codigo_producto}}"
    method="POST" >
    <section>
    <label for="codigo_producto">Codigo Producto</label>
    <input type="hidden" id="codigo_producto" name="codigo_producto" value="{{codigo_producto}}"/>
    <input type="hidden" id="mode" name="mode" value="{{mode}}" />
    <input type="text" readonly name="codigo_productodummy" value="{{codigo_producto}}"/>
    </section>
    <section>
      <label for="nombre_producto">Nombre Producto</label>
      <input type="text" {{readonly}} name="nombre_producto" value="{{nombre_producto}}" maxlength="255" placeholder="Nombre de producto"/>
    </section>
    <section>
      <label for="descripcion_producto">Descripcion de producto</label>
      <input type="text" {{readonly}} name="descripcion_producto" value="{{descripcion_producto}}" maxlength="45" placeholder="Descripcion del producto"/>
    </section>
    <section>
      <label for="precio">Precio</label>
      <input type="text" {{readonly}} name="precio" value="{{precio}}" maxlength="45" placeholder="Precio"/>
    </section>
    <section>
      <label for="cantidad_stock">Cantidad Stock</label>
      <input type="text" {{readonly}} name="cantidad_stock" value="{{cantidad_stock}}" maxlength="45" placeholder="Cantidad en inventario"/>
    </section>
    <section>
      <label for="codigo_categoria">Codigo categoria</label>
      <input type="text" {{readonly}} name="codigo_categoria" value="{{codigo_categoria}}" maxlength="45" placeholder="Codigo de categoria"/>
    </section>
    {{if hasErrors}}
        <section>
          <ul>
            {{foreach aErrors}}
                <li>{{this}}</li>
            {{endfor aErrors}}
          </ul>
        </section>
    {{endif hasErrors}}
    <section>
      {{if showaction}}
      <button type="submit" name="btnGuardar" value="G">Guardar</button>
      {{endif showaction}}
      <button type="button" id="btnCancelar">Cancelar</button>
    </section>
  </form>
</section>


<script>
  document.addEventListener("DOMContentLoaded", function(){
      document.getElementById("btnCancelar").addEventListener("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_crudproductos");
      });
  });
</script>