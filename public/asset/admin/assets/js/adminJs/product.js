$(document).ready(function () {
    $("body").on("click",".deleteProduct",function(e){

    e.preventDefault();
    var id = $(this).data("id");
    // var id = $(this).attr('data-id');
    var token = $("meta[name='csrf-token']").attr("content");
    var url = e.target;

    $.ajax(
        {
            url: url.href, //or you can use url: "company/"+id,
            type: 'DELETE',
            method: 'DELETE',
            data: {
            _token: token,
                id: id
        },
        success: function (response){
            console.log('Xóa thành công!');
            // $('#deleteProduct' + id).modal('hide');
            $('#tableId'+id).remove();
            $( "#success" ).addClass( "success bg-success p-3" );
            $("#success").html(response.message);
        }
        });
        return false;
    });
});