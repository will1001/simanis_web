$(document).ready(function(){
	$('#logout').on('click', async function(e){
		e.preventDefault();
		showLoading();
		var response = await fetch(path + 'keluar', {method: "GET"}).then(res => res.json()).then(res => res).catch(err => err);
		endLoading();
		console.log(response);
		if(response.message && response.message == 'Berhasil Logout')
			window.location.href = path + 'masuk';
	});

	$('#profile').on('click', function(e){e.preventDefault(); location.href = path + 'profile'})
})
