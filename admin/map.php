<script>
	latlng = new google.maps.LatLng(
		<?= isset($Form->data['lat']) ? $Form->data['lat'] : 5.3096600 ?>,
	 	<?= isset($Form->data['lng']) ? $Form->data['lng'] : -4.0126600 ?>);
	map = new google.maps.Map(document.getElementById('map'), {
	  center: latlng,
	  zoom: 16,
	  MapTypeId: google.maps.MapTypeId.SATELLITE
	});

	var marker = new google.maps.Marker({
		position: latlng,
		map: map,
		title: 'Déplacer le curseur pour definir emplacement',
		draggable: true,
		animation: google.maps.Animation.DROP
	});

	var geocoder = new google.maps.Geocoder();

	google.maps.event.addListener(marker,'drag',function(){
		setPosition(marker);
	});

	$('#inputadresse').on('keypress', function(e){
		
		if(e.keyCode == 13){
			var request = {
				address : $(this).val()
			}

			geocoder.geocode(request, function(results,status){
				if(status == google.maps.GeocoderStatus.OK){
					var position = results[0].geometry.location;
					map.setCenter(position);
					marker.setPosition(position);
					setPosition(marker);
				}else{
					alert(status);
				}
			});

			return false;
		}

		
	})

	function setPosition(marker){
		var pos = marker.getPosition()
		$('#inputlat').length ? $('#inputlat').val(pos.lat()) : null;
		$('#inputlng').length ? $('#inputlng').val(pos.lng()) : null;
	}
</script>

