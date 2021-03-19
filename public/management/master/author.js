$(function(){
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/authors',
        columns: [
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, class: 'text-center' },
            {data: 'code', class: 'text-center'},
            {data: 'name'},
            {data: 'created_by'},
            {data: 'action', class: 'text-center'}
        ]
    })
});

function edit_author(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/master/authors/"+id+"/show",
        beforeSend: function(){
            $('.btn_edit_author'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_edit_author'+id).removeClass('btn-progress');
            $('#modal-default-edit').modal('show');
            $('.codec').val(response.code);
            $('.namec').val(response.name);
            $('.id_author').val(response.id);
        }
    });
}

function delete_author(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/master/authors/"+id+"/show",
        beforeSend: function(){
            $('.btn_delete_author'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_delete_author'+id).removeClass('btn-progress');
            $('#modal-default-delete').modal('show');
            $('.id_author').val(response.id);
        }
    });
}

$(document).ready(function(){
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $('#frm_add_author').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/master/authors/store",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_simpan_author').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default').modal('hide');
                    $('#frm_add_author')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_simpan_author').removeClass('btn-progress');
            },
        });
    });

    $('#frm_edit_author').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/master/authors/"+$('.id_author').val()+'/update',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_update_author').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-edit').modal('hide');
                    $('#frm_edit_author')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_update_author').removeClass('btn-progress');
            },
        });
    });

    $('#frm_destroy_author').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/admin/master/authors/"+$('.id_author').val()+'/delete',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_destroy_author').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-delete').modal('hide');
                    $('#frm_destroy_author')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'error',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_destroy_author').removeClass('btn-progress');
            },
        });
    });
});
