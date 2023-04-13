@include('layout.header')

<div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Products</h3>
                                <div class="btn-group group-link btn-set-task w-sm-100">
                                    <a href="product-grid.html" class="btn d-inline-flex align-items-center" aria-current="page"><i class="icofont-wall px-2 fs-5"></i>Grid View</a>
                                    <a href="product-list.html" class="btn active d-inline-flex align-items-center"><i class="icofont-listing-box px-2 fs-5"></i> List View</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card mb-3 bg-transparent p-2">
                                <div class="card border-0 mb-1">
                                    <!-- <div class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
                                        <input class="form-check-input" type="checkbox" id="Eaten-switch1" checked="">
                                        <label class="form-check-label" for="Eaten-switch1">Add to Cart</label>
                                    </div> -->
                                    @if(isset($products))  
                                        @foreach($products as $key=>$product)
                                        <div class="card-body d-flex align-items-center flex-column flex-md-row">
                                        <a href="/Product/AddProduct?pid={{$key}}">
                                            <img class="w120 rounded img-fluid" src="{{URL::asset($product[0]['image_path'])}}" alt="">
                                        </a>
                                        <div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
                                            <a href="/Product/AddProduct?pid={{$key}}"><h6 class="mb-3 fw-bold">{{$product[0]['name']}}<span class="text-muted small fw-light d-block">{{$product[0]['title']}}</span></h6></a>
                                                <div class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
                                                    <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                                                        <div class="text-muted small">Stock</div>
                                                        <strong>{{$product[0]['inventory']}}</strong>
                                                    </div>
                                                    <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                                                        <div class="text-muted small">Category</div>
                                                        <strong>{{$product[0]['category']}}</strong>
                                                    </div>
                                                    <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                                                        <div class="text-muted small">Price</div>
                                                        <strong>{{$product[0]['price']}}</strong>
                                                    </div>
                                                    <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                                                        <div class="text-muted small">Visibility</div>
                                                        <strong>{{$product[0]['visibility']}}</strong>
                                                    </div>
                                                </div>
                                                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
                                                    <button type="button" class="btn btn-primary">Add Cart</button>
                                                </div>
                                        </div>
                                    </div>

                                        @endforeach
                                        @else
                                        <div class="card-body d-flex align-items-center flex-column flex-md-row">
                                            <span>No Product Available</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-12">
                                    


                                
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                </div>
            </div>




@include('layout.footer')