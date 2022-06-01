var ajax;

$(document).ready(function () {
    
    setAjax();
    fetchAjaxData();



});

function setAjax(){
    ajax = new XMLHttpRequest();
    var method = 'GET';
    var url = 'dataReceiver.php';
    var asynchronous = true;

    ajax.open(method,url,asynchronous);

    sendAjax();

}

function sendAjax(){
    ajax.send();
}

function fetchAjaxData(){
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var information = convertJSONtoArray(this.responseText);
           //0- authors
           //1- books
           //2-genres
            console.log(information);
           


       }
    };

        
   
    
}

function convertJSONtoArray(json){
    var data = JSON.parse(json);
    return data;
}