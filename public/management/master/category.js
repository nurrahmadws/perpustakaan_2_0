$(function(){
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/categories',
        columns: [
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, class: 'text-center' },
            {data: 'collection_type'},
            {data: 'code', class: 'text-center'},
            {data: 'name'},
            {data: 'created_by'},
            {data: 'action', class: 'text-center'}
        ]
    })
});

function edit_category(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/master/categories/"+id+"/edit",
        beforeSend: function(){
            $('.btn_edit_category'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_edit_category'+id).removeClass('btn-progress');
            $('#modal-default-edit').modal('show');
            $("#isi_content_edit_category").html(response);

            $('.select2bs4').select2({
                theme: 'bootstrap4',
            });
        }
    });
}

function delete_category(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/master/categories/"+id+"/show",
        beforeSend: function(){
            $('.btn_delete_category'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_delete_category'+id).removeClass('btn-progress');
            $('#modal-default-delete').modal('show');
            $('.id_category').val(response.id);
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
        placeholder: 'Pilih Jenis Kategori'
    });

    $('#frm_add_category').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/master/categories/store",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_simpan_category').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default').modal('hide');
                    $('#frm_add_category')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_simpan_category').removeClass('btn-progress');
            },
        });
    });

    $('#frm_edit_category').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/master/categories/"+$('.id_category').val()+'/update',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_update_category').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-edit').modal('hide');
                    $('#frm_edit_category')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_update_category').removeClass('btn-progress');
            },
        });
    });

    $('#frm_destroy_category').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/admin/master/categories/"+$('.id_category').val()+'/delete',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_destroy_category').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-delete').modal('hide');
                    $('#frm_destroy_category')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'error',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_destroy_category').removeClass('btn-progress');
            },
        });
    });
});
