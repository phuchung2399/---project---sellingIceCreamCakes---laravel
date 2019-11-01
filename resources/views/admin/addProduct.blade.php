<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style type="text/css">
    </style>
</head>

<body>
    <div class="container">
        <center>
            <h2 class="page-header"> Add Product</h2>
        </center>
        <a href="{!! url('admin/') !!}"><i class="fa fa-plus-circle"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <form method="post" action="{{ URL::action('ProductController@postAdd') }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" placeholder="Nhập tên sản phẩm..." name="txtname">
                </div>
            </div>

             <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="name">description:</label>
                    <input type="text" class="form-control" placeholder="Nhập tên sản phẩm..." name="txtname">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="price">unit_price:</label>
                    <input onkeypress='return event.charCode >= 48 && event.charCode <=57' type="text" class="form-control" placeholder="Nhập giá sản phẩm..." name="txtprice">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="promotion price">promotion_price:</label>
                    <input onkeypress='return event.charCode >= 48 && event.charCode <=57' type="text" class="form-control" placeholder="Nhập giá khuyến mãi sản phẩm..." name="txtoldprice">
                </div>
            </div>

             <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="image">Image:</label>
                    <input type="file" name="txtimage">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" placeholder="Nhập tên mã..." name="txtcode">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="danhmuc">id_type</label>
                    <select class="form-control" name="id_categories" id="id_categories">
                        <option value="">Mời bạn chọn:</option>
                        <!-- $category trong hàm getAdd của file ProductsController -->
                        @foreach($category as $cate)
                        <option value="{!! $cate['id']!!}">{!! $cate['name'] !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- button add -->
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success" style="margin-left: 15px">Add Product</button>
                </div>
            </div>
            <!-- /butto add -->
        </form>
    </div>
</body>

</html>