<?php include("insert_probun_functions.php"); ?>




<div class="card mb-4">
    <h5 class="card-header">Insert Product</h5>
    <form class="card-body form-horizontal" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
            <h6>1. Product Details</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="product_title">Product Title</label>
                    <input type="text" id="product_title" class="form-control" name="product_title" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="product_url">Product Url</label>
                    <input type="text" id="product_url" class="form-control" name="product_url" required>
                    <p style="font-size:15px; font-weight:bold;">Product Url Example: navy-blue-t-shirt</p>
                </div>
            </div>

            <hr class="my-4 mx-n4">
            <h6>2. Manufacturer, Product and Category</h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="manufacturer">Manufacturer</label>
                    <select name="manufacturer" class="form-control">
                        <option>Select a Manufacturer</option>
                        <?php echo consultarManufacturers($con); ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label name"p_cat" class="form-label">Product Category</label>
                    <select name="product_cat" class="form-control">
                        <option>Select a Product Category</option>
                        <?php echo consultarProductCategories($con); ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="cat">Category</label>
                    <select name="cat" class="form-control">
                        <option>Select a Category</option>
                        <?php echo consultarCategorias($con); ?>
                    </select>
                </div>
            </div>

            <hr class="my-4 mx-n4">
            <h6>3. Product Images</h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="product_img1">Product Image 1</label>
                    <input type="file" id="product_img1" class="form-control" name="product_img1" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="product_img2">Product Image 2</label>
                    <input type="file" id="product_img2" class="form-control" name="product_img2" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="product_img3">Product Image 3</label>
                    <input type="file" id="product_img3" class="form-control" name="product_img3" required>
                </div>
            </div>

            <hr class="my-4 mx-n4">
            <h6>4. Product Price, Product Sale Price and Product Keywords</h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="product_price">Product Price</label>
                    <input type="text" id="product_price" class="form-control" name="product_price" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="psp_price">Product Sale Price</label>
                    <input type="text" id="psp_price" class="form-control" name="psp_price" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="product_keywords">Product Keywords</label>
                    <input type="text" id="product_keywords" class="form-control" name="product_keywords" required>
                </div>
            </div>

            <hr class="my-4 mx-n4">
            <h6>5. Product Color, Size, Quantity</h6>
            <!-- Agrega este bloque de código donde quieras mostrar los campos dinámicos de color, talla y cantidad en tu formulario -->
            <div class="form-group" id="dynamic_fields">
                <div class="input-group">
                <div class="col-md-12">
                        <div class="field-container row">
                            <div class="col-md-4">
                                <label class="form-label" for="colors">Color</label>
                                <select class="form-control" name="colors[]">
                                    <option>Select A Color</option>
                                    <?php echo obtenerColores($con); ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="sizes">Sizes</label>
                                <select class="form-control" name="sizes[]">
                                    <option>Select A Size</option>
                                    <?php echo obtenerTallas($con); ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="quantities">Quantity</label>
                                <input type="text" name="quantities[]" class="form-control" placeholder="Quantity" required>
                            </div>
                        <div class="col-md-1"><br>
                                <button class="btn btn-info add-field" type="button">
                                    <i class="ti ti-shopping-cart-plus"></i> +
                                </button>
                        </div>
                        </div>

                    </div>
                </div>
            </div>


            <hr class="my-4 mx-n4">
            <h6>6. Product Tabs</h6>
            <div class="card text-center mb-3">
                <div class="card-header pt-1">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#description" aria-controls="description" aria-selected="true">
                                Description
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#features" aria-controls="features" aria-selected="false" tabindex="-1">
                                Features
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#video" aria-controls="video" aria-selected="false" tabindex="-1">
                                Video
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body pt-3">
                    <div class="tab-content p-0">
                        <div id="description" class="tab-pane fade show active" role="tabpanel">
                            <br>
                            <textarea name="product_desc" class="form-control" rows="5 id="product_desc"></textarea>
                        </div>
                        <div id="features" class="tab-pane fade" role="tabpanel">
                            <br>
                            <textarea name="product_features" class="form-control" rows="5" id="product_features"></textarea>
                        </div>
                        <div id="video" class="tab-pane fade" role="tabpanel">
                            <br>
                            <textarea name="product_video" class="form-control" rows="5" id="product_video"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4 mx-n4">
            <h6>7.  Product Label</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="product_label">Product Label</label>
                    <input type="text" id="product_label" class="form-control" name="product_label"
                           required>
                </div>
                <div class="col-md-6" >
                    <label class="form-label" for="update">Insert</label>
                    <input type="submit" name="submit" value="Insert Product" class="btn btn-primary form-control" >
                </div>
            </div>
</form>
</div>
</div>




<!-- Agrega este bloque de código donde quieras mostrar los campos dinámicos de color, talla y cantidad en tu formulario -->
<!-- Script para manejar campos dinámicos -->
<script>
    $(document).ready(function () {
        var max_fields = 10; // Máximo número de campos permitidos
        var wrapper = $("#dynamic_fields"); // Contenedor de campos

        var x = 1; // Inicial contador de campos

        $(wrapper).on("click", ".add-field", function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                var newField = $(`
                <br>

                    <div class="field-container row">
                        <div class="col-md-4">
                            <select class="form-control" name="colors[]">
                                <option>Select A Color</option>
                                <?php echo obtenerColores($con); ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select class="form-control" name="sizes[]">
                                <option>Select A Size</option>
                                <?php echo obtenerTallas($con); ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="quantities[]" class="form-control" placeholder="Quantity" required>
                        </div>

                        <div class="col-md-1">
                            <button class="btn btn-danger remove-field" type="button">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                    </div>
                `);
                $(wrapper).append(newField);
            }
        });

        $(wrapper).on("click", ".remove-field", function (e) {
            e.preventDefault();

            // Obtener el contenedor actual
            var container = $(this).closest('.field-container');

            // Obtener el elemento <br> anterior al contenedor
            var previousBr = container.prev('br');

            // Eliminar ambos, el contenedor y el <br>
            container.remove();
            previousBr.remove();

            x--;
        });

    });
</script>


<?php

if(isset($_POST['submit'])){

$product_title = $_POST['product_title'];
$product_cat = $_POST['product_cat'];
$cat = $_POST['cat'];
$manufacturer_id = $_POST['manufacturer'];
$product_price = $_POST['product_price'];
$product_desc = $_POST['product_desc'];
$product_keywords = $_POST['product_keywords'];

$psp_price = $_POST['psp_price'];

$product_label = $_POST['product_label'];

$product_url = $_POST['product_url'];

$product_features = $_POST['product_features'];

$product_video = $_POST['product_video'];

$product_color = $_POST['product_color']; // Nuevo campo para el color



    $status = "product";

$product_img1 = $_FILES['product_img1']['name'];
$product_img2 = $_FILES['product_img2']['name'];
$product_img3 = $_FILES['product_img3']['name'];

$temp_name1 = $_FILES['product_img1']['tmp_name'];
$temp_name2 = $_FILES['product_img2']['tmp_name'];
$temp_name3 = $_FILES['product_img3']['tmp_name'];

move_uploaded_file($temp_name1,"product_images/$product_img1");
move_uploaded_file($temp_name2,"product_images/$product_img2");
move_uploaded_file($temp_name3,"product_images/$product_img3");

$insert_product = "insert into products (p_cat_id,cat_id,manufacturer_id,date,product_title,product_url,product_img1,product_img2,product_img3,product_price,product_psp_price,product_desc,product_features,product_video,product_keywords,product_label,status) values ('$product_cat','$cat','$manufacturer_id',NOW(),'$product_title','$product_url','$product_img1','$product_img2','$product_img3','$product_price','$psp_price','$product_desc','$product_features','$product_video','$product_keywords','$product_label','$status')";

$run_product = mysqli_query($con,$insert_product);

// Inserta los colores, tallas y cantidades en la tabla de productos
insertTallasColoresCantidad($con);


if($run_product){

echo "<script>alert('Product has been inserted successfully')</script>";

echo "<script>window.open('index.php?view_products','_self')</script>";

}

}

?>
