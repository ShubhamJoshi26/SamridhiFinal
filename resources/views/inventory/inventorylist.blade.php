@include('layout.header')

@include('layout.alert')
@php use App\Models\Product; @endphp
<div class="card">
    <div class="col-md-12">
        <a href="/Inventory/AddInventory" style="float: right;margin-right: 20px;"><button class="btn btn-primary mt-3" type="button">Add Inventory</button></a>
    </div>
    <div class="card-body p-4">
        <div class="table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($inventory))
                        @foreach($inventory as $inventorylist)
                            <tr>
                                <td>{{$inventorylist['id']}}</td>
                                <td>@php $productname = Product::find($inventorylist['product_id'])->toArray();@endphp
                                    {{$productname['name']}}
                                </td>
                                <td>{{$inventorylist['stock']}}</td>
                                <td><a href="/Inventory/AddInventory?iid={{$inventorylist['id']}}"><i class="icofont-ui-edit" style="color: blue;font-weight: bolder;cursor: pointer;"></i></a><a href="/Inventory/Delete?iid={{$inventorylist['id']}}"><i class="icofont-ui-delete" style="color: red;font-weight: bolder;cursor: pointer;margin-left: 15px;"></i></a></td>

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