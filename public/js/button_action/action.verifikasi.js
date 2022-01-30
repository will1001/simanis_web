async (e, dt, node, config) => {
    $(node).prop('disabled', true);
    var data = instance.dataTables[config.data.tableid].rows({ selected: true }).data().toArray()
    if (data.length == 0) {
        alert("Pilih baris yang ingin diverifikasi");
        $(node).prop('disabled', false);
        return;
    }
    var res = confirm("Yakin Ingin Memverifikasi Data .?");
    if (!res) {
        $(node).prop('disabled', false);
        return;
    }
    showLoading();
    var ids = data.map(d => d[8]);

    $.post(path + 'umkm/verifikasi', {
        '_token': "<?php echo csrf_token(); ?>",
        ids: ids
    }, function (res, code, d) {
        var toastOpt = config.data.toasCofig;
        toastOpt.bg = 'bg-success';
        toastOpt.title = 'Berhasil';
        toastOpt.message = res.message;
        config.data.loadData();
        makeToast(toastOpt);
        setTimeout(function(){
            config.data.loadData();
        }, 1000);

    }, 'json').fail(function (res) {
        endLoading();
        var toastOpt = config.data.toasCofig;
        res = res.responseJSON
        toastOpt.message = res.message;

        makeToast(toastOpt);
        config.data.loadData();


    });
    endLoading();
    $(node).prop('disabled', false);
}