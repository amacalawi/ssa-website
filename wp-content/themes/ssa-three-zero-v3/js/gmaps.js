    var mapOptions = {
    zoom: 19,
    center: new google.maps.LatLng(1.319670, 103.892475),
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var image = 'img/marker.png';
    map = new google.maps.Map(document.getElementById('map'),
    mapOptions);
    var myLatLng1 = new google.maps.LatLng(1.319630, 103.892475);

    
    
    var markers1 = new google.maps.Marker({
    position: myLatLng1,
    map: map,
    icon: image
    });

    markers1.setAnimation(google.maps.Animation.BOUNCE);

    
    var image = 'img/marker.png';
    var myLatLng2 = new google.maps.LatLng(1.333788,103.739684);
    var beachMarker2 = new google.maps.Marker({
    position: myLatLng2,
    map: map,
    icon: image
    });
    
    beachMarker2.setAnimation(google.maps.Animation.BOUNCE);
    

    var myLatLng3 = new google.maps.LatLng(14.581694,121.060860);
    var beachMarker3 = new google.maps.Marker({
    position: myLatLng3,
    map: map,
    icon: image
    });
    
    beachMarker3.setAnimation(google.maps.Animation.BOUNCE); 


    var myLatLng4 = new google.maps.LatLng(1.301602,103.837812);
    var beachMarker4 = new google.maps.Marker({
    position: myLatLng4,
    map: map,
    icon: image
    });
    
    beachMarker4.setAnimation(google.maps.Animation.BOUNCE);   



function go_hq() {

    var panPoint = new google.maps.LatLng(1.319670, 103.892475);
    map.panTo(panPoint);
   
    markers1.setAnimation(google.maps.Animation.BOUNCE);

   
    

}

function go_office() {

    
    $( ".tabz-office li" ).each(function( index ) {
        if($(this).hasClass('active')){
            if(index==0){
                go_jurong();
            } else {
                go_manila();
            }
        }
    });



}

function go_training() {
     $( ".tabz-trainings li" ).each(function( index ) {
        if($(this).hasClass('active')){
            if(index==0){
                go_hq()
            } else if(index==1){
                go_jurong();
            } else {
                go_somerset();
            }
        }
    });
}

function go_jurong() {

    var panPoint = new google.maps.LatLng(1.333788,103.739684);
    map.panTo(panPoint);    
    
    beachMarker2.setAnimation(google.maps.Animation.BOUNCE);
}

function go_manila() {

    var panPoint = new google.maps.LatLng(14.581694,121.060860);
    map.panTo(panPoint);
    beachMarker3.setAnimation(google.maps.Animation.BOUNCE);  

}

function go_somerset(){
    var panPoint = new google.maps.LatLng(1.301602,103.837812);
    map.panTo(panPoint);
    beachMarker4.setAnimation(google.maps.Animation.BOUNCE);  
}



google.maps.event.addDomListener(window, 'load');