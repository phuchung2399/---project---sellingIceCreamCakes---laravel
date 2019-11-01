<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>

</head>
<body>
	<div class="container">
		<center><h1 >Manage</h1></center>
		<hr style="border: 15px solid 005fbf; border-radius: 5px;" />

		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#Product">Sản phẩm</a></li>
			<li><a data-toggle="tab" href="#slide">Slide</a></li>
			<li><a data-toggle="tab" href="#bills">Hóa Đơn</a></li>
			<li><a data-toggle="tab" href="#BillDetail">Hóa Đơn Chi Tiết</a></li>
			<li><a data-toggle="tab" href="#user">User</a></li>
			<li><a data-toggle="tab" href="#new">New</a></li>
		</ul>
		<div class="tab-content">
			<!-- tab 1 -->
    		<div id="Product" class="tab-pane fade in active">
				<div class="border border-success">
					<a href="{!! url('/add') !!}"><i class="fa fa-plus-circle"></i>&nbsp;Add Product</a>&nbsp;&nbsp;
				</div>
				<hr>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
					<table class="table table-striped table-bordered table-hover">
	                    <thead>
	                      	<tr class="bg-success text-white">
	                        	<th>Name</th>
                                <th>id_type</th>
                                <th>Description</th>
                                <th>Unit_price</th>
                                <th>Promotion_price</th>
                                <th>Image</th>
                                <th>Unit</th>
                                <th>New</th>
	                        	<th style="width: 20%">Action</th>
	                      	</tr>
                        </thead>
                     
	                    <tbody>
	                    @foreach($products as $value)
	                      	<tr>
                                <td> {!! $value["name"] !!} </td>
                                <td> {!! $value["id_type"] !!} </td>
                                <td> {!! $value["description"] !!} </td>
                                <td> {!! $value["unit_price"] !!} </td>
                                <td> {!! $value["promotion_price"] !!} </td>
                                <td>
		                        	<img src="{!! asset('source/image/product/'.$value["image"]) !!}" width="100" alt="{!! $value["name"] !!}">
                                </td>
                                <td>{!! $value["unit"] !!}</td>
                                <td>{!! $value["new"] !!}</td>
		                        <td>
		                        	<a href="{!! url('update',$value["id"]) !!}"><i class="fa fa-pencil"></i>&nbsp;Update</a>&nbsp;&nbsp;
		                          	<a href="{{ route('Product.getDeleteProduct',$value["id"]) }}" ><i class="fa fa-trash"></i>&nbsp;Delete</a>
		                        </td>
	                      	</tr>
                      	@endforeach
	                    </tbody>
					  </table>
			</div>	
		</div>	
	</div>	
<!--- -->
		<div id="slide" class="tab-pane fade in active">
				<div class="border border-success">
					<a href="{!! url('/add') !!}"><i class="fa fa-plus-circle"></i>&nbsp;Add Slide</a>&nbsp;&nbsp;
                </div>

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
					<table class="table table-striped table-bordered table-hover">
	                    <thead>
	                      	<tr class="bg-success text-white">
	                        	<th>Id</th>
                                <th>Image</th>
	                        	<th style="width: 20%">Action</th>
	                      	</tr>
                        </thead>
                     
	                    <tbody>
	                    @foreach($slide as $value)
	                      	<tr>
                                <td> {!! $value["id"] !!} </td>
                                <td>
		                        	<img src="{!! asset('source/image/slide/'.$value["image"]) !!}" width="100">
                                </td>          
		                        <td>
		                        	<a href="{!! url('/update',$value["id"]) !!}"><i class="fa fa-pencil"></i>&nbsp;Update</a>&nbsp;&nbsp;
		                          	<a href="{{ route('Product.getDeleteSlide',$value["id"]) }}"><i class="fa fa-trash"></i>&nbsp;Delete</a>
		                        </td>
	                      	</tr>
                      	@endforeach
	                    </tbody>
                  	</table>
				</div>
			</div>
		</div> <!-- -->

		<!-- tab 3 -->
		<div id="user" class="tab-pane fade in active">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
					<table class="table table-striped table-bordered table-hover">
	                    <thead>
	                      	<tr class="bg-success text-white">
	                        	<th>ID</th>
                                <th>Full name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Addree</th>
	                        	<th style="width: 20%">Action</th>
	                      	</tr>
                        </thead>
                     
	                    <tbody>
	                    @foreach($user as $value)
	                      	<tr>
                                <td> {!! $value["id"] !!} </td>
                                <td> {!! $value["full_name"] !!} </td>
                                <td> {!! $value["email"] !!} </td>
                                <td> {!! $value["phone"] !!} </td>
                                <td> {!! $value["address"] !!} </td>
		                        <td>
		                        	<a href="{!! url('/update',$value["id"]) !!}"><i class="fa fa-pencil"></i>&nbsp;Update</a>&nbsp;&nbsp;
		                          	<a href="{{ route('Product.getDeleteUser',$value["id"]) }}"><i class="fa fa-trash"></i>&nbsp;Delete</a>
		                        </td>
	                      	</tr>
                      	@endforeach
	                    </tbody>
                  	</table>
				</div>
			</div>
		</div>

		<!-- tab 1 -->
		<div id="bills" class="tab-pane fade in active">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
					<table class="table table-striped table-bordered table-hover">
	                    <thead>
	                      	<tr class="bg-success text-white">
	                        	<th>id</th>
                                <th>id_customer</th>
                                <th>date_order</th>
                                <th>total</th>
                                <th>payment</th>
                                <th>note</th>
	                        	<th style="width: 20%">Action</th>
	                      	</tr>
                        </thead>
                     
	                    <tbody>
	                    @foreach($bill as $value)
	                      	<tr>
                                <td> {!! $value["id"] !!} </td>
                                <td> {!! $value["id_customer"] !!} </td>
                                <td> {!! $value["date_order"] !!} </td>
                                <td> {!! $value["total"] !!} </td>
                                <td> {!! $value["payment"] !!} </td>
                                <td>{!! $value["note"] !!}</td>                   
		                        <td>
		                        	<a href="{!! url('/update',$value["id"]) !!}"><i class="fa fa-pencil"></i>&nbsp;Update</a>&nbsp;&nbsp;
		                          	<a href="{{ route('Product.getDeleteBill',$value["id"]) }}"><i class="fa fa-trash"></i>&nbsp;Delete</a>
		                        </td>
	                      	</tr>
                      	@endforeach
	                    </tbody>
                  	</table>
				</div>
			</div>
		</div>
<!--- -->

<!-- tab 1 -->
<div id="BillDetail" class="tab-pane fade in active">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
					<table class="table table-striped table-bordered table-hover">
	                    <thead>
	                      	<tr class="bg-success text-white">
	                        	<th>id</th>
                                <th>id_bill</th>
                                <th>id_product</th>
                                <th>quantity</th>
                                <th>unit_price</th>
	                        	<th style="width: 20%">Action</th>
	                      	</tr>
                        </thead>
                     
	                    <tbody>
	                    @foreach($BillDetail as $value)
	                      	<tr>
                                <td> {!! $value["id"] !!} </td>
                                <td> {!! $value["id_bill"] !!} </td>
                                <td> {!! $value["id_product"] !!} </td>
                                <td> {!! $value["quantity"] !!} </td>
                                <td> {!! $value["unit_price"] !!} </td>                
		                        <td>
		                        	<a href="{!! url('/update',$value["id"]) !!}"><i class="fa fa-pencil"></i>&nbsp;Update</a>&nbsp;&nbsp;
		                          	<a href="{{ route('Product.getDeleteBillDetail',$value["id"]) }}"><i class="fa fa-trash"></i>&nbsp;Delete</a>
		                        </td>
	                      	</tr>
                      	@endforeach
	                    </tbody>
                  	</table>
				</div>
			</div>
		</div>

		<!-- tab new -->
<div id="new" class="tab-pane fade in active">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
			<div class="border border-success">
					<a href="{!! url('/add') !!}"><i class="fa fa-plus-circle"></i>&nbsp;Add New</a>&nbsp;&nbsp;
				</div>
				<hr>
					<table class="table table-striped table-bordered table-hover">
	                    <thead>
	                      	<tr class="bg-success text-white">
	                        	<th>id</th>
                                <th>title</th>
                                <th>content</th>
                                <th>image</th>
	                        	<th style="width: 20%">Action</th>
	                      	</tr>
                        </thead>

	                    <tbody>
	                    @foreach($News as $value)
	                      	<tr>
                                <td> {!! $value["id"] !!} </td>
                                <td> {!! $value["title"] !!} </td>
                                <td> {!! $value["content"] !!} </td>
								<td>
		                        	<img src="{!! asset('source/image/new/'.$value["image"]) !!}" width="100" !!}">
                                </td>      
		                        <td>
		                        	<a href="{!! url('/update',$value["id"]) !!}"><i class="fa fa-pencil"></i>&nbsp;Update</a>&nbsp;&nbsp;
		                          	<a href="{{ route('Product.getDeleteNew',$value["id"]) }}"><i class="fa fa-trash"></i>&nbsp;Delete</a>
		                        </td>
	                      	</tr>
                      	@endforeach
	                    </tbody>
                  	</table>
				</div>
			</div>
		</div>
<!--- -->
		

		</div><!-- /.tab-content-->
	</div>

</div><!-- /.row -->
</div><!-- /.container -->
</body>
</html>