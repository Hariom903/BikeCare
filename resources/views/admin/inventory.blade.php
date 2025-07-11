@extends('layout.app')
@section('main')
    <div class="container">
        <div class="container bg-body p-4 mt-4  mb-4 shadow rounded-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true"> Add Product </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false"> View Product </button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <h3 class="h3 fw-bold p-2 "> Add New Part </h3>
                        <div class="row border pt-3 border-dark  ">
                            <div class="col-sm-4  col-12 mb-3">
                                <label for="name" clsss="form-lable"> Product Name </label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Clutch Plate , Brake Pad " value="">
                                @error('name')
                                    <div class="error"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-sm-4 col-12 mb-3">
                                <label for="category" clsss="form-lable"> Category </label>
                                <input type="text" class="form-control" name="category"
                                    placeholder="Lubricants (Oil, Grease, Coolant) Engine Parts (Piston, Valves) Brake System (Pads, iscs)Transmission Parts (Clutch, Gearbox) Electricals (Battery, Alternator) Accessories (Wipers, Mats)"
                                    value="">
                                @error('category')
                                    <div class="error"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-sm-4 col-12 mb-3">
                                <label for="brand" clsss="form-lable"> Brand </label>
                                <input type="text" class="form-control" name="brand" value="">
                                @error('brand')
                                    <div class="error"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class=" col-12 mb-3">
                                <button class="btn btn-primary"> Add Product </button>
                            </div>
                        </div>
                    </form>


                    <form action="{{ route('productvariant.store') }}" method="POST">
                        @csrf
                        <h3 class="h3 fw-bold pt-4 pb-2  "> Add Product </h3>
                        <div class="row border pt-3 border-dark  ">
                            <div class="col-sm-4  col-12 mb-3">
                                <label for="product_id" clsss="form-lable"> Product </label>
                                <select name="product_id" class="form-control" id="">
                                    <option value="" selected disabled> -Select Product- </option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }} </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="error"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-sm-4 col-12 mb-3">
                                <label for="size_or_type" clsss="form-lable"> Size OR Type </label>
                                <input type="text" class="form-control" name="size_or_type"
                                    placeholder=" 250ml , 1 letter " value="">
                                @error('size_or_type')
                                    <div class="error"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-sm-4 col-12 mb-3">
                                <label for="unit" clsss="form-lable"> Unit </label>
                                <input type="text" class="form-control" name="unit" placeholder="ml,liter, pls "
                                    value="">
                                @error('unit')
                                    <div class="error"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-sm-4 col-12 mb-3">
                                <label for="quantity_in_stock" clsss="form-lable"> Quantiy stock </label>
                                <input type="number" class="form-control" name="quantity_in_stock" placeholder=""
                                    value="">
                                @error('quantity_in_stock')
                                    <div class="error"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-sm-4 col-12 mb-3">
                                <label for="unit_price" clsss="form-lable"> Unit_price </label>
                                <input type="number" class="form-control" name="unit_price" placeholder=""
                                    value="">
                                @error('unit_price')
                                    <div class="error"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-sm-2 col-12 mb-3">
                                <label for="CGST" clsss="form-lable"> CGST </label>
                                <input type="number" class="form-control" name="CGST" placeholder="Enter CGST"
                                    value="{{ old('CGST') }}">
                                @error('CGST')
                                    <div class="error"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-sm-2 col-12 mb-3">
                                <label for="SGST" clsss="form-lable"> SGST </label>
                                <input type="number" class="form-control" name="SGST" placeholder="Enter SGST"
                                    value="{{ old('SGST') }}">
                                @error('SGST')
                                    <div class="error"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class=" col-12 mb-3">
                                <button class="btn btn-primary"> Add Product </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="container bg-body p-4  mb-4 shadow ">
                        <h3> Inventory item list </h3>
                        <table id="inventoryTable" class="table display ">
                            <thead style=" background-color: rgb(69, 3, 75);">
                                <tr>
                                    <th> Id
                                    </th>
                                    <th> product Name
                                    </th>
                                    <th> Category </th>
                                    <th> Brand </th>
                                    <th> Size/Type
                                    </th>
                                    <th>Unit
                                    </th>
                                    <th>Quantiy In Stock
                                    </th>
                                    <th>Unit Price
                                    </th>
                                    <th>CGST
                                    </th>
                                    <th>SGST
                                    </th>

                                    <th> Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($productsvariants as $productsvariant)
                                    <tr>
                                        <td> {{ $productsvariant->id }} </td>
                                        <td> {{ $productsvariant->product->name }} </td>
                                        <td> {{ $productsvariant->product->category }} </td>
                                        <td> {{ $productsvariant->product->brand }} </td>
                                        <td> {{ $productsvariant->size_or_type }} </td>
                                        <td> {{ $productsvariant->unit }} </td>
                                        <td> {{ $productsvariant->quantity_in_stock }} </td>
                                        <td> {{ $productsvariant->unit_price }} </td>
                                        <td> {{ $productsvariant->CGST }} % </td>
                                        <td> {{ $productsvariant->SGST }} % </td>
                                        <td>
                                            <button class="btn btn-primary"
                                                onclick="openEditModal( {{ $productsvariant->id }},'{{ $productsvariant->product->name }}','{{ $productsvariant->product->category }}','{{ $productsvariant->product->brand }}','{{ $productsvariant->size_or_type }}','{{ $productsvariant->unit }}','{{ $productsvariant->quantity_in_stock }}','{{ $productsvariant->unit_price }}',{{ $productsvariant->CGST }},{{ $productsvariant->SGST }})">
                                                Update
                                            </button>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>





        </div>




    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editId">

                        <div class="mb-3">
                            <label>product Name</label>
                            <input type="text" id="editname" readonly class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Category Name</label>
                            <input type="text" id="editcategory" readonly class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Brand Name</label>
                            <input type="text" id="editbrand" readonly class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Size/Type</label>
                            <input type="text" id="editsize_type" readonly class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Unit</label>
                            <input type="text" id="editunit" readonly class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Quantity in Old  stock</label>
                            <input type="text" id="editquantity_in_stock" readonly class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>CGST</label>
                            <input type="text" id="editCGST" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label>SGST</label>
                            <input type="text" id="editSGST" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Quantity in new stock</label>
                            <input type="text" id="addquantity_in_stock"  class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Unit Price</label>
                            <input type="text" id="editunit_price" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="update()" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $('#inventoryTable').DataTable();
        });

 const editModalEl = document.getElementById('editModal');
 const editModal = new bootstrap.Modal(editModalEl);

// Function to open modal & fill data
function openEditModal(id,editname,editcategory,editbrand,editsize_type,editunit,editquantity_in_stock,editunit_price, CGST, SGST) {
       document.getElementById('editId').value = id
       document.getElementById('editname').value = editname
       document.getElementById('editcategory').value = editcategory
       document.getElementById('editbrand').value = editbrand
       document.getElementById('editsize_type').value = editsize_type
       document.getElementById('editunit').value = editunit
       document.getElementById('editquantity_in_stock').value = editquantity_in_stock
       document.getElementById('editunit_price').value = editunit_price
         document.getElementById('editCGST').value = CGST
         document.getElementById('editSGST').value = SGST


  editModal.show();
}

function update(){
    var id = document.getElementById('editId').value;
    var quantity_in_stock =  document.getElementById('addquantity_in_stock').value;
   var  unit_price= document.getElementById('editunit_price').value;

    $.ajax({
       url:"{{ route('productvariant.update') }}",
       type:"POST",
       data:{
         '_token': '{{ csrf_token() }}',
         'id':id,
         'quantity_in_stock':quantity_in_stock,
         'unit_price':unit_price
       },
        success:(res)=>{
      console.log(res);
               if (res['success']) {


                        editModal.hide();
                        window.location.reload();


                    }
        },
        error: (xhr, status, error) => {

        var errors = xhr.responseJSON.errors;
        console.log(errors);

        }

   });
}

    </script>
@endsection
