function initMap() {

	var east = {
		info: '<strong>DESM&E HQ Below Police Head Quarter, Church Road</strong><br>\
					Gangtok, Sikkim<br> East Sikkim<br>\ PIN: 737101',
		lat: 27.330011,
		long: 88.6106845
	};

	var west = {
		info: '<strong>District Statistics Office (DSO) West District</strong><br>\
					Kyongsa, Gyalshing, West Sikkim, <br>\PIN: 737111',
		lat: 27.290962,
		long: 88.248134
	};

	var north = {
		info: '<strong>District Statistics Office (DSO)</strong><br>\
					Penlok, DAC Road, Mangan<br> North Sikkim<br>\ PIN: 737116',
		lat: 27.654853,
		long: 88.479872
	};
	
	var south = {
		info: '<strong>DSO South District</strong><br>\
					DAC Namchi<br> South Sikkim<br>\ PIN: 737126',
		lat: 27.165376,
		long: 88.3478879
	};

	var locations = [
      [east.info, east.lat, east.long, 0],
      [west.info, west.lat, west.long, 1],
      [north.info, north.lat, north.long, 2],
	  [south.info, south.lat, south.long, 3],
    ];

	var map = new google.maps.Map(document.getElementById('map'), {
		zoom:9,
		center: new google.maps.LatLng(27.514577, 88.567786),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var infowindow = new google.maps.InfoWindow({});

	var marker, i;

	for (i = 0; i < locations.length; i++) {
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map
		});

		google.maps.event.addListener(marker, 'click', (function (marker, i) {
			return function () {
				infowindow.setContent(locations[i][0]);
				infowindow.open(map, marker);
			}
		})(marker, i));
	}
}
