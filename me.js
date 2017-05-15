
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

var tag = getParameterByName('tag');


function myFunction() {
   setInterval(function(){ 
 var i=0;  
$.ajax({
 async:false,
 type: "POST",
 url: 'me.php',
 data: { key: tag },
 dataType: 'json'
}).done(function( msg ) {

$("#twdiv tr").remove();



$.each(msg[1], function (index, data) {
        
if(data.img)
$("#twdiv").append("<tr><td><img src="+data.src+" alt='dsjh face' height='55px' width='55px' style ='border-radius:50%;' ></td><td>"+data.text+"<h6><img src='TwitterIcon_Black.png' alt='sample' height='25px' width='25px'>@"+data.timeline+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data.time+"</h6></td><td><img src="+data.img+" alt='Smiley face' height='200px'style ='border-radius:10%;' ></td></tr>");
else
$("#twdiv").append("<tr><td><img src="+data.src+" alt='dsjh face' height='55px' width='55px' style ='border-radius:50%; '></td><td>"+data.text+"<h6><img src='TwitterIcon_Black.png' alt='sample' height='25px' width='25px'>@"+data.timeline+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data.time+"</h6></td><td></td></tr>");
    })
$("#cont tr").remove();

$("#cont").append("<tr><th>User</th><th>Tweets Count</th></tr>")
$.each(msg[0], function (index, data) {

i++;
 $("#cont").append("<tr class='active'><td><h5>@"+index+"</h5></td><td><h5><img src='logo.png' alt='sample' height='10px' width='10px'>"+" "+data+"</h5></td></tr>");
if(i==5){
return false;
}

    })








});


   }, 10000);

}
myFunction();
