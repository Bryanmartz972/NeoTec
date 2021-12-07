<h1>Listado de Categorias para el Index</h1>
<section class="m-4">
<table class="table table-info table-striped">
  <thead>
    <tr>
          <th>#</th>
          <th>Categoria</th>
          <th class="hidden-s">Descripción</th>
          <th><a href="index.php?page=mnt_categoria&mode=INS" class="button"><i class="fas fa-plus"></i></a></th>
    </tr>
  </thead>
  <tbody>
    {{foreach categorias}}
    <tr>
      <td>{{codigo_categoria}}</td>
      <td><a href="index.php?page=mnt_categoria&mode=DSP&id={{codigo_categoria}}">{{nombre_categoria}}</a></td>
      <td class="hidden-s">{{descripcion_categoria}}</td>
      <td class="center">
        <a href="index.php?page=mnt_categoria&mode=UPD&id={{codigo_categoria}}"><i class="far fa-edit"></i></a>
        &nbsp;
        <a href="index.php?page=mnt_categoria&mode=DEL&id={{codigo_categoria}}"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>
    {{endfor categorias}}

  </tbody>
</table>
</section>