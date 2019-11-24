var ajax = new XMLHttpRequest;   //request tells the server to get ready to receive a request

// callback function = function to execute when ajax receive response from the server
ajax.onreadystatechange = function () {
    if (ajax.readyState === 4) {  //readyState === 4 means the response is back 
        //ajax.responseText == response from server;

        //code to manipulate html
    }
};

//open the request
ajax.open('GET', urlfromthefiletochange);

//send the request to web server
ajax.send(); //can pass some info



//shoutd use get if we need to receive information from the server
//should use post if we need to send sensible information to the server (allow us to send more infos and not visible in the url)