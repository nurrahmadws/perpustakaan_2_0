$(function(){
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/penalties',
        columns: [
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, class: 'text-center' },
            {data: 'category'},
            {data: 'symbol', class: 'text-center'},
            {data: 'nilai'},
            {data: 'status', class: 'text-center'},
            {data: 'created_by'},
            {data: 'updated_by'},
            {data: 'action', class: 'text-center'}
        ]
    })
});

function edit_penalty(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/master/penalties/"+id+"/edit",
        beforeSend: function(){
            $('.btn_edit_penalty'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_edit_penalty'+id).removeClass('btn-progress');
            $('#modal-default-edit').modal('show');
            $('#isi_content').html(response);
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            });
            $('.curr').mask('000.000.000.000.000,00', { reverse: true });
        }
    });
}

function delete_penalty(id)
{
    $('.btn_destroy_penalty'+id).removeClass('btn-progress');
    $('#modal-default-delete').modal('show');
    $('.id_penalty').val(id);
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
    });

    $('.curr').mask('#.##0', { reverse: true });

    $('#frm_add_penalty').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/master/penalties/store",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_simpan_penalty').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default').modal('hide');
                    $('#frm_add_penalty')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_simpan_penalty').removeClass('btn-progress');
            },
        });
    });

    $('#frm_edit_penalty').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/master/penalties/"+$('.penalty_id').val()+'/update',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_update_penalty').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-edit').modal('hide');
                    $('#frm_edit_penalty')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_update_penalty').removeClass('btn-progress');
            },
        });
    });

    $('#frm_destroy_penalty').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/admin/master/penalties/"+$('.id_penalty').val()+'/delete',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_destroy_penalty').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-delete').modal('hide');
                    $('#frm_destroy_penalty')[0].reset();
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'error',
                        title: response.success
                    })
                }
            },
            complete: function(){
                $('.btn_destroy_penalty').removeClass('btn-progress');
            },
        });
    });
});
