$(document).ready(function(){
    var toasCofig = {
        wrapper: '#navigation',
        id: 'toast',
        delay: 6000,
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
    
    var formid = "<?php echo $formid ?>";
    var submitSukses = <?php echo isset($submitSukses) ? $submitSukses: 'null' ?>;
    var submitError = <?php echo isset($submitError) ? $submitError : 'null' ?>;
    var options = {
        submitError: function(response){
            endLoading();
            var responseText  = JSON.parse(response.responseText)
            console.log(responseText);
            $('#alert_danger').text(responseText.message).show();
            $('#btn-login').prop('disabled', false);

            if(isFunction(submitError))
                submitError(response);

        },
        sebelumSubmit: function(input, ){
            showLoading();
            $('#alert_danger').text('').hide();
            $('#btn-login').prop('disabled', true);
        }, 
        submitSuccess: function(data){
            endLoading();
            if(isFunction(submitSukses))
                submitSukses(data);
        }
    }
    $(formid).initFormAjax(options);



    $("#reset-password").on('click', function(){
        var modalId = 'form-modal-reset-password',
        wrapper = 'body',
        option = {
            type: 'form',
            open: true,
            destroy: true,
            ajax: true,
            modalTitle: 'Reset Password anda',
            formOpt: {
                formid: 'form-reset-password', 
                formAct: 'auth/resetpass',
                formMethod: 'POST'
            },
            modalBody: {
                input: [
                    {type: 'hidden', name: '_token', value: "<?php echo csrf_token(); ?>"},
                    {label: 'Masukkan NIK yang terdaftar', type: 'text', name: 'nik', id: 'nik-reset', attr: 'data-rule-required=true'}
                ],
                buttons: [
                    {type: 'Submit', text: 'Kirim', class:'btn btn-primary btn-xs'}
                ]
            },
            sebelumSubmit: showLoading,
            submitSuccess: (res) => {
                var toastOpt = {...toasCofig, bg: 'bg-success', message: res.message, title: 'Berhasil'};
                $('#' + modalId).modal('hide');

                makeToast(toastOpt);
                endLoading();
            },
            submitError: (res) => {
                res = res.responseJSON;
                var toastOpt = {...toasCofig, wrapper: '#' + modalId , message: res.message};

                makeToast(toastOpt);
                endLoading();
            }
        };
        generateModal(modalId, wrapper, option);
    });
})