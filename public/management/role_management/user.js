$(function(){
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/users',
        columns: [
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, class: 'text-center' },
            {data: 'name'},
            {data: 'email'},
            {data: 'role'},
            {data: 'action', class: 'text-center'}
        ]
    })
});

function edit_user(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/management/role_management/users/"+id+"/detail",
        beforeSend: function(){
            $('.btn_edit_user'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_edit_user'+id).removeClass('btn-progress');
            $('#modal-default-edit').modal('show');
            $('.namec').val(response.user.name);
            $('.emailc').val(response.user.email);
            $('.id_user').val(response.user.id);
            $('.rolec').val(response.roles).trigger('change');
        }
    });
}

function delete_user(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/management/role_management/users/"+id+"/detail",
        beforeSend: function(){
            $('.btn_delete_user'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_delete_user'+id).removeClass('btn-progress');
            $('#modal-default-delete').modal('show');
            $('.id_user').val(response.user.id);
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

    $('.select2bs4').select2({
        theme: 'bootstrap4',
        placeholder: 'Pilih Role'
    });

    $('#frm_add_user').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/management/role_management/users/store",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_simpan_user').addClass('btn-progress');
            },
            success: function (response) {
                if (response.errors) {
                    for (var count = 0; count < response.errors.length; count++) {
                        Toast.fire({
                            icon: 'error',
                            title: response.errors[count]
                        })
                    }
                    $('.btn_simpan_user').removeClass('btn-progress');
                }
                if (response.success) {
                    $('#modal-default').modal('hide');
                    $('#frm_add_user')[0].reset();
                    $('.select2bs4').val('').trigger('change');
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_simpan_user').removeClass('btn-progress');
            },
        });
    });

    $('#frm_update_user').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/management/role_management/users/"+$('.id_user').val()+'/update',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_update_user').addClass('btn-progress');
            },
            success: function (response) {
                if (response.errors) {
                    for (var count = 0; count < response.errors.length; count++) {
                        Toast.fire({
                            icon: 'error',
                            title: response.errors[count]
                        })
                    }
                    $('.btn_simpan_user').removeClass('btn-progress');
                }
                if (response.success) {
                    $('#modal-default-edit').modal('hide');
                    $('#frm_update_user')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_update_user').removeClass('btn-progress');
            },
        });
    });

    $('#frm_destroy_user').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/admin/management/role_management/users/"+$('.id_user').val()+'/delete',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_destroy_user').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-delete').modal('hide');
                    $('#frm_destroy_user')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'error',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_destroy_user').removeClass('btn-progress');
            },
        });
    });
});
