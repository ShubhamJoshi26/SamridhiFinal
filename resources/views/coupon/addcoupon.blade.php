@include('layout.header')

@include('layout.alert')

<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title">Add Category</h5>
        <hr>
        <div class="form-body mt-4">
            <form action="/CreateCoupon" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id" value="@if(isset($coupon)){{$coupon['id']}}@endif">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="inputProductTitle" class="form-label">Coupon Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" value="@if(isset($coupon)){{$coupon['name']}}@endif">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="inputProductTitle" class="form-label">Coupon Code</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Category Name" value="@if(isset($coupon)){{$coupon['code']}}@endif">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="inputProductTitle" class="form-label">Coupon Discount</label>
                        <input type="text" class="form-control" id="discount" name="discount" placeholder="Category Name" value="@if(isset($coupon)){{$coupon['discount']}}@endif">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="inputProductTitle" class="form-label">Category Status</label>
                        <select class="form-control" id="status" name="status" placeholder="Category Status">
                            <option value="">Select Category</option>
                            <option value="1" @if(isset($coupon) && $coupon['status']==1){{"selected"}}@endif>Active</option>
                            <option value="0" @if(isset($coupon) && $coupon['status']==0){{"selected"}}@endif>In-Active</option>
                        </select>
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