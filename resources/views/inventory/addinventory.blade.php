@include('layout.header')

@include('layout.alert')

                                    
<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title">Add Category</h5>
        <hr>
        <div class="form-body mt-4">
            <form action="/CreateInventory" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id" value="@if(isset($inventory)){{$inventory['id']}}@endif">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="inputProductTitle" class="form-label">Product</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Category Name" value="@if(isset($productname)){{$productname}}@endif">
                        <input type="hidden" class="form-control" id="product_id" name="product_id" placeholder="Category Name" value="@if(isset($inventory)){{$inventory['product_id']}}@endif">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="inputProductTitle" class="form-label">Stock</label>
                        <input type="text" class="form-control" id="stock" name="stock" placeholder="Category Name" value="@if(isset($inventory)){{$inventory['stock']}}@endif">
                    </div>
                    <div class="col-md-4 mt-4">
                        <button type="submit" name="submitcoupon" id="submitcoupon" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




@include('layout.footer')