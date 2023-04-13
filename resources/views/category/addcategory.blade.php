@include('layout.header')


<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title">Add Category</h5>
        <hr>
        <div class="form-body mt-4">
            <form action="/CreateCategory" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id" value="@if(isset($catdata)){{$catdata['id']}}@endif">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="inputProductTitle" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" value="@if(isset($catdata)){{$catdata['category_name']}}@endif">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="inputProductTitle" class="form-label">Category Status</label>
                        <select class="form-control" id="category_status" name="category_status" placeholder="Category Status">
                            <option value="">Select Category</option>
                            <option value="1" @if(isset($catdata) && $catdata['category_status']==1){{"selected"}}@endif>Active</option>
                            <option value="0" @if(isset($catdata) && $catdata['category_status']==0){{"selected"}}@endif>In-Active</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                                    
                                    <label for="inputProductDescription" class="form-label">Category Images</label>
                                    <input type="file" class="form-control" name="category_image" id="category_image">
                                </div>
                                <div class="mb-3 row">
                                    @if(isset($catdata))
                                        
                                            <div class="col-md-4 images">
                                            
                                            <img src="{{URL::asset($catdata['image_path'])}}" alt="" style="    width: 240px;
    height: 150px;margin-left:4px;margin-top:20px;"></img>
                                            </div>
                                      
                                    @endif
                                
                                    </div>
                    <div class="col-md-4 mt-4">
                        <button type="submit" name="submitcategory" id="submitcategory" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@include('layout.footer')