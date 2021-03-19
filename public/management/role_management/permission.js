$(function(){
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/permissions',
        columns: [
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, class: 'text-center' },
            {data: 'name'},
            {data: 'action', class: 'text-center'}
        ]
    })
});

function edit_permission(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/management/role_management/permissions/"+id+"/detail",
        beforeSend: function(){
            $('.btn_edit_permission'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_edit_permission'+id).removeClass('btn-progress');
            $('#modal-default-edit').modal('show');
            $('.namec').val(response.name);
            $('.id_permission').val(response.id);
        }
    });
}

function delete_permission(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/management/role_management/permissions/"+id+"/detail",
        beforeSend: function(){
            $('.btn_delete_permission'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_delete_permission'+id).removeClass('btn-progress');
            $('#modal-default-delete').modal('show');
            $('.id_permission').val(response.id);
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
    $('#frm_add_permission').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/management/role_management/permissions/store",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_simpan_permission').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default').modal('hide');
                    $('#frm_add_permission')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_simpan_permission').removeClass('btn-progress');
            },
        });
    });

    $('#frm_edit_permission').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/management/role_management/permissions/"+$('.id_permission').val()+'/update',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_update_permission').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-edit').modal('hide');
                    $('#frm_edit_permission')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_update_permission').removeClass('btn-progress');
            },
        });
    });

    $('#frm_destroy_permission').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/admin/management/role_management/permissions/"+$('.id_permission').val()+'/delete',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_destroy_permission').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-delete').modal('hide');
                    $('#frm_destroy_permission')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'error',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_destroy_permission').removeClass('btn-progress');
            },
        });
    });
});
