<h1>Gestión de Ventas de NeoTec</h1>
<section class="WWFilter">

</section>
<section class="WWList">
  <table >
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Usuario</th>
        <th>Fecha de creación</th>
        <th>Fecha de expiración</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      {{foreach items}}
      <tr>
        <td>{{codigo_carrito}}</td>
        <td><a >{{codigo_usuario}}</a></td>
        <td><a >{{fechaCreado}}</a></td>
        <td><a >{{fechaExpira}}</a></td>
        <td><a >{{estado}}</a></td>
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