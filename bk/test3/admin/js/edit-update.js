// JavaScript Document
var beginLat =10.355090729236755;
var beginLng =107.08455562591553;


function SelectText(id)
{
document.getElementById(id).focus();
document.getElementById(id).select();
}

//////////////////////HAM THEM ////////////////////////
  var geocoder;
  var map;
  var infowindow = new google.maps.InfoWindow();
  var marker;
	
function placeMarker(location) //tạo các điểm market
{
  var marker = new google.maps.Marker({
      position: location,
      map: map });
map.setCenter(location);
}



function initialize() 
{
        geocoder = new google.maps.Geocoder();
	

        var mapOptions = {
          zoom: 15,
          center: new google.maps.LatLng(beginLat,beginLng),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
		

	google.maps.event.addListener(map, 'click', function(event) // sự kiện click 
  	{
			placeMarker(event.latLng);
			var myLatLng = event.latLng;
			var lat = myLatLng.lat();
			var lng = myLatLng.lng();
			document.getElementById("lat").value = lat;// gán giá trị vào 2 ô textbox dưới
			document.getElementById("lng").value = lng;
			//codeLatLng();
			 
			
        	var latlng = new google.maps.LatLng(lat, lng);
			
        geocoder.geocode({'latLng': latlng}, function(results, status) 
		{
          if (status == google.maps.GeocoderStatus.OK) 
		  {
				if (results[1]) 
				{
				  map.setZoom(18);
				  marker = new google.maps.Marker({ position: latlng,  map: map });
				  infowindow.setContent(results[0].formatted_address);
				  infowindow.open(map, marker);
				  $("textarea[name='add']").text(results[0].formatted_address);
				} 
				else 
				{
				  alert('No results found');
				}
          } 
		  else 
		  {
            alert('Geocoder failed due to: ' + status);
          }
		});//end Geo
				 
				 
			    $(window).resize(); 
			    $("#showLocation").show("slow");
 			 });//end addlister

}//end initialize
