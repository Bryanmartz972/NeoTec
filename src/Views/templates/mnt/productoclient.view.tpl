<h1 class="text-center">Productos</h1>


<section class="container-md d-flex  ">
        <div class="d-flex row justify-content-center flex-wrap">
            {{foreach productos}}
            <div class="card col-sm-3 m-1" style="">
                <img class="card-img-top img-fluid" name="uri_img" value="" src="{{uri_img}}" alt="Card image cap"/>
                <div class="card-body">
                    <h4 class="card-title">{{nombre_producto}}</h4>
                    <p class="card-text">{{descripcion_producto}}</p>
                    
                </div>
                <form action="index.php?page=mnt_Catalogo" method="POST">
                    <div class="d-flex justify-content-center">
                        <label for="cantidad">Cantidad:   </label>
                        <input type="number" class="col-sm-2 " name="cantidad" id="cantidad"  value="" />
                    </div>
                <input type="hidden" name="codigo_producto" value="{{codigo_producto}}"/>
                 <input type="hidden" name="precio" value="{{precio}}"/>
                 <input type="hidden" name="cantidad_stock" value="{{cantidad_stock}}"/>
                 <button name="btnComprar" id="btnComprar" style="background-color: #2DA89C; border:none;" class="btn btn-primary m-4"   type="submit" >Comprar</button>
                 <a name="btnPrecio" id="btnPrecio"   class="btn btn-primary m-4"  href="#" role="button" style="background-color: #1D0031; border:none; color:#fff;" name="precio"><i class="fas fa-money-check-alt" ></i> {{precio}}</a>
                
                </form>
            </div>
            {{endfor productos}}
        </div>
        
</section>





