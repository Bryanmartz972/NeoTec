<h1>Permisos</h1>

<section class="container-md">
    <h2>Funciones</h2>
<table class="table table-info table-striped">
    <thead>
        <tr>
            <th>Código Función</th>
            <th>Descripción</th>
            <th>Activo</th>
            <th>Type</th>
            <th></th>
    </tr>
    </thead>
    <tbody>
        {{foreach funciones}}
        <tr>
            <td>{{codigo_funcion}}</td>
            <td>{{funcion_descripcion}}</td>
            <td>{{funcion_estado}}</td>
            <td>{{funcion_typ}}</td>
            <td><a href="index.php?page=mnt_categoria&mode=UPD&id={{codigo_funcion}}"><i class="far fa-edit"></i></a></td>
       </tr>
       {{endfor funciones}}
    </tbody>
</table>

<h2>Funciones-Roles</h2>
<table class="table table-info table-striped">
    <thead>
        <tr>
            <th>Código Rol</th>
            <th>Código Función</th>
            <th>Función Rol Estado</th>
            <th>Fecha Expira</th>
            <th><a href="index.php?page=Sec_funcionesroles&mode=INS" class="button"><i class="fas fa-plus"></i></a></th>
        </tr>
    </thead>
    <tbody>
        {{foreach funciones_roles}}
        <tr>    
            <td>{{codigorol}}</td>
            <td>{{codigo_funcion}}</td>
            <td>{{funcion_rol_estado}}</td>
            <td>{{fecha_exp}}</td>
            <td>
                   <a href="index.php?page=Sec_funcionesroles&mode=UPD&id={{codigorol}}&id2={{codigo_funcion}}"><i class="far fa-edit"></i></a>
            </td>
        </tr>
        {{endfor funciones_roles}}
    </tbody>
</table>
</section>