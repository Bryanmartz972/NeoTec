<h1>Gestión de Productos</h1>
<section class="WWFilter">

</section>
<section class="WWList">
  <table >
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Producto</th>
        <th>Descripcion</th>
        <th>Precio</th>
        <th>Inventario</th>
        <th>Categoria</th>
        <th>
          {{if new_enabled}}
          <button id="btnAdd">Nuevo</button>
          {{endif new_enabled}}
        </th>
      </tr>
    </thead>
    <tbody>
      {{foreach items}}
      <tr>
        <td>{{codigo_producto}}</td>
        <td><a >{{nombre_producto}}</a></td>
        <td><a >{{descripcion_producto}}</a></td>
        <td><a >{{precio}}</a></td>
        <td><a >{{cantidad_stock}}</a></td>
        <td><a >{{codigo_categoria}}</a></td>
        <td>
          {{if ~edit_enabled}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_crudproducto"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="codigo_producto" value={{codigo_producto}} />
              <button type="submit">Editar</button>
          </form>
          {{endif ~edit_enabled}}
          {{if ~delete_enabled}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_crudproducto"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="codigo_producto" value={{codigo_producto}} />
              <button type="submit">Eliminar</button>
          </form>
          {{endif ~delete_enabled}}
        </td>
      </tr>
      {{endfor items}}
    </tbody>
  </table>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_crudproducto&mode=INS&codigo_producto=0");
      });
    });
</script>