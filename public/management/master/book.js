$(function(){
    $('#datatable').DataTable({
        "lengthMenu": [[5,10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        paging: true,
        pageLength: 5,
        // destroy: true,
        processing: true,
        serverSide: true,
        // "scrollY": "500px",
        // "scrollCollapse": true,
        // responsive:true,
        ajax: '/admin/books',
        columns: [
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, class: 'text-center' },
            {data: 'cover', class: 'text-center'},
            {data: 'title'},
            // {data: 'publisher'},
            // {data: 'publication_year'},
            {data: 'stock'},
            {data: 'status'},
            {data: 'barcode', class: 'text-center'},
            {data: 'action', class: 'text-center'}
        ]
    })
});

function delete_book(id)
{
    $.ajax({
        type: "GET",
        url: "/admin/master/books/"+id+"/show",
        beforeSend: function(){
            $('.btn_delete_book'+id).addClass('btn-progress');
        },
        success: function (response) {
            $('.btn_delete_book'+id).removeClass('btn-progress');
            $('#modal-default-delete').modal('show');
            $('.book_id').val(response.id);
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
        allowClear: true,
    });

    $('.coti').on('change', function(){
        const id = $(this).val();

        $.ajax({
            url: '/admin/master/books/list_category/' + id,
            beforeSend: function (request) {
                $('.cate option').remove();
                $('.cate').append('<option value="">------</option>');
            },
            success: function(data){
                let option = '<option value="{id}">{name}</option>';

                $('.cate option').remove();
                $('.cate').append('<option value="">Pilih Kategori Buku</option>');
                data.forEach(function(item){
                    $('.cate').append(
                        option.replace(/{id}/g, item.id).replace(/{name}/g, item.name)
                    );
                });
            }
        });
    });

    // if($('.coti_edit').val() != null)
    // {
    //     const id = $('.coti_edit').val();

    //     $.ajax({
    //         url: '/admin/master/books/list_category/' + id,
    //         beforeSend: function (request) {
    //             $('.cate option').remove();
    //             $('.cate').append('<option value="">------</option>');
    //         },
    //         success: function(data){
    //             let option = '<option value="{id}">{name}</option>';

    //             $('.cate option').remove();
    //             $('.cate').append('<option value="">Pilih Kategori Buku</option>');
    //             data.forEach(function(item){
    //                 $('.cate').append(
    //                     option.replace(/{id}/g, item.id).replace(/{name}/g, item.name)
    //                 );
    //                 $(".cate").val(item.id).trigger("change");
    //             });

    //             // var newProduct = data.category_id;
    //             // var newData = data.category.name;
    //             // if ($(".cate").find("option[value='" + newProduct + "']").length) {
    //             //     $(".cate").val(newProduct).trigger("change");
    //             //     alert('ini')
    //             // }else{
    //             //     var newProd = new Option(newData, newProduct, true, true);
    //             //     $('.cate').append(newProd).trigger('change');
    //             //     alert('ini1')
    //             // }
    //         }
    //     });
    // }

    $('#frm_add_book').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/master/books/store",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_simpan_book').addClass('btn-progress');
            },
            success: function(response) {
                if (response.errors) {
                    for (var count = 0; count < response.errors.length; count++) {
                        Toast.fire({
                            icon: 'warning',
                            title: response.success
                        })
                    }
                    $('.btn_simpan_book').removeClass("btn-progress");
                }

                if (response.error_extension) {
                    Toast.fire({
                        icon: 'error',
                        title: response.success
                    })
                    $('.btn_simpan_book').removeClass("btn-progress");
                }

                if (response.success) {
                    $('.index_c').show();
                    $('.create_part').hide();
                    $('.btn_crt_book').show();
                    $('.btn_cancel_book').hide();
                    $('.t_class').hide();
                    $('.t_class_list').show();
                    $('#frm_add_book')[0].reset();
                    $('.btn_simpan_book').removeClass("btn-progress");
                    $('.select2bs4').trigger('change');
                    $('#datatable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    })
                }
            }
        });
    });

    $('#frm_edit_book').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/master/books/"+$('.book_id').val()+"/update",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_update_book').addClass('btn-progress');
            },
            success: function(response) {
                if (response.errors) {
                    for (var count = 0; count < response.errors.length; count++) {
                        Toast.fire({
                            icon: 'warning',
                            title: response.success
                        })
                    }
                    $('.btn_update_book').removeClass("btn-progress");
                }

                if (response.error_extension) {
                    Toast.fire({
                        icon: 'error',
                        title: response.success
                    })
                    $('.btn_update_book').removeClass("btn-progress");
                }

                if (response.success) {
                    $('#frm_edit_book')[0].reset();
                    $('.btn_update_book').removeClass("btn-progress");
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    });
                    setTimeout(function() {
                        location.href = "/admin/master/books/"+$('.book_id').val()+"/detail";
                    }, 100);
                }
            }
        });
    });

    $('.btn_destroy_book').on('click', function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/admin/master/books/"+$('.book_id').val()+'/delete',
            dataType: "json",
            beforeSend: function(){
                $('.btn_destroy_book').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    $('#modal-default-delete').modal('hide');
                    $('#frm_destroy_book')[0].reset();
                    Toast.fire({
                        icon: 'error',
                        title: response.success
                    });
                    setTimeout(function() {
                        location.href = "/admin/master/books";
                    }, 100);
                }
            },
            complete: function(){
                $('.btn_destroy_book').removeClass('btn-progress');
            },
        });
    });

    $('.approve_c').on('click', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/master/books/"+$('.id_buku').val()+'/approve',
            dataType: "json",
            beforeSend: function(){
                $('.btn_update_status').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    });
                    setTimeout(function() {
                        location.href = "/admin/master/books/"+$('.id_buku').val()+"/detail";
                    }, 100);
                }
            },
            // complete: function(){
            //     $('.btn_update_status').removeClass('btn-progress');
            // },
        });
    });

    $('.publish_c').on('click', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/admin/master/books/"+$('.id_buku').val()+'/publish',
            dataType: "json",
            beforeSend: function(){
                $('.btn_update_status').addClass('btn-progress');
            },
            success: function (response) {
                if (response.success) {
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    });
                    setTimeout(function() {
                        location.href = "/admin/master/books/"+$('.id_buku').val()+"/detail";
                    }, 100);
                }
            },
            // complete: function(){
            //     $('.btn_update_status').removeClass('btn-progress');
            // },
        });
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
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    });
                    var newProduct = response.author_id;
                    var newData = response.author_code+' | '+response.author_name;
                    if ($(".author_class").find("option[value='" + newProduct + "']").length) {
                        $(".author_class").val(newProduct).trigger("change");
                    }else{
                        var newProd = new Option(newData, newProduct, true, true);
                        $('.author_class').append(newProd).trigger('change');
                    }
                }
            },
            complete: function(){
                $('.btn_simpan_author').removeClass('btn-progress');
            },
        });
    });

    if($('.iterations').length > 0 && $('.iterations') != null){
        var i = $('.iterations').val();
        // alert(i);
        const tottal = $('.iterations').val();
        for (let j = 1; j <= tottal; j++) {
            $('body').on('click', '.del_row_isbn_edt'+j, function(e){
                e.preventDefault();
                $(this).closest("tr").remove();
                j--;
            });
        }
    }else{
        var i = 1;
    }

    $('body').on('click', '.add_row_isbn', function(e){
        e.preventDefault();
        i++;
        var newRows = $('<tr class="text-center">');
        var bungkus = "";
        bungkus +=
            '<td>'+
                '<input type="number" class="form-control" name="isbn[]" required>'+
            '</td>'+
            '<td>'+
                '<a class="btn btn-danger del_row_isbn'+i+'" style="color: whitesmoke;"><i class="fa fa-minus"></i></a>'+
            '</td>'
        ;
        newRows.append(bungkus);
        $("tbody.multi_row").append(newRows);

        $('body').on('click', '.del_row_isbn'+i, function(e){
            e.preventDefault();
            $(this).closest("tr").remove();
            i--;
        });
    });

    $('body').on('click', '.btn_crt_book', function(e){
        e.preventDefault();
        $('.index_c').hide();
        $('.create_part').show();
        $('.btn_crt_book').hide();
        $('.btn_cancel_book').show();
        $('.t_class').show();
        $('.t_class_list').hide();
    });

    $('body').on('click', '.btn_cancel_book', function(e){
        e.preventDefault();
        $('.index_c').show();
        $('.create_part').hide();
        $('.btn_crt_book').show();
        $('.btn_cancel_book').hide();
        $('.t_class').hide();
        $('.t_class_list').show();
    });
});
