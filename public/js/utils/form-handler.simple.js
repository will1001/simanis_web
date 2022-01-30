$(document).ready(async function(){
    var data = await persiapan_data();
    add_eventlistener(data);
    inisialisasi(data);
});

async function persiapan_data(){
    var data = {};
    
    var formid = "<?php echo $formid ?>";
    var submitSukses = <?php echo isset($submitSukses) ? $submitSukses: 'null' ?>;
    var submitError = <?php echo isset($submitError) ? $submitError : 'null' ?>;

    var toasCofig = {
        wrapper: '#' + formid,
        id: 'toast-barang',
        delay: 3000,
        autohide: true,
        show: true,
        bg: 'bg-danger',
        textColor: 'text-white',
        time: waktu(null, 'HH:mm'),
        toastId: 'logout-error',
        title: 'Gagal, Terjadi kesalahan',
        type: 'danger',
        hancurkan: true
    }
    var opsiFormAjax = {
        submitSuccess: function (res) {
            $('button[type="submit"]').prop('disabled', false);
            endLoading();
            var toastOpt = toasCofig;
            toastOpt.bg = 'bg-success';
            toastOpt.title = 'Berhasil';
            toastOpt.message = res.message;
            makeToast(toastOpt);

            if(isFunction(submitSukses))
                submitError(res);
        },
        submitError: function (res) {
            $('button[type="submit"]').prop('disabled', false);
            endLoading();

            res = res.responseJSON
            var toastOpt = toasCofig;

            toastOpt.bg = 'bg-danger';
            toastOpt.message = res.message;
            toastOpt.title = "Galat";
            makeToast(toastOpt);

            if(isFunction(submitError))
                submitError(res);
        },
        sebelumSubmit: function () {
            $('button[type="submit"]').prop('disabled', true);
            showLoading();
        },
    };


    data.opsiFormAjax = opsiFormAjax;
    data.toasCofig = toasCofig;
    data.formid = formid;

    return data;
}

function add_eventlistener(parent){


    // Modular Event Listener
    <?php echo isset($eventlistener) ? $eventlistener : 'null' ?>;
}


function inisialisasi(parent){
    if($().select2)
        $('.select2').select2();

    if($().datepicker)
        $('.datepicker').datepicker();

    if($().daterangepicker)
        $('.daterangepicker').daterangepicker();

    $('#' + parent.formid).initFormAjax(parent.opsiFormAjax);
}
