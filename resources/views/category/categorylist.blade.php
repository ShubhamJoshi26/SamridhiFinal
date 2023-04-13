@include('layout.header')

@include('layout.alert')

<div class="card">
    <div class="col-md-12">
        <a href="/Category/AddCategory"><button class="btn btn-primary" type="button">Add Category</button></a>
    </div>
    <div class="card-body p-4">
        <div class="table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category Name</th>
                        <th>Category Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($category))
                        @foreach($category as $cat)
                            <tr>
                                <td>{{$cat['id']}}</td>
                                <td>{{$cat['category_name']}}</td>
                                @if($cat['category_status']=='1')
                                <td>Active</td>
                                @else
                                <td>In-Active</td>
                                @endif
                                <td><a href="/Category/EditCategory?id={{$cat['id']}}"><i class="icofont-ui-edit" style="color: blue;font-weight: bolder;cursor: pointer;"></i></a><a href="/Category/Delete?id={{$cat['id']}}"><i class="icofont-ui-delete" style="color: red;font-weight: bolder;cursor: pointer;margin-left: 15px;"></i></a></td>
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