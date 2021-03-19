$(function(){
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/roles',
        columns: [
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, class: 'text-center' },
            {data: 'name'},
            {data: 'permission'},
            {data: 'action', class: 'text-center'}
        ]
    })
});

function edit_role(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/management/role_management/roles/"+id+"/detail",
        beforeSend: function(){
            $('.btn_edit_role'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_edit_role'+id).removeClass('btn-progress');
            $('#modal-default-edit').modal('show');
            $('.namec').val(response.role.name);
            $('.id_role').val(response.role.id);
            $('.permi_c').val(response.permissions).trigger('change');
        }
    });
}

function delete_role(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/management/role_management/roles/"+id+"/detail",
        beforeSend: function(){
            $('.btn_delete_role'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_delete_role'+id).removeClass('btn-progress');
            $('#modal-default-delete').modal('show');
            $('.id_role').val(response.role.id);
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
        placeholder: 'Pilih Permission'
    });

    $('#frm_add_role').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/management/role_management/roles/store",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_simpan_role').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default').modal('hide');
                    $('#frm_add_role')[0].reset();
                    $('.select2bs4').val('').trigger('change');
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_simpan_role').removeClass('btn-progress');
            },
        });
    });

    $('#frm_edit_role').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/management/role_management/roles/"+$('.id_role').val()+'/update',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_update_role').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-edit').modal('hide');
                    $('#frm_edit_role')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_update_role').removeClass('btn-progress');
            },
        });
    });

    $('#frm_destroy_role').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/admin/management/role_management/roles/"+$('.id_role').val()+'/delete',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_destroy_role').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-delete').modal('hide');
                    $('#frm_destroy_role')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'error',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_destroy_role').removeClass('btn-progress');
            },
        });
    });
});
