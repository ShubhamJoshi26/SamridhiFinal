function AddVariantRow(cnt)
{
    cnt++;
    var html = ' <tr id="row_'+cnt+'"><td><div class="product-cart d-flex align-items-center"><div class="product-thumb"><input type="file" class="form-control" name="variant_file" id="variant_file_'+cnt+'" multiple></div></div></td><td><input type="text" class="form-control" value="" name="variant_name[]" id="variant_name_'+cnt+'"></td><td><input type="color" class="form-control" value="" name="variant_color[]" id="variant_color_'+cnt+'"></td><td><div class="product-quantity d-inline-flex"><input type="number" value="" name="variant_qty[]" id="variant_qty_'+cnt+'"></div></td><td><div class="btn-group" role="group" aria-label="Basic outlined example"><button type="button" class="btn btn-outline-secondary deleterow" onclick=DeleteVariantRow("row_'+cnt+'")><i class="icofont-ui-delete text-danger"></i></button></div></td></tr>';
$('#varianttablebody').append(html);
$('#variant_count').val(cnt);
}
function DeleteVariantRow(cnt)
{
    $('#'+cnt).remove();
}
function SaveProduct(fname)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    data = new FormData($('#'+fname)[0]);
    $.ajax({
        url:'/Product/CreateProduct?action=addproduct',
        type:'POST',
        data:data,
        success:function(suc)
        {
            console.log(suc);
        },
        contentType: false,
         cache: false,
         processData: false,
    })
}
function DeleteProductImage(id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'/product/deleteproduct',
        type:'post',
        data:{id:id},
        success:function(suc)
        {
            response = JSON.parse(suc);
            if(response['success']=='true')
            {
                alert('Image Deleted Successfully');
                window.location.reload();
            }
            else
            {
                alert('Something Went Wrong');
                window.location.reload();
            }
            
        }
    })
}