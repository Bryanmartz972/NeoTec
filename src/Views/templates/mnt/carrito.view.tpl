
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<body class="bg-info p-2"  style="--bs-bg-opacity: .10;">
<h1 style="text-align:center;border:1px dotted #000; padding:8px;font: oblique bold 120% cursive;  background-color: #1F77B8; color: white;"><i class="fas fa-shopping-cart"></i> Bienvenido Al Carrito de Compras <i class="fas fa-shopping-cart"></i></h1>
<input type="hidden" name="token" value="{{carrito_xss_token}}"/>
<br>
<h2 style="text-align:center;"> Detalle De Compra</h2>

<section class="d-flex flex-row m-5 flex-wrap justify-content-around " style="height: 100vh;">
    <div class="">
         <table class="table table-bordered" style="width: 1000px; color:1D0031; ">
             <thead class="">
                 <tr>
                     
                     <th>Producto</th>
                     <th>Código</th>
                     <th>Nombre</th>
                     <th>Precio</th>
                     <th>Cantidad</th>
                   
                     <th>Delete</th>

                 </tr>
             </thead>
             <tbody>
                 {{foreach cart}}
                 <tr>
                     
                     <td><img src="{{uri_img}}" alt="{{nombre_producto}} " style="width: 100px; height:100px; "/></td>
                     <td>{{codigo_producto_c}}</td>
                     <td>{{nombre_producto}}</td>
                     <td>{{precio}}</td>
                     <td>{{cantidad}}</td>
                     
                    
                     <td>
                        <form action="index.php?page=mnt_carrito" method="POST">
                            <input type="hidden" value="{{codigo_producto_c}}" name="codigo_producto_c"/>
                        <button name="BtnDelete" onclick="" id="BtnDelete" type="submit" class="btn btn-light shadow-md"><i class="far fa-trash-alt m-2" style="color:#F8485E; font-size:24px;"></i></button>
                       </form>
                     </td>
                     
                 </tr>
                 {{endfor cart}}
             </tbody>
         </table>
           
     
    </div>
   
 
    <!--Pago-->
    <div class="">
        
        <div class="card border-primary mb-3" style="width: 400px;">
            <h2 class="text-center m-3"> Neotec Pre-Receipt</h2>
            <form action="index.php?page=checkout_checkout" method="POST">
               <div class="m-3">
                    <label for="txtSubtotal">Subtotal</label>
                    <input class="m-2 " type="text" value="{{suma}}" readonly disabled/>
               </div>
               <div class="m-3">
                    <label for="txtImpuesto">ISV</label>
                    <input class="m-2 " type="text" value="{{isv}}" readonly disabled/>
               </div>
               <div class="m-3">
                    <label for="txtTotal">Total</label>
                    <input class="m-2 " type="text" value="{{total}}" readonly disabled/>
               </div>
               <div >
                   <div class="d-flex justify-content-center ">
                     
                          <button type="submit" name="btnPagar"  id="btnPagar" class="bbtn btn-info btn-lg">Pagar</button>
                    
                   </div>
               </div>
              
            </form>
              
        </div>
    </div>
  
</section>
</body>
<!-- <button type="submit" name="btnPagar"  id="btnPagar" class="btn btn-outline-warning w-25 mt-3 mb-3">Pagar</button>-->
<!--<script src="https://www.paypal.com/sdk/js?client-id={{PAYPAL_CLIENT_ID}}"></script>
        <script>paypal.Buttons().render('#btnPagar');</script>
    
    <script>paypal.Buttons({
    createOrder:function(data,actions){
        return actions.order.create({
            purchase_units:[{
                amount:{
                    value:'0.1'
                }
            }]
        });
    },
    onApprove:function(data, actions){
        return actions.order.capture().then(function(details){
            console.log(details);});
    }
}).render('#btnPagar');</script> -->