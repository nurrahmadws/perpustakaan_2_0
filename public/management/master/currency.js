$(function(){
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/currencies',
        columns: [
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, class: 'text-center' },
            {data: 'name'},
            {data: 'symbol', class: 'text-center'},
            {data: 'status', class: 'text-center'},
            {data: 'created_by'},
            {data: 'updated_by'},
            {data: 'action', class: 'text-center'}
        ]
    })
});

function edit_currency(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/master/currencies/"+id+"/show",
        beforeSend: function(){
            $('.btn_edit_currency'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_edit_currency'+id).removeClass('btn-progress');
            $('#modal-default-edit').modal('show');
            $('.namec').val(response.name);
            $('.symbolc').val(response.symbol);
            $('.statusc').val(response.status).trigger('change');
            $('.id_currency').val(response.id);
        }
    });
}

function delete_currency(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/master/currencies/"+id+"/show",
        beforeSend: function(){
            $('.btn_delete_currency'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_delete_currency'+id).removeClass('btn-progress');
            $('#modal-default-delete').modal('show');
            $('.id_currency').val(response.id);
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
        placeholder: 'Pilih Status'
    });

    $('#frm_add_currency').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/master/currencies/store",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_simpan_currency').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default').modal('hide');
                    $('#frm_add_currency')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_simpan_currency').removeClass('btn-progress');
            },
        });
    });

    $('#frm_edit_currency').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/master/currencies/"+$('.id_currency').val()+'/update',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_update_currency').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-edit').modal('hide');
                    $('#frm_edit_currency')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_update_currency').removeClass('btn-progress');
            },
        });
    });

    $('#frm_destroy_currency').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/admin/master/currencies/"+$('.id_currency').val()+'/delete',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_destroy_currency').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-delete').modal('hide');
                    $('#frm_destroy_currency')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'error',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_destroy_currency').removeClass('btn-progress');
            },
        });
    });
});
