async (e, dt, node, config) => {
    showLoading();

    var modalConf = {
        pos: 'def',
        size: 'modal-md',
        submit: 'umkm/import',
        headers: {'X-CSRF-TOKEN': $('meta[name="__token__"]').attr('content')},

        sukses: function(res){
            var pesan = '  <div class="row">';
            if(res.fail.length > 0){
                res.fail.forEach(fail => {
                    pesan += '<div class="form-group col-sm-12 col-md-6 ml-2 mr-2">' +
                                '<h6>NIK: ' + fail.nik + '</h6>' + 
                                '<h6>Nama: ' + fail.nama + '</h6>' + 
                                '<h6>Alasan: ' + fail.alasan + '</h6>' + 
                            '</div>';
                });
                pesan += '</div>';
            }else{
                pesan += '<h5 style="text-align:center"> Semua Data Berhasil diimport </h5></div>';
            }
            generateModal('modal-fail', 'body', {
                type: 'custom',
                open: true,
                destroy: true,
                modalTitle: '<h4> Data yang gagal di Import <span class="badge badge-pill badge-warning badge-sm">'+ res.fail.length +'</span></h4>',
                saatBuka: function () {
                    $('#modal-fail div.modal-dialog').addClass('modal-dialog-scrollable');
                 },
                saatTutup: function () { 
                },
                modalBody: {
                    customBody: pesan
                }
            })
        }
    };
    
    await tambahHandler(config.data, false, null, 'forms/importExcel', modalConf, {jenis: 'profile'});
    endLoading();
    $(node).prop('disabled', false);
}