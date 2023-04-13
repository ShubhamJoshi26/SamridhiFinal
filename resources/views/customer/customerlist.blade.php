@include('layout.header')

@include('layout.alert')

<div class="card">
    <div class="col-md-12">
        <a href="/Customer/AddCustomers"><button class="btn btn-primary" type="button">Add Customers</button></a>
    </div>
    <div class="card-body p-4">
        <div class="table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Email Id</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($customers))
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{$customer['id']}}</td>
                                <td>{{$customer['name']}}</td>
                                <td>{{$customer['mobileno']}}</td>
                                <td>{{$customer['emailid']}}</td>
                                <td><a href="/Customer/EditCustomer?id={{$customer['id']}}"><i class="icofont-ui-edit" style="color: blue;font-weight: bolder;cursor: pointer;"></i></a><a href="/Customer/Delete?id={{$customer['id']}}"><i class="icofont-ui-delete" style="color: red;font-weight: bolder;cursor: pointer;margin-left: 15px;"></i></a></td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                                <td colspan="4">No Data Found</td>
                            </tr>
                    @endif
                    
                </tbody>
            </table>
           
        </div>
    </div>
</div>

@include('layout.footer')