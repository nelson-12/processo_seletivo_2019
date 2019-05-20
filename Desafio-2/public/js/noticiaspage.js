 
 $(document).ready(function () {
        var proxyUrl = 'https://cors-anywhere.herokuapp.com/',
         url = 'http://www.marcha.cnm.org.br/webservice/noticias'
    fetch( proxyUrl + url).then(res => res.json())
    .then(json => { 
      var result = json;
      console.log(result);
    })
    

    });