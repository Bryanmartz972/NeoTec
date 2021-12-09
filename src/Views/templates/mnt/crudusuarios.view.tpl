<h1 class="bg-dark text-white">Gestión de Ventas de NeoTec</h1>
<section class="WWFilter">

</section>
<section class="WWList">
  <table class="table table-dark table-striped table-bordered table-hover">
    <thead  class="thead-dark">
      <tr>
        <th>Codigo</th>
        <th>Usuario</th>
        <th>Correo electronico</th>
        <th>Fecha de creacion</th>
        <th>Estado</th>
        <th>Estado de contraseña</th>
      </tr>
    </thead>
    <tbody>
      {{foreach items}}
      <tr>
        <td>{{codigo_usuario}}</td>
        <td><a >{{nombre_usuario}}</a></td>
        <td><a >{{correo_electronico}}</a></td>
        <td><a >{{fecha_creacion}}</a></td>
        <td><a >{{estado}}</a></td>
        <td><a >{{password_estado}}</a></td>
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