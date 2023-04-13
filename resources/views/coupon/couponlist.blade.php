@include('layout.header')

@include('layout.alert')

<div class="card">
    <div class="col-md-12">
        <a href="/Coupons/AddCoupons"><button class="btn btn-primary" type="button">Add Coupon</button></a>
    </div>
    <div class="card-body p-4">
        <div class="table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Coupon Name</th>
                        <th>Coupon Code</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($coupon))
                        @foreach($coupon as $couponlist)
                            <tr>
                                <td>{{$couponlist['id']}}</td>
                                <td>{{$couponlist['name']}}</td>
                                <td>{{$couponlist['code']}}</td>
                                <td>{{$couponlist['discount']}}</td>
                                @if($couponlist['status']=='1')
                                <td>Active</td>
                                @else
                                <td>In-Active</td>
                                @endif
                                <td><a href="/Coupons/AddCoupons?cid={{$couponlist['id']}}"><i class="icofont-ui-edit" style="color: blue;font-weight: bolder;cursor: pointer;"></i></a><a href="/Coupon/Delete?cid={{$couponlist['id']}}"><i class="icofont-ui-delete" style="color: red;font-weight: bolder;cursor: pointer;margin-left: 15px;"></i></a></td>

                              </tr>
                        @endforeach
                        @else
                        <tr>
                                <td colspan="6">No Data Found</td>
                            </tr>
                    @endif
                    
                </tbody>
            </table>
           
        </div>
    </div>
</div>




@include('layout.footer')