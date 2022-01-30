var kecamatan = <?php echo $kec ?>;
var kelurahan = <?php echo $kel ?>;

var selectedKab = "<?php echo isset($selectedKab) ? $selectedKab : null  ?>";
var selectedKec = "<?php echo isset($selectedKec) ? $selectedKec : null  ?>";
var selectedKel = "<?php echo isset($selectedKel) ? $selectedKel : null  ?>";
var wil = {};

if(!selectedKab)
    selectedKab = 5201;
// Normalisasi data kecamatan
kecamatan.forEach(kec => {
    if(wil[kec.regency_id])
        wil[kec.regency_id].push({id: kec.id, nama: kec.name});
    else
        wil[kec.regency_id] = [{id: kec.id, nama: kec.name}];
});

kelurahan.forEach(kel => {
    if(wil[kel.district_id])
        wil[kel.district_id].push({id: kel.id, nama: kel.name})
    else
        wil[kel.district_id] = [{id: kel.id, nama: kel.name}];
});


$("#kab, #kec").on('change', function(){
    var val = $(this).val();
    var id = $(this).attr('id');
    var target = '#kec';
    var selected = selectedKec;

    if(id == 'kec'){
        target = '#kel';
        selected = selectedKel;
    }

    renderOpsi(wil[val], target, selected);
});


function renderOpsi(opsi, id, selected = null){
    $(id).select2('destroy');
    $(id + ' option').remove();

    var rows = '';

    opsi.forEach(o => {
        rows += '<option value="' + o.id + '">' + o.nama + '</option>';
    });

    $(id).append(rows);
    $(id).select2();

    if(selected){
        $(id + ' option[value="' + selected + '"]').prop('selected', true);
        $(id).trigger('change')
    }

}

setTimeout(function(){
    console.log(selectedKab);
$("#kab option[value='" + selectedKab + "']").prop('selected', true).parent().trigger('change');

}, 500)
